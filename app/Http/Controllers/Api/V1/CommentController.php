<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Comment;
use App\Http\Resources\CommentResource;
use App\Http\Controllers\Controller;
class CommentController extends Controller
{
    public function index()
    {
        return CommentResource::collection(Comment::all());
    }

    public function show(Comment $comment){
        return CommentResource::make($comment);
    }

    public function store(StoreCommentRequest $request) 
    {
        return new CommentResource(Comment::create($request->validated()));
    }

    public function update(UpdateCommentRequest $request, Comment $comment)
    {
        $comment->update($request->validated());
        return CommentResource::make($comment);
    }    

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return response()->noContent();
    }
}
