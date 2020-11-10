

<?php $__env->startSection('breadcrumbs'); ?>
  <?php echo e(Breadcrumbs::render('conclusions')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('main'); ?>
<div class="page-title">
  <p>完了タスク一覧</p>
</div>
<div id="conclusions-btn">
  <ul>
    <li><a href="<?php echo e(route('export.conclution')); ?>" id="csv">CSV出力</a></li>
    <li><a href="<?php echo e(url('/posts/create')); ?>" id="new">タスク追加</a></li>
    <li><a href="<?php echo e(url('/posts')); ?>" id="pass">未完了タスク一覧</a></li>
  </ul>
</div>

<form method="post" action="delete_post">
  <?php echo csrf_field(); ?>
  <div class="index-conclusions">
    <table class="index-conclusions-table">
      <tbody>
        <tr>
          <th>詳細</th>
          <th>案件名</th>
          <th>タスク</th>
          <th>作業者</th>
          <th>工数</th>
          <th>開始日</th>
          <th>完了日</th>
          <th>削除</th>
        </tr>
        <?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <?php if($post->status == 1): ?>
        <tr>
          <td><a href="<?php echo e(url('/posts', $post->id)); ?>" id="detail">詳細</a></td>
          <td class="matter"><?php echo e($post->matter); ?></td>
          <td class="task"><?php echo e($post->task); ?></td>
          <td class="staff">
            <p>
              <?php if($user->icon == null): ?>
              <img src="/storage/no-icon.png"><span><?php echo e($post->staff); ?></span>
              <?php else: ?>
              <img src="/storage/<?php echo e($user->icon); ?>"><span><?php echo e($post->staff); ?></span>
              <?php endif; ?>
            </p>
          </td>
          <td><?php echo e($post->hour); ?></td>
          <td><?php echo e($post->start_date); ?></td>
          <td><?php echo e($post->end_date); ?></td>
          <td><input type="checkbox" name="ids[]" value="<?php echo e($post->id); ?>"</td>
        </tr>
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
          <td colspan="8" id="null">完了タスクはありません</td>
        </tr>
        <?php endif; ?>
      </tbody>
    </table>
    <div class="delete-btns">
      <input type="submit" value="&#xf2ed" class="fas" onClick="return confirm('選択した項目を全て削除してもよろしいですか？')">
    </div>
  </div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\youmeco\resources\views/conclusions/index.blade.php ENDPATH**/ ?>