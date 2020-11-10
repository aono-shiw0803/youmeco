

<?php $__env->startSection('breadcrumbs'); ?>
  <?php echo e(Breadcrumbs::render('progresses-show', $progress)); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('main'); ?>
<div class="page-title">
  <p>詳細</p>
</div>
<div class="show-progresses-btn-area-top">
  <ul>
    <li><a href="<?php echo e(action('ProgressController@edit', $progress)); ?>" class="edit">編集</a></li>
    <li><a href="<?php echo e(url('/progresses/create')); ?>" id="new">進捗新規登録</a></li>
    <li>
      <form method="post" action="/progresses/delete/<?php echo e($progress->id); ?>">
        <?php echo csrf_field(); ?>
        <input class="delete" type="submit" value="削除" onclick="return confirm('本当に削除してもよろしいですか？')">
      </form>
    </li>
  </ul>
</div>
<table class="show-progresses-table">
  <tbody>
    <tr class="main-tema">
      <th colspan="3">案件</th>
    </tr>
    <tr class="sub-tema">
      <th>施策名</th><th>納品月</th><th>企業名／サイト名</th>
    </tr>
    <tr>
      <td class="td-width-90"><?php echo e($progress->measures); ?></td>
      <td class="td-width-10"><?php echo e($progress->month); ?></td>
      <td class="td-width-90"><?php echo e($progress->company); ?></td>
    </tr>
    <tr class="sub-tema">
      <th>No.</th><th>タイトル</th><th>備考</th>
    </tr>
    <tr>
      <td class="td-width-10"><?php echo e($progress->no); ?></td>
      <td class="td-width-90"><?php echo e($progress->title); ?></td>
      <td class="progress-show-textarea-width"><p><?php echo e($progress->matter_content); ?></p></td>
    </tr>
    <tr class="main-tema">
      <th colspan="3">納品物作成</th>
    </tr>
    <tr class="sub-tema">
      <th colspan="3">原本</th>
    </tr>
    <tr class="sub-tema">
      <th>担当者</th><th>完了</th><th>備考</th>
    </tr>
    <tr>
      <td class="td-width-30"><?php echo e($progress->original_staff); ?></td>
      <td class="td-width-10"><?php echo e($progress->original_done); ?></td>
      <td class="progress-show-textarea-width"><?php echo e($progress->original_content); ?></td>
    </tr>
    <tr class="sub-tema">
      <th colspan="3">チェック</th>
    </tr>
    <tr class="sub-tema">
      <th>担当者</th><th>完了</th><th>備考</th>
    </tr>
    <tr>
      <td class="td-width-30"><?php echo e($progress->check_staff); ?></select>
      </td>
      <td class="td-width-10"><?php echo e($progress->check_done); ?></td>
      <td class="progress-show-textarea-width"><?php echo e($progress->check_content); ?></td>
    </tr>
    <tr class="sub-tema">
      <th colspan="3">修正</th>
    </tr>
    <tr class="sub-tema">
      <th>担当者</th><th>完了</th><th>備考</th>
    </tr>
    <tr>
      <td class="td-width-30"><?php echo e($progress->update_staff); ?></select>
      </td>
      <td class="td-width-10"><?php echo e($progress->update_done); ?></td>
      <td class="progress-show-textarea-width"><?php echo e($progress->update_content); ?></td>
    </tr>
    <tr class="main-tema">
      <th colspan="3">納品ファイル作成</th>
    </tr>
    <tr class="sub-tema">
      <th>担当者</th><th>完了</th><th>備考</th>
    </tr>
    <tr>
      <td class="td-width-30"><?php echo e($progress->file_staff); ?></td>
      <td class="td-width-10"><?php echo e($progress->file_done); ?></td>
      <td class="progress-show-textarea-width"><?php echo e($progress->file_content); ?></td>
    </tr>
    <tr class="main-tema">
      <th colspan="3">最終チェック（営業）</th>
    </tr>
    <tr class="sub-tema">
      <th>担当者</th><th>完了</th><th>備考</th>
    </tr>
    <tr>
      <td class="td-width-30"><?php echo e($progress->sale_staff); ?></select>
      </td>
      <td class="td-width-10"><?php echo e($progress->sale_done); ?></td>
      <td class="progress-show-textarea-width"><?php echo e($progress->sale_content); ?></td>
    </tr>
    <tr class="main-tema">
      <th colspan="3">最終修正</th>
    </tr>
    <tr class="sub-tema">
      <th>担当者</th><th>完了</th><th>備考</th>
    </tr>
    <tr>
      <td class="td-width-30"><?php echo e($progress->final_staff); ?></td>
      <td class="td-width-10"><?php echo e($progress->final_done); ?></td>
      <td class="progress-show-textarea-width"><?php echo e($progress->final_content); ?></td>
    </tr>
    <tr class="main-tema">
      <th colspan="3">納品</th>
    </tr>
    <tr class="sub-tema">
      <th colspan="3">完了</th>
    </tr>
    <tr>
      <td colspan="3" class="td-width-10"><?php echo e($progress->delivery); ?></td>
    </tr>
  </tbody>
</table>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\youmeco\resources\views/progresses/show.blade.php ENDPATH**/ ?>