<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ImageController extends Controller
{
    public function store($images, $post_id) {
        foreach ($images as $img) {
            $imageName = time() . '_' . $img->getClientOriginalName();
            $img->move(public_path('images/' . $post_id), $imageName);

            $imageData = [
                'image' => 'images/' . $post_id . '/' . $imageName,
                'post_id' => $post_id,
                'created_at' => now(),
                'updated_at' => now()
            ];

            DB::table('images')->insert($imageData);
        }
    }

    public function destroy($post_id) {
        $images = DB::table('images')->where('post_id', '=', $post_id)->select('image')->get();
        foreach ($images as $img) {
            if (isset($img->image)) {
                File::delete($img->image);
            }
        }
        DB::table('images')->where('post_id', '=', $post_id)->delete();
    }
}
