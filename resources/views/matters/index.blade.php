@extends('layouts.index')

@section('breadcrumbs')
  {{ Breadcrumbs::render('matters') }}
@endsection

@section('main')
<div class="page-title">
  <p>案件一覧</p>
</div>
@if(Auth::id() == 1 || Auth::id() == 4)
<div class="index-matters-btn-area">
  <ul>
    <li><a href="{{url('/matters/create')}}" id="new">案件追加</a></li>
  </ul>
</div>
@endif
<table class="index-matters-table">
  <tbody>
    <tr>
      <th>案件名</th>
      <th>案件名2</th>
      <th>登録日時</th>
      <th>表示順</th>
      <th>編集</th>
      <th>削除</th>
    </tr>
    @forelse($matters as $matter)
    <tr>
      <td><p class="matter"><a href="{{url('matters/' . $matter->id)}}" class="link">{{$matter->name}}</a></p></td>
      <td><p class="matter">{{$matter->name_2}}</p></td>
      <td>{{$matter->created_at}}</td>
      <td>{{$matter->rank}}</td>
      <td id="click">
        @if(Auth::user()->id == 1 || Auth::id() == 4)
        <a href="{{action('MatterController@edit', $matter)}}" id="edit">編集</a>
        @else
        <p>－</p>
        @endif
      </td>
      <td id="click">
        @if(Auth::user()->id == 1 || Auth::id() == 4)
        <form method="post" action="/matters/delete/{{$matter->id}}">
          @csrf
          <input id="delete" type="submit" value="削除" onclick="return confirm('本当に削除してもよろしいですか？')">
        </form>
        @else
        <p>－</p>
        @endif
      </td>
    </tr>
    @empty
    <tr>
      <td  colspan="5" id="null">現在案件は登録されていません</td>
    </tr>
    @endforelse
  </tbody>
</table>
@endsection
