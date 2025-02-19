<?php

namespace App\Http\Controllers;

use App\Repositories\PostRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use SplFileInfo;

class PostDetailController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, string $slug, PostRepository $postRepository)
    {
        $post = $postRepository->findPost($slug);
        if ($post === null)  abort(404);

        return view('post-detail', compact('post'));
    }
}
