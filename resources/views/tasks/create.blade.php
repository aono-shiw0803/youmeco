@extends('layouts.index')

@section('breadcrumbs')
  {{ Breadcrumbs::render('tasks-create') }}
@endsection

@section('main')
<div class="page-title">
  <p>タスク追加</p>
</div>
<div class="tasks-must">
  <p id="must"><span>※</span>は入力必須項目です。</p>
</div>
<form method="post" action="{{url('/tasks')}}">
  @csrf
  <table class="create-tasks-table">
    <tbody>
      <tr>
        <th id="middle">タスク名<span class="must">※（20文字以内）</span></th>
        <td>
          <input autofocus id="large" type="text" name="title" placeholder="例）方針案作成" value="{{old('title')}}">
          @if($errors->has('title'))
          <br><span id="error">{{$errors->first('title')}}</span>
          @endif
        </td>
      </tr>
      <tr>
        <th>背景色<span id="bg16">（16進数で入力してください）</span></th>
        <td>
          <input type="text" name="bg" placeholder="例）FF0000" value="{{old('bg')}}">
          @if($errors->has('bg'))
          <br><span id="error">{{$errors->first('bg')}}</span>
          @endif
        </td>
      </tr>
    </tbody>
  </table>
  <div class="create-tasks-btn-area">
    <ul>
      <li><input id="submit" type="submit" value="追加" onclick="return confirm('追加してもよろしいですか？')"></li>
    </ul>
  </div>
</form>
@endsection
