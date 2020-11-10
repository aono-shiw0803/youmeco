@extends('layouts.app')

@section('main')
<div class="email-main">
  <div class="email-main-title">
    <p>パスワードの再設定</p>
  </div>
  <!-- if (session('status'))
  <div class="alert alert-success" role="alert">
    {{ session('status') }}
  </div>
  endif -->
  <form method="POST" action="{{ route('password.email') }}">
    @csrf
    <ul>
      <li id="head-space"><label for="email">登録済みメールアドレス</label></li>
      <li>
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
        @error('email')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </li>
      <li id="head-space"><button type="submit" class="btn btn-primary">パスワードリセット申請</button></li>
      <li id="head-space"><a href="/">トップに戻る</a></li>
    </ul>
  </form>
</div>
@endsection
