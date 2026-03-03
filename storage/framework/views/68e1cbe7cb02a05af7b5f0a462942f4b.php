

<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="welcome-header rounded-3 text-white p-4 mb-4" style="background: linear-gradient(to bottom, #5293CD 0%, #2E5B9D 100%);">
    <h1><i class="bi bi-check-circle"></i> Bem-vindo, <?php echo e(Auth::user()->name); ?>!</h1>
    <p class="mb-0">Você está autenticado no sistema.</p>
</div>

<div class="row">
    <div class="col-12 col-lg-9 order-1 order-lg-2 mb-4 mb-lg-0">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between flex-wrap gap-2" style="background: linear-gradient(to bottom, #5293CD 0%, #2E5B9D 100%); color: #fff;">
                <a href="<?php echo e(route('dashboard', ['month' => $prevMonth->month, 'year' => $prevMonth->year])); ?>" class="btn btn-light btn-sm"><i class="bi bi-chevron-left"></i></a>
                <h5 class="mb-0 text-center"><?php echo e($current->locale('pt_BR')->translatedFormat('F Y')); ?></h5>
                <a href="<?php echo e(route('dashboard', ['month' => $nextMonth->month, 'year' => $nextMonth->year])); ?>" class="btn btn-light btn-sm"><i class="bi bi-chevron-right"></i></a>
            </div>
            <div class="card-body p-0">
                <table class="table table-bordered mb-0 dashboard-calendar">
                    <thead>
                        <tr class="table-light">
                            <th class="text-center py-2">Dom</th>
                            <th class="text-center py-2">Seg</th>
                            <th class="text-center py-2">Ter</th>
                            <th class="text-center py-2">Qua</th>
                            <th class="text-center py-2">Qui</th>
                            <th class="text-center py-2">Sex</th>
                            <th class="text-center py-2">Sáb</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $weeks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $week): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <?php $__currentLoopData = $week; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cell): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <td class="p-1 align-top calendar-day <?php if($cell['day'] === null): ?> bg-light <?php endif; ?>" style="min-height: 100px; vertical-align: top;">
                                <?php if($cell['day'] !== null): ?>
                                    <div class="fw-semibold text-muted small"><?php echo e($cell['day']); ?></div>
                                    <?php $__currentLoopData = $cell['events']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="small border-start border-3 border-primary ps-2 mb-1 py-1" style="border-color: #5293CD !important;">
                                        <div class="fw-semibold"><?php echo e($event->name); ?></div>
                                        <div class="text-muted"><?php echo e($event->date_time->setTimezone('America/Sao_Paulo')->format('H:i')); ?> · <?php echo e(Str::limit($event->location, 25)); ?></div>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </td>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer small text-muted">
                <i class="bi bi-clock"></i> Horários em Brasília
            </div>
        </div>
        <div class="d-flex flex-column flex-sm-row align-items-center justify-content-between gap-2 mt-3 p-3 rounded-3 bg-light border">
            <p class="mb-0 text-muted text-center text-sm-start">Tem algo pra compartilhar? Sua voz é anônima e faz a diferença.</p>
            <a href="<?php echo e(route('feedback.create')); ?>" class="btn btn-primary btn-sm flex-shrink-0"><i class="bi bi-chat-quote"></i> Pode falar!</a>
        </div>
    </div>
    <aside class="col-12 col-lg-3 order-2 order-lg-1">
        <div class="card text-center p-4 mb-3">
            <i class="bi bi-person-circle" style="font-size: 2.5rem; color: #5293CD;"></i>
            <h5 class="mt-3">Perfil</h5>
            <p class="text-muted small mb-0"><?php echo e(Auth::user()->email); ?></p>
            <?php $roles = \App\Models\User::roles(); ?>
            <p class="small mb-0 mt-1"><span class="badge bg-secondary"><?php echo e($roles[Auth::user()->role] ?? Auth::user()->role); ?></span></p>
        </div>
        <?php if(Auth::user()->canManageContent()): ?>
        <div class="card p-3">
            <h6 class="mb-2"><i class="bi bi-link-45deg"></i> Atalhos</h6>
            <ul class="list-unstyled mb-0 small">
                <li class="mb-1"><a href="<?php echo e(route('pages.index')); ?>">Páginas</a></li>
                <li class="mb-1"><a href="<?php echo e(route('carousels.index')); ?>">Carrosséis</a></li>
                <li class="mb-1"><a href="<?php echo e(route('events.index')); ?>">Eventos</a></li>
                <li><a href="<?php echo e(route('novidades.index')); ?>">Novidades</a></li>
            </ul>
        </div>
        <?php endif; ?>
    </aside>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/dashboard.blade.php ENDPATH**/ ?>