<?php

namespace App\Helpers\Rate;

use App\Models\Rate;
use App\Models\Rateable;
use Illuminate\Support\Facades\DB;

class RatesInfoAdderHelper
{
    public static function addRates($data, $class)
    {
        foreach ($data as &$object) {
            $rates = Rate::where('rates.targetable_type', '=', $class)
                ->join('rateables', 'rates.rateable_id', '=', 'rateables.id')
                ->where('rates.targetable_id', '=', $object->id)
                ->whereIn('rateables.data_type', [Rateable::TYPE_OPINION, Rateable::TYPE_NUMERIC])
                ->groupBy('rates.rateable_id', 'rateables.name', 'rateables.min_value', 'rateables.max_value', 'rateables.data_type')
                ->select('rates.rateable_id', 'rateables.name as rateable_name',
                    'rateables.min_value as rateable_min_value', 'rateables.max_value as rateable_max_value',
                    'rateables.data_type as rateable_data_type', DB::raw('avg(rates.value::real) as avg')
                )
                ->get();

            foreach ($rates as $rate) {
                if($rate->rateable_data_type == Rateable::TYPE_OPINION) {
                    $maxAdjusted = $rate->rateable_max_value;
                    $valueAdjusted = $rate->avg;
                    $min = $rate->rateable_min_value;

                    if($min < 0) {
                        $maxAdjusted = $maxAdjusted + abs($min);
                        $valueAdjusted = $valueAdjusted + abs($min);
                    }
                    else if ($min >= 0) {
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

                    $object[$rate->rateable_name] = $parsedValue;
                    $object[$rate->rateable_name . '_original'] = round($rate->avg, 1);
                }
                else if($rate->rateable_data_type == Rateable::TYPE_NUMERIC) {
                    $object[$rate->rateable_name] = round($rate->avg);
                }
            }
        }
        unset($object);

        return $data;
    }
}