<?php

namespace App\Http\Controllers\Web;

use App\Helpers\Rate\RatesInfoAdderHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\Web\CityResource;
use App\Models\City;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = QueryBuilder::for(City::class)
            ->allowedFilters(
                'name',
                AllowedFilter::scope('country_uuid'),
                AllowedFilter::scope('province_uuid'),
                AllowedFilter::scope('search'),
            )
            ->allowedSorts(
                'name',
                'population',
                'created_at',
            )
            ->defaultSort('-population')
            ->with('country')
            ->with('province')
            ->with('universities')
            ->paginate($request->per_page ?? 15);

        $data = RatesInfoAdderHelper::addRates($data, City::class);

        return CityResource::collection($data);
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
     * @param  City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        return new CityResource($city);
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
