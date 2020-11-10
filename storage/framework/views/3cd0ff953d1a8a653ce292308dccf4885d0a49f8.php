

<?php $__env->startSection('breadcrumbs'); ?>
  <?php echo e(Breadcrumbs::render('posts-create')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('main'); ?>
<div class="page-title">
  <p>新規タスク追加</p>
</div>
<div class="posts-must">
  <p id="must"><span>※</span>は入力必須項目です。</p>
</div>
<form method="post" action="<?php echo e(url('/posts')); ?>" enctype="multipart/form-data">
  <?php echo csrf_field(); ?>
  <table class="create-posts-table">
    <tbody>
      <input type="hidden" name="status" value=0>
      <tr>
        <th id="middle">案件名<span class="must">※</span></th>
        <td>
          <select autofocus id="small" name="matter">
            <option disabled selected value>選択してください</option>
            <?php $__currentLoopData = $matters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $matter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($matter->name); ?>" <?php if(old('matter', $matter->matter) == $matter->name): ?> selected <?php endif; ?>><?php echo e($matter->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
          <?php if($errors->has('matter')): ?>
          <span id="error"><?php echo e($errors->first('matter')); ?></span>
          <?php endif; ?>
        </td>
      </tr>
      <tr>
        <th id="middle">案件名2</th>
        <td>
          <select autofocus id="small" name="matter_2">
            <option disabled selected value>選択してください</option>
            <?php $__currentLoopData = $matters; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $matter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($matter->name_2); ?>" <?php if(old('matter_2', $matter->matter_2) == $matter->name_2): ?> selected <?php endif; ?>><?php echo e($matter->name_2); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
          <?php if($errors->has('matter_2')): ?>
          <span id="error"><?php echo e($errors->first('matter_2')); ?></span>
          <?php endif; ?>
        </td>
      </tr>
      <tr>
        <th>タスク<span class="must">※</span></th>
        <td>
          <select id="small" name="task">
            <option disabled selected value>選択してください</option>
            <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($task->title); ?>" <?php if(old('task', $task->task) == $task->title): ?> selected <?php endif; ?>><?php echo e($task->title); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
          <?php if($errors->has('task')): ?>
          <span id="error"><?php echo e($errors->first('task')); ?></span>
          <?php endif; ?>
        </td>
      </tr>
      <tr>
        <th>作業者<span class="must">※</span></th>
        <td>
          <select id="small" name="staff">
            <option disabled selected value>選択してください</option>
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($user->name); ?>"><?php echo e($user->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
          <?php if($errors->has('staff')): ?>
          <span id="error"><?php echo e($errors->first('staff')); ?></span>
          <?php endif; ?>
        </td>
      </tr>
      <tr>
        <th>営業担当</th>
        <td>
          <select id="small" name="salestaff">
            <option disabled selected value>選択してください</option>
            <option value="中西">中西</option>
            <option value="日高">日高</option>
            <option value="伏木">伏木</option>
            <option value="森杉">森杉</option>
          </select>
          <?php if($errors->has('salestaff')): ?>
          <span id="error"><?php echo e($errors->first('salestaff')); ?></span>
          <?php endif; ?>
        </td>
      </tr>
      <tr>
        <th>営業担当欄の背景色</th>
        <?php
          $salestaff_bgs[] = array();
          $salestaff_bgs = ['#FFCC66', '#99CC99', '#FFC7AF', '#A4C6FF', '#CCCCCC', '#D9E5FF', '#FFCCCC']
        ?>
        <td id="radio-salestaff_bg">
          <?php $__currentLoopData = $salestaff_bgs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $salestaff_bg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <i class="fas fa-circle" style="color:<?php echo e($salestaff_bg); ?>"></i><input type="radio" name="salestaff_bg" value="<?php echo e($salestaff_bg); ?>">
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </td>
      </tr>
      <tr>
        <th>担当者</th>
        <td>
          <select id="small" name="windowstaff">
            <option disabled selected value>選択してください</option>
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($user->name); ?>"><?php echo e($user->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
          <?php if($errors->has('windowstaff')): ?>
          <span id="error"><?php echo e($errors->first('windowstaff')); ?></span>
          <?php endif; ?>
        </td>
      </tr>
      <tr>
        <th>工数<span class="must">※</span></th>
        <td>
          <input type="text" inputmode="numeric" pattern="\d*" name="hour" value="<?php echo e(old('hour')); ?>" placeholder="0">
          <?php if($errors->has('hour')): ?>
          <span id="error"><?php echo e($errors->first('hour')); ?></span>
          <?php endif; ?>
        </td>
      </tr>
      <tr>
        <th>種別</th>
        <td>
          <select id="small" name="type">
            <option disabled selected value>選択してください</option>
            <option value="記事">記事</option>
            <option value="方針案">方針案</option>
          </select>
          <?php if($errors->has('type')): ?>
          <span id="error"><?php echo e($errors->first('type')); ?></span>
          <?php endif; ?>
        </td>
      </tr>
      <tr>
        <th>開始日<span class="must">※</span></th>
        <td>
          <input type="date" name="start_date" value="<?php echo e(old('start_date')); ?>">
          <?php if($errors->has('start_date')): ?>
          <span id="error"><?php echo e($errors->first('start_date')); ?></span>
          <?php endif; ?>
        </td>
      </tr>
      <tr>
        <th>完了日<span class="must">※</span></th>
        <td>
          <input type="date" name="end_date" value="<?php echo e(old('end_date')); ?>">
          <?php if($errors->has('end_date')): ?>
          <span id="error"><?php echo e($errors->first('end_date')); ?></span>
          <?php endif; ?>
        </td>
      </tr>
      <tr>
        <th>納品日</th>
        <td>
          <input type="date" name="delivery_date" value="<?php echo e(old('delivery_date')); ?>">
          <?php if($errors->has('delivery_date')): ?>
          <span id="error"><?php echo e($errors->first('delivery_date')); ?></span>
          <?php endif; ?>
        </td>
      </tr>
      <tr>
        <th>納品数</th>
        <td>
          <input id="delivery" type="text" name="delivery_number" value="<?php echo e(old('delivery_number')); ?>" placeholder="例）2/3">
          <?php if($errors->has('delivery_number')): ?>
          <span id="error"><?php echo e($errors->first('delivery_number')); ?></span>
          <?php endif; ?>
        </td>
      </tr>
      <tr>
        <th>重要チェック</th>
        <td>
          <input type="checkbox" name="important" value="1">&nbsp;&nbsp;&nbsp;<span id="important">※重要なタスクの場合はチェックを入れてください。</span>
          <?php if($errors->has('important')): ?>
          <span id="error"><?php echo e($errors->first('important')); ?></span>
          <?php endif; ?>
        </td>
      </tr>
      <tr>
        <th>備考</th>
        <td>
          <textarea id="textarea" name="content"><?php echo e(old('content')); ?></textarea>
          <?php if($errors->has('content')): ?>
          <span id="error"><?php echo e($errors->first('content')); ?></span>
          <?php endif; ?>
        </td>
      </tr>
    </tbody>
  </table>
  <div class="create-posts-btn-area">
    <ul>
      <li><input id="submit" type="submit" value="追加" onclick="return confirm('追加してもよろしいですか？')"></li>
    </ul>
  </div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.index', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\youmeco\resources\views/posts/create.blade.php ENDPATH**/ ?>