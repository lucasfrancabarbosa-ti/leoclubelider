

<?php $__env->startSection('title', 'Editar carrossel'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex align-items-center gap-2 mb-4">
    <a href="<?php echo e(route('carousels.index')); ?>" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left"></i></a>
    <h2 class="mb-0"><i class="bi bi-images"></i> <?php echo e($carousel->name ?: 'Carrossel'); ?></h2>
</div>

<div class="card mb-4">
    <div class="card-header bg-light">
        <h5 class="mb-0">Dados do carrossel</h5>
    </div>
    <div class="card-body">
        <form action="<?php echo e(route('carousels.update', $carousel)); ?>" method="POST" class="row g-3">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="col-md-6">
                <label for="name" class="form-label">Nome (opcional)</label>
                <input type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="name" name="name" value="<?php echo e(old('name', $carousel->name)); ?>">
                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="col-md-6 d-flex align-items-end">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" <?php echo e(old('is_active', $carousel->is_active) ? 'checked' : ''); ?>>
                    <label class="form-check-label" for="is_active">Carrossel ativo</label>
                </div>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i> Salvar</button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header bg-light d-flex justify-content-between align-items-center flex-wrap gap-2">
        <h5 class="mb-0">Imagens (ordem de exibição)</h5>
        <form action="<?php echo e(route('carousels.images.store', $carousel)); ?>" method="POST" enctype="multipart/form-data" class="d-flex align-items-center gap-2">
            <?php echo csrf_field(); ?>
            <input type="file" name="image" accept="image/*" required class="form-control form-control-sm" style="max-width: 220px;">
            <button type="submit" class="btn btn-sm btn-success"><i class="bi bi-upload"></i> Enviar</button>
        </form>
    </div>
    <div class="card-body">
        <?php if($carousel->images->isEmpty()): ?>
            <p class="text-muted mb-0">Nenhuma imagem. Use o formulário acima para fazer upload.</p>
        <?php else: ?>
            <form action="<?php echo e(route('carousels.images.reorder', $carousel)); ?>" method="POST" id="reorder-form">
                <?php echo csrf_field(); ?>
                <div class="row g-3 mb-3" id="sortable-images">
                    <?php $__currentLoopData = $carousel->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-6 col-md-4 col-lg-3" data-id="<?php echo e($image->id); ?>">
                            <div class="card h-100">
                                <img src="<?php echo e(asset('storage/' . $image->path)); ?>" alt="" class="card-img-top" style="height: 140px; object-fit: cover;">
                                <div class="card-body py-2 px-2 d-flex justify-content-between align-items-center">
                                    <span class="text-muted small">Ordem: <?php echo e($image->order + 1); ?></span>
                                    <div class="btn-group btn-group-sm">
                                        <button type="button" class="btn btn-outline-secondary btn-move" data-dir="up" title="Subir"><i class="bi bi-arrow-up"></i></button>
                                        <button type="button" class="btn btn-outline-secondary btn-move" data-dir="down" title="Descer"><i class="bi bi-arrow-down"></i></button>
                                        <form action="<?php echo e(route('carousels.images.destroy', [$carousel, $image])); ?>" method="POST" class="d-inline" onsubmit="return confirm('Remover esta imagem?');">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-outline-danger" title="Excluir"><i class="bi bi-trash"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div id="order-inputs"></div>
                <button type="submit" class="btn btn-outline-primary btn-sm"><i class="bi bi-arrow-left-right"></i> Salvar ordem</button>
            </form>
        <?php endif; ?>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
(function() {
    const form = document.getElementById('reorder-form');
    if (!form) return;
    const container = document.getElementById('sortable-images');
    const orderInputs = document.getElementById('order-inputs');

    function updateOrder() {
        const ids = Array.from(container.querySelectorAll('[data-id]')).map(el => el.getAttribute('data-id'));
        orderInputs.innerHTML = ids.map(id => '<input type="hidden" name="order[]" value="' + id + '">').join('');
    }

    container.querySelectorAll('.btn-move').forEach(btn => {
        btn.addEventListener('click', function() {
            const card = this.closest('[data-id]');
            const dir = this.dataset.dir;
            const prev = dir === 'up' ? card.previousElementSibling : card.nextElementSibling;
            if (prev && prev.matches('[data-id]')) {
                if (dir === 'up') container.insertBefore(card, prev);
                else container.insertBefore(prev, card);
                updateOrder();
            }
        });
    });

    updateOrder();
})();
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/carousels/edit.blade.php ENDPATH**/ ?>