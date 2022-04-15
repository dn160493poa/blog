<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\UpdateRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, Post $post)
    {
        $data = $request->validated();
        $tag_ids = $data['tag_ids'];
        unset($data['tag_ids']);

        $data['main_image'] = Storage::disk('public')->put('/images/main', $data['main_image']);
        $data['preview_image'] = Storage::disk('public')->put('/images/preview', $data['preview_image']);

        $post->update($data);
        $post->tags()->sync($tag_ids);

        return view('admin.post.show', compact('post'));
    }
}
