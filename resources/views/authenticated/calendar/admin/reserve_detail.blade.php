@extends('layouts.sidebar')
{{-- スクール予約詳細画面 --}}
@section('content')
    <div class="vh-100 d-flex" style="align-items:center; justify-content:center;">
        <div class="w-50 m-auto h-75">
            <p><span>{{ $date }}日</span><span class="ml-3">{{ $part }}部</span></p>
            <div class="h-75 border">
                <table class="">
                    <tr class="text-center">
                        <th class="w-25">ID </th>
                        <th class="w-25">名前 </th>
                        <th class="w-25">場所</th>
                    </tr>
                    {{-- 予約者情報の一覧を表示　
                      $reservePersons にusers情報がはいっている --}}
                    @foreach ($reservePersons as $reserve)
                        @foreach ($reserve->users as $user)
                            {{-- foreach (配列やコレクション as 一時変数) { 繰り返し処理 } --}}
                            <tr class="text-center">
                                <td class="w-25">{{ $user->id }}</td>
                                <td class="w-25">{{ $user->over_name }} {{ $user->under_name }}</td>
                                <td class="w-25">{{ $user->pivot->location ?? 'リモート' }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection
