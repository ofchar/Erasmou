<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\Web\UserResource;
use App\Models\City;
use App\Models\Country;
use App\Models\User;
use App\Models\VerificationCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|unique:users,username',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|unique:users,phone',
            'password' => 'required|string',
            'bio' => 'nullable|string',
            'country_uuid' => 'required|uuid',
            'city_uuid' => 'required|uuid',
            'verification_code' => 'nullable|string',
        ]);

        $country = Country::whereUuid($request->country_uuid)->firstOrFail();
        $city = City::whereUuid($request->city_uuid)->firstOrFail();

        DB::beginTransaction();

        if(isset($request->verification_code)) {
            $verificationCode = VerificationCode::whereCode($request->verification_code)->firstOrFail();

            if($verificationCode->uses_left == -1) {
                $type = User::TYPE_ERASMUS;
            }
            else if($verificationCode->uses_left > 0) {
                $type = User::TYPE_ERASMUS;

                $verificationCode->uses_left = $verificationCode->uses_left - 1;
                $verificationCode->save();
            }
            else {
                return response()->json([
                    'error' => 'Verification code used',
                ], 403);
            }
        }
        else {
            $type = User::TYPE_USER;
        }

        $user = User::create([
            'username' => $request->username,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'bio' => $request->bio,
            'type' => $type,
            'country_id' => $country->id,
            'city_id' => $city->id,
            'password' => Hash::make($request->password),
        ]);

        DB::commit();

        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if(Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return response()->json([
                'status' => 'ok',
                'error' => null,
                'user' => new UserResource(Auth::user()),
            ]);
        }

        return response()->json([
            'error' => 'wrong credentials',
        ]);
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->json([
            'status' => 'ok',
        ], 200);
    }


    public function verify(User $user, Request $request) {
        $request->validate([
            'verification_code' => 'nullable|string',
        ]);

        $verificationCode = VerificationCode::whereCode($request->verification_code)->firstOrFail();

        if($verificationCode->uses_left == -1) {
            //all ok
        }
        else if($verificationCode->uses_left > 0) {
            $verificationCode->uses_left = $verificationCode->uses_left - 1;
            $verificationCode->save();
        }
        else {
            return response()->json([
                'error' => 'Verification code used',
            ], 403);
        }

        $user->type = User::TYPE_ERASMUS;
        $user->save();

        return response()->json([], 200);
    }
}
