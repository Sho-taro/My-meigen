<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\PostCreateRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostCreateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(PostCreateRequest $request)
    {
        // ユーザーidと新規投稿フォームの入力内容を取得して保存
        $post = new Post;
        $post->user_id = $request->user()->id;
        $post->content = $request->postContent();
        $post->save();

        // // New画面から移動してきたなら、New画面にリダイレクト
        // // Feature画面から移動してきたなら、Feature画面にリダイレクト
        if ($request->fullUrl() === route('post.new.index')){
            return redirect()->route('post.new.index');
        } elseif ($request->fullUrl() === route('post.feature.index')){
            return redirect()->route('post.feature.index');
        }
    }
}
