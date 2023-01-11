<?php

namespace App\Http\Controllers\Web;

use App\Helpers\Rate\RatesInfoAdderHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\Web\VerificationCodeResource;
use App\Models\Apartment;
use App\Models\Rate;
use App\Models\Rateable;
use App\Models\VerificationCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class VerificationCodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = QueryBuilder::for(VerificationCode::class)
            ->paginate(15);

        return VerificationCodeResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Gate::allows('create-codes')) {
            abort(403);
        }

        $request->validate([
            'uses' => 'required|numeric',
        ]);

        $code = VerificationCode::create([
            'code' => bin2hex(random_bytes(16)),
            'uses_left' => $request->uses,
            'user_id' => Auth::user()->id,
        ]);

        return new VerificationCodeResource($code);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  VerificationCode  $verificationCode
     * @return \Illuminate\Http\Response
     */
    public function destroy(VerificationCode $verificationCode)
    {
        if (!Gate::allows('create-codes')) {
            abort(403);
        }

        $verificationCode->delete();

        return response()->json([], 200);
    }
}
