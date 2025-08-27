@extends('layouts.sidebar')

@section('content')
    <div class="vh-100 pt-5" style="background:#ECF1F6;">
        <div class="border w-75 m-auto pt-5 pb-5" style="border-radius:5px; background:#FFF;">
            <div class="w-75 m-auto border" style="border-radius:5px;">

                <p class="text-center">{{ $calendar->getTitle() }}</p>
                <div class="">
                    {!! $calendar->render() !!}
                    {{-- ↑↑↑↑ CalendarView.phpの呼び出し --}}
                    <div class="js-modal modal">
                        <div class="modal__bg js-modal-close"></div>
                        <div class="modal__content">
                            <form action="{{ route('deleteParts') }}" method="post">
                                @csrf
                                <p>予約日: <span class="modal-reserve-date"></span></p>
                                <p>時間: <span class="modal-reserve-part"></span></p>
                                <p>この予約をキャンセルしてもよろしいですか？</p>

                                <!-- フォームで送る隠し値 -->
                                <input type="hidden" name="getData" class="modal-input-date">
                                <input type="hidden" name="getPart" class="modal-input-part">

                                <button type="button" class="js-modal-close btn btn-primary">閉じる</button>
                                <button type="submit" class="btn btn-danger">キャンセル</button>

                            </form>
                        </div>
                    </div>


                    <div class="text-right w-75 m-auto">
                        <input type="submit" class="btn btn-primary" value="予約する" form="reserveParts">
                    </div>
                </div>
            @endsection
