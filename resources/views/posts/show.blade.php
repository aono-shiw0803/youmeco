@extends('layouts.index')

@section('breadcrumbs')
  {{ Breadcrumbs::render('posts-show', $post) }}
@endsection

@section('main')
<div class="page-title">
  <p>タスク詳細</p>
</div>
<div class="show-posts-btn-area-top">
  <ul>
    <li><a href="{{action('PostController@edit', $post)}}" class="edit">編集</a></li>
    <li><a href="{{url('/posts/create')}}" id="new">タスク追加</a></li>
    <li>
      <form method="post" action="/posts/delete/{{$post->id}}">
        @csrf
        <input class="delete" type="submit" value="削除" onclick="return confirm('本当に削除してもよろしいですか？')">
      </form>
    </li>
  </ul>
</div>
<table class="show-posts-table">
  <tbody>
    <tr>
      <th>案件名</th>
      <td>{{$post->matter}}</td>
      <th>案件名2</th>
      <td>{{$post->matter_2}}</td>
    </tr>
    <tr>
      <th>タスク名</th>
      <td>{{$post->task}}</td>
      <th>作業者</th>
      <td>{{$post->staff}}</td>
    </tr>
    <tr>
      <th>営業担当</th>
      <td style="background-color:{{$post->salestaff_bg}}">{{$post->salestaff}}</td>
      <th>担当者</th>
      <td>{{$post->windowstaff}}</td>
    </tr>
    <tr>
      <th>開始日</th>
      <td>{{$post->start_date}}</td>
      <th>完了日</th>
      <td>{{$post->end_date}}</td>
    </tr>
    <tr>
      <th>納品日</th>
      <td>{{$post->delivery_date}}</td>
      <th>納品数</th>
      <td>{{$post->delivery_number}}</td>
    </tr>
    <tr>
      <th>工数</th>
      <td>{{$post->hour}}時間</td>
      <th>種別</th>
      <td>{{$post->type}}</td>
    </tr>
    <tr>
      <th>作成日時</th>
      <td>{{$post->created_at}}</td>
      <th>最終更新日時</th>
      <td>{{$post->updated_at}}</td>
    </tr>
    <tr>
      <th colspan="4">備考</th>
    </tr>
    <tr>
      @if($post->content == true)
        <td colspan="4"><p>{{$post->content}}</p></td>
        <!-- 備考は改行を反映させるために<p>タグで囲っている -->
      @else
        <td colspan="4"><p class="content-null">－</p></td>
      @endif
    </tr>
  </tbody>
</table>
@endsection
