

<?php $__env->startSection('title', $page->title . ' - ' . config('app.name')); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <?php if($carousel && $carousel->images->isNotEmpty()): ?>
            <div class="mb-4 ratio ratio-16x9 overflow-hidden bg-dark rounded">
                <div id="pageCarousel" class="carousel slide h-100" data-bs-ride="carousel">
                    <div class="carousel-inner h-100">
                        <?php $__currentLoopData = $carousel->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="carousel-item h-100 <?php echo e($index === 0 ? 'active' : ''); ?>">
                                <img src="<?php echo e(asset('storage/' . $image->path)); ?>" class="d-block w-100 h-100" alt="" style="object-fit: cover;">
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php if($carousel->images->count() > 1): ?>
                        <button class="carousel-control-prev" type="button" data-bs-target="#pageCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#pageCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    <?php endif; ?>
                </div>
            </div>
            <?php elseif($page->featured_image): ?>
            <div class="mb-4 ratio ratio-16x9 overflow-hidden bg-dark rounded">
                <img src="<?php echo e($page->featured_image_url); ?>" alt="" class="d-block w-100 h-100" style="object-fit: cover;">
            </div>
            <?php endif; ?>

            <h1 class="mb-4"><?php echo e($page->title); ?></h1>
            <div class="content">
                <?php echo $page->body; ?>

            </div>

            <?php if($novidades->isNotEmpty()): ?>
            <section class="mt-5 pt-4 border-top">
                <h2 class="h5 mb-3">Últimas novidades</h2>
                <div class="row g-3">
                    <?php $__currentLoopData = $novidades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $novidade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-4">
                        <div class="card h-100 flex-row overflow-hidden">
                            <div class="flex-shrink-0" style="width: 120px;">
                                <?php if($novidade->image): ?>
                                    <img src="<?php echo e($novidade->image_url); ?>" class="w-100 h-100" style="object-fit: cover;" alt="">
                                <?php else: ?>
                                    <div class="w-100 h-100 bg-light d-flex align-items-center justify-content-center">
                                        <i class="bi bi-image text-muted" style="font-size: 2rem;"></i>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="card-body d-flex flex-column flex-grow-1 p-3">
                                <h3 class="card-title h6 mb-2"><?php echo e($novidade->title); ?></h3>
                                <p class="card-text small text-muted mb-0 flex-grow-1"><?php echo e($novidade->description); ?></p>
                                <small class="text-muted"><?php echo e($novidade->published_at->format('d/m/Y H:i')); ?></small>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </section>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/public/page.blade.php ENDPATH**/ ?>