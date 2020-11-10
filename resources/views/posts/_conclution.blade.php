@extends('layouts.index')

@section('breadcrumbs')
  完了済みタスク一覧
@endsection

@section('main')

<div class="index-posts-btn-area">
  <ul>
    <li><a href="{{url('/posts')}}" id="new">未完了タスク一覧の戻る</a></li>
    <li><a href="{{url('/posts/create')}}" id="new">タスク追加</a></li>
  </ul>
</div>

<div class="index-posts">
  <table class="index-posts-table">
    <tbody>
      <tr>
        <th>詳細</th>
        <th>タスク<br>ID</th>
        <th>案件名</th>
        <th>タスク</th>
        <th>担当者</th>
        <th>工数</th>
        <th>開始日</th>
        <th>完了日</th>
      </tr>
      @forelse($posts as $post)
      @if($post->status == 1)
      <tr>
        <td><a href="{{url('/posts', $post->id)}}" id="detail">詳細</a></td>
        <td>{{$post->id}}</td>
        <td class="matter">{{$post->matter}}</td>
        <td class="task">{{$post->task}}</td>
        <td>{{$post->staff}}</td>
        <td>{{$post->hour}}</td>
        <td>{{$post->start_date}}</td>
        <td>{{$post->end_date}}</td>
      </tr>
      @else
      <tr>
        <td colspan="8" id="null">完了タスクはありません。</td>
      </tr>
      @endif
      @empty
      <tr>
        <td colspan="8" id="null">登録されていません</td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection
