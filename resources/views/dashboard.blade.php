<x-app-layout>
    <x-slot name="meta">
        <meta name="description" content='ダッシュボード'>
        <meta name="keywords" content="">
        <title>ダッシュボード | {{ config('app.name', 'welcome to Q & A site!') }}</title>

        <?php /* OGP meta */ ?>
        <meta property="og:site_name" content="{{ config('app.name', 'welcome to Q & A site!') }}">
        <meta property="og:url" content="<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">
        <meta property="og:title" content="ダッシュボード">
        <meta property="og:description" content='「Q & A site - ナゼナゼの実 -」 は質問を投稿、及び回答することができるC to C サービスです。質問者の投稿に気軽にコメントとリプライを送ることができ、名前とメールアドレスの登録だけで簡単に始められます。'>
        <meta property="og:image" content="<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']; ?>/ogp.jpg">
        <meta property="og:locale" content="ja_JP">
        <meta property="fb:admins" content="xxxxxxxxx">
        <meta property="og:type" content="article">
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard  　　- 開発中 -') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-jet-welcome />
            </div>
        </div>
    </div>
</x-app-layout>