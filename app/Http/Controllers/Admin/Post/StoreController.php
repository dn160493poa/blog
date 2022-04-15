<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\StoreRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        try {
            $data = $request->validated();
            $tag_ids = $data['tag_ids'];
            unset($data['tag_ids']);

            $data['main_image'] = Storage::disk('public')->put('/images/main', $data['main_image']);
            $data['preview_image'] = Storage::disk('public')->put('/images/preview', $data['preview_image']);

            $post = Post::firstOrCreate($data); // the same as - Category::firstOrCreate(['title'=> $data['title']]);
            $post->tags()->attach($tag_ids);
        }catch (\Exception $exception){

        }


        return redirect()->route('admin.post.index');
    }
}
