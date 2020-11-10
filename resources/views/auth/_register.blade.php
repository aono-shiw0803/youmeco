@extends('layouts.app')

@section('main')
<div class="login-main">
  <div class="login-main-title">
    <p>新規ユーザー登録</p>
  </div>
  <form method="POST" action="{{ route('register') }}">
    @csrf
    <ul>
      <li id="head-space"><label for="name">ユーザー名</label></li>
      <li>
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
        @error('name')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </li>
      <li id="head-space"><label for="email">メールアドレス</label></li>
      <li>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
        @error('email')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </li>
      <li id="head-space"><label for="password">パスワード</label></li>
      <li>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
        @error('password')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </li>
      <li id="head-space"><label for="password-confirm">パスワード（確認）</label></li>
      <li><input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password"></li>
      <li id="head-space"><button type="submit" onclick"return confirm('登録してもよろしいですか？')">登録</button></li>
      <li id="head-space"><a href="/">トップに戻る</a></li>
    </ul>
  </form>
</div>
@endsection
