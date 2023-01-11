<?php

namespace App\Http\Controllers\Web;

use App\Helpers\Rate\RatesInfoAdderHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\Web\ApartmentResource;
use App\Models\Apartment;
use App\Models\City;
use App\Models\Landlord;
use App\Models\Rate;
use App\Models\Rateable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = QueryBuilder::for(Apartment::class)
            ->allowedFilters(
                'name',
                AllowedFilter::exact('foreign_url'),
                AllowedFilter::exact('longitude'),
                AllowedFilter::exact('latitude'),
                AllowedFilter::scope('landlord_uuid'),
                AllowedFilter::scope('user_uuid'),
                AllowedFilter::scope('city_uuid'),
                AllowedFilter::scope('search'),
            )
            ->allowedSorts(
                'name',
                'created_at',
            )
            ->paginate(15);

        $data = RatesInfoAdderHelper::addRates($data, Apartment::class);

        return ApartmentResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Gate::allows('create-content')) {
            abort(403);
        }

        $request->validate([
            'landlord_uuid' => 'nullable|uuid',
            'landlord_name' => 'nullable|string',
            'landlord_email' => 'nullable|email|unique:landlords,email',
            'landlord_phone' => 'nullable|string|unique:landlords,phone',
            'landlord_website' => 'nullable|string|unique:landlords,website',

            'name' => 'required|string',
            'description' => 'nullable|string',
            'foreign_url' => 'nullable|string',
            'road' => 'required|string',
            'building_number' => 'required|string',
            'apartment_number' => 'nullable|string',
            'city_uuid' => 'required|uuid',
        ]);

        $city = City::whereUuid($request->city_uuid)->firstOrFail();

        DB::beginTransaction();

        $landlord = null;
        if(isset($request->landlord_uuid)) {
            $landlord = Landlord::whereUuid($request->landlord_uuid)->firstOrFail();
        }
        else {
            $landlord = Landlord::create([
                'name' => $request->landlord_name,
                'email' => $request->landlord_email,
                'phone' => $request->landlord_phone,
                'website' => $request->landlord_website,
                'user_id' => Auth::user()->id,
                'city_id' => $city->id,
            ]);
        }

        $apartment = Apartment::create([
            'landlord_id' => $landlord->id,
            'user_id' => Auth::user()->id,
            'city_id' => $city->id,
            'name' => $request->name,
            'description' => $request->description,
            'foreign_url' => $request->foreign_url,
            'road' => $request->road,
            'building_number' => $request->building_number,
            'apartment_number' => $request->apartment_number,
        ]);

        DB::commit();

        return new ApartmentResource($apartment);
    }

    /**
     * Display the specified resource.
     *
     * @param  Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
        $data = RatesInfoAdderHelper::addRates([$apartment], Apartment::class);

        return new ApartmentResource($data[0]);
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
