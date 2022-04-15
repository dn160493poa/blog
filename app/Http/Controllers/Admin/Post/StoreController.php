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
        $data = $request->validated();
        $data['main_image'] = Storage::put('/images/main', $data['main_image']);
        $data['preview_image'] = Storage::put('/images/preview', $data['preview_image']);

        Post::firstOrCreate($data); // the same as - Category::firstOrCreate(['title'=> $data['title']]);

        return redirect()->route('admin.post.index');
    }
}
