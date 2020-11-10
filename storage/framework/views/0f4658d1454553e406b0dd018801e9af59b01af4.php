

<?php $__env->startSection('breadcrumbs'); ?>
  <?php echo e(Breadcrumbs::render('contents')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('main'); ?>
<div class="page-title">
  <p>コンテンツ作成スケジュール</p>
</div>
<div class="sub-header">
  <div class="date-select">
    <P>ー&nbsp;表示期間の設定&nbsp;ー</P>
    <form method="get">
      <input type="date" name="start_date" value="<?php echo e($start_date); ?>">
      <input type="date" name="end_date" value="<?php echo e($end_date); ?>">
      <input id="set" type="submit" value="設定">
    </form>
  </div>
  <div class="conclusions-btn">
    <ul>
      <li><a href="<?php echo e(url('/posts/create')); ?>" id="new">タスク追加</a></li>
      <li><a href="<?php echo e(url('/posts')); ?>" id="pass">未完了タスク一覧</a></li>
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
  <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <table class="index-contents-table">
    <tbody>
      <tr>
        <th>日付</th>
        <th colspan="100"><?php echo e($user->name); ?></th>
      </tr>
      <?php $__currentLoopData = $period; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <tr>
        <th class="week<?php echo e(date('w',strtotime($date))); ?>" id="<?php foreach($holidays as $holiday){ if(date('Y-m-d', strtotime($date)) == $holiday){ echo "holiday"; } } ?>"><p><?php echo e(date('m月d日',strtotime($date))); ?>（<?php echo e($weeks[date('w', strtotime($date))]); ?>）</p></th>
        <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php if($post->status == 0): ?>
            <?php if($user->name == $post->staff): ?>
              <?php if($post->start_date <= $date && $date <= $post->end_date): ?>
                <?php if(strpos($post->matter_2, '納') != false): ?>
                  <td class="bold-red" style="background-color:<?php echo e($post->salestaff_bg); ?>"><?php echo e($post->matter_2); ?></td>
                <?php else: ?>
                  <td style="background-color:<?php echo e($post->salestaff_bg); ?>"><?php echo e($post->matter_2); ?></td>
                <?php endif; ?>
              <?php endif; ?>
            <?php endif; ?>
          <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </tr>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
  </table>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\youmeco\resources\views/contents/index.blade.php ENDPATH**/ ?>