

<?php $__env->startSection('content'); ?>
<div class="container-fluid">

    
    <div class="mb-4">
        <h3 class="fw-bold text-primary">Dashboard Wali</h3>
        <p class="text-muted">
            Selamat datang, <strong><?php echo e(auth()->user()->name); ?></strong>
        </p>
    </div>

    
    <div class="row g-3 mb-4">

        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-success text-white">
                <div class="card-body">
                    <i class="bi bi-people fs-1"></i>
                    <h6 class="mt-2">Total Anak</h6>
                    <h3><?php echo e($totalAnak); ?></h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-warning text-dark">
                <div class="card-body">
                    <i class="bi bi-file-text fs-1"></i>
                    <h6 class="mt-2">Total Laporan</h6>
                    <h3><?php echo e($totalLaporan); ?></h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-danger text-white">
                <div class="card-body">
                    <i class="bi bi-bell fs-1"></i>
                    <h6 class="mt-2">Notifikasi Baru</h6>
                    <h3><?php echo e($totalNotifikasi); ?></h3>
                </div>
            </div>
        </div>

    </div>

    
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <strong>Notifikasi</strong>
        </div>

        <ul class="list-group list-group-flush">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $notifikasi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <li class="list-group-item d-flex justify-content-between align-items-center
                    <?php echo e($n->is_read ? '' : 'fw-bold'); ?>">
                    
                    <div>
                        <div><?php echo e($n->title); ?></div>
                        <small class="text-muted"><?php echo e($n->message); ?></small>
                    </div>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$n->is_read): ?>
                        <span class="badge bg-danger">Baru</span>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <li class="list-group-item text-center text-muted">
                    Tidak ada notifikasi
                </li>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </ul>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sispeka\resources\views/dashboard/wali.blade.php ENDPATH**/ ?>