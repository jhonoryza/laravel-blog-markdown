<x-layout>
    <!-- pagination link -->
    <div class="m-8">
        {{ $posts->links() }}
    </div>

    <div class="m-8">
        <form action="{{ route('home') }}" method="get">
            <input class="border border-slate-400 rounded shadow p-2 hover:border-slate-500"
            type="search" name="search" id="search" placeholder="Search ..."
            value="{{ old('search', request('search')) }}">
        </form>
    </div>

    <!-- posts -->
    @foreach ($posts as $post)
    <div class="m-8 p-4 border border-slate-300 rounded shadow hover:shadow-lg transition duration-100 ease in-out transform hover:-translate-y-1">
        <a href="{{ route('posts.show', $post->slug) }}" class="text-2xl font-bold hover:cursor-pointer">
            {{ $post->title }}
        </a>
        <p class="mt-2 text-sm">{{ $post->date->format('d F Y') }}</p>
        <p class="mt-2">{{ $post->desc }}</p>
    </div>
    @endforeach

</x-layout>
