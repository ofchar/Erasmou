<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\Web\ForumResource;
use App\Models\Forum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = QueryBuilder::for(Forum::class)
            ->allowedFilters(
                'name',
                AllowedFilter::exact('forumable_type'),
                AllowedFilter::scope('forumable_uuid'),
                AllowedFilter::scope('search'),
            )
            ->allowedSorts(
                'name',
                'created_at',
            )
            ->with('post')
            ->withCount('posts')
            ->paginate(15);

        return ForumResource::collection($data);
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
            'forumable_type' => 'required|string',
            'forumable_uuid' => 'required|uuid',
            'name' => 'required|string',
            'description' => 'required|string',
        ]);

        $forumableType = $request->forumable_type;
        $forumable = $forumableType::whereUuid($request->forumable_uuid)->firstOrFail();

        $forum = Forum::create([
            'forumable_type' => $forumableType,
            'forumable_id' => $forumable->id,
            'name' => $request->name,
            'description' => $request->description,
            'user_id' => Auth::user()->id,
        ]);

        return new ForumResource($forum);
    }

    /**
     * Display the specified resource.
     *
     * @param  Forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function show(Forum $forum)
    {
        return new ForumResource($forum);
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
