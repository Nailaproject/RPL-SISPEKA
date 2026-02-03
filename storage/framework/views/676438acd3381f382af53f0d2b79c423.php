

<?php $__env->startSection('content'); ?>
<div class="container mt-4">

    <h4 class="mb-4">Dashboard</h4>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <div class="row g-3">
        <!-- Total Siswa -->
        <div class="col-md-3">
            <div class="card text-center" style="background-color: #28a745; color: #fff;">
                <div class="card-body">
                    <h6>Total Siswa</h6>
                    <h3><?php echo e($totalSiswa); ?></h3>
                </div>
            </div>
        </div>

        <!-- Total Guru -->
        <div class="col-md-3">
            <div class="card text-center" style="background-color: #007bff; color: #fff;">
                <div class="card-body">
                    <h6>Total Guru</h6>
                    <h3><?php echo e($totalGuru); ?></h3>
                </div>
            </div>
        </div>

        <!-- Total Kelas -->
        <div class="col-md-3">
            <div class="card text-center" style="background-color: #ffc107; color: #212529;">
                <div class="card-body">
                    <h6>Total Kelas</h6>
                    <h3><?php echo e($totalKelas); ?></h3>
                </div>
            </div>
        </div>

        <!-- Total Laporan -->
        <div class="col-md-3">
            <div class="card text-center" style="background-color: #dc3545; color: #fff;">
                <div class="card-body">
                    <h6>Total LaporanSiswa</h6>
                    <h3><?php echo e($totalLaporanSiswa); ?></h3>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sispeka\resources\views/sispeka/dashboard.blade.php ENDPATH**/ ?>