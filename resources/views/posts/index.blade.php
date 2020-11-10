@extends('layouts.index')

@section('breadcrumbs')
  {{ Breadcrumbs::render('posts') }}
@endsection

@section('main')

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
      <li><a href="{{route('export.post')}}" id="csv">CSV出力</a></li>
      <li><a href="{{url('/posts/create')}}" id="new">タスク追加</a></li>
      <li><a href="{{url('/conclusions')}}" id="pass">完了タスク一覧</a></li>
    </ul>
  </div>
</div>
<div class="index-posts">
  <table class="index-posts-table">
    <tbody>
      <tr>
        <th>詳細</th>
        <th>案件名</th>
        <th>タスク</th>
        <th>作業者</th>
        <th>工数</th>
      </tr>
      @forelse($posts as $post)
      @if($post->status == 0)
      <tr>
        @if(strtotime($today2) > strtotime($post->end_date))
        <td class="attention">
          <a href="{{url('/posts', $post->id)}}">未完了</a>
          <p class="msg">期日が過ぎています</p>
        </td>
        @else
        <td><a href="{{url('/posts', $post->id)}}" id="detail">詳細</a></td>
        @endif
        <td class="matter">{{$post->matter}}</td>
        @if($post->important == 1)
          <td class="task" style="background-color:#{{\App\Task::where('title', $post->task)->first()->bg}}">{{$post->task}}&nbsp;<i id="important-mark" class="fas fa-exclamation-triangle"></i></td>
        @else
          <td class="task" style="background-color:#{{\App\Task::where('title', $post->task)->first()->bg}}">{{$post->task}}</td>
        @endif
        <td class="staff">
          <p>
            @if(\App\User::where('name', $post->staff)->first()->icon == null)
              <img src="/storage/no-icon.png"><span>{{$post->staff}}</span>
            @else
              <img src="/storage/{{\App\User::where('name', $post->staff)->first()->icon}}"><span>{{$post->staff}}</span>
            @endif
          </p>
        </td>
        <td>{{$post->hour}}</td>
      </tr>
      @endif
      @empty
      <!-- <tr>
        <td colspan="5" id="null">登録されていません</td>
      </tr> -->
      @endforelse
    </tbody>
  </table>

  <?php
  // 「$start_date」と「$end_date」はPostControllerで定義している
  $diff = ( strtotime( $end_date ) - strtotime( $start_date ) ) / ( 60 * 60 * 24 );
  for( $i = 0; $i <= $diff; $i++ ) {
    $period[] = date('Y-m-d', strtotime( $start_date . '+' . $i . 'days') );
  }
  ?>

  <div class="schedule">
    <table class="schedule-table">
      <tbody>
        <tr class="days-tr">
          @foreach($period as $date)
          <th class="week{{ date('w',strtotime($date)) }}" id="<?php foreach($holidays as $holiday){ if(date('Y-m-d', strtotime($date)) == $holiday){ echo "holiday"; } } ?>"><p class="month-p">{{date('n',strtotime($date))}}</p></th>
          @endforeach
        </tr>
        <tr class="days-tr">
          @foreach($period as $date)
          <th class="week{{ date('w',strtotime($date)) }}" id="<?php foreach($holidays as $holiday){ if(date('Y-m-d', strtotime($date)) == $holiday){ echo "holiday"; } } ?>">{{date('d',strtotime($date))}}<br>{{ $weeks[date('w', strtotime($date))] }}</th>
          @endforeach
        </tr>
      </tbody>
    </table>
    @foreach($posts as $post)
    @if($post->status == 0)
    <table class="date-table">
      <tbody>
        <tr>
          @foreach($period as $date)
          @if(strtotime($date) >= strtotime($post->start_date) && strtotime($date) <= strtotime($post->end_date))
          <th class="target <?php foreach($holidays as $holiday){ if(date('Y-m-d', strtotime($date)) == $holiday){ echo "holiday"; } } ?>" id="week{{ date('w',strtotime($date)) }}" data-date="{{ $date }}"><p>00</p></th>
          @else
          <th class="<?php foreach($holidays as $holiday){ if(date('Y-m-d', strtotime($date)) == $holiday){ echo "holiday"; } } ?>" id="week{{ date('w',strtotime($date)) }}" data-date="{{ $date }}"><p>00</p></th>
          @endif
          @endforeach
        </tr>
      </tbody>
    </table>
    @endif
    @endforeach
  </div>
</div>
@endsection
