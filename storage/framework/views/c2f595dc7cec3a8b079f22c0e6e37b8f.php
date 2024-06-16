<div class="row form-group <?php echo e($align); ?>">
    <?php $__currentLoopData = $group; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="<?php echo e($class); ?>

                    <?php echo e($loop->first && $itemToEnd ? 'ms-auto': ''); ?>

                    <?php echo e(!$loop->last ? 'pe-md-0': ''); ?>

            ">
            <?php echo $field; ?>

        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php /**PATH /mnt/Локальный диск/диплом/domains/laravel-vue-orchid/vendor/orchid/platform/resources/views/fields/group.blade.php ENDPATH**/ ?>