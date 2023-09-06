<?php

namespace App\Repositories;

use App\Data\Post;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use SplFileInfo;

class PostRepository
{
    public function getAllPosts(): Collection
    {
        return collect(File::allFiles(storage_path('markdown/posts')))
            ->filter(function (SplFileInfo $file) {
                return $file->getExtension() === 'md';
            })
            ->map(function (SplFileInfo $file) {
                return $this->makePost($file);
            })
            ->sortByDesc('date');
    }

    public function makePost(SplFileInfo $file): Post
    {
        $content = Str::markdown(File::get($file->getPathname()), config('markdown'));
        $title = Str::betweenFirst($content, "title: ", "\n");
        $title = Str::replace("'", "", $title);
        $date = Str::betweenFirst($content, "date: ", "</h2>");
        $desc = Str::betweenFirst($content, "<p>", "</p>");
        $content = Str::after($content, "</h2>");

        return new Post(
            title: $title,
            slug: Str::slug($title),
            date: Carbon::createFromFormat('Y-m-d H:i:s', (Str::replace("'", "", $date))),
            content: $content,
            desc: $desc
        );
    }

    public function findPost(string $slug): ?Post
    {
        $file = collect(File::allFiles(storage_path('markdown/posts')))
            ->filter(function (SplFileInfo $file) {
                return $file->getExtension() === 'md';
            })
            ->filter(function (SplFileInfo $file) use ($slug) {
                $content = Str::lower(Str::markdown(File::get($file->getPathname()), config('markdown')));
                $title = Str::betweenFirst($content, "title: ", "\n");
                $title = Str::slug(Str::replace("'", "", $title));
                return Str::contains($title, $slug);
            })
            ->first();
        return $file ? $this->makePost($file) : null;
    }

    public function searchPost(string $search): Collection
    {
        return collect(File::allFiles(storage_path('markdown/posts')))
            ->filter(function (SplFileInfo $file) {
                return $file->getExtension() === 'md';
            })
            ->filter(function (SplFileInfo $file) use ($search) {
                $content = Str::lower(Str::markdown(File::get($file->getPathname()), config('markdown')));
                $keyword = Str::lower(Str::title(str_replace('-', ' ', $search)));
                return Str::contains($content, $keyword);
            })
            ->map(function (SplFileInfo $file) {
                return $this->makePost($file);
            })
            ->sortByDesc('date');
    }
}
