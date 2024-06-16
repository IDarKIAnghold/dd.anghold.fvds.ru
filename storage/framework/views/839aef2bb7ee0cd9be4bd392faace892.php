<td class="text-<?php echo e($align); ?> <?php if(!$width): ?> text-truncate <?php endif; ?> <?php echo e($class); ?>"
    data-column="<?php echo e($slug); ?>" colspan="<?php echo e($colspan); ?>"
        style="<?php echo \Illuminate\Support\Arr::toCssStyles([
        "min-width:$width;" => $width,
        "$style" => $style,
        ]) ?>"
>
    <div>
        <?php if(isset($render)): ?>
            <?php echo $value; ?>

        <?php else: ?>
            <?php echo e($value); ?>

        <?php endif; ?>
    </div>
</td>
<?php /**PATH /mnt/Локальный диск/диплом/domains/laravel-vue-orchid/vendor/orchid/platform/resources/views/partials/layouts/td.blade.php ENDPATH**/ ?>