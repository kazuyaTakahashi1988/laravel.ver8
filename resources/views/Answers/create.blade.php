<x-app-layout>
    <x-slot name="meta">
        <meta name="description" content='ベストアンサー選出'>
        <meta name="keywords" content="">
        <title>ベストアンサー選出 | {{ config('app.name', 'Q & A site - ナゼナゼの実 -') }}</title>

        <meta name="robots" content="noindex , nofollow">
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            【 こちらの回答をベストアンサーに選出します。よろしいでしょうか？ 】
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
                            <div class="">
                                <div class="gap-2">
                                    <form action="{{ route('answers.store') }}" method="POST" enctype="multipart/form-data">
                                        {{ csrf_field() }}

                                        <div class="m-3">
                                            <button class="shadow-lg px-2 py-1  bg-indigo-500 text-lg text-white font-semibold rounded  hover:bg-blue-500 hover:shadow-sm hover:translate-y-0.5 transform transition ">選出します</button>
                                        </div>
                                        <div class="mt-4 text-gray-400 text-sm">ユーザー：{{ $user }}</div>
                                        <div class="flex-items items-center mt-2">
                                            <svg version="1.1" class="mt-1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="width: 24px; height: 24px; opacity: 1;" xml:space="preserve">
                                                <style type="text/css">
                                                    .st0 {
                                                        fill: #4B4B4B;
                                                    }
                                                </style>
                                                <g>
                                                    <path class="st0" d="M500.111,71.068l-59.195-59.174c-15.859-15.849-41.531-15.862-57.386-0.014l-38.378,38.378L57.257,338.187
		c-7.775,7.768-13.721,17.165-17.443,27.498L1.801,471.476c-3.968,11.039-1.202,23.367,7.086,31.655
		c8.298,8.296,20.634,11.046,31.669,7.083l105.778-38.024c10.332-3.722,19.73-9.674,27.501-17.443l277.874-277.888l0.017,0.013
		l10.031-10.048l38.353-38.378l0.017-0.007C515.907,112.591,515.973,86.937,500.111,71.068z M136.729,445.475l-67.393,24.227
		l-27.02-27.02l24.213-67.393c0.184-0.485,0.416-0.964,0.609-1.441l71.024,71.024C137.679,445.073,137.221,445.302,136.729,445.475z
		 M153.759,434.678c-0.956,0.956-1.978,1.836-3.011,2.703L74.63,361.263c0.863-1.025,1.739-2.051,2.696-3.007L363.814,71.732
		l76.443,76.437L153.759,434.678z M480.031,108.385l-28.319,28.329l-1.421,1.421l-76.444-76.437l29.75-29.75
		c4.758-4.74,12.463-4.747,17.245,0.014l59.199,59.174C484.796,95.884,484.806,103.575,480.031,108.385z" style="fill: rgb(75, 75, 75);"></path>
                                                </g>
                                            </svg>
                                            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">A：{{ $comment }}</div>
                                        </div>
                                        <input type="hidden" name="comment_id" value="{{ $comment_id }}">
                                        <input type="hidden" name="post_id" value="{{ $post_id }}">

                                    </form>
                                    <!-- form - end -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Form end -->
                </div>
            </div>
        </div>
    </div>

</x-app-layout>