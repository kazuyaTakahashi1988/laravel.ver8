<x-app-layout>
    <x-slot name="meta">
        <meta name="description" content='コメント投稿'>
        <meta name="keywords" content="">
        <title>コメント投稿 | {{ config('app.name', 'welcome to Q & A site!') }}</title>

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
                                    <label for="comment" class="inline-block text-gray-800 text-sm sm:text-base mb-2">コメント内容</label>
                                    <textarea name="comment" class="w-full h-250 bg-gray-50 text-gray-800 border focus:ring ring-indigo-300 rounded outline-none transition duration-100 px-3"></textarea>
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

</x-app-layout>