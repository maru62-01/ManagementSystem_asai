@extends('layouts.sidebar')
@section('content')
    {{-- スクール枠登録画面 --}}
    <div class="w-100 d-flex" style="min-height:100vh; align-items:center; justify-content:center;">
        <div class="w-75 m-auto">
            <div class="input-back-two">

                <p class="text-center">{{ $calendar->getTitle() }}</p>
                {!! $calendar->render() !!}

                <div class="adjust-table-btn m-auto text-right">
                    <input type="submit" class="btn btn-primary" value="登録" form="reserveSetting"
                        onclick="return confirm('登録してよろしいですか？')">
                </div>

            </div>
        </div>
    </div>
@endsection
