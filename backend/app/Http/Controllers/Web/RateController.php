<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\Web\RateResource;
use App\Models\Rate;
use App\Models\Rateable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class RateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = QueryBuilder::for(Rate::class)
            ->allowedFilters(
                AllowedFilter::exact('targetable_type'),
                AllowedFilter::scope('targetable_uuid'),
            )
            ->allowedSorts(
                'created_at',
            )
            ->defaultSort('-created_at')
            ->with('rateable')
            ->with('targetable')
            ->with('user')
            ->paginate($request->per_page ?? 15);

        return RateResource::collection($data);
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
            'opinions' => 'required|array',
            'comments' => 'required|array',
        ]);

        $targetableType = $request->targetable_type;
        $targetable = $targetableType::whereUuid($request->targetable_uuid)->firstOrFail();

        foreach($request->opinions as $rateable_uuid => $opinion) {
            $rateable = Rateable::whereUuid($rateable_uuid)->firstOrFail();

            $comment = array_key_exists($rateable_uuid, $request->comments) ? $request->comments[$rateable_uuid] : null;

            $rate = Rate::create([
                'targetable_type' => $targetableType,
                'targetable_id' => $targetable->id,
                'rateable_id' => $rateable->id,
                'value' => $opinion,
                'comment' => $comment,
                'user_id' => Auth::user()->id,
            ]);
        }

        return response()->json([]);
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
