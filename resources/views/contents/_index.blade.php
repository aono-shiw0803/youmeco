@extends('layouts.index')

@section('breadcrumbs')
  {{ Breadcrumbs::render('contents') }}
@endsection

@section('main')
<div class="page-title">
  <p>コンテンツ作成スケジュール</p>
</div>
<div class="sub-header">
  <div class="date-select">
    <P>ー&nbsp;表示期間の設定&nbsp;ー</P>
    <form method="get">
      <input type="date" name="start_date" value="{{$start_date}}">
      <input type="date" name="end_date" value="{{$end_date}}">
      <input id="set" type="submit" value="設定">
    </form>
  </div>
  <div class="conclusions-btn">
    <ul>
      <li><a href="{{url('/posts/create')}}" id="new">タスク追加</a></li>
      <li><a href="{{url('/posts')}}" id="pass">未完了タスク一覧</a></li>
    </ul>
  </div>
</div>

<div class="index-contents">
  <table class="index-contents-table">
    <thead>
      <tr>
        <th>日付</th>
      </tr>
    </thead>
    <?php
    // 「$start_date」と「$end_date」はPostControllerで定義している
    $diff = ( strtotime( $end_date ) - strtotime( $start_date ) ) / ( 60 * 60 * 24 );
    for( $i = 0; $i <= $diff; $i++ ) {
      $period[] = date('Y-m-d', strtotime( $start_date . '+' . $i . 'days') );
    }
    ?>
    <tbody>
      @foreach($period as $date)
        <tr class="days-tr">
          <td class="week{{ date('w',strtotime($date)) }}" id="<?php foreach($holidays as $holiday){ if(date('Y-m-d', strtotime($date)) == $holiday){ echo "holiday"; } } ?>"><p>{{date('m月d日',strtotime($date))}}（{{ $weeks[date('w', strtotime($date))] }}）</p></td>
        </tr>
      @endforeach
    </tbody>
  </table>
  <div class="salestaff-lists">
    <table>
      <thead>
        <tr>
          @foreach($users as $user)
            <th>{{$user->name}}</th>
          @endforeach
        </tr>
      </thead>
      <tbody>
        <tr>
          @foreach($posts as $post)
            <th>{{$post->matter_2}}</th>
          @endforeach
        </tr>
      </tbody>
    </table>
  </div>
</div>
@endsection
