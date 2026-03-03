

<?php $__env->startSection('title', 'Login - ' . config('app.name')); ?>

<?php $__env->startSection('content'); ?>
<div class="auth-header">
    <h2><i class="bi bi-box-arrow-in-right"></i> Login</h2>
    <p class="text-muted">Entre com suas credenciais</p>
</div>

<form method="POST" action="<?php echo e(route('login')); ?>">
    <?php echo csrf_field(); ?>

    <div class="mb-3">
        <label for="email" class="form-label">
            <i class="bi bi-envelope"></i> Email
        </label>
        <input 
            type="email" 
            class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
            id="email" 
            name="email" 
            value="<?php echo e(old('email')); ?>" 
            required 
            autofocus
            placeholder="seu@email.com"
        >
        <?php $__errorArgs = ['email'];
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

    <div class="mb-3">
        <label for="password" class="form-label">
            <i class="bi bi-lock"></i> Senha
        </label>
        <input 
            type="password" 
            class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
            id="password" 
            name="password" 
            required
            placeholder="••••••••"
        >
        <?php $__errorArgs = ['password'];
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

    <div class="mb-3 form-check">
        <input 
            type="checkbox" 
            class="form-check-input" 
            id="remember" 
            name="remember"
        >
        <label class="form-check-label" for="remember">
            Lembrar-me
        </label>
    </div>

    <button type="submit" class="btn btn-primary">
        <i class="bi bi-box-arrow-in-right"></i> Entrar
    </button>

    <div class="auth-footer">
        <p class="mb-2">
            <a href="<?php echo e(route('password.request')); ?>">Esqueceu sua senha?</a>
        </p>
        <p class="mb-0">
            Não tem uma conta? <a href="<?php echo e(route('register')); ?>">Registre-se</a>
        </p>
    </div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/auth/login.blade.php ENDPATH**/ ?>