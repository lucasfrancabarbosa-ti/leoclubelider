

<?php $__env->startSection('title', 'Nova novidade'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex align-items-center gap-2 mb-4">
    <a href="<?php echo e(route('novidades.index')); ?>" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left"></i></a>
    <h2 class="mb-0"><i class="bi bi-plus-lg"></i> Nova novidade</h2>
</div>

<div class="card">
    <div class="card-body">
        <form action="<?php echo e(route('novidades.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo $__env->make('novidades._form', ['novidade' => new \App\Models\Novidade()], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/novidades/create.blade.php ENDPATH**/ ?>