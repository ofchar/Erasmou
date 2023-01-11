<?php

namespace App\Http\Controllers\Web;

use App\Helpers\Rate\RatesInfoAdderHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\Web\ApartmentResource;
use App\Models\Apartment;
use App\Models\Rate;
use App\Models\Rateable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        //
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
