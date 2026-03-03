

<?php $__env->startSection('title', 'Rodapé'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex align-items-center gap-2 mb-4">
    <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left"></i></a>
    <h2 class="mb-0"><i class="bi bi-window"></i> Configuração do rodapé</h2>
</div>

<form action="<?php echo e(route('footer-config.update')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>

    <div class="card mb-4">
        <div class="card-header bg-light">
            <h5 class="mb-0">Copyright</h5>
        </div>
        <div class="card-body">
            <label for="copyright" class="form-label">Texto de copyright</label>
            <input type="text" class="form-control <?php $__errorArgs = ['copyright'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="copyright" name="copyright" value="<?php echo e(old('copyright', $setting->copyright)); ?>" placeholder="Ex: © 2024 LeoClube. Todos os direitos reservados." maxlength="500">
            <?php $__errorArgs = ['copyright'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="invalid-feedback"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header bg-light">
            <h5 class="mb-0">Redes sociais</h5>
        </div>
        <div class="card-body">
            <p class="text-muted small">Informe o link completo de cada rede. Deixe em branco para não exibir.</p>
            <?php
                $socialLinks = $setting->social_links ?? [];
            ?>
            <?php $__currentLoopData = \App\Models\FooterSetting::socialNetworks(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $config): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="row align-items-center mb-3">
                    <div class="col-auto">
                        <span class="badge bg-light text-dark border p-2 rounded">
                            <i class="bi <?php echo e($config['icon']); ?>" style="font-size: 1.25rem;"></i>
                            <?php echo e($config['label']); ?>

                        </span>
                    </div>
                    <div class="col">
                        <input type="<?php echo e($key === 'whatsapp' ? 'text' : 'url'); ?>" class="form-control <?php $__errorArgs = ['social_links.'.$key];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="social_links[<?php echo e($key); ?>]" value="<?php echo e(old('social_links.'.$key, $socialLinks[$key] ?? '')); ?>" placeholder="<?php echo e($config['placeholder']); ?>">
                        <?php $__errorArgs = ['social_links.'.$key];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <p class="text-muted small mb-0 mt-2">WhatsApp: use <code>https://wa.me/5511999999999</code> (com DDI e DDD, sem + ou espaços).</p>
        </div>
    </div>

    <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg"></i> Salvar configuração</button>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/footer-config/index.blade.php ENDPATH**/ ?>