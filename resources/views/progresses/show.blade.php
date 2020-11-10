@extends('layouts.index')

@section('breadcrumbs')
  {{ Breadcrumbs::render('progresses-show', $progress) }}
@endsection

@section('main')
<div class="page-title">
  <p>詳細</p>
</div>
<div class="show-progresses-btn-area-top">
  <ul>
    <li><a href="{{action('ProgressController@edit', $progress)}}" class="edit">編集</a></li>
    <li><a href="{{url('/progresses/create')}}" id="new">進捗新規登録</a></li>
    <li>
      <form method="post" action="/progresses/delete/{{$progress->id}}">
        @csrf
        <input class="delete" type="submit" value="削除" onclick="return confirm('本当に削除してもよろしいですか？')">
      </form>
    </li>
  </ul>
</div>
<table class="show-progresses-table">
  <tbody>
    <tr class="main-tema">
      <th colspan="3">案件</th>
    </tr>
    <tr class="sub-tema">
      <th>施策名</th><th>納品月</th><th>企業名／サイト名</th>
    </tr>
    <tr>
      <td class="td-width-90">{{$progress->measures}}</td>
      <td class="td-width-10">{{$progress->month}}</td>
      <td class="td-width-90">{{$progress->company}}</td>
    </tr>
    <tr class="sub-tema">
      <th>No.</th><th>タイトル</th><th>備考</th>
    </tr>
    <tr>
      <td class="td-width-10">{{$progress->no}}</td>
      <td class="td-width-90">{{$progress->title}}</td>
      <td class="progress-show-textarea-width"><p>{{$progress->matter_content}}</p></td>
    </tr>
    <tr class="main-tema">
      <th colspan="3">納品物作成</th>
    </tr>
    <tr class="sub-tema">
      <th colspan="3">原本</th>
    </tr>
    <tr class="sub-tema">
      <th>担当者</th><th>完了</th><th>備考</th>
    </tr>
    <tr>
      <td class="td-width-30">{{$progress->original_staff}}</td>
      <td class="td-width-10">{{$progress->original_done}}</td>
      <td class="progress-show-textarea-width">{{$progress->original_content}}</td>
    </tr>
    <tr class="sub-tema">
      <th colspan="3">チェック</th>
    </tr>
    <tr class="sub-tema">
      <th>担当者</th><th>完了</th><th>備考</th>
    </tr>
    <tr>
      <td class="td-width-30">{{$progress->check_staff}}</select>
      </td>
      <td class="td-width-10">{{$progress->check_done}}</td>
      <td class="progress-show-textarea-width">{{$progress->check_content}}</td>
    </tr>
    <tr class="sub-tema">
      <th colspan="3">修正</th>
    </tr>
    <tr class="sub-tema">
      <th>担当者</th><th>完了</th><th>備考</th>
    </tr>
    <tr>
      <td class="td-width-30">{{$progress->update_staff}}</select>
      </td>
      <td class="td-width-10">{{$progress->update_done}}</td>
      <td class="progress-show-textarea-width">{{$progress->update_content}}</td>
    </tr>
    <tr class="main-tema">
      <th colspan="3">納品ファイル作成</th>
    </tr>
    <tr class="sub-tema">
      <th>担当者</th><th>完了</th><th>備考</th>
    </tr>
    <tr>
      <td class="td-width-30">{{$progress->file_staff}}</td>
      <td class="td-width-10">{{$progress->file_done}}</td>
      <td class="progress-show-textarea-width">{{$progress->file_content}}</td>
    </tr>
    <tr class="main-tema">
      <th colspan="3">最終チェック（営業）</th>
    </tr>
    <tr class="sub-tema">
      <th>担当者</th><th>完了</th><th>備考</th>
    </tr>
    <tr>
      <td class="td-width-30">{{$progress->sale_staff}}</select>
      </td>
      <td class="td-width-10">{{$progress->sale_done}}</td>
      <td class="progress-show-textarea-width">{{$progress->sale_content}}</td>
    </tr>
    <tr class="main-tema">
      <th colspan="3">最終修正</th>
    </tr>
    <tr class="sub-tema">
      <th>担当者</th><th>完了</th><th>備考</th>
    </tr>
    <tr>
      <td class="td-width-30">{{$progress->final_staff}}</td>
      <td class="td-width-10">{{$progress->final_done}}</td>
      <td class="progress-show-textarea-width">{{$progress->final_content}}</td>
    </tr>
    <tr class="main-tema">
      <th colspan="3">納品</th>
    </tr>
    <tr class="sub-tema">
      <th colspan="3">完了</th>
    </tr>
    <tr>
      <td colspan="3" class="td-width-10">{{$progress->delivery}}</td>
    </tr>
  </tbody>
</table>
@endsection
