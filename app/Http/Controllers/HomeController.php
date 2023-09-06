<?php

namespace App\Http\Controllers;

use App\Repositories\PostRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, PostRepository $postRepository)
    {
        if ($request->has('search') && $request->get('search') !== null) {
            $posts = $postRepository->searchPost($request->get('search'))
                ->paginate(3, page: $request->get('page', 1))
                ->withQueryString();
        } else {
            $posts = $postRepository->getAllPosts()
                ->paginate(3, page: $request->get('page', 1))
                ->withQueryString();
        }

        session()->put('posts', $posts);

        return view('welcome')->with(['posts' => $posts]);
    }
}
