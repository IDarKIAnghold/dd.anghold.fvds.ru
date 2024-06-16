<fieldset class="mb-3" data-async>

    <?php if(empty(!$title)): ?>
        <div class="col p-0 px-3">
            <legend class="text-black text-black mt-2 mx-2">
                <?php echo e($title); ?>

            </legend>
        </div>
    <?php endif; ?>

    <div class="bg-white rounded shadow-sm p-4 py-4 d-flex flex-column">
        <dl class="d-block m-0">
            <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="d2-grid py-3 <?php echo e($loop->first ? '' : 'border-top'); ?>">
                    <dt class="text-muted fw-normal me-3">
                        <?php echo $column->buildDt($repository); ?>

                    </dt>
                    <dd class="text-black">
                        <?php echo $column->buildDd($repository); ?>

                    </dd>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </dl>
    </div>
</fieldset>
<?php /**PATH D:\диплом\domains\laravel-vue-orchid\vendor\orchid\platform\resources\views/layouts/legend.blade.php ENDPATH**/ ?>