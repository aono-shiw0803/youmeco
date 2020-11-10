@extends('layouts.index')

@section('breadcrumbs')
  {{ Breadcrumbs::render('tasks') }}
@endsection

@section('main')
<div class="page-title">
  <p>タスク一覧</p>
</div>
@if(Auth::id() == 1 || Auth::id() == 4)
<div class="index-tasks-btn-area">
  <ul>
    <li><a href="{{url('/tasks/create')}}" id="new">タスク追加</a></li>
  </ul>
</div>
@endif
<table class="index-tasks-table">
  <tbody>
    <tr>
      <th>タスク名</th>
      <th>登録日時</th>
      <th>編集</th>
      <th>削除</th>
    </tr>
    @forelse($tasks as $task)
    <tr>
      @if($task->bg == null)
        <td><p class="task"><i class="fas fa-circle" style="color:#fff"></i>&nbsp;<a href="{{url('tasks/' . $task->id)}}" class="link">{{$task->title}}</a></p></td>
      @else
        <td><p class="task"><i class="fas fa-circle" style="color:#{{$task->bg}}"></i>&nbsp;<a href="{{url('tasks/' . $task->id)}}" class="link">{{$task->title}}</a></p></td>
      @endif

      <td id="small">{{$task->created_at}}</td>
      <td id="click">
        @if(Auth::user()->id == 1 || Auth::user()->id == 4)
        <a href="{{action('TaskController@edit', $task)}}" id="edit">編集</a>
        @else
        <p>－</p>
        @endif
      </td>
      <td id="click">
        @if(Auth::user()->id == 1 || Auth::user()->id == 4)
        <form method="post" action="/tasks/delete/{{$task->id}}">
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
      <td  colspan="5" id="null">現在タスクは登録されていません</td>
    </tr>
    @endforelse
  </tbody>
</table>
@endsection
