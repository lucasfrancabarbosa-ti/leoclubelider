

<?php $__env->startSection('title', 'Nova página'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex align-items-center gap-2 mb-4">
    <a href="<?php echo e(route('pages.index')); ?>" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left"></i></a>
    <h2 class="mb-0"><i class="bi bi-plus-lg"></i> Nova página</h2>
</div>

<div class="card">
    <div class="card-body">
        <form action="<?php echo e(route('pages.store')); ?>" method="POST" enctype="multipart/form-data">
            <?php echo $__env->make('pages._form', ['page' => new \App\Models\Page()], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/pages/create.blade.php ENDPATH**/ ?>