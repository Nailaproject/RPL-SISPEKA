

<?php $__env->startSection('content'); ?>
<div class="card shadow-sm p-3">

    <div class="d-flex justify-content-between mb-4">
        <h4>Data Nilai</h4>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->role === 'guru'): ?>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNilai">
                New Nilai
            </button>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-primary text-center">
                <tr>
                    <th>No</th>
                    <th>Siswa</th>
                    <th>Tugas Mengajar</th>
                    <th>Jenis</th>
                    <th>Nilai</th>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->role === 'guru'): ?>
                        <th>Aksi</th>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tr>
            </thead>

            <tbody>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $nilai; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td class="text-center"><?php echo e($loop->iteration); ?></td>

                    <td><?php echo e($n->siswa->name ?? '-'); ?></td>

                    <td>
                        <?php echo e(optional(optional($n->assignment)->guru)->nama ?? '-'); ?> -
                        <?php echo e(optional(optional($n->assignment)->kelas)->name ?? '-'); ?> -
                        <?php echo e(optional(optional($n->assignment)->subject)->name ?? '-'); ?>

                    </td>

                    <td class="text-center">
                        <span class="badge bg-info"><?php echo e(strtoupper($n->type)); ?></span>
                    </td>

                    <td class="text-center">
                        <strong><?php echo e($n->score); ?></strong>
                    </td>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->role === 'guru'): ?>
                    <td class="text-center">
                        <button class="btn btn-warning btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#editNilai<?php echo e($n->id); ?>">
                            <i class="bi bi-pencil-square"></i>
                        </button>

                        <form action="<?php echo e(route('guru.grade.destroy', $n->id)); ?>"
                              method="POST" class="d-inline">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin hapus nilai?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="6" class="text-center text-muted">
                        Belum ada data nilai
                    </td>
                </tr>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </tbody>
        </table>
    </div>
</div>


<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->role === 'guru'): ?>
<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $nilai; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $n): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="modal fade" id="editNilai<?php echo e($n->id); ?>" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form method="POST"
              action="<?php echo e(route('guru.grade.update', $n->id)); ?>"
              class="modal-content">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="modal-header">
                <h5 class="modal-title">Edit Nilai</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label>Siswa</label>
                    <select name="siswa_id" class="form-control" required>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $siswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($s->id); ?>"
                                <?php echo e($n->siswa_id == $s->id ? 'selected' : ''); ?>>
                                <?php echo e($s->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Tugas Mengajar</label>
                    <select name="assignment_id" class="form-control" required>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $assignment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($a->id); ?>"
                                <?php echo e($n->assignment_id == $a->id ? 'selected' : ''); ?>>
                                <?php echo e(optional($a->guru)->nama ?? '-'); ?> -
                                <?php echo e(optional($a->kelas)->name ?? '-'); ?> -
                                <?php echo e(optional($a->subject)->name ?? '-'); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Jenis Nilai</label>
                    <select name="type" class="form-control" required>
                        <option value="tugas" <?php echo e($n->type == 'tugas' ? 'selected' : ''); ?>>Tugas</option>
                        <option value="uts" <?php echo e($n->type == 'uts' ? 'selected' : ''); ?>>UTS</option>
                        <option value="uas" <?php echo e($n->type == 'uas' ? 'selected' : ''); ?>>UAS</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Nilai</label>
                    <input type="number" name="score"
                           value="<?php echo e($n->score); ?>"
                           class="form-control"
                           min="0" max="100" required>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-primary">Update</button>
                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            </div>
        </form>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->role === 'guru'): ?>
<div class="modal fade" id="addNilai" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form method="POST"
              action="<?php echo e(route('guru.grade.store')); ?>"
              class="modal-content">
            <?php echo csrf_field(); ?>

            <div class="modal-header">
                <h5 class="modal-title">Tambah Nilai</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label>Siswa</label>
                    <select name="siswa_id" class="form-control" required>
                        <option value="">Pilih Siswa</option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $siswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($s->id); ?>"><?php echo e($s->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Tugas Mengajar</label>
                    <select name="assignment_id" class="form-control" required>
                        <option value="">Pilih Tugas</option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $assignment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($a->id); ?>">
                                <?php echo e(optional($a->guru)->nama ?? '-'); ?> -
                                <?php echo e(optional($a->kelas)->name ?? '-'); ?> -
                                <?php echo e(optional($a->subject)->name ?? '-'); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Jenis Nilai</label>
                    <select name="type" class="form-control" required>
                        <option value="tugas">Tugas</option>
                        <option value="uts">UTS</option>
                        <option value="uas">UAS</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Nilai</label>
                    <input type="number"
                           name="score"
                           class="form-control"
                           min="0" max="100" required>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-primary">Simpan</button>
                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            </div>
        </form>
    </div>
</div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sispeka\resources\views/sispeka/nilai.blade.php ENDPATH**/ ?>