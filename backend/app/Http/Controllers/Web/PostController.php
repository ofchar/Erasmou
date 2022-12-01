<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\Web\PostResource;
use App\Models\Forum;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = QueryBuilder::for(Post::class)
            ->allowedFilters(
                'title',
                AllowedFilter::scope('forum_uuid'),
                AllowedFilter::scope('user_uuid'),
                AllowedFilter::scope('search'),
            )
            ->allowedSorts(
                'created_at',
            )
            ->with('user')
            ->paginate(15);

        return PostResource::collection($data);
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
            'forum_uuid' => 'required|uuid',
            'title' => 'required|string',
            'body' => 'required|string',
        ]);

        $forum = Forum::whereUuid($request->forum_uuid)->firstOrFail();

        $post = Post::create([
            'forum_id' => $forum->id,
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => Auth::user()->id,
        ]);

        return new PostResource($post);
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
