<?php

namespace App\Repositories;

use App\Data\Post;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\MarkdownConverter;
use Phiki\CommonMark\PhikiExtension;
use Phiki\Theme\Theme;
use SplFileInfo;

class PostRepository
{
    public function getPostCollection(): Collection
    {
        $files = Cache::get('files');
        if ($files != null && $files instanceof Collection) {
            return $files;
        }

        $files = collect(File::allFiles(storage_path('markdown/posts')))
            ->filter(function (SplFileInfo $file) {
                return $file->getExtension() === 'md';
            })
            ->map(function (SplFileInfo $file) {
                return $this->makePost($file);
            });

        Cache::forever('files', $files);

        return $files;
    }

    public function makePost(SplFileInfo $file): Post
    {
        $environment = new Environment;
        $environment
            ->addExtension(new CommonMarkCoreExtension)
            ->addExtension(new PhikiExtension(
                theme: Theme::KanagawaWave,
                withWrapper: true,
            ));

        $converter = new MarkdownConverter($environment);

        $content = $converter->convert(File::get($file->getPathname()));
        // $content = Str::markdown(File::get($file->getPathname()), config('markdown'));
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

    public function getAllPosts(): Collection
    {
        return $this->getPostCollection()
            ->sortByDesc('date');
    }

    public function findPost(string $slug): ?Post
    {
        $file = $this->getPostCollection()
            ->filter(function (Post $post) use ($slug) {
                return Str::contains($post->title, $slug);
            })
            ->first();
        return $file ? $this->makePost($file) : null;
    }

    public function searchPost(string $search): Collection
    {
        return $this->getPostCollection()
            ->filter(function (Post $post) use ($search) {
                $keyword = Str::lower($search);
                return Str::contains($post->content, $keyword) || Str::contains($post->title, $keyword);
            })
            ->sortByDesc('date');
    }
}
