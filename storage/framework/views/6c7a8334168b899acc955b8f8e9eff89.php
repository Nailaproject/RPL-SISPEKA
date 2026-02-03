

<?php $__env->startSection('content'); ?>
<div class="card shadow-sm border-0 p-4">

    <div class="d-flex align-items-center mb-3">
        <h5 class="fw-bold mb-0 text-danger">Akses Dibatasi</h5>
    </div>

    <div class="alert alert-light border mb-0">
        <p class="mb-2 fw-semibold text-dark">
            Menu ini tidak tersedia untuk akun Anda.
        </p>
        <p class="text-muted mb-0" style="font-size:16px;">
            Akun dengan peran <b><?php echo e(ucfirst(auth()->user()->role)); ?></b> hanya diperbolehkan
            mengakses fitur yang berhubungan dengan laporan siswa.
        </p>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sispeka\resources\views/akses-ditolak.blade.php ENDPATH**/ ?>