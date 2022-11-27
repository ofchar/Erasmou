<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\Web\ApartmentResource;
use App\Models\Apartment;
use App\Models\Rate;
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

        foreach ($data as &$apartment) {
            $rates = Rate::where('rates.targetable_type', '=', Apartment::class)
                ->join('rateables', 'rates.rateable_id', '=', 'rateables.id')
                ->where('rates.targetable_id', '=', $apartment->id)
                ->groupBy('rates.rateable_id', 'rateables.name', 'rateables.min_value', 'rateables.max_value')
                ->select('rates.rateable_id', 'rateables.name as rateable_name', 'rateables.min_value as rateable_min_value', 'rateables.max_value as rateable_max_value',  DB::raw('avg(rates.value::real) as avg'))
                ->get();

            foreach ($rates as $rate) {
                $maxAdjusted = $rate->rateable_max_value;
                $valueAdjusted = $rate->avg;
                $min = $rate->rateable_min_value;

                if($min < 0) {
                    $maxAdjusted = $maxAdjusted + abs($min);
                    $valueAdjusted = $valueAdjusted + abs($min);
                }
                else if ($min > 0) {
                    $maxAdjusted = $maxAdjusted - $min;
                    $valueAdjusted = $valueAdjusted - $min;
                }

                $result = $valueAdjusted / $maxAdjusted;

                if($result <= 0.35) {
                    $parsedValue = -1;
                }
                else if ($result >= 0.65) {
                    $parsedValue = 1;
                }
                else {
                    $parsedValue = 0;
                }

                $apartment[$rate->rateable_name] = $parsedValue;
                $apartment[$rate->rateable_name . '_original'] = $rate->avg;
            }
        }
        unset($apartment);

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
