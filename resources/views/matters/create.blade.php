@extends('layouts.index')

@section('breadcrumbs')
  {{ Breadcrumbs::render('matters-create') }}
@endsection

@section('main')
<div class="page-title">
  <p>案件追加</p>
</div>
<div class="matters-must">
  <p id="must"><span>※</span>は入力必須項目です。</p>
</div>
<form method="post" action="{{url('/matters')}}">
  @csrf
  <table class="create-matters-table">
    <tbody>
      <input type="hidden" inputmode="numeric" pattern="\d*" name="rank" value=99>
      <tr>
        <th id="middle">案件名&nbsp;<span class="must">※（20文字以内）</span></th>
        <td>
          <input autofocus id="large" type="text" name="name" placeholder="例）ミライユ" value="{{old('name')}}">
          @if($errors->has('name'))
          <br><span id="error">{{$errors->first('name')}}</span>
          @endif
        </td>
      </tr>
      <tr>
        <th id="middle">案件名2</th>
        <td>
          <input autofocus id="large" type="text" name="name_2" placeholder="例）【確】ミライユ" value="{{old('name_2')}}">
          @if($errors->has('name_2'))
          <br><span id="error">{{$errors->first('name_2')}}</span>
          @endif
        </td>
      </tr>
      <tr>
        <th>備考</th>
        <td>
          <textarea id="textarea" name="content">{{old('content')}}</textarea>
          @if($errors->has('content'))
          <br><span id="error">{{$errors->first('content')}}</span>
          @endif
        </td>
      </tr>
    </tbody>
  </table>
  <div class="create-matters-btn-area">
    <ul>
      <li><input id="submit" type="submit" value="追加" onclick="return confirm('追加してもよろしいですか？')"></li>
    </ul>
  </div>
</form>
@endsection
