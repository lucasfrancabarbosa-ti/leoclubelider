

<?php $__env->startSection('title', 'Novo evento'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex align-items-center gap-2 mb-4">
    <a href="<?php echo e(route('events.index')); ?>" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left"></i></a>
    <h2 class="mb-0"><i class="bi bi-calendar-plus"></i> Novo evento</h2>
</div>

<div class="card">
    <div class="card-body">
        <form action="<?php echo e(route('events.store')); ?>" method="POST">
            <?php echo $__env->make('events._form', ['event' => new \App\Models\Event()], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/events/create.blade.php ENDPATH**/ ?>