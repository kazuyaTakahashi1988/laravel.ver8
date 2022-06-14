<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            質問を投稿してください。
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
                                    <label for="title" class="inline-block text-gray-800 text-sm sm:text-base mb-2">タイトル</label>
                                    <input name="title" class="w-full bg-gray-50 text-gray-800 border focus:ring ring-indigo-300 rounded outline-none transition duration-100 px-3 py-2" />
                                </div>

                                <div class="form-group">
                                    <label for="category_id" class="inline-block text-gray-800 text-sm sm:text-base mb-2">カテゴリー</label>
                                    <select id="exampleFormControlSelect1" name="category_id" class="w-full bg-gray-50 text-gray-800 border focus:ring ring-indigo-300 rounded outline-none transition duration-100 px-3 py-2">
                                        <option selected="">---</option>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="sm:col-span-2">
                                    <label for="content" class="inline-block text-gray-800 text-sm sm:text-base mb-2">内容</label>
                                    <textarea name="content" class="content w-full h-250 bg-gray-50 text-gray-800 border focus:ring ring-indigo-300 rounded outline-none transition duration-100 px-3 py-3"></textarea>
                                </div>

                                <div class="sm:col-span-2">
                                    <label for="image" class="inline-block text-gray-800 text-sm sm:text-base mb-2">サムネイル画像</label><br>
                                    <input type="file" name="image" class="bg-red-500" />
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

</x-app-layout>