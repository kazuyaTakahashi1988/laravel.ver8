<x-app-layout>
    <x-slot name="meta">
        <meta name="description" content='コメント投稿'>
        <meta name="keywords" content="">
        <title>コメント投稿 | {{ config('app.name', 'Q & A site - ナゼナゼの実 -') }}</title>

        <meta name="robots" content="noindex , nofollow">
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            コメント投稿
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="bg-white py-6 sm:py-8 lg:py-12">
                    <!-- Form -->
                    <div class="bg-white sm:py-8 lg:py-12">
                        <div class="max-w-screen-2xl px-4 md:px-8 mx-auto">
                            @if ($errors->any())
                            <div class="w-full bg-red-50 text-red-800 border focus:ring ring-indigo-300 rounded outline-none transition duration-100 px-3 py-2">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li style="color: red;">{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div><br>
                            @endif
                            <!-- form - start -->
                            <form class="max-w-screen-md grid sm:grid-cols-2 gap-4 mx-auto" action="{{ route('comments.store') }}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}

                                <div class="sm:col-span-2">
                                    <label for="comment" class="inline-block text-gray-800 text-sm sm:text-base mb-2"><b>コメント内容</b></label>
                                    <textarea name="comment" id="ckeditor" class="content w-full bg-gray-50 text-gray-800 border focus:ring ring-indigo-300 rounded outline-none transition duration-100 px-3 py-3">{{ old('content' , '') }}</textarea>
                                </div>
                                <input name="post_id" type="hidden" value="{{ $post_id }}" />
                                <div class="m-3">
                                    <button class="shadow-lg px-2 py-1  bg-indigo-500 text-lg text-white font-semibold rounded  hover:bg-blue-500 hover:shadow-sm hover:translate-y-0.5 transform transition ">Create</button>
                                </div>
                            </form>
                            <!-- form - end -->
                        </div>
                    </div>
                    <!-- Form end -->
                </div>
            </div>
        </div>
    </div>
    <?php /* --------------------------------------------------
        ▽ CKeditor 読み込み ▽
    ----------------------------------------------------------- */ ?>
    <script src="{{ asset('ckeditor/ckeditor.js')}}"></script>
    <script>
        CKEDITOR.replace('ckeditor', {
            filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token() ]) }}",
            filebrowserUploadMethod: 'form',
            // スペルチェック機能OFF
            scayt_autoStartup: false,
            // Enterを押した際に改行タグを挿入
            enterMode: CKEDITOR.ENTER_BR,
            // Shift+Enterを押した際に段落タグを挿入
            shiftEnterMode: CKEDITOR.ENTER_P,
            // idやclassを指定可能にする
            allowedContent: true,
            // preコード挿入時
            format_pre: {
                element: "pre",
                attributes: {
                    class: "code",
                },
            },
            // タグのパンくずリストを削除
            removePlugins: "elementspath",

            // webからコピペした際でもプレーンテキストを貼り付けるようにする
            forcePasteAsPlainText: true,

            // 自動で空白を挿入しないようにする
            fillEmptyBlocks: false,

            // タブの入力を無効にする
            tabSpaces: 0,

        });
    </script>
</x-app-layout>