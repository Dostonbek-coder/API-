<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 200,
            'data' => Post::with('user')->get(),
        ]);
    }

    public function store(StorePostRequest $request)
    {
        $post = Post::create($request->validated());

        return response()->json([
            'status' => 201,
            'message' => 'Post muvaffaqiyatli yaratildi',
            'data' => $post,
        ],201);
    }

    public function show($id)
    {
        $post = Post::with('user')->find($id);

        if (!$post) {
            return response()->json([
                'status' => 404,
                'message' => 'Post topilmadi',
            ],404);
        }

        return response()->json([
            'status' => 200,
            'data' => $post,
        ],200);
    }

    public function update(UpdatePostRequest $request, $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'status' => 404,
                'message' => 'Post topilmadi',
            ],404);
        }

        $post->update($request->validated());

        return response()->json([
            'status' => 200,
            'message' => 'Post muvaffaqiyatli yangilandi',
            'data' => $post,
        ],200);
    }

    public function destroy($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'status' => 404,
                'message' => 'Post topilmadi',
            ],404);
        }

        $post->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Post o‘chirildi',
        ],404);
    }
}
