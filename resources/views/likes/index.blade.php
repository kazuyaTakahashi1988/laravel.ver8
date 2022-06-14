<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if(!isset($likes[0])) お気に入りがありません @else お気に入り一覧 @endif
        </h2>
    </x-slot>
    
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12 qList">
        <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2">
            @foreach($likes as $like)
            <div class="border-white">
                <a class="p-6" href="/posts/{{ $like->post->id }}">
                    <div class="flex items-center">
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-400">
                            <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">Q：{{ $like->post->title }}</div>
                    </div>

                    <div class="ml-12">
                        <div class="mt-2 text-sm text-gray-500">
                            ユーザー：{{ $like->post->user->name }}<br>
                            カテゴリー：{{ $like->post->category->category_name }}<br>
                        </div>
                        <div class="qContext mt-4 text-sm text-gray-500">
                            {{ $like->post->content }}
                        </div>

                        <span>
                            <div class="mt-3 flex items-center text-sm font-semibold text-indigo-700">
                                <div>Read More</div>

                                <div class="ml-1 text-indigo-500">
                                    <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <img class="h-10 w-10 rounded-full object-cover ml-auto" src="{{ $like->post->user->profile_photo_url }}" alt="{{ $like->post->user->name }}" />
                            </div>
                        </span>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
        <br>{{ $likes->links() }}
    </div>
</x-app-layout>