@extends('layouts.index')

@section('breadcrumbs')
  {{ Breadcrumbs::render('progresses-edit', $progress) }}
@endsection

@section('main')
<div class="page-title">
  <p>編集</p>
</div>
<div class="progresses-must">
  <p id="must"><span>※</span>は入力必須項目です。</p>
</div>
<form method="post" action="{{url('/progresses/'. $progress->id)}}">
  @csrf
  @method('PATCH')
  <table class="edit-progresses-table">
    <tbody>
      <tr class="main-tema">
        <th colspan="3">案件</th>
      </tr>
      <tr class="sub-tema">
        <th>施策名<span class="must">&nbsp;※</span></th><th>納品月</th><th>企業名／サイト名<span class="must">&nbsp;※</span></th>
      </tr>
      <tr>
        <td class="td-width-90">
          <input autofocus type="text" name="measures" value="{{old('measures', $progress->measures)}}">
          @if($errors->has('measures'))
            <br><span id="error">※{{$errors->first('measures')}}</span>
          @endif
        </td>
        <td class="td-width-10">
          <select name="month">
            <option value="－" @if(old('month', $progress->month) == "－") selected @endif>－</option>
            @php
            $months = ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'];
            @endphp
            @foreach($months as $month)
              <option value="{{$month}}" @if(old('month', $progress->month) == $month) selected @endif>{{$month}}</option>
            @endforeach
          </select>
        </td>
        <td class="td-width-90">
          <input autofocus type="text" name="company" value="{{old('company', $progress->company)}}">
          @if($errors->has('company'))
            <br><span id="error">※{{$errors->first('company')}}</span>
          @endif
        </td>
      </tr>
      <tr class="sub-tema">
        <th>No.</th><th>タイトル</th><th>備考</th>
      </tr>
      <tr>
        <td class="td-width-10">
          <input type="text" inputmode="numeric" pattern="\d*" name="no" value="{{old('no', $progress->no)}}" placeholder="0">
        </td>
        <td class="td-width-90">
          <input type="text" name="title" value="{{old('title', $progress->title)}}" placeholder="例）不要になったソファの処分方法">
        </td>
        <td class="progress-textarea-width">
          <textarea class="progress-textarea" name="matter_content">{{old('matter_content', $progress->matter_content)}}</textarea>
        </td>
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
        <td class="td-width-30">
          <select name="original_staff">
            <option value="－" @if(old('original_staff', $progress->original_staff) == "－") selected @endif>－</option>
            @foreach($users as $user)
              <option value="{{$user->name}}" @if(old('original_staff', $progress->original_staff) == $user->name) selected @endif>{{$user->name}}</option>
            @endforeach
          </select>
        </td>
        <td class="td-width-10">
          <select name="original_done">
            <option value="未完了" @if(old('original_done', $progress->original_done) == "－") selected @endif>－</option>
            <option value="完了" @if(old('original_done', $progress->original_done) == "完了") selected @endif>完了</option>
          </select>
        </td>
        <td class="progress-textarea-width">
          <textarea class="progress-textarea" name="original_content">{{old('original_content', $progress->original_content)}}</textarea>
        </td>
      </tr>
      <tr class="sub-tema">
        <th colspan="3">チェック</th>
      </tr>
      <tr class="sub-tema">
        <th>担当者</th><th>完了</th><th>備考</th>
      </tr>
      <tr>
        <td class="td-width-30">
          <select name="check_staff">
            <option value="－" @if(old('check_staff', $progress->check_staff) == "－") selected @endif>－</option>
            @foreach($users as $user)
              <option value="{{$user->name}}" @if(old('check_staff', $progress->check_staff) == $user->name) selected @endif>{{$user->name}}</option>
            @endforeach
          </select>
        </td>
        <td class="td-width-10">
          <select name="check_done">
            <option value="未完了" @if(old('check_done', $progress->check_done) == "－") selected @endif>－</option>
            <option value="完了" @if(old('check_done', $progress->check_done) == "完了") selected @endif>完了</option>
          </select>
        </td>
        <td class="progress-textarea-width">
          <textarea class="progress-textarea" name="check_content">{{old('check_content', $progress->check_content)}}</textarea>
        </td>
      </tr>
      <tr class="sub-tema">
        <th colspan="3">修正</th>
      </tr>
      <tr class="sub-tema">
        <th>担当者</th><th>完了</th><th>備考</th>
      </tr>
      <tr>
        <td class="td-width-30">
          <select name="update_staff">
            <option value="－" @if(old('update_staff', $progress->update_staff) == "－") selected @endif>－</option>
            @foreach($users as $user)
              <option value="{{$user->name}}" @if(old('update_staff', $progress->update_staff) == $user->name) selected @endif>{{$user->name}}</option>
            @endforeach
          </select>
        </td>
        <td class="td-width-10">
          <select name="update_done">
            <option value="未完了" @if(old('update_done', $progress->update_done) == "－") selected @endif>－</option>
            <option value="完了" @if(old('update_done', $progress->update_done) == "完了") selected @endif>完了</option>
          </select>
        </td>
        <td class="progress-textarea-width">
          <textarea class="progress-textarea" name="update_content">{{old('update_content', $progress->update_content)}}</textarea>
        </td>
      </tr>
      <tr class="main-tema">
        <th colspan="3">納品ファイル作成</th>
      </tr>
      <tr class="sub-tema">
        <th>担当者</th><th>完了</th><th>備考</th>
      </tr>
      <tr>
        <td class="td-width-30">
          <select name="file_staff">
            <option value="－" @if(old('file_staff', $progress->file_staff) == "－") selected @endif>－</option>
            @foreach($users as $user)
              <option value="{{$user->name}}" @if(old('file_staff', $progress->file_staff) == $user->name) selected @endif>{{$user->name}}</option>
            @endforeach
          </select>
        </td>
        <td class="td-width-10">
          <select name="file_done">
            <option value="未完了" @if(old('file_done', $progress->file_done) == "－") selected @endif>－</option>
            <option value="完了" @if(old('file_done', $progress->file_done) == "完了") selected @endif>完了</option>
          </select>
        </td>
        <td class="progress-textarea-width">
          <textarea class="progress-textarea" name="file_content">{{old('file_content', $progress->file_content)}}</textarea>
        </td>
      </tr>
      <tr class="main-tema">
        <th colspan="3">最終チェック（営業）</th>
      </tr>
      <tr class="sub-tema">
        <th>担当者</th><th>完了</th><th>備考</th>
      </tr>
      <tr>
        <td class="td-width-30">
          <select name="sale_staff">
            <option value="－" @if(old('sale_staff', $progress->sale_staff) == "－") selected @endif>－</option>
            @php
              $sale_staffs = ['清野部長', '中西Mgr', '日高リーダー', '伏木', '森杉'];
            @endphp
            @foreach($sale_staffs as $sale_staff)
              <option value="{{$sale_staff}}" @if(old('sale_staff', $progress->sale_staff) == $sale_staff) selected @endif>{{$sale_staff}}</option>
            @endforeach
          </select>
        </td>
        <td class="td-width-10">
          <select name="sale_done">
            <option value="未完了" @if(old('sale_done', $progress->sale_done) == "－") selected @endif>－</option>
            <option value="完了" @if(old('sale_done', $progress->sale_done) == "完了") selected @endif>完了</option>
          </select>
        </td>
        <td class="progress-textarea-width">
          <textarea class="progress-textarea" name="sale_content">{{old('sale_content', $progress->sale_content)}}</textarea>
        </td>
      </tr>
      <tr class="main-tema">
        <th colspan="3">最終修正</th>
      </tr>
      <tr class="sub-tema">
        <th>担当者</th><th>完了</th><th>備考</th>
      </tr>
      <tr>
        <td class="td-width-30">
          <select name="final_staff">
            <option value="－" @if(old('final_staff', $progress->final_staff) == "－") selected @endif>－</option>
            @foreach($users as $user)
              <option value="{{$user->name}}" @if(old('final_staff', $progress->final_staff) == $user->name) selected @endif>{{$user->name}}</option>
            @endforeach
          </select>
        </td>
        <td class="td-width-10">
          <select name="final_done">
            <option value="未完了" @if(old('final_done', $progress->final_done) == "－") selected @endif>－</option>
            <option value="完了" @if(old('final_done', $progress->final_done) == "完了") selected @endif>完了</option>
          </select>
        </td>
        <td class="progress-textarea-width">
          <textarea class="progress-textarea" name="final_content">{{old('final_content', $progress->final_content)}}</textarea>
        </td>
      </tr>
      <tr class="main-tema">
        <th colspan="3">納品</th>
      </tr>
      <tr class="sub-tema">
        <th colspan="3">完了</th>
      </tr>
      <tr>
        <td colspan="3" class="td-width-10">
          <select name="delivery">
            <option value="未完了" @if(old('delivery', $progress->delivery) == "－") selected @endif>－</option>
            <option value="完了" @if(old('delivery', $progress->delivery) == "完了") selected @endif>完了</option>
          </select>
        </td>
      </tr>
    </tbody>
  </table>
  <div class="edit-progresses-btn-area">
    <ul>
      <li><input id="submit" type="submit" value="更新" onclick="return confirm('更新してもよろしいですか？')"></li>
    </ul>
  </div>
</form>
@endsection
