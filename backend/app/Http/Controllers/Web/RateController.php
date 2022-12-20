<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\Web\RateResource;
use App\Models\Rate;
use App\Models\Rateable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RateController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'targetable_type' => 'required|string',
            'targetable_uuid' => 'required|uuid',
            'rateable_uuid' => 'required|uuid',
            'value' => 'required|string',
            'comment' => 'nullable|string',
        ]);

        $targetableType = $request->targetable_type;
        $targetable = $targetableType::whereUuid($request->targetable_uuid)->firstOrFail();

        $rateable = Rateable::whereUuid($request->rateable_uuid)->firstOrFail();

        $rate = Rate::create([
            'targetable_type' => $targetableType,
            'targetable_id' => $targetable->id,
            'rateable_id' => $rateable->id,
            'value' => $request->value,
            'comment' => $request->comment,
            'user_id' => Auth::user()->id,
        ]);

        return new RateResource($rate);
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
}
