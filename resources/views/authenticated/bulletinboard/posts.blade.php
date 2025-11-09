@extends('layouts.sidebar')

@section('content')
    <div class="board_area w-100 border m-auto d-flex">
        <div class="post_view w-75 mt-5">
            <p class="w-75 m-auto"></p>
            @foreach ($posts as $post)
                <div class="post_area border w-75 m-auto p-3">
                    <p class="username"><span>{{ $post->user->over_name }}</span>
                        <span class="ml-3">{{ $post->user->under_name }}</span>さん
                    </p>
                    <p><a class="title" href="{{ route('post.detail', ['id' => $post->id]) }}">{{ $post->post_title }}</a>
                    </p>
                    {{-- ▼サブカテゴリー表示　青文字 --}}
                    @if ($post->subCategories->isNotEmpty())
                        {{-- isNotEmpty 空じゃない時 --}}
                        <div class="mt-2">
                            @foreach ($post->subCategories as $subCategory)
                                <span class="badge badge-primary text-white" style="background-color: #03aad2;">
                                    {{ $subCategory->sub_category }}
                                </span>
                            @endforeach
                        </div>
                    @endif

                    <div class="post_bottom_area d-flex">
                        <div class="d-flex post_status">
                            <div class="mr-5">

                                {{-- コメント数の表示 --}}
                                <i class="fa fa-comment">
                                    <span class="comment_counts{{ $post->id }}">
                                        {{ $post->postComments->count() }}
                                    </span>
                                </i>
                                {{--  $post->postComments⇒投稿のコメント一覧 -リレーションから引っ張ってきている-}}
                            </div>

                            {{-- いいねの数の表示 --}}
                                <div>
                                    @if (Auth::user()->is_Like($post->id))
                                        <p class="m-0">
                                            <i class="fas fa-heart un_like_btn" post_id="{{ $post->id }}"></i>
                                            <span
                                                class="like_counts{{ $post->id }}">{{ $like->likeCounts($post->id) }}</span>

                                        </p>
                                    @else
                                        <p class="m-0">
                                            <i class="fas fa-heart like_btn" post_id="{{ $post->id }}">
                                                {{-- <span class="like_counts{{ $post->id }}"></span></p> --}}
                                                <span
                                                    class="like_counts{{ $post->id }}">{{ $like->likeCounts($post->id) }}</span>
                                            </i>
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="other_area w-25">
            <div class="side_area m-4">
                <p class="text-center"><a href="{{ route('post.input') }}" class="text-btn w-100">投稿</a>
                    {{-- w-100 横幅を１００％にする --}}
                </p>
                <div class="search_post_area">
                    <input type="text" placeholder="キーワードを検索" name="keyword"
                        class="search-input"form="postSearchRequest">
                    <input type="submit" class="search-post-btn" value="検索" form="postSearchRequest">
                </div>
            </div>
            <div class="bottom_area">
                <input type="submit" name="like_posts" class="btn-like" value="いいねした投稿" form="postSearchRequest">
                <input type="submit" name="my_posts" class=" btn-my" value="自分の投稿" form="postSearchRequest">
            </div>
            {{-- サブカテゴリーの表示 --}}
            <p class="category">カテゴリー検索</p>
            <ul class="accordion-list">
                @foreach ($categories as $category)
                    <li class="accordion-item">
                        <input type="checkbox" id="cat-toggle-{{ $category->id }}" class="accordion-toggle">
                        <label for="cat-toggle-{{ $category->id }}" class="accordion-label">
                            {{ $category->main_category }}
                            <span class="arrow"></span>
                        </label>

                        <ul class="accordion-content">
                            @foreach ($category->sub_categories as $sub_category)
                                <li>
                                    <a href="{{ route('posts.bySubCategory', ['id' => $sub_category->id]) }}"
                                        class="category_btn">
                                        {{ $sub_category->sub_category }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>

            {{-- <P>カテゴリー検索</P>
            <ul>
                @foreach ($categories as $category)
                    <li class="main_categories" category_id="{{ $category->id }}">
                        <span>{{ $category->main_category }}</span>
                    </li>
                    @foreach ($category->sub_categories as $sub_category)
                        <li>
                            <a href="{{ route('posts.bySubCategory', ['id' => $sub_category->id]) }}" class="category_btn">
                                {{ $sub_category->sub_category }}
                            </a>
                        </li>
                    @endforeach
                @endforeach --}}
            {{-- @foreach ($categories as $category)
                        <li class="main_categories" category_id="{{ $category->id }}">
                            <span>{{ $category->main_category }}<span>
                        </li>

                        @foreach ($categories->sub_categories as $sub_category)
                            <li value="{{ $sub_category->id }}">{{ $sub_category->sub_category }}
                            </li>
                        @endforeach
                    @endforeach --}}


            {{-- </ul> --}}
        </div>
    </div>
    <form action="{{ route('post.show') }}" method="get" id="postSearchRequest"></form>
    </div>
@endsection
