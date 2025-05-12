<?php


namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;

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
            'data' => $post,
        ]);
    }


    public function show($id)
    {
        $post = Post::with('user')->find($id);

        if (!$post) {
            return response()->json([
                'status' => 404,
                'message' => 'Post topilmadi',
            ]);
        }

        return response()->json([
            'status' => 200,
            'data' => $post,
        ]);
    }


    public function update(StorePostRequest $request, $id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'status' => 404,
                'message' => 'Post topilmadi',
            ]);
        }

        $post->update($request->validated());

        return response()->json([
            'status' => 200,
            'data' => $post,
        ]);
    }


    public function destroy($id)
    {
        $post = Post::find($id);

        if (!$post) {
            return response()->json([
                'status' => 404,
                'message' => 'Post topilmadi',
            ]);
        }

        $post->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Post o‘chirildi',
        ]);
    }
}
