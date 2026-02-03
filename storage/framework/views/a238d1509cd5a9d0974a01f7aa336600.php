

<?php $__env->startSection('content'); ?>
<div class="card p-4 shadow-sm">

    <div class="d-flex justify-content-between mb-3">
    <h4>Kehadiran</h4>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->role === 'guru'): ?>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addKehadiran">
            New Kehadiran
        </button>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <table class="table table-bordered align-middle">
        <thead class="table-primary text-center">
            <tr>
                <th>No</th>
                <th>Siswa</th>
                <th>Tugas Mengajar</th>
                <th>Tanggal</th>
                <th>Status</th>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->role === 'guru'): ?>
                <th>Aksi</th>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </tr>
        </thead>
        <tbody>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $attendances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <tr>
    <td class="text-center"><?php echo e($loop->iteration); ?></td>
    <td><?php echo e($a->siswa->name); ?></td>
    <td>
        <?php echo e($a->assignment->guru->nama); ?> -
        <?php echo e($a->assignment->kelas->name); ?> -
        <?php echo e($a->assignment->subject->name); ?>

    </td>
    <td class="text-center"><?php echo e($a->date); ?></td>
    <td class="text-center">
        <span class="badge bg-success"><?php echo e(ucfirst($a->status)); ?></span>
    </td>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->role === 'guru'): ?>
    <td class="text-center">
        <div class="d-flex justify-content-center gap-2">

            <!-- EDIT -->
            <button class="btn btn-warning btn-sm"
                data-bs-toggle="modal"
                data-bs-target="#editKehadiran<?php echo e($a->id); ?>">
                <i class="bi bi-pencil-square"></i>
            </button>

            <!-- DELETE -->
            <form action="<?php echo e(route('guru.attendance.destroy',$a->id)); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button onclick="return confirm('Hapus?')" class="btn btn-danger btn-sm">
                    <i class="bi bi-trash"></i>
                </button>
                    </form>
                </div>
                </td>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

            <tr>
                <td colspan="6" class="text-center text-muted">Belum ada data</td>
            </tr>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </tbody>
    </table>
</div>

<!-- MODAL ADD -->
 <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->role === 'guru'): ?>
<div class="modal fade" id="addKehadiran" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form method="POST" action="<?php echo e(route('guru.attendance.store')); ?>" class="modal-content">
            <?php echo csrf_field(); ?>

            <div class="modal-header">
                <h5 class="modal-title">Tambah Kehadiran</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label>Siswa</label>
                    <select name="siswa_id" class="form-select" required>
                        <option value="">Select an option</option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $siswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($s->id); ?>"><?php echo e($s->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Tugas Mengajar</label>
                    <select name="assignment_id" class="form-select" required>
                        <option value="">Select an option</option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $assignment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($t->id); ?>">
                                <?php echo e($t->guru->nama); ?> - <?php echo e($t->kelas->name); ?> - <?php echo e($t->subject->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Tanggal</label>
                    <input type="date" name="date" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Status</label>
                    <select name="status" class="form-select" required>
                        <option value="">Select an option</option>
                        <option value="hadir">Hadir</option>
                        <option value="izin">Izin</option>
                        <option value="sakit">Sakit</option>
                        <option value="alpha">Alpha</option>
                    </select>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            </div>

        </form>
    </div>
</div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<!-- MODAL EDIT -->
<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->role === 'guru'): ?>
<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $attendances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="modal fade" id="editKehadiran<?php echo e($a->id); ?>" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form method="POST" action="<?php echo e(route('guru.attendance.update', $a->id)); ?>" class="modal-content">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="modal-header">
                <h5 class="modal-title">Edit Kehadiran</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label>Siswa</label>
                    <select name="siswa_id" class="form-select" required>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $siswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($s->id); ?>" <?php echo e($s->id == $a->siswa_id ? 'selected' : ''); ?>>
                                <?php echo e($s->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Tugas Mengajar</label>
                    <select name="assignment_id" class="form-select" required>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $assignment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($t->id); ?>" <?php echo e($t->id == $a->assignment_id ? 'selected' : ''); ?>>
                                <?php echo e($t->guru->nama); ?> - <?php echo e($t->kelas->name); ?> - <?php echo e($t->subject->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Tanggal</label>
                    <input type="date" name="date" class="form-control" value="<?php echo e($a->date); ?>" required>
                </div>

                <div class="mb-3">
                    <label>Status</label>
                    <select name="status" class="form-select" required>
                        <option value="hadir" <?php echo e($a->status == 'hadir' ? 'selected' : ''); ?>>Hadir</option>
                        <option value="izin" <?php echo e($a->status == 'izin' ? 'selected' : ''); ?>>Izin</option>
                        <option value="sakit" <?php echo e($a->status == 'sakit' ? 'selected' : ''); ?>>Sakit</option>
                        <option value="alpha" <?php echo e($a->status == 'alpha' ? 'selected' : ''); ?>>Alpha</option>
                    </select>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-primary">Update</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            </div>

        </form>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sispeka\resources\views/sispeka/kehadiran.blade.php ENDPATH**/ ?>