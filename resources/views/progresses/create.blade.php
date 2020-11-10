@extends('layouts.index')

@section('breadcrumbs')
  {{ Breadcrumbs::render('progresses-create') }}
@endsection

@section('main')
<div class="page-title">
  <p>新規登録</p>
</div>
<div class="progresses-must">
  <p id="must"><span>※</span>は入力必須項目です。</p>
</div>
<form method="post" action="{{url('/progresses')}}">
  @csrf
  <table class="create-progresses-table">
    <tbody>
      <tr class="main-tema">
        <th colspan="3">案件</th>
      </tr>
      <tr class="sub-tema">
        <th>施策名<span class="must">&nbsp;※</span></th><th>納品月</th><th>企業名／サイト名<span class="must">&nbsp;※</span></th>
      </tr>
      <tr>
        <td class="td-width-90">
          <input autofocus type="text" name="measures" value="{{old('measures')}}" placeholder="例）ライティング支援">
          @if($errors->has('measures'))
            <br><span id="error">※{{$errors->first('measures')}}</span>
          @endif
        </td>
        <td class="td-width-10">
          <select name="month">
            <option value="－">－</option>
            @php
            $months = ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'];
            @endphp
            @foreach($months as $month)
              <option value={{$month}}>{{$month}}</option>
            @endforeach
          </select>
        </td>
        <td class="td-width-90">
          <input autofocus type="text" name="company" value="{{old('company')}}" placeholder="例）【集客激増プラン】沼田椅子製作所">
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
          <input type="text" inputmode="numeric" pattern="\d*" name="no" value="{{old('no')}}" placeholder="0">
        </td>
        <td class="td-width-90">
          <input type="text" name="title" value="{{old('title')}}" placeholder="例）不要になったソファの処分方法">
        </td>
        <td class="progress-textarea-width">
          <textarea class="progress-textarea" name="matter_content">{{old('matter_content')}}</textarea>
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
            <option value="－">－</option>
            @foreach($users as $user)
              <option value="{{$user->name}}">{{$user->name}}</option>
            @endforeach
          </select>
        </td>
        <td class="td-width-10">
          <select name="original_done">
            <option value="未完了">－</option>
            <option value="完了">完了</option>
          </select>
        </td>
        <td class="progress-textarea-width">
          <textarea class="progress-textarea" name="original_content">{{old('original_content')}}</textarea>
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
            <option value="－">－</option>
            @foreach($users as $user)
              <option value="{{$user->name}}">{{$user->name}}</option>
            @endforeach
          </select>
        </td>
        <td class="td-width-10">
          <select name="check_done">
            <option value="未完了">－</option>
            <option value="完了">完了</option>
          </select>
        </td>
        <td class="progress-textarea-width">
          <textarea class="progress-textarea" name="check_content">{{old('check_content')}}</textarea>
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
            <option value="－">－</option>
            @foreach($users as $user)
              <option value="{{$user->name}}">{{$user->name}}</option>
            @endforeach
          </select>
        </td>
        <td class="td-width-10">
          <select name="update_done">
            <option value="未完了">－</option>
            <option value="完了">完了</option>
          </select>
        </td>
        <td class="progress-textarea-width">
          <textarea class="progress-textarea" name="update_content">{{old('update_content')}}</textarea>
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
            <option value="－">－</option>
            @foreach($users as $user)
              <option value="{{$user->name}}">{{$user->name}}</option>
            @endforeach
          </select>
        </td>
        <td class="td-width-10">
          <select name="file_done">
            <option value="未完了">－</option>
            <option value="完了">完了</option>
          </select>
        </td>
        <td class="progress-textarea-width">
          <textarea class="progress-textarea" name="file_content">{{old('file_content')}}</textarea>
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
            <option value="－">－</option>
            @php
              $sale_staffs = ['清野部長', '中西Mgr', '日高リーダー', '伏木', '森杉'];
            @endphp
            @foreach($sale_staffs as $sale_staff)
              <option value="{{$sale_staff}}">{{$sale_staff}}</option>
            @endforeach
          </select>
        </td>
        <td class="td-width-10">
          <select name="sale_done">
            <option value="未完了">－</option>
            <option value="完了">完了</option>
          </select>
        </td>
        <td class="progress-textarea-width">
          <textarea class="progress-textarea" name="sale_content">{{old('sale_content')}}</textarea>
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
            <option value="－">－</option>
            @foreach($users as $user)
              <option value="{{$user->name}}">{{$user->name}}</option>
            @endforeach
          </select>
        </td>
        <td class="td-width-10">
          <select name="final_done">
            <option value="未完了">－</option>
            <option value="完了">完了</option>
          </select>
        </td>
        <td class="progress-textarea-width">
          <textarea class="progress-textarea" name="final_content">{{old('final_content')}}</textarea>
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
            <option value="未完了">－</option>
            <option value="完了">完了</option>
          </select>
        </td>
      </tr>
    </tbody>
  </table>
  <div class="create-progresses-btn-area">
    <ul>
      <li><input id="submit" type="submit" value="登録" onclick="return confirm('登録してもよろしいですか？')"></li>
    </ul>
  </div>
</form>
@endsection
