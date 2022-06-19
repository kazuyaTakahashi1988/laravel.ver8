<x-app-layout>
    <x-slot name="meta">
        <meta name="description" content='質問投稿'>
        <meta name="keywords" content="">
        <title>質問投稿 | {{ config('app.name', 'Q & A site - ナゼナゼの実 -') }}</title>

        <meta name="robots" content="noindex , nofollow">
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            質問を投稿できます。
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="bg-white sm:py-8 lg:py-12">
                    <!-- Form -->
                    <div class="bg-white py-6 sm:py-8 lg:py-12">
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
                            <form class="max-w-screen-md grid sm:grid-cols-2 gap-4 mx-auto" action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div>
                                    <label for="title" class="inline-block text-gray-800 text-sm sm:text-base mb-2"><b>タイトル</b></label>
                                    <input name="title" class="w-full bg-gray-50 text-gray-800 border focus:ring ring-indigo-300 rounded outline-none transition duration-100 px-3 py-2" />
                                </div>

                                <div>
                                    <label for="title" class="inline-block text-gray-800 text-sm sm:text-base"><b>サムネイル画像</b></label>
                                    <div id="drag-drop-area" class="w-full bg-gray-50 text-gray-800 border focus:ring ring-indigo-300 rounded outline-none transition duration-100 px-3 py-2">
                                        <div class="drag-drop-inside">
                                            <p class="drag-drop-info">ここにファイルをドロップ</p>
                                            <p>または</p>
                                            <p class="drag-drop-buttons"><input id="fileInput" type="file" value="ファイルを選択" name="image"></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="category_id" class="inline-block text-gray-800 text-sm sm:text-base mb-2"><b>カテゴリー</b></label>
                                    <select id="exampleFormControlSelect1" name="category_id" class="w-full bg-gray-50 text-gray-800 border focus:ring ring-indigo-300 rounded outline-none transition duration-100 px-3 py-2">
                                        <option selected="">---</option>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="sm:col-span-2">
                                    <label for="content" class="inline-block text-gray-800 text-sm sm:text-base mb-2"><b>内容</b></label>
                                    <textarea name="content" id="ckeditor" class="content w-full bg-gray-50 text-gray-800 border focus:ring ring-indigo-300 rounded outline-none transition duration-100 px-3 py-3"></textarea>
                                </div>

                                <div class="m-3 mt-4">
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
        ▽ 画像のドラッグ＆ドロップ処理 ▽
    ----------------------------------------------------------- */ ?>
    <script>
        var fileArea = document.getElementById('drag-drop-area');
        var fileInput = document.getElementById('fileInput');


        fileArea.addEventListener('dragover', function(evt) {
            evt.preventDefault();
            fileArea.classList.add('dragover');
        });

        fileArea.addEventListener('dragleave', function(evt) {
            evt.preventDefault();
            fileArea.classList.remove('dragover');
        });
        fileArea.addEventListener('drop', function(evt) {
            evt.preventDefault();
            fileArea.classList.remove('dragenter');
            var files = evt.dataTransfer.files;
            fileInput.files = files;
        });
    </script>

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