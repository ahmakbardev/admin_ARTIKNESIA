<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ArticleImageController extends Controller
{
    public function upload(Request $request): ?JsonResponse
    {
        if ($request->hasFile('upload')) {
            Log::info($request->file('upload')->getClientOriginalName());

            $file = $request->file('upload');
            $name = $file->getClientOriginalName();
            $name = Str::slug($name);
            $img = Image::make($file);
            $img->stream();
            $name = str_replace('png', '', $name) . '.png';

            $fileName = $file->store('media', 'public');

            return response()->json(['fileName' => $name, 'uploaded' => 1, 'url' => asset("storage/$fileName")]);
        }

        return null;
    }
}
