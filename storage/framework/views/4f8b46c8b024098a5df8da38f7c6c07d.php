<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title inertia><?php echo e(config('app.name')); ?></title>

    <link rel="shortcut icon" href="<?php echo e(asset('favicon.svg')); ?>" type="image/x-icon">

    <!-- Actual stylesheet links -->
    <link rel="stylesheet" href="<?php echo e(asset('/css/reset.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/css/bootstrap.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('/css/style.css')); ?>">

</head>

<body>
    <header class="sticky-top" style="top: 0; z-index:1050" id="navigation"></header>

    <main class="wrapper">
        <div class="mt-5 mb-5 ps-3 pe-3 maincontainer">
            <div class="container-xxl py-4 main" id="main"><?php if (!isset($__inertiaSsrDispatched)) { $__inertiaSsrDispatched = true; $__inertiaSsrResponse = app(\Inertia\Ssr\Gateway::class)->dispatch($page); }  if ($__inertiaSsrResponse) { echo $__inertiaSsrResponse->body; } else { ?><div id="app" data-page="<?php echo e(json_encode($page)); ?>"></div><?php } ?></div>
        </div>
    </main>

    <div class="modal fade">
        <div class="modal-content"></div>
    </div>

    <footer class="site-footer mt-5" id="footer"></footer>

    <?php echo app('Tighten\Ziggy\BladeRouteGenerator')->generate(); ?>
    <script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/js/app.js']); ?>
    
</body>

</html>
<?php /**PATH D:\диплом\domains\laravel-vue-orchid\resources\views/app.blade.php ENDPATH**/ ?>