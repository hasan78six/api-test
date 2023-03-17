<?php

namespace App\Http\Controllers;

use App\Models\MerchantProduct;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;
use Stripe;
use Stripe\Exception\SignatureVerificationException;
use UnexpectedValueException;

class SubscriptionController extends Controller
{
    public function __construct()
    {
        Stripe\Stripe::setApiKey('sk_test_51MmfufLqGnnMwIYJLdTqySHNRt6koVhSQrxXm2HzivfqTvmC9OehwzpcAb2JO8JmwrQYxXDDiCGdNrPsIL2mN2Bu00Ycyb11rB');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $fields = $request->validate([
                "product" => ["required", "integer"]
            ]);

            if (empty($this->getActiveSubscription())) {
                $product = MerchantProduct::where("id", $fields["product"])->with("detail")->first();

                if (!empty($product)) {
                    $source = Stripe\Source::create([
                        'type' => 'card',
                        'card' => [
                            'number' => '4242424242424242',
                            'exp_month' => 12,
                            'exp_year' => 2024,
                            'cvc' => '123',
                        ],
                    ]);

                    $charge = Stripe\Charge::create([
                        'amount' => ((float)$product->price * 100),
                        'currency' => 'aed',
                        'description' => $product->detail->name,
                        'source' => $source->id
                    ]);

                    if (isset($charge->id)) {
                        $sub = DB::transaction(
                            function () use ($charge, $product) {
                                $sub = Subscription::create([
                                    'merchant_product_id' => $product->id,
                                    'user_id' => auth()->user()->id,
                                    'merchant_partner' => 1,
                                    'transaction_id' => $charge->id,
                                    'status' => Subscription::STATUS_PENDING
                                ]);

                                return $sub;
                            });
                        return response()->json([
                            "data" => ["info" => $sub],
                            "message" => "Product subscribed successfully."
                        ], 201);

                    } else {
                        return response()->json([
                            "message" => "Unable to proceed with this transaction"
                        ], 500);
                    }
                } else {
                    return response()->json([
                        "message" => "Please select valid product"
                    ], 500);
                }
            } else {
                return response()->json([
                    "message" => "You already have active subcription."
                ], 500);
            }
        } catch (Exception $ex) {
            return response()->json([
                "message" => $ex->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    private function getActiveSubscription()
    {
        $subcription = Subscription::where("user_id", auth()->user()->id)
            ->whereIn('status', [Subscription::STATUS_ACTIVE, Subscription::STATUS_PENDING])
            ->get();

        return count($subcription) == 1 ? $subcription[0] : null;
    }

    public function unsubscribe()
    {
        $subscription = $this->getActiveSubscription();

        if (!empty($subscription)) {
            $status = DB::transaction(
                function () use ($subscription) {
                    return $subscription->update(["status" => Subscription::STATUS_CANCELLED]);
                });

            if ($status) {
                return response()->json([
                    "message" => "Subscription unsubcribed successfully."
                ], 200);
            } else {
                return response()->json([
                    "message" => "Something went wrong. Please try again."
                ], 200);
            }
        } else {
            return response()->json([
                "message" => "There is no active subcription that can be unsubscribed."
            ], 200);
        }
    }

    public function updateSubStatus()
    {
        $endpoint_secret = 'whsec_40368e102e6ad5109b203eeac815eae4733edc14a072dd87c8140cd415d0e2da';

        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
            $event = Stripe\Webhook::constructEvent(
                $payload, $sig_header, $endpoint_secret
            );
        } catch (UnexpectedValueException $e) {
            // Invalid payload
            return response()->json(["message" => $e->getMessage()], 500);
        } catch (SignatureVerificationException $e) {
            // Invalid signature
            return response()->json(["message" => $e->getMessage()], 500);
        }

        $data = $event->data->object;
        $subscription = Subscription::where("transaction_id", $data->payment->id)->first();
        // Handle the event
        switch ($event->type) {
            case 'payment_intent.succeeded':
                $subscription->update(["status" => Subscription::STATUS_ACTIVE]);
                break;
            default:
                $subscription->update(["status" => Subscription::STATUS_CANCELLED]);
                break;
        }
    }
}
