@extends('layouts.sidebar')
@section('content')
    <div class="vh-100 d-flex">
        <div class="w-50 mt-5">
            <div class="m-3 detail_container input-radius">
                <div class="p-3">
                    <div class="detail_inner_head">
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

                        {{-- Auth::id() 現在ログインしているユーザーのID --}}
                        {{--  $post->user_id  -> そのデータの中の(投稿テーブル)投稿をとりだす --}}
                        @auth
                            @if (Auth::id() === $post->user_id)
                                <span class="edit-modal-open btn btn-primary btn-edit" post_title="{{ $post->post_title }}"
                                    post_body="{{ $post->post }}" post_id="{{ $post->id }}">
                                    編集
                                </span>
                            @endif

                        @endauth
                        {{-- <span class="edit-modal-open" post_title="{{ $post->post_title }}"
                                post_body="{{ $post->post }}" post_id="{{ $post->id }}">編集</span> --}}
                        @auth
                            @if (Auth::id() === $post->user_id)
                                <P>
                                    <a class="trash-btn  btn btn-danger d-inline-block btn-edit "
                                        href="{{ route('post.delete', ['id' => $post->id]) }}"
                                        onclick="return confirm('この投稿を削除します。よろしいですか？')">削除
                                    </a>

                                    {{-- <a href="{{ route('post.delete', ['id' => $post->id]) }}">削除</a> --}}
                            @endif
                        @endauth
                    </div>

                    <div class="contributor d-flex">
                        <p>
                            <span>{{ $post->user->over_name }}</span>
                            <span>{{ $post->user->under_name }}</span>
                            さん
                        </p>
                        <span class="ml-5">{{ $post->created_at }}</span>
                    </div>
                    <div class="detsail_post_title">{{ $post->post_title }}</div>
                    <div class="mt-3 detsail_post">{{ $post->post }}</div>
                </div>
                <div class="p-3">
                    <div class="comment_container">
                        <span class="">コメント</span>
                        @foreach ($post->postComments as $comment)
                            <div class="comment_area border-top">
                                <p>
                                    <span>{{ $comment->commentUser($comment->user_id)->over_name }}</span>
                                    <span>{{ $comment->commentUser($comment->user_id)->under_name }}</span>さん
                                </p>
                                <p>{{ $comment->comment }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="w-50 p-3">
            <div class="comment_container border m-5">
                <form action="{{ route('comment.create') }}" method="post" id="commentRequest" class="input-radius">
                    {{ csrf_field() }}

                    <div class="comment_area p-3">
                        <p class="m-0">コメントする</p>
                        @error('comment')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror


                        <textarea class="w-100" name="comment" form="commentRequest"></textarea>
                        <input type="hidden" name="post_id" form="commentRequest" value="{{ $post->id }}">
                        <input type="submit" class="btn btn-primary" form="commentRequest" value="投稿">
                    </div>
                </form>

            </div>
        </div>
    </div>
    {{-- モーダルの中身 --}}
    <div class="modal js-modal">
        <div class="modal__bg js-modal-close"></div>
        <div class="modal__content">
            <form action="{{ route('post.edit') }}" method="post" id="postEditRequest">
                @csrf
                <div class="w-100">
                    <div class="modal-inner-title w-50 m-auto">
                        @error('post_title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <input type="text" name="post_title" placeholder="タイトル" class="w-100">
                    </div>

                    <div class="modal-inner-body w-50 m-auto pt-3 pb-3">
                        @error('post_body')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <textarea placeholder="投稿内容" name="post_body" class="w-100"></textarea>
                    </div>

                    <div class="w-50 m-auto edit-modal-btn d-flex">
                        <a class="js-modal-close btn btn-danger d-inline-block" href="">閉じる</a>
                        <input type="hidden" class="edit-modal-hidden" name="post_id" value="{{ $post->id }}">
                        {{-- hiddenどの投稿をサーバーに伝えるかの隠しフィールド --}}
                        <input type="submit" class="btn btn-primary d-block" value="編集" form="postEditRequest">
                    </div>
                </div>
                {{ csrf_field() }}
            </form>
        </div>
    </div>
@endsection
