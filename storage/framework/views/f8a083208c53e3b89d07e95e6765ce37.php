

<?php $__env->startSection('title', 'Feedbacks'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
    <h2 class="mb-0"><i class="bi bi-chat-quote"></i> Feedbacks</h2>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Data/Hora</th>
                        <th>Título</th>
                        <th>Descrição</th>
                        <th class="text-center">Avaliação</th>
                        <th class="text-end">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $feedbacks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feedback): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="text-nowrap text-muted small"><?php echo e($feedback->created_at->format('d/m/Y H:i')); ?></td>
                            <td><?php echo e($feedback->title); ?></td>
                            <td><?php echo e(Str::limit($feedback->description, 80)); ?></td>
                            <td class="text-center">
                                <?php if($feedback->rating === 'positivo'): ?>
                                    <span class="badge bg-success"><i class="bi bi-hand-thumbs-up"></i> Positivo</span>
                                <?php elseif($feedback->rating === 'negativo'): ?>
                                    <span class="badge bg-danger"><i class="bi bi-hand-thumbs-down"></i> Negativo</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">—</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-end">
                                <div class="btn-group btn-group-sm">
                                    <form action="<?php echo e(route('admin.feedbacks.rate', $feedback)); ?>" method="POST" class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="rating" value="positivo">
                                        <button type="submit" class="btn btn-outline-success" title="Avaliar como positivo"><i class="bi bi-hand-thumbs-up"></i></button>
                                    </form>
                                    <form action="<?php echo e(route('admin.feedbacks.rate', $feedback)); ?>" method="POST" class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="rating" value="negativo">
                                        <button type="submit" class="btn btn-outline-danger" title="Avaliar como negativo"><i class="bi bi-hand-thumbs-down"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">Nenhum feedback encontrado.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php if($feedbacks->hasPages()): ?>
    <div class="card-footer">
        <?php echo e($feedbacks->links()); ?>

    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/admin/feedbacks/index.blade.php ENDPATH**/ ?>