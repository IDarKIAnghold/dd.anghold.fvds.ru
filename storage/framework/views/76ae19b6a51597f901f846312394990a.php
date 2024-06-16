<div class="mb-3 d-flex align-items-center">
    <span class="thumb-sm avatar me-3">
        <img src="<?php echo e($lockUser->presenter()->image()); ?>" class="b bg-light" alt="test">
    </span>
    <span style="width:125px;" class="small">
        <span class="text-ellipsis"><?php echo e($lockUser->presenter()->title()); ?></span>
        <span class="text-muted d-block text-ellipsis"><?php echo e($lockUser->presenter()->subTitle()); ?></span>
    </span>
    <input type="hidden" name="email" required value="<?php echo e($lockUser->email); ?>">
</div>

<?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
    <span class="d-block invalid-feedback text-danger">
            <?php echo e($errors->first('email')); ?>

    </span>
<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

<div class="mb-3">
    <input type="hidden" name="remember" value="true">

    <?php echo \Orchid\Screen\Fields\Password::make('password')
            ->required()
            ->autocomplete('current-password')
            ->tabindex(1)
            ->autofocus()
            ->placeholder(__('Enter your password')); ?>

</div>

<div class="row align-items-center">
    <div class="col-md-6 col-xs-12">
        <a href="<?php echo e(route('platform.login.lock')); ?>" class="small">
            <?php echo e(__('Sign in with another user.')); ?>

        </a>
    </div>
    <div class="col-md-6 col-xs-12">
        <button id="button-login" type="submit" class="btn btn-default btn-block" tabindex="2">
            <?php if (isset($component)) { $__componentOriginal385240e1db507cd70f0facab99c4d015 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal385240e1db507cd70f0facab99c4d015 = $attributes; } ?>
<?php $component = Orchid\Icons\IconComponent::resolve(['path' => 'bs.box-arrow-in-right','class' => 'small me-2'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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
<?php endif; ?>
            <?php echo e(__('Login')); ?>

        </button>
    </div>
</div>
<?php /**PATH /mnt/Локальный диск/диплом/domains/laravel-vue-orchid/vendor/orchid/platform/resources/views/auth/lockme.blade.php ENDPATH**/ ?>