

<?php $__env->startSection('title', 'Configuração do menu'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex align-items-center gap-2 mb-4">
    <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left"></i></a>
    <h2 class="mb-0"><i class="bi bi-list-ul"></i> Configuração do menu superior</h2>
</div>

<form action="<?php echo e(route('menu-config.update')); ?>" method="POST" id="menu-config-form" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>

    <div class="card mb-4">
        <div class="card-header bg-light">
            <h5 class="mb-0">Logo do menu</h5>
        </div>
        <div class="card-body">
            <p class="text-muted small">A logo aparece à esquerda do menu superior no site público. Recomendado: imagem em PNG ou SVG, altura até 40px.</p>
            <?php if($setting->logo): ?>
                <div class="d-flex align-items-center gap-3 mb-3">
                    <img src="<?php echo e(asset('storage/' . $setting->logo)); ?>" alt="Logo atual" style="max-height: 40px; max-width: 150px; object-fit: contain;">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remove_logo" value="1" id="remove_logo">
                        <label class="form-check-label" for="remove_logo">Remover logo</label>
                    </div>
                </div>
            <?php endif; ?>
            <div class="mb-0">
                <label for="logo" class="form-label"><?php echo e($setting->logo ? 'Substituir logo' : 'Enviar logo'); ?></label>
                <input type="file" class="form-control" id="logo" name="logo" accept="image/*">
            </div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header bg-light">
            <h5 class="mb-0">Páginas no menu (ordem de exibição)</h5>
        </div>
        <div class="card-body">
            <p class="text-muted small">Arraste para reordenar ou use os botões. A ordem aqui define a ordem no menu superior.</p>
            <div class="row">
                <div class="col-md-7">
                    <ul class="list-group list-group-flush" id="menu-pages-list">
                        <?php $__currentLoopData = $pagesInMenu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="list-group-item d-flex justify-content-between align-items-center" data-id="<?php echo e($page->id); ?>">
                                <span><i class="bi bi-grip-vertical text-muted me-2"></i><?php echo e($page->title); ?></span>
                                <div class="btn-group btn-group-sm">
                                    <button type="button" class="btn btn-outline-secondary btn-move" data-dir="up" title="Subir"><i class="bi bi-arrow-up"></i></button>
                                    <button type="button" class="btn btn-outline-secondary btn-move" data-dir="down" title="Descer"><i class="bi bi-arrow-down"></i></button>
                                    <button type="button" class="btn btn-outline-danger btn-remove" title="Remover do menu"><i class="bi bi-x-lg"></i></button>
                                </div>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                    <?php if($pagesInMenu->isEmpty()): ?>
                        <p class="text-muted mb-0 mt-2">Nenhuma página no menu. Adicione abaixo.</p>
                    <?php endif; ?>
                </div>
                <div class="col-md-5">
                    <label class="form-label">Adicionar página ao menu</label>
                    <select class="form-select" id="add-page-select">
                        <option value="">Selecione uma página...</option>
                        <?php $__currentLoopData = $availablePages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($page->id); ?>"><?php echo e($page->title); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <button type="button" class="btn btn-outline-primary btn-sm mt-2" id="add-page-btn" disabled>
                        <i class="bi bi-plus"></i> Adicionar
                    </button>
                </div>
            </div>
            <div id="order-inputs"></div>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-body">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="show_dashboard_link" name="show_dashboard_link" value="1" <?php echo e($setting->show_dashboard_link ? 'checked' : ''); ?>>
                <label class="form-check-label" for="show_dashboard_link">Exibir atalho para área logada no menu</label>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i> Salvar configuração</button>
</form>

<?php $__env->startPush('scripts'); ?>
<script>
(function() {
    const list = document.getElementById('menu-pages-list');
    const addSelect = document.getElementById('add-page-select');
    const addBtn = document.getElementById('add-page-btn');
    const orderInputs = document.getElementById('order-inputs');
    const form = document.getElementById('menu-config-form');

    function updateOrderInputs() {
        const ids = Array.from(list.querySelectorAll('[data-id]')).map(el => el.getAttribute('data-id'));
        orderInputs.innerHTML = ids.map(id => '<input type="hidden" name="page_order[]" value="' + id + '">').join('');
    }

    function updateAddButton() {
        addBtn.disabled = !addSelect.value;
    }

    addSelect.addEventListener('change', updateAddButton);

    addBtn.addEventListener('click', function() {
        const opt = addSelect.options[addSelect.selectedIndex];
        if (!opt || !opt.value) return;
        const id = opt.value;
        const title = opt.text;
        const li = document.createElement('li');
        li.className = 'list-group-item d-flex justify-content-between align-items-center';
        li.setAttribute('data-id', id);
        li.innerHTML = '<span><i class="bi bi-grip-vertical text-muted me-2"></i>' + title + '</span>' +
            '<div class="btn-group btn-group-sm">' +
            '<button type="button" class="btn btn-outline-secondary btn-move" data-dir="up" title="Subir"><i class="bi bi-arrow-up"></i></button>' +
            '<button type="button" class="btn btn-outline-secondary btn-move" data-dir="down" title="Descer"><i class="bi bi-arrow-down"></i></button>' +
            '<button type="button" class="btn btn-outline-danger btn-remove" title="Remover do menu"><i class="bi bi-x-lg"></i></button>' +
            '</div>';
        list.appendChild(li);
        opt.remove();
        updateAddButton();
        updateOrderInputs();
        bindListItem(li);
    });

    function bindListItem(li) {
        li.querySelectorAll('.btn-move').forEach(btn => {
            btn.addEventListener('click', function() {
                const dir = this.dataset.dir;
                const prev = dir === 'up' ? li.previousElementSibling : li.nextElementSibling;
                if (prev && prev.matches('[data-id]')) {
                    if (dir === 'up') list.insertBefore(li, prev);
                    else list.insertBefore(prev, li);
                    updateOrderInputs();
                }
            });
        });
        li.querySelector('.btn-remove').addEventListener('click', function() {
            const id = li.getAttribute('data-id');
            const title = li.querySelector('span').textContent.trim();
            const opt = document.createElement('option');
            opt.value = id;
            opt.textContent = title;
            addSelect.appendChild(opt);
            li.remove();
            updateAddButton();
            updateOrderInputs();
        });
    }

    list.querySelectorAll('[data-id]').forEach(bindListItem);
    updateOrderInputs();
})();
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/menu-config/index.blade.php ENDPATH**/ ?>