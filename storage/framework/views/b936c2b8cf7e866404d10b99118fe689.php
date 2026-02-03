

<?php $__env->startSection('content'); ?>
<div class="card p-4 shadow-sm">
    <h4>Kehadiran: <?php echo e($siswa->name ?? ''); ?></h4>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Tugas Mengajar</th>
                <th>Tanggal</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $attendances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($loop->iteration); ?></td>
                <td><?php echo e($a->assignment->guru->nama ?? '-'); ?> - <?php echo e($a->assignment->kelas->name ?? '-'); ?> - <?php echo e($a->assignment->subject->name ?? '-'); ?></td>
                <td><?php echo e($a->date); ?></td>
                <td><?php echo e(ucfirst($a->status)); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="4" class="text-center">Belum ada data</td>
            </tr>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </tbody>
    </table>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sispeka\resources\views/wali/attendance.blade.php ENDPATH**/ ?>