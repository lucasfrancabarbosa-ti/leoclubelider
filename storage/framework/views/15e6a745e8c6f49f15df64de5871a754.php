

<?php $__env->startSection('title', 'Últimas novidades'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
    <h2 class="mb-0"><i class="bi bi-newspaper"></i> Últimas novidades</h2>
    <a href="<?php echo e(route('novidades.create')); ?>" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Nova novidade
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Imagem</th>
                        <th>Título</th>
                        <th>Descrição</th>
                        <th>Data e hora</th>
                        <th class="text-end">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $novidades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $novidade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <?php if($novidade->image): ?>
                                    <img src="<?php echo e($novidade->image_url); ?>" alt="" class="rounded" style="height: 36px; width: 48px; object-fit: cover;">
                                <?php else: ?>
                                    <span class="text-muted small">—</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo e($novidade->title); ?></td>
                            <td><?php echo e(Str::limit($novidade->description, 50)); ?></td>
                            <td><?php echo e($novidade->published_at->format('d/m/Y H:i')); ?></td>
                            <td class="text-end">
                                <a href="<?php echo e(route('novidades.edit', $novidade)); ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                                <form action="<?php echo e(route('novidades.destroy', $novidade)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Remover esta novidade?');">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                Nenhuma novidade. <a href="<?php echo e(route('novidades.create')); ?>">Criar primeira novidade</a>.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php if($novidades->hasPages()): ?>
        <div class="card-footer"><?php echo e($novidades->links()); ?></div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/novidades/index.blade.php ENDPATH**/ ?>