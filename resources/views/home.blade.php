<x-app-layout>
    <x-slot name="meta">
        <meta name="description" content='ホーム'>
        <meta name="keywords" content="">
        <title>{{ config('app.name', 'Q & A site - ナゼナゼの実 -') }}</title>

        <?php /* OGP meta */ ?>
        <meta property="og:site_name" content="{{ config('app.name', 'Q & A site - ナゼナゼの実 -') }}">
        <meta property="og:url" content="<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">
        <meta property="og:title" content="Q & A site - ナゼナゼの実 -">
        <meta property="og:description" content='「Q & A site - ナゼナゼの実 -」 は質問を投稿、及び回答することができるC to C サービスです。質問者の投稿に気軽にコメントとリプライを送ることができ、名前とメールアドレスの登録だけで簡単に始められます。'>
        <meta property="og:image" content="<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']; ?>/ogp.jpg">
        <meta property="og:locale" content="ja_JP">
        <meta property="fb:admins" content="xxxxxxxxx">
        <meta property="og:type" content="website">
        <meta name="twitter:card" content="summary_large_image" />
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <!-- {{ __('Top') }} -->
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-jet-welcome />
            </div>
        </div>
    </div>


    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6 qList">
        <h2 class="p-6 font-semibold text-xl text-gray-800 leading-tight bg-white shadow">
            新着 Q & A
        </h2>
        <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2">
            @foreach($posts as $post)
            <div class="border-white">
                <a class="p-6" href="/posts/{{ $post->id }}">
                    <div class="flex items-center">
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-400">
                            <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold q-title">Q：{{ $post->title }}</div>
                    </div>

                    <div class="ml-12">
                        <div class="mt-2 text-sm text-gray-500">
                            ユーザー：{{ $post->user->name }}<br>
                            カテゴリー：{{ $post->category->category_name }}<br>
                        </div>
                        <div class="qContext mt-2 text-sm text-gray-500">
                            {{ strip_tags($post->content) }}
                        </div>

                        <span>
                            <div class="mt-3 flex items-center text-sm font-semibold text-indigo-700">
                                <div>Read More</div>

                                <div class="ml-1 text-indigo-500">
                                    <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <!-- <img class="h-10 w-10 rounded-full object-cover ml-auto" src="{{ $post->user->profile_photo_url }}" alt="{{ $post->user->name }}" /> -->
                                <img class="h-10 w-10 rounded-full object-cover ml-auto" src="{{ asset('storage/profile-photos/'.$post->user->icon_img) }}" alt="{{ $post->user->name }}" />
                            </div>
                        </span>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>