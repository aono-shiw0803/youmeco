@extends('layouts.index')

@section('breadcrumbs')
  {{ Breadcrumbs::render('progresses-edit_ajax', $progress) }}
@endsection

@section('main')
<div class="page-title">
  <p>担当者一括編集</p>
</div>
<div class="sub-header">
  <div class="conclusions-btn">
    <ul>
      <li><a href="{{url('/progresses/create')}}" id="new">進捗新規登録</a></li>
    </ul>
  </div>
</div>

<form method="post" action="{{url('/progresses')}}">
  @csrf
  @method('PUT')
  <div class="edit_ajax-progresses">
    <table class="index-progresses-table">
      <thead>
        <tr>
          <th class="main-tema" rowspan="3">詳細</th><th class="main-tema" colspan="6" rowspan="2">案件</th><th class="main-tema" colspan="4">納品物作成</th><th class="main-tema" colspan="2"></th><th class="main-tema" colspan="2">納品ファイル作成</th><th class="main-tema" colspan="2">最終チェック（営業）</th><th class="main-tema" colspan="2">最終修正</th><th class="main-tema">納品</th>
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
          <td>
            <select name="progress[{{$progress->id}}][original_staff]">
              <option value="－" @if(old('progress.' .$progress->id .'original_staff', $progress->original_staff) == "－") selected @endif>－</option>
              @foreach($users as $user)
                <option value="{{$user->name}}" @if(old('progress.' .$progress->id .'original_staff', $progress->original_staff) == $user->name) selected @endif>{{$user->name}}</option>
              @endforeach
            </select>
          </td>
          @if($progress->original_done == '完了')
          <td><i class="fas fa-circle done circle-grid"></i></td>
          @else
          <td>－</td>
          @endif
          <td>
            <select name="progress[{{$progress->id}}][check_staff]">
              <option value="－" @if(old('progress.' .$progress->id .'check_staff', $progress->check_staff) == "－") selected @endif>－</option>
              @foreach($users as $user)
                <option value="{{$user->name}}" @if(old('progress.' .$progress->id .'check_staff', $progress->check_staff) == $user->name) selected @endif>{{$user->name}}</option>
              @endforeach
            </select>
          </td>
          @if($progress->check_done == '完了')
          <td><i class="fas fa-circle done circle-grid"></i></td>
          @else
          <td>－</td>
          @endif
          <td>
            <select name="progress[{{$progress->id}}][update_staff]">
              <option value="－" @if(old('progress.' .$progress->id .'update_staff', $progress->update_staff) == "－") selected @endif>－</option>
              @foreach($users as $user)
                <option value="{{$user->name}}" @if(old('progress.' .$progress->id .'update_staff', $progress->update_staff) == $user->name) selected @endif>{{$user->name}}</option>
              @endforeach
            </select>
          </td>
          @if($progress->update_done == '完了')
          <td><i class="fas fa-circle done circle-grid"></i></td>
          @else
          <td>－</td>
          @endif
          <td>
            <select name="progress[{{$progress->id}}][file_staff]">
              <option value="－" @if(old('progress.' .$progress->id .'file_staff', $progress->file_staff) == "－") selected @endif>－</option>
              @foreach($users as $user)
                <option value="{{$user->name}}" @if(old('progress.' .$progress->id .'file_staff', $progress->file_staff) == $user->name) selected @endif>{{$user->name}}</option>
              @endforeach
            </select>
          </td>
          @if($progress->file_done == '完了')
          <td><i class="fas fa-circle done circle-grid"></i></td>
          @else
          <td>－</td>
          @endif
          <td>
            <select name="progress[{{$progress->id}}][sale_staff]">
              <option value="－" @if(old('progress.' .$progress->id .'sale_staff', $progress->sale_staff) == "－") selected @endif>－</option>
              @php
                $sale_staffs = ['清野部長', '中西Mgr', '日高リーダー', '伏木', '森杉'];
              @endphp
              @foreach($sale_staffs as $sale_staff)
                <option value="{{$sale_staff}}" @if(old('sale_staff', $progress->sale_staff) == $sale_staff) selected @endif>{{$sale_staff}}</option>
                <option value="{{$sale_staff}}" @if(old('sale_staff.' .$progress->id .'sale_staff', $progress->sale_staff) == $user->name) selected @endif>{{$sale_staff}}</option>
              @endforeach
            </select>
          </td>
          @if($progress->sale_done == '完了')
          <td><i class="fas fa-circle done circle-grid"></i></td>
          @else
          <td>－</td>
          @endif
          <td>
            <select name="progress[{{$progress->id}}][final_staff]">
              <option value="－" @if(old('progress.' .$progress->id .'final_staff', $progress->final_staff) == "－") selected @endif>－</option>
              @foreach($users as $user)
                <option value="{{$user->name}}" @if(old('progress.' .$progress->id .'final_staff', $progress->final_staff) == $user->name) selected @endif>{{$user->name}}</option>
              @endforeach
            </select>
          </td>
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
        </tr>
        @empty
        <tr>
          <td colspan="20" id="null">登録されていません。</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
  <div class="edit-progresses-btn-area">
    <ul>
      <li><input id="submit" type="submit" value="更新" onclick="return confirm('更新してもよろしいですか？')"></li>
    </ul>
  </div>
</form>
@endsection
