@extends('layouts.app')

<div class="animation">
  <div clasS="animation-main">
    <ul>
      <li id="anime-1">You&nbsp;</li>
      <li id="anime-2">Me&nbsp;</li>
      <li id="anime-3">Co</li>
    </ul>
    <h1><span>You</span>&nbsp;and&nbsp;<span>Me</span>&nbsp;for&nbsp;<span>Co</span>ntents</h1>
  </div>
</div>

@section('main')
<div class="welcome-btn">
  <a href="{{ route('login') }}">ログイン</a>
</div>
@endsection
