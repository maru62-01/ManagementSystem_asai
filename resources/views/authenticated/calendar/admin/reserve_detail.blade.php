@extends('layouts.sidebar')
{{-- スクール予約詳細画面 --}}
@section('content')
    <div class="vh-100 d-flex" style="align-items:center; justify-content:center;">
        <div class="w-50 m-auto h-75">
            <p><span class="date-day">{{ $date }}日</span><span class="ml-3 date-day">{{ $part }}部</span></p>
            <div class="h-75 detail-table">
                <table class="text-table">
                    <tr class="text-main-center">
                        <th class="w-25 text-sub">ID </th>
                        <th class="w-25 text-sub-name">名前 </th>
                        <th class="w-25 text-sub">場所</th>
                    </tr>
                    {{-- 予約者情報の一覧を表示　
                      $reservePersons にusers情報がはいっている --}}
                    @foreach ($reservePersons as $reserve)
                        @foreach ($reserve->users as $user)
                            {{-- foreach (配列やコレクション as 一時変数) { 繰り返し処理 } --}}
                            {{-- $loopで一行ずつ背景色を変える --}}
                            <tr class="text-detail-center {{ $loop->odd ? 'row-odd' : 'row-even' }}">
                                <td class="w-25 detail">{{ $user->id }}</td>
                                <td class="w-25 detail-name">{{ $user->over_name }} {{ $user->under_name }}</td>
                                <td class="w-25 detail-remote">{{ $user->pivot->location ?? 'リモート' }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
