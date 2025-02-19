<x-layout>
    <!-- posts -->
    <div class="m-8 p-2 border border-slate-300 rounded">

        <!-- back button -->
        <a href="{{ url()->previous() }}" class="text-blue-500 hover:text-blue-600">
            <svg class="inline-block w-4 h-4 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M15 18l-6-6 6-6" /></svg>
            Back
        </a>

        <h2 class="text-2xl font-bold ">{{ $post->title }}</h2>
        <p class="mt-2 ">{{ $post->date->format('d F Y') }}</p>
        <div class="mt-2 prose max-w-none">{!! $post->content !!}</div>

    </div>
</x-layout>
