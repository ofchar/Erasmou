<?php

namespace App\Http\Controllers\Web;

use App\Helpers\Rate\RatesInfoAdderHelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\Web\UniversityResource;
use App\Models\Rate;
use App\Models\University;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class UniversityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = QueryBuilder::for(University::class)
            ->allowedFilters(
                'name',
                AllowedFilter::scope('country_uuid'),
                AllowedFilter::scope('city_uuid'),
                AllowedFilter::scope('search'),
            )
            ->allowedSorts(
                'created_at',
            )
            ->with('city')
            ->with('faculties')
            ->paginate(15);

        $data = RatesInfoAdderHelper::addRates($data, University::class);

        return UniversityResource::collection($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return response()->json([], 501);
    }

    /**
     * Display the specified resource.
     *
     * @param  University  $university
     * @return \Illuminate\Http\Response
     */
    public function show(University $university)
    {
        $data = RatesInfoAdderHelper::addRates([$university], University::class);

        return new UniversityResource($data[0]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  University  $university
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, University $university)
    {
        return response()->json([], 501);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  University  $university
     * @return \Illuminate\Http\Response
     */
    public function destroy(University $university)
    {
        return response()->json([], 501);
    }
}
