@extends('layouts.index')

@section('breadcrumbs')
  {{ Breadcrumbs::render('conclusions') }}
@endsection

@section('main')
<div class="page-title">
  <p>完了タスク一覧</p>
</div>
<div id="conclusions-btn">
  <ul>
    <li><a href="{{route('export.conclution')}}" id="csv">CSV出力</a></li>
    <li><a href="{{url('/posts/create')}}" id="new">タスク追加</a></li>
    <li><a href="{{url('/posts')}}" id="pass">未完了タスク一覧</a></li>
  </ul>
</div>

<form method="post" action="delete_post">
  @csrf
  <div class="index-conclusions">
    <table class="index-conclusions-table">
      <tbody>
        <tr>
          <th>詳細</th>
          <th>案件名</th>
          <th>タスク</th>
          <th>作業者</th>
          <th>工数</th>
          <th>開始日</th>
          <th>完了日</th>
          <th>削除</th>
        </tr>
        @forelse($posts as $post)
        @if($post->status == 1)
        <tr>
          <td><a href="{{url('/posts', $post->id)}}" id="detail">詳細</a></td>
          <td class="matter">{{$post->matter}}</td>
          <td class="task">{{$post->task}}</td>
          <td class="staff">
            <p>
              @if($user->icon == null)
              <img src="/storage/no-icon.png"><span>{{$post->staff}}</span>
              @else
              <img src="/storage/{{$user->icon}}"><span>{{$post->staff}}</span>
              @endif
            </p>
          </td>
          <td>{{$post->hour}}</td>
          <td>{{$post->start_date}}</td>
          <td>{{$post->end_date}}</td>
          <td><input type="checkbox" name="ids[]" value="{{$post->id}}"</td>
        </tr>
        @endif
        @empty
        <tr>
          <td colspan="8" id="null">完了タスクはありません</td>
        </tr>
        @endforelse
      </tbody>
    </table>
    <div class="delete-btns">
      <input type="submit" value="&#xf2ed" class="fas" onClick="return confirm('選択した項目を全て削除してもよろしいですか？')">
    </div>
  </div>
</form>
@endsection
