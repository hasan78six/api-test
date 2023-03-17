<?php

namespace App\Http\Controllers;

use App\Models\MerchantUser;
use App\Models\User;
use App\Models\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Setting up validation rules for api
    private $rules = [
        'first_name' => ["required", "string", 'max:30'],
        'last_name' => ["required", 'string', 'max:30'],
        "email" => ["required", 'string', 'max:50'],
        "password" => ["required", 'string', 'confirmed', 'max:30']
    ];

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return string[]
     */
    public function store(Request $request)
    {
        try {
            $this->rules["merchant"][] = ["required", "integer"];
            $data = $request->validate($this->rules);

            // Defining transaction scope
            $user = DB::transaction(
                function () use ($data) {
                    $data["password"] = Hash::make($data["password"]);
                    $user = User::create($data);

                    MerchantUser::create(["merchant_id" => $data["merchant"], "user_id" => $user->id]);

                    return $user;
                });

            $token = $user->createToken(sha1(time()))->plainTextToken;

            return response()->json([
                "data" => ["info" => $user, "token" => $token],
                "message" => "User created successfully."
            ], 201);
        } catch (Exception $ex) {
            return response()->json([
                "message" => $ex->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function login(Request $request)
    {
        try {
            $fields = $request->validate([
                "email" => ["required", 'string', 'max:50'],
                "password" => ["required", 'string', 'max:30']
            ]);

            $user = User::where([
                "email" => $fields["email"],
                "user_type" => UserType::USER,
                "status" => User::STATUS_ACTIVE
            ])->first();

            if (!$user && !Hash::check($fields["password"], $user->password)) {
                return response()->json([
                    "message" => "No user found with this username or password"
                ], 200);
            }

            $token = $user->createToken(sha1(time()))->plainTextToken;

            return response()->json([
                "data" => ["info" => $user, "token" => $token],
                "message" => "Logged in successfully."
            ], 201);
        } catch (Exception $ex) {
            return response()->json([
                "message" => $ex->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            $data = $request->validate(array_map(function ($rule) {
                unset($rule[array_search('required', $rule)]);
                return $rule;
            }, $this->rules));

            $user = auth()->user();

            // Defining transaction scope
            $status = DB::transaction(
                function () use ($user, $data) {
                    if (isset($data["password"])) {
                        $data["password"] = Hash::make($data["password"]);
                    }

                    return $user->update($data);
                });

            if ($status) {
                return response()->json([
                    "message" => "User edit successfully."
                ], 200);
            } else {
                return response()->json([
                    "message" => "Something went wrong. Please try again."
                ], 200);
            }

        } catch (Exception $ex) {
            return response()->json([
                "message" => $ex->getMessage()
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            auth()->user()->tokens()->delete();

            return response()->json([
                "message" => "Logged out"
            ], 200);
        } catch (Exception $ex) {
            return response()->json([
                "message" => $ex->getMessage()
            ], 500);
        }
    }
}
