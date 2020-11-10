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

<?php
$diff = ( strtotime( $end_date ) - strtotime( $start_date ) ) / ( 60 * 60 * 24 );
for( $i = 0; $i <= $diff; $i++ ) {
  $period[] = date('Y-m-d', strtotime( $start_date . '+' . $i . 'days') );
}
?>
<div class="index-contents">
  @foreach($users as $user)
  <table class="index-contents-table">
    <tbody>
      <tr>
        <th>日付</th>
        <th colspan="100">{{$user->name}}</th>
      </tr>
      @foreach($period as $date)
      <tr>
        <th class="week{{ date('w',strtotime($date)) }}" id="<?php foreach($holidays as $holiday){ if(date('Y-m-d', strtotime($date)) == $holiday){ echo "holiday"; } } ?>"><p>{{date('m月d日',strtotime($date))}}（{{ $weeks[date('w', strtotime($date))] }}）</p></th>
        @foreach($posts as $post)
          @if($post->status == 0)
            @if($user->name == $post->staff)
              @if($post->start_date <= $date && $date <= $post->end_date)
                @if(strpos($post->matter_2, '納') != false)
                  <td class="bold-red" style="background-color:{{$post->salestaff_bg}}">{{$post->matter_2}}</td>
                @else
                  <td style="background-color:{{$post->salestaff_bg}}">{{$post->matter_2}}</td>
                @endif
              @endif
            @endif
          @endif
        @endforeach
      </tr>
      @endforeach
    </tbody>
  </table>
  @endforeach
</div>
@endsection
