

<?php $__env->startSection('title', 'Carrosséis'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
    <h2 class="mb-0"><i class="bi bi-images"></i> Carrosséis</h2>
    <a href="<?php echo e(route('carousels.create')); ?>" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Novo carrossel
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Nome</th>
                        <th class="text-center">Imagens</th>
                        <th class="text-center">Ativo</th>
                        <th class="text-end">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $carousels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $carousel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($carousel->name ?: '—'); ?></td>
                            <td class="text-center"><?php echo e($carousel->images_count); ?></td>
                            <td class="text-center">
                                <?php if($carousel->is_active): ?>
                                    <span class="badge bg-success">Ativo</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Inativo</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-end">
                                <a href="<?php echo e(route('carousels.edit', $carousel)); ?>" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-pencil"></i> Editar
                                </a>
                                <form action="<?php echo e(route('carousels.destroy', $carousel)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Remover este carrossel e todas as imagens?');">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">
                                Nenhum carrossel. <a href="<?php echo e(route('carousels.create')); ?>">Criar primeiro carrossel</a>.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php if($carousels->hasPages()): ?>
        <div class="card-footer"><?php echo e($carousels->links()); ?></div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/carousels/index.blade.php ENDPATH**/ ?>