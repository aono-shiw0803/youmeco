<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, inicial-scale=1.0">
  <meta name=”robots” content=”noindex”>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
  <script src="/js/main.js"></script>
  <title>YouMeCo</title>
  <link rel="stylesheet" href="/css/style.css">
</head>
<body>
{{$today}}のタスク
@php
$posts = \App\Post::where('start_date', '<=', \Carbon\Carbon::today())->where('end_date', '>=', \Carbon\Carbon::today())->orderBy('start_date', 'asc')->get();
@endphp
<br>【小野】
@foreach($posts as $post)
@if($post->staff == "小野")
<br>{{$post->matter}}：{{$post->task}}
@endif
@endforeach
<br>-------------------------------------------
<br>【小高】
@foreach($posts as $post)
@if($post->staff == "小高")
<br>{{$post->matter}}：{{$post->task}}
@endif
@endforeach
<br>-------------------------------------------
<br>【大友】
@foreach($posts as $post)
@if($post->staff == "大友")
<br>{{$post->matter}}：{{$post->task}}
@endif
@endforeach
<br>-------------------------------------------
<br>【伊藤】
@foreach($posts as $post)
@if($post->staff == "伊藤")
<br>{{$post->matter}}：{{$post->task}}
@endif
@endforeach
<br>-------------------------------------------
<br>【淵上】
@foreach($posts as $post)
@if($post->staff == "淵上")
<br>{{$post->matter}}：{{$post->task}}
@endif
@endforeach
<br>-------------------------------------------
<br>【川合】
@foreach($posts as $post)
@if($post->staff == "川合")
<br>{{$post->matter}}：{{$post->task}}
@endif
@endforeach
<br>-------------------------------------------
</body>
</html>
