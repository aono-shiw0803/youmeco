@extends('layouts.index')

@section('breadcrumbs')
  {{ Breadcrumbs::render('progresses') }}
@endsection

@section('main')
<div class="page-title">
  <p>コンテンツ進捗管理表</p>
</div>
<div class="sub-header">
  <div class="conclusions-btn">
    <ul>
      <li><a href="{{url('/progresses/create')}}" id="new">進捗新規登録</a></li>
      <li><a href="{{url('/progresses/edit_ajax')}}" class="edit">担当者一括編集</a></li>
    </ul>
  </div>
</div>

<form method="post" action="delete_progress">
  @csrf
  <div class="index-progresses">
    <table class="index-progresses-table">
      <thead>
        <tr>
          <th class="main-tema" rowspan="3">詳細</th><th class="main-tema" colspan="6" rowspan="2">案件</th><th class="main-tema" colspan="4">納品物作成</th><th class="main-tema" colspan="2"></th><th class="main-tema" colspan="2">納品ファイル作成</th><th class="main-tema" colspan="2">最終チェック（営業）</th><th class="main-tema" colspan="2">最終修正</th><th class="main-tema">納品</th><th class="main-tema" rowspan="3">編集</th>
          <th class="main-tema" rowspan="3"><input id="garbage" type="submit" value="&#xf2ed" class="fas" onClick="return confirm('選択した項目を全て削除してもよろしいですか？')"></th>
        </tr>
        <tr>
          <th class="sub-tema" colspan="2">原本</th><th class="sub-tema" colspan="2">チェック</th><th class="sub-tema" colspan="2">修正</th><th class="sub-tema" colspan="2"></th><th class="sub-tema" colspan="2"></th><th class="sub-tema" colspan="2"></th><th class="sub-tema"></th>
        </tr>
        <tr>
          <th class="sub-tema">施策名</th><th class="sub-tema">納品月</th><th class="sub-tema">完全完了</th><th class="sub-tema">企業名／サイト名</th><th class="sub-tema">No.</th><th class="sub-tema">タイトル</th><th class="sub-tema">担当者</th><th class="sub-tema">完了</th><th class="sub-tema">担当者</th><th class="sub-tema">完了</th><th class="sub-tema">担当者</th><th class="sub-tema">完了</th>
          <th class="sub-tema">担当者</th><th class="sub-tema">完了</th><th class="sub-tema">担当者</th><th class="sub-tema">完了</th><th class="sub-tema">担当者</th><th class="sub-tema">完了</th><th class="sub-tema">完了</th>
        </tr>
      </thead>
      <tbody>
        @forelse($progresses as $progress)
        <tr>
          <td class="text-center"><a href="{{url('/progresses', $progress->id)}}"><i id="search" class="fas fa-search"></i></a></td>
          <td><p>{{$progress->measures}}</p></td>
          <td>{{$progress->month}}</td>
          @if($progress->original_done == "完了" && $progress->check_done == "完了" && $progress->update_done == "完了" && $progress->file_done == "完了" && $progress->sale_done == "完了" && $progress->final_done == "完了" && $progress->delivery == "完了")
          <td><i class="fas fa-circle done circle-grid"></i></td>
          @else
          <td>－</td>
          @endif
          <td><p>{{$progress->company}}</p></td>
          <td>{{$progress->no}}</td>
          @if($progress->title == true)
          <td><p>{{$progress->title}}</p></td>
          @else
          <td class="text-center">－</td>
          @endif
          <td>{{$progress->original_staff}}</td>
          @if($progress->original_done == '完了')
          <td><i class="fas fa-circle done circle-grid"></i></td>
          @else
          <td>－</td>
          @endif
          <td>{{$progress->check_staff}}</td>
          @if($progress->check_done == '完了')
          <td><i class="fas fa-circle done circle-grid"></i></td>
          @else
          <td>－</td>
          @endif
          <td>{{$progress->update_staff}}</td>
          @if($progress->update_done == '完了')
          <td><i class="fas fa-circle done circle-grid"></i></td>
          @else
          <td>－</td>
          @endif
          <td>{{$progress->file_staff}}</td>
          @if($progress->file_done == '完了')
          <td><i class="fas fa-circle done circle-grid"></i></td>
          @else
          <td>－</td>
          @endif
          <td>{{$progress->sale_staff}}</td>
          @if($progress->sale_done == '完了')
          <td><i class="fas fa-circle done circle-grid"></i></td>
          @else
          <td>－</td>
          @endif
          <td>{{$progress->final_staff}}</td>
          @if($progress->final_done == '完了')
          <td><i class="fas fa-circle done circle-grid"></i></td>
          @else
          <td>－</td>
          @endif
          @if($progress->delivery == '完了')
          <td><i class="fas fa-circle done circle-grid"></i></td>
          @else
          <td>－</td>
          @endif
          <td class="text-center"><a href="{{action('ProgressController@edit', $progress)}}" id="edit">編集</a></td>
          <td class="text-center"><input type="checkbox" name="ids[]" value="{{$progress->id}}"</td>
        </tr>
        @empty
        <tr>
          <td colspan="22" id="null">登録されていません。</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</form>
@endsection
