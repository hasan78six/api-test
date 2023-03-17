<?php

namespace App\Http\Controllers;

use App\Models\MerchantProduct;
use App\Models\User;
use Illuminate\Http\Request;
use stdClass;
use Exception;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $user = User::where("id", auth()->user()->id)->with("merchant:merchant_users.id,user_id,merchant_id")->first();

            $products = MerchantProduct::select('id', 'product_id', 'price')->where("merchant_id", $user->merchant->merchant_id)
                ->with("detail:products.id,name,product_type")->get();

            $output = [];

            foreach ($products as $product) {
                $obj = new stdClass();
                $obj->id = $product->id;
                $obj->name = $product->detail->name;
                $obj->price = $product->price;
                $output[$product->detail->type->type][] = $obj;
            }

            return response()->json($output, 200);
        } catch (Exception $ex) {
            return response()->json([
                "message" => $ex->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
}
