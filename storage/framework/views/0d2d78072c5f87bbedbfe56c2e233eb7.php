<div id="accordion-<?php echo e($templateSlug); ?>" class="accordion mb-3">
    <?php $__currentLoopData = $manyForms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name => $forms): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="accordion-heading <?php if($loop->index): ?> collapsed <?php endif; ?>"
             id="heading-<?php echo e(\Illuminate\Support\Str::slug($name)); ?>"
             data-bs-toggle="collapse"
             data-bs-target="#collapse-<?php echo e(\Illuminate\Support\Str::slug($name)); ?>"
             aria-expanded="true"
             aria-controls="collapse-<?php echo e(\Illuminate\Support\Str::slug($name)); ?>">
            <h6 class="btn btn-link btn-group-justified pt-2 pb-2 mb-0 pe-0 ps-0 d-flex align-items-center">
                <?php if (isset($component)) { $__componentOriginal385240e1db507cd70f0facab99c4d015 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal385240e1db507cd70f0facab99c4d015 = $attributes; } ?>
<?php $component = Orchid\Icons\IconComponent::resolve(['path' => 'bs.chevron-right','class' => 'small me-2'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('orchid-icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Orchid\Icons\IconComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal385240e1db507cd70f0facab99c4d015)): ?>
<?php $attributes = $__attributesOriginal385240e1db507cd70f0facab99c4d015; ?>
<?php unset($__attributesOriginal385240e1db507cd70f0facab99c4d015); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal385240e1db507cd70f0facab99c4d015)): ?>
<?php $component = $__componentOriginal385240e1db507cd70f0facab99c4d015; ?>
<?php unset($__componentOriginal385240e1db507cd70f0facab99c4d015); ?>
<?php endif; ?> <?php echo $name; ?>

            </h6>
        </div>

        <div id="collapse-<?php echo e(\Illuminate\Support\Str::slug($name)); ?>"
             class="mt-2 collapse <?php if(!$loop->index): ?> show <?php endif; ?>"
             aria-labelledby="heading-<?php echo e(\Illuminate\Support\Str::slug($name)); ?>"
             <?php if(!$stayOpen): ?>
                 data-bs-parent="#accordion-<?php echo e($templateSlug); ?>"
            <?php endif; ?>
        >
                <?php $__currentLoopData = $forms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $form): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo $form; ?>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php /**PATH /mnt/Локальный диск/диплом/domains/laravel-vue-orchid/vendor/orchid/platform/resources/views/layouts/accordion.blade.php ENDPATH**/ ?>