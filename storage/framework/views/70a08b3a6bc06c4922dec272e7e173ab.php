

<?php $__env->startSection('title', 'Eventos'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
    <h2 class="mb-0"><i class="bi bi-calendar-event"></i> Eventos</h2>
    <a href="<?php echo e(route('events.create')); ?>" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Novo evento
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Nome</th>
                        <th>Data e hora</th>
                        <th>Localização</th>
                        <th class="text-end">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($event->name); ?></td>
                            <td><?php echo e($event->date_time->setTimezone('America/Sao_Paulo')->format('d/m/Y H:i')); ?></td>
                            <td><?php echo e(Str::limit($event->location, 40)); ?></td>
                            <td class="text-end">
                                <a href="<?php echo e(route('events.edit', $event)); ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                                <form action="<?php echo e(route('events.destroy', $event)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Remover este evento?');">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">
                                Nenhum evento. <a href="<?php echo e(route('events.create')); ?>">Criar primeiro evento</a>.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php if($events->hasPages()): ?>
        <div class="card-footer"><?php echo e($events->links()); ?></div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/events/index.blade.php ENDPATH**/ ?>