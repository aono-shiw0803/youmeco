

<?php $__env->startSection('breadcrumbs'); ?>
  <?php echo e(Breadcrumbs::render('posts')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('main'); ?>

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
      <li><a href="<?php echo e(route('export.post')); ?>" id="csv">CSV出力</a></li>
      <li><a href="<?php echo e(url('/posts/create')); ?>" id="new">タスク追加</a></li>
      <li><a href="<?php echo e(url('/conclusions')); ?>" id="pass">完了タスク一覧</a></li>
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
      <?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
      <?php if($post->status == 0): ?>
      <tr>
        <?php if(strtotime($today2) > strtotime($post->end_date)): ?>
        <td class="attention">
          <a href="<?php echo e(url('/posts', $post->id)); ?>">未完了</a>
          <p class="msg">期日が過ぎています</p>
        </td>
        <?php else: ?>
        <td><a href="<?php echo e(url('/posts', $post->id)); ?>" id="detail">詳細</a></td>
        <?php endif; ?>
        <td class="matter"><?php echo e($post->matter); ?></td>
        <?php if($post->important == 1): ?>
          <td class="task" style="background-color:#<?php echo e(\App\Task::where('title', $post->task)->first()->bg); ?>"><?php echo e($post->task); ?>&nbsp;<i id="important-mark" class="fas fa-exclamation-triangle"></i></td>
        <?php else: ?>
          <td class="task" style="background-color:#<?php echo e(\App\Task::where('title', $post->task)->first()->bg); ?>"><?php echo e($post->task); ?></td>
        <?php endif; ?>
        <td class="staff">
          <p>
            <?php if(\App\User::where('name', $post->staff)->first()->icon == null): ?>
              <img src="/storage/no-icon.png"><span><?php echo e($post->staff); ?></span>
            <?php else: ?>
              <img src="/storage/<?php echo e(\App\User::where('name', $post->staff)->first()->icon); ?>"><span><?php echo e($post->staff); ?></span>
            <?php endif; ?>
          </p>
        </td>
        <td><?php echo e($post->hour); ?></td>
      </tr>
      <?php endif; ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
      <!-- <tr>
        <td colspan="5" id="null">登録されていません</td>
      </tr> -->
      <?php endif; ?>
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
          <?php $__currentLoopData = $period; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <th class="week<?php echo e(date('w',strtotime($date))); ?>" id="<?php foreach($holidays as $holiday){ if(date('Y-m-d', strtotime($date)) == $holiday){ echo "holiday"; } } ?>"><p class="month-p"><?php echo e(date('n',strtotime($date))); ?></p></th>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tr>
        <tr class="days-tr">
          <?php $__currentLoopData = $period; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <th class="week<?php echo e(date('w',strtotime($date))); ?>" id="<?php foreach($holidays as $holiday){ if(date('Y-m-d', strtotime($date)) == $holiday){ echo "holiday"; } } ?>"><?php echo e(date('d',strtotime($date))); ?><br><?php echo e($weeks[date('w', strtotime($date))]); ?></th>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tr>
      </tbody>
    </table>
    <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if($post->status == 0): ?>
    <table class="date-table">
      <tbody>
        <tr>
          <?php $__currentLoopData = $period; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php if(strtotime($date) >= strtotime($post->start_date) && strtotime($date) <= strtotime($post->end_date)): ?>
          <th class="target <?php foreach($holidays as $holiday){ if(date('Y-m-d', strtotime($date)) == $holiday){ echo "holiday"; } } ?>" id="week<?php echo e(date('w',strtotime($date))); ?>" data-date="<?php echo e($date); ?>"><p>00</p></th>
          <?php else: ?>
          <th class="<?php foreach($holidays as $holiday){ if(date('Y-m-d', strtotime($date)) == $holiday){ echo "holiday"; } } ?>" id="week<?php echo e(date('w',strtotime($date))); ?>" data-date="<?php echo e($date); ?>"><p>00</p></th>
          <?php endif; ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tr>
      </tbody>
    </table>
    <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\youmeco\resources\views/posts/index.blade.php ENDPATH**/ ?>