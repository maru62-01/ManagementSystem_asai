@extends('layouts.sidebar')

@section('content')
    <div class="post_create_container d-flex">
        <div class="post_create_area border w-50 m-5 p-5">
            <form action="{{ route('post.create') }}" method="post" id="postCreate">
                {{ csrf_field() }}

                <div class="">
                    <p class="mb-0">カテゴリー</p>
                    @if ($errors->first('post_category_id'))
                        <span class="error_message">{{ $errors->first('post_category_id') }}</span>
                    @endif
                    <select class="w-100" form="postCreate" name="post_category_id">

                        @foreach ($main_categories as $main_category)
                            <optgroup label="{{ $main_category->main_category }}">

                                <!-- サブカテゴリー表示のループ -->
                                @foreach ($main_category->sub_categories as $sub_category)
                                    <option value="{{ $sub_category->id }}">{{ $sub_category->sub_category }}</option>

                                    {{-- ☆彡-> は箱の中($sub_category)を取り出してという意味 --}}
                                @endforeach
                                {{-- サブカテゴリーループのおしまい --}}
                            </optgroup>
                        @endforeach
                    </select>
                    {{-- <input type="hidden" name="post_category_id" value="{{ $sub_category->id }}"> --}}

                </div>
                <div class="mt-3">
                    @if ($errors->first('post_title'))
                        <span class="error_message">{{ $errors->first('post_title') }}</span>
                    @endif
                    <p class="mb-0">タイトル</p>
                    <input type="text" class="w-100" form="postCreate" name="post_title"
                        value="{{ old('post_title') }}">
                </div>
                <div class="mt-3">
                    @if ($errors->first('post_body'))
                        <span class="error_message">{{ $errors->first('post_body') }}</span>
                    @endif
                    <p class="mb-0">投稿内容</p>
                    <textarea class="w-100" form="postCreate" name="post_body">
                        {{ old('post_body') }}</textarea>
                </div>
                <div class="mt-3 text-right">
                    <input type="submit" class="btn btn-primary" value="投稿" form="postCreate">
                </div>
            </form>
        </div>

        @can('admin')
            <div class="w-25 ml-auto mr-auto">
                <div class="category_area mt-5 p-5">
                    <form action="{{ route('main.category.create') }}" method="post" id="mainCategoryRequest">
                        {{ csrf_field() }}
                        <div class="">
                            <p class="m-0">メインカテゴリー</p>
                            @error('main_category_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror

                            <input type="text" class="w-100" name="main_category_name">
                        </div>

                        <input type="submit" value="追加" class="w-100 btn btn-primary p-0" form="mainCategoryRequest">

                        {{-- @error('main_category_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror --}}
                    </form>


                    <form action="{{ route('sub.category.create') }}" method="post" id="subCategoryRequest">
                        {{ csrf_field() }}
                        <div class="">
                            <p class="m-0">サブカテゴリー</p>
                            @error('sub_category_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror

                            {{-- メインカテゴリーの選択 --}}
                            <select class="w-100" name="main_category_id">
                                @foreach ($main_categories as $main_category)
                                    <option value="{{ $main_category->id }}">
                                        {{ $main_category->main_category }}
                                    </option>
                                @endforeach
                            </select>
                            {{-- メインカテゴリーの選択終わり --}}
                            {{-- サブカテゴリーの追加 --}}
                            <input type="text" class="w-100" name="sub_category_name">
                        </div>
                        <input type="submit" value="追加" class="w-100 btn btn-primary p-0" form="subCategoryRequest">
                        {{-- サブカテゴリーの終わり --}}

                    </form>


                    <!-- サブカテゴリー追加 -->
                </div>
            </div>
        @endcan
    </div>
@endsection
