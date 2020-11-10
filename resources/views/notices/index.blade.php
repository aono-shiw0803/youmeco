@php
$posts = \App\Post::where('start_date', '<=', \Carbon\Carbon::today())->where('end_date', '>=', \Carbon\Carbon::today())->orderBy('start_date', 'asc')->get();
@endphp
<?php
$message = '[code]おはようございます！タイムカードとタスクのチェックを忘れずに！[/code]';

$member = ['小野','小高','大友','伊藤','淵上','川合' ];

?>

@foreach($posts as $post)
<?php
$task_array[] = $post->task;
?>
@endforeach
<?php
$task_unique = array_unique($task_array);
?>
<?php
foreach ($member as $m) {
?>
@foreach($posts as $post)
@if($post->staff == $m)
  @if($post->matter != '')
  <?php
	  foreach ($task_unique as $t) {
	  	  if($post->task ==  $t){
     		$op[$m][$t][] = $post->matter;
	  	  }
  		}
  ?>
  @endif
@endif
@endforeach
<?php
}
?>
<?php
foreach($op as $user => $tsk){

$message .= '[info]';
$message .= '[title]';
$message .= $user;
$message .= '[/title] ';

  foreach($tsk as $ts => $mt) :
       $message .= "\n ". '■ ' . $ts . "\n ";
	foreach($mt as $ma) {
       $message .= '・' . $ma;
       $message .= "\n ";
	}
  endforeach;
  $message .= '[/info]';
}

$msg = array(
        'body' => $message,
        );

$token = '095ded4922cd2796b284d07d35adb700';

$room = '200911847';

$ch = curl_init();
curl_setopt($ch, CURLOPT_HTTPHEADER,
            array('X-ChatWorkToken: '.$token));
curl_setopt($ch, CURLOPT_URL, "https://api.chatwork.com/v2/rooms/".$room."/messages");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($msg, '', '&'));
$result = curl_exec($ch);
curl_close($ch);
