

<?php $__env->startSection('title', 'Usuários'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
    <h2 class="mb-0"><i class="bi bi-people"></i> Usuários</h2>
    <a href="<?php echo e(route('users.create')); ?>" class="btn btn-primary">
        <i class="bi bi-person-plus"></i> Novo usuário
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Perfil</th>
                        <th class="text-end">Cadastro</th>
                        <th class="text-end">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($user->name); ?></td>
                            <td><?php echo e($user->email); ?></td>
                            <td>
                                <?php $labels = \App\Models\User::roles(); ?>
                                <span class="badge <?php echo e($user->role === 'administrador' ? 'bg-primary' : ($user->role === 'gestor' ? 'bg-info' : 'bg-secondary')); ?>"><?php echo e($labels[$user->role] ?? $user->role); ?></span>
                            </td>
                            <td class="text-end text-muted small"><?php echo e($user->created_at->format('d/m/Y H:i')); ?></td>
                            <td class="text-end">
                                <a href="<?php echo e(route('users.edit', $user)); ?>" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                Nenhum usuário. <a href="<?php echo e(route('users.create')); ?>">Cadastrar primeiro usuário</a>.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php if($users->hasPages()): ?>
        <div class="card-footer"><?php echo e($users->links()); ?></div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/users/index.blade.php ENDPATH**/ ?>