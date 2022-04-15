<?php


namespace App\Service;


use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PostService
{
    public function store($data)
    {
        try {
            DB::beginTransaction();

            if(isset($data['tag_ids'])){
                $tag_ids = $data['tag_ids'];
                unset($data['tag_ids']);
            }

            if(isset($data['main_image'])){
                $data['main_image'] = Storage::disk('public')->put('/images/main', $data['main_image']);
            }
            if(isset($data['preview_image'])){
                $data['preview_image'] = Storage::disk('public')->put('/images/preview', $data['preview_image']);
            }

            $post = Post::firstOrCreate($data); // the same as - Category::firstOrCreate(['title'=> $data['title']]);

            if(isset($tag_ids)){
                $post->tags()->attach($tag_ids);
            }

            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
            abort(500);
        }
    }

    public function update($data, $post){
        try {
            DB::beginTransaction();

            if(isset($data['tag_ids'])){
                $tag_ids = $data['tag_ids'];
                unset($data['tag_ids']);
            }

            if(isset($data['main_image'])){
                $data['main_image'] = Storage::disk('public')->put('/images/main', $data['main_image']);
            }
            if(isset($data['preview_image'])){
                $data['preview_image'] = Storage::disk('public')->put('/images/preview', $data['preview_image']);
            }

            $post->update($data);
            if(isset($tag_ids)){
                $post->tags()->sync($tag_ids);
            }

            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
            abort(500);
        }



        return $post;
    }
}
