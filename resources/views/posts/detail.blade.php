<x-app-layout title="タイトルの書き換え">

    <x-slot name="meta">
        <meta name="description" content='{{ mb_substr(str_replace(array("\r\n", "\r", "\n"), "", strip_tags($post->content)), 0, 130); }}'>
        <meta name="keywords" content="">
        <title>{{ $post->title }} | {{ config('app.name', 'Q & A site - ナゼナゼの実 -') }}</title>

        <?php /* OGP meta */ ?>
        <meta property="og:site_name" content="{{ config('app.name', 'Q & A site - ナゼナゼの実 -') }}">
        <meta property="og:url" content="<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">
        <meta property="og:title" content="{{ $post->title }} | {{ config('app.name', 'Q & A site - ナゼナゼの実 -') }}">
        <meta property="og:description" content='{{ mb_substr(str_replace(array("\r\n", "\r", "\n"), "", strip_tags($post->content)), 0, 130); }}'>
        @if($post->image)
        <meta property="og:image" content="{{ asset('storage/image/'.$post->image) }}">
        @else
        <meta property="og:image" content="<?php echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST']; ?>/ogp.jpg">
        @endif
        <meta property="og:locale" content="ja_JP">
        <meta property="fb:admins" content="xxxxxxxxx">
        <meta property="og:type" content="article">
        <meta name="twitter:card" content="summary_large_image" />
    </x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            質問詳細
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 border-white bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="wClm">
                    <div class="sideLeft @if(empty($post->image)) w100 @endif">
                        <div class="flex-items items-center">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-8 h-8 text-gray-400">
                                <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">Q：{{ $post->title }}</div>

                        </div>
                        <div class="ml-12">
                            <div class="mt-2 text-sm text-gray-500">
                                ユーザー：<a href="/posts/user/{{ $post->user->id }}" class="underline">{{ $post->user->name }}</a><br>
                                カテゴリー：<a href="/posts/category/{{ $post->category->id }}" class="underline">{{ $post->category->category_name }}</a><br>

                                @auth
                                <div id="likeBtnArea" class="@if($defaultLiked) active @endif">
                                    <div class="likeBtn">
                                        <button type="button" class="shadow-lg font-semibold rounded" onClick="like({{ $post->id }})">Like：<span class="likeCount">{{ $defaultCount }}</span></button>
                                    </div>
                                    <div class="unlikeBtn">
                                        <button type="button" class="shadow-lg font-semibold rounded " onClick="unlike({{ $post->id }})">Like：<span class="likeCount">{{ $defaultCount }}</span></button>
                                    </div>
                                    <?php /* ?><span class="likeCount">{{ $defaultCount }}</span><?php */ ?>
                                </div>
                                @else
                                <div class="mt-2 text-sm text-indigo-700"><b>Like：{{ $defaultCount }}</b></div>
                                @endauth
                            </div>
                            <div class="mt-8 text-l text-gray-500 postContents">
                                {!! $post->content !!}
                            </div>
                        </div>
                    </div>
                    @if(!empty($post->image))
                    <div class="sideRight"><img src="{{ asset('storage/image/'.$post->image) }}"></div>
                    @endif
                </div>

                <div class="dataString mt-4 text-sm text-gray-500">
                    <a href="/posts/user/{{ $post->user->id }}" class="icon">
                        @if(isset($post->user->icon_img))
                        <img class="h-10 w-10 rounded-full object-cover" src="{{ asset('storage/profile-photos/'.$post->user->icon_img) }}" alt="{{ $post->user->name }}" />
                        @else
                        <img class="h-10 w-10 rounded-full object-cover" src="{{ $post->user->profile_photo_url }}" alt="{{ $post->user->name }}" />
                        @endif
                    </a>
                    <b>作成日：{{ $post->created_at->format('Y/m/d D H:i') }}</b><br>
                    <b class="bg">回答期限：{{ $limit->format('Y/m/d D H:i') }}</b>
                </div>

            </div>
            @if( $timeG == false )
            <div class="mt-8">
                <a href="/comments/create/{{ $post->id }}" class="shadow-lg px-2 py-1  bg-indigo-500 text-lg text-white font-semibold rounded transform transition mt-8">回答する</a>
            </div>
            @endif

            {{-- ベストアンサー選出後---Start --}}
            @if( isset($post->answer->id) && $timeG == true )
            <div class="p-6 mt-8 border-white bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <h2 class="text-l leading-tight text-lg text-gray-600 leading-7 font-semibold">ベストアンサー</h2>
                <div class="mt-8">
                    <div class="gap-2">
                        <div class="text-gray-400 text-sm">ユーザー：<a href="/posts/user/{{ $post->answer->comment->user->id }}" class="underline">{{ $post->answer->comment->user->name }}</a></div>
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
                            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold comment01">A：{!! $post->answer->comment->comment !!}</div>
                        </div>
                    </div>
                    <div class="dataString mt-4 text-sm text-gray-500">
                        <a href="/posts/user/{{ $post->answer->comment->user->id }}" class="icon iconB">
                            @if(isset($post->answer->comment->user->icon_img))
                            <img class="h-10 w-10 rounded-full object-cover" src="{{ asset('storage/profile-photos/'.$post->answer->comment->user->icon_img) }}" alt="{{ $post->answer->comment->user->name }}" />
                            @else
                            <img class="h-10 w-10 rounded-full object-cover" src="{{$post->answer->comment->user->profile_photo_url }}" alt="{{ $post->answer->comment->user->name }}" />
                            @endif
                        </a>{{ $post->answer->comment->created_at->format('Y/m/d D H:i') }}
                    </div>
                </div>
            </div>
            {{-- ベストアンサー選出後---End --}}
            @endif

            <!-- comment - start -->
            @if( isset($userAuth->id) && $userAuth->id == $post->user_id && !isset($post->answer->id) && $timeG == true )
            <div class="p-6 mt-8 border-white bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <h2 class="text-l leading-tight text-lg text-gray-600 leading-7 font-semibold">ベストアンサーを選出してください！！！</h2>
                <div class="text-sm text-gray-500">
                    @foreach($comments as $comment)
                    <div class="overflow-hidden shadow-xl py-6">
                        <div class="gap-2">
                            <form action="/answers/create/" method="GET" enctype="multipart/form-data">

                                <p class="card-text"><button type="submit" class="mt-3 flex items-center text-sm font-semibold text-indigo-700">
                                        <div class="mt-3 flex items-center text-sm font-semibold text-indigo-700">
                                            <div>この回答を選出する</div>
                                            <div class="ml-1 text-indigo-500">
                                                <svg viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                                    <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </button></p>

                                <div class="mt-2 text-gray-400 text-sm">ユーザー：{{ $comment->user->name }}</div>
                                <div class="flex-items items-center mt-2">
                                    <svg version="1.1" class="mt-1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="width: 24px; height: 24px; opacity: 1;" xml:space="preserve">
                                        <style type="text/css">
                                            .st0 {
                                                fill: #4B4B4B;
                                            }
                                        </style>Ï
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
                                    <div class="ml-4 text-l text-gray-600 leading-7 font-semibold comment01">A：{!! $comment->comment !!}</div>

                                    <div class="dataString mt-4 text-sm text-gray-500"><a class="icon iconB">
                                            @if(isset($comment->user->icon_img))
                                            <img class="h-10 w-10 rounded-full object-cover" src="{{ asset('storage/profile-photos/'.$comment->user->icon_img) }}" alt="{{ $comment->user->name }}" />
                                            @else
                                            <img class="h-10 w-10 rounded-full object-cover" src="{{$comment->user->profile_photo_url }}" alt="{{ $comment->user->name }}" />
                                            @endif
                                        </a>{{ $comment->created_at->format('Y/m/d D H:i') }}</div>
                                </div>

                                <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                <input type="hidden" name="comment" value="{{ $comment->comment }}">
                                <input type="hidden" name="user" value="{{ $comment->user->name }}">

                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @else
            <div class="p-6 mt-8 border-white bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <h2 class="text-l leading-tight text-lg text-gray-600 leading-7 font-semibold">回答コメント</h2>
                <div class="text-sm text-gray-500">
                    @foreach($comments as $comment)
                    <div class="p-6 mt-8 overflow-hidden shadow-xl shadow-xls posiR">
                        <div class="gap-2">
                            <div class="text-gray-400 text-sm">ユーザー：<a href="/posts/user/{{ $comment->user->id }}" class="underline">{{ $comment->user->name }}</a></div>
                            <div class="flex-items items-center mt-2">
                                <a href="/replies/create/{{ $comment->id }}?post_id={{ $comment->post_id }}"><svg version="1.1" class="mt-1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="width: 24px; height: 24px; opacity: 1;" xml:space="preserve">
                                        <style type="text/css">
                                            .st0 {
                                                fill: #4B4B4B;
                                            }
                                        </style>Ï
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
                                    </svg></a>
                                <div class="ml-4 text-l text-gray-600 leading-7 font-semibold comment01">A：{!! $comment->comment !!}</div>
                            </div>
                        </div>
                        <div class="dataString mt-4 text-sm text-gray-500"><a href="/posts/user/{{ $comment->user->id }}" class="icon iconB">
                                @if(isset($comment->user->icon_img))
                                <img class="h-10 w-10 rounded-full object-cover" src="{{ asset('storage/profile-photos/'.$comment->user->icon_img) }}" alt="{{ $comment->user->name }}" />
                                @else
                                <img class="h-10 w-10 rounded-full object-cover" src="{{$comment->user->profile_photo_url }}" alt="{{ $comment->user->name }}" />
                                @endif

                            </a>{{ $comment->created_at->format('Y/m/d D H:i') }}</div>
                        @if (!empty($comment->reply[0]))
                        <div class="bar">&nbsp;</div>
                        <div class="replyArea">
                            @foreach($comment->reply as $reply)

                            <div class="text-gray-400 text-sm">ユーザー：<a href="/posts/user/{{ $reply->user->id }}" class="underline">{{ $reply->user->name }}</a></div>
                            <div class="mt-2 text-l text-gray-500">{{ $reply->reply }}</div>
                            <div class="dataString mt-4 text-sm text-gray-400"><a href="/posts/user/{{ $reply->user->id }}" class="icon iconC">
                                    @if(isset($reply->user->icon_img))
                                    <img class="h-8 w-8 rounded-full object-cover" src="{{ asset('storage/profile-photos/'.$reply->user->icon_img) }}" alt="{{ $reply->user->name }}" />
                                    @else
                                    <img class="h-8 w-8 rounded-full object-cover" src="{{$reply->user->profile_photo_url }}" alt="{{ $reply->user->name }}" />
                                    @endif
                                </a>{{ $reply->created_at->format('Y/m/d D H:i') }}</div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>

            @endif
            <!-- comment - end -->
            <br>{{ $comments->links() }}

            <script>
                const likeBtnArea = document.getElementById('likeBtnArea');
                const likeCount = document.getElementsByClassName('likeCount');
                async function like(id) {
                    likeBtnArea.classList.add('active');
                    const sURL = '/posts/like/' + id;
                    const response = await fetch(sURL);
                    const jsondata = await response.json();
                    for (let index = 0; index < likeCount.length; index++) {
                        likeCount[index].innerHTML = jsondata['likeCount'];
                    }
                }
                async function unlike(id) {
                    likeBtnArea.classList.remove('active');
                    const sURL = '/posts/unlike/' + id;
                    const response = await fetch(sURL);
                    const jsondata = await response.json();
                    for (let index = 0; index < likeCount.length; index++) {
                        likeCount[index].innerHTML = jsondata['likeCount'];
                    }
                }
            </script>

        </div>
    </div>

</x-app-layout>