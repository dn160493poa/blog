<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Tag\StoreRequest;
use App\Models\Tag;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        Tag::firstOrCreate($data); // the same as - Tag::firstOrCreate(['title'=> $data['title']]);

        return redirect()->route('admin.tag.index');
    }
}
