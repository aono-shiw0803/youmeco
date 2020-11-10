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
<?php
$posts = \App\Post::where('start_date', '<=', \Carbon\Carbon::today())->where('end_date', '>=', \Carbon\Carbon::today())->orderBy('start_date', 'asc')->get();
?>
<?php
$message = '[code]おはようございます！タイムカードとタスクのチェックを忘れずに！[/code]';

$member = ['小野','小高','大友','伊藤','淵上','川合' ];

?>

<?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php
$task_array[] = $post->task;
?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php
$task_unique = array_unique($task_array);
?>
<?php
foreach ($member as $m) {
?>
<?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if($post->staff == $m): ?>
  <?php if($post->matter != ''): ?>
  <?php
	  foreach ($task_unique as $t) {
	  	  if($post->task ==  $t){
     		$op[$m][$t][] = $post->matter;
	  	  }
  		}
  ?>
  <?php endif; ?>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\youmeco\resources\views/notices/index.blade.php ENDPATH**/ ?>