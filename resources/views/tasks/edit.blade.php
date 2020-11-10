@extends('layouts.index')

@section('breadcrumbs')
  {{ Breadcrumbs::render('tasks-edit', $task) }}
@endsection

@section('main')
<div class="page-title">
  <p>タスク編集</p>
</div>
<div class="tasks-must">
  <p id="must"><span>※</span>は入力必須項目です。</p>
</div>
<form method="post" action="{{url('/tasks', $task->id)}}">
  @csrf
  @method('PATCH')
  <table class="edit-tasks-table">
    <tbody>
      <tr>
        <th id="middle">タスク名<span class="must">※（20文字以内）</span></th>
        <td>
          <input autofocus id="large" type="text" name="title" placeholder="例）方針案作成" value="{{old('title', $task->title)}}">
          @if($errors->has('title'))
          <span id="error">{{$errors->first('title')}}</span>
          @endif
        </td>
      </tr>
      <tr>
        <th>背景色<span id="bg16">（16進数で入力してください）</span></th>
        <td>
          <input type="text" name="bg" placeholder="例）FF0000" value="{{old('bg', $task->bg)}}">
          @if($errors->has('bg'))
          <br><span id="error">{{$errors->first('bg')}}</span>
          @endif
        </td>
      </tr>
    </tbody>
  </table>
  <div class="edit-tasks-btn-area">
    <ul>
      <li><input id="submit" type="submit" value="更新" onclick="return confirm('更新してもよろしいですか？')"></li>
    </ul>
  </div>
</form>
@endsection
