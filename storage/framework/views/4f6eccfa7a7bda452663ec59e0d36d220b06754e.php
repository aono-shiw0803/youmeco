

<?php $__env->startSection('breadcrumbs'); ?>
  <?php echo e(Breadcrumbs::render('progresses')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('main'); ?>
<div class="page-title">
  <p>コンテンツ進捗管理表</p>
</div>
<div class="sub-header">
  <div class="conclusions-btn">
    <ul>
      <li><a href="<?php echo e(url('/progresses/create')); ?>" id="new">進捗新規登録</a></li>
      <li><a href="<?php echo e(url('/progresses/edit_ajax')); ?>" class="edit">担当者一括編集</a></li>
    </ul>
  </div>
</div>

<form method="post" action="delete_progress">
  <?php echo csrf_field(); ?>
  <div class="index-progresses">
    <table class="index-progresses-table">
      <thead>
        <tr>
          <th class="main-tema" rowspan="3">詳細</th><th class="main-tema" colspan="6" rowspan="2">案件</th><th class="main-tema" colspan="4">納品物作成</th><th class="main-tema" colspan="2"></th><th class="main-tema" colspan="2">納品ファイル作成</th><th class="main-tema" colspan="2">最終チェック（営業）</th><th class="main-tema" colspan="2">最終修正</th><th class="main-tema">納品</th><th class="main-tema" rowspan="3">編集</th>
          <th class="main-tema" rowspan="3"><input id="garbage" type="submit" value="&#xf2ed" class="fas" onClick="return confirm('選択した項目を全て削除してもよろしいですか？')"></th>
        </tr>
        <tr>
          <th class="sub-tema" colspan="2">原本</th><th class="sub-tema" colspan="2">チェック</th><th class="sub-tema" colspan="2">修正</th><th class="sub-tema" colspan="2"></th><th class="sub-tema" colspan="2"></th><th class="sub-tema" colspan="2"></th><th class="sub-tema"></th>
        </tr>
        <tr>
          <th class="sub-tema">施策名</th><th class="sub-tema">納品月</th><th class="sub-tema">完全完了</th><th class="sub-tema">企業名／サイト名</th><th class="sub-tema">No.</th><th class="sub-tema">タイトル</th><th class="sub-tema">担当者</th><th class="sub-tema">完了</th><th class="sub-tema">担当者</th><th class="sub-tema">完了</th><th class="sub-tema">担当者</th><th class="sub-tema">完了</th>
          <th class="sub-tema">担当者</th><th class="sub-tema">完了</th><th class="sub-tema">担当者</th><th class="sub-tema">完了</th><th class="sub-tema">担当者</th><th class="sub-tema">完了</th><th class="sub-tema">完了</th>
        </tr>
      </thead>
      <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $progresses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $progress): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
          <td class="text-center"><a href="<?php echo e(url('/progresses', $progress->id)); ?>"><i id="search" class="fas fa-search"></i></a></td>
          <td><p><?php echo e($progress->measures); ?></p></td>
          <td><?php echo e($progress->month); ?></td>
          <?php if($progress->original_done == "完了" && $progress->check_done == "完了" && $progress->update_done == "完了" && $progress->file_done == "完了" && $progress->sale_done == "完了" && $progress->final_done == "完了" && $progress->delivery == "完了"): ?>
          <td><i class="fas fa-circle done circle-grid"></i></td>
          <?php else: ?>
          <td>－</td>
          <?php endif; ?>
          <td><p><?php echo e($progress->company); ?></p></td>
          <td><?php echo e($progress->no); ?></td>
          <?php if($progress->title == true): ?>
          <td><p><?php echo e($progress->title); ?></p></td>
          <?php else: ?>
          <td class="text-center">－</td>
          <?php endif; ?>
          <td><?php echo e($progress->original_staff); ?></td>
          <?php if($progress->original_done == '完了'): ?>
          <td><i class="fas fa-circle done circle-grid"></i></td>
          <?php else: ?>
          <td>－</td>
          <?php endif; ?>
          <td><?php echo e($progress->check_staff); ?></td>
          <?php if($progress->check_done == '完了'): ?>
          <td><i class="fas fa-circle done circle-grid"></i></td>
          <?php else: ?>
          <td>－</td>
          <?php endif; ?>
          <td><?php echo e($progress->update_staff); ?></td>
          <?php if($progress->update_done == '完了'): ?>
          <td><i class="fas fa-circle done circle-grid"></i></td>
          <?php else: ?>
          <td>－</td>
          <?php endif; ?>
          <td><?php echo e($progress->file_staff); ?></td>
          <?php if($progress->file_done == '完了'): ?>
          <td><i class="fas fa-circle done circle-grid"></i></td>
          <?php else: ?>
          <td>－</td>
          <?php endif; ?>
          <td><?php echo e($progress->sale_staff); ?></td>
          <?php if($progress->sale_done == '完了'): ?>
          <td><i class="fas fa-circle done circle-grid"></i></td>
          <?php else: ?>
          <td>－</td>
          <?php endif; ?>
          <td><?php echo e($progress->final_staff); ?></td>
          <?php if($progress->final_done == '完了'): ?>
          <td><i class="fas fa-circle done circle-grid"></i></td>
          <?php else: ?>
          <td>－</td>
          <?php endif; ?>
          <?php if($progress->delivery == '完了'): ?>
          <td><i class="fas fa-circle done circle-grid"></i></td>
          <?php else: ?>
          <td>－</td>
          <?php endif; ?>
          <td class="text-center"><a href="<?php echo e(action('ProgressController@edit', $progress)); ?>" id="edit">編集</a></td>
          <td class="text-center"><input type="checkbox" name="ids[]" value="<?php echo e($progress->id); ?>"</td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <tr>
          <td colspan="22" id="null">登録されていません。</td>
        </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\youmeco\resources\views/progresses/index.blade.php ENDPATH**/ ?>