<?php

namespace App\Http\Controllers;

use App\Http\Requests\TopicCreateRequest;
use App\Http\Requests\UpdateTopicRequest;
use App\Http\Resources\TopicResource;
use App\Models\Post;
use App\Models\Topic;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class TopicController extends Controller
{

    public function index()
    {
        $topic = Topic::latestFirst()->paginate(5);
        //use eager loading, this is only for test purpose!!!
        return TopicResource::collection($topic);
    }

    public function create()
    {
        //
    }

    public function store(TopicCreateRequest $request)
    {
        $topic = new Topic();
        $topic->title = $request->title;
        $topic->user()->associate($request->user());

        $post = new Post();
        $post->body = $request->body;
        $post->user()->associate($request->user());

        $topic->save();
        $topic->posts()->save($post);

        //this is not eager loading this only for test should not be used for real project!!!!

        return new TopicResource($topic);
    }

    public function show($topic)
    {
        $data = Topic::find($topic);
        return new TopicResource($data);
    }

    public function edit(Topic $topic)
    {

    }

    public function update(UpdateTopicRequest $request,$topic)
    {
        $myTopic = Topic::find($topic);
        $myTopic->title = $request->title;
        $myTopic->save();
        return new TopicResource($myTopic);
    }

    public function destroy(Topic $topic)
    {
        //
    }
}
