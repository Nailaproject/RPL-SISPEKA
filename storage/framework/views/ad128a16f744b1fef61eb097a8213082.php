

<?php $__env->startSection('content'); ?>
<div class="card p-4">

    <div class="d-flex justify-content-between mb-4">
        <h4>Data Guru Mengajar</h4>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTeaching">
            New Assignment
        </button>
    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <table class="table table-bordered table-striped">
        <thead class="table-primary text-center">
            <tr>
                <th>No</th>
                <th>Guru</th>
                <th>Kelas</th>
                <th>Mata Pelajaran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $teaching; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr class="text-center">
                <td><?php echo e($loop->iteration); ?></td>
                <td><?php echo e(optional($t->guru)->nama ?? '-'); ?></td>
                <td><?php echo e(optional($t->kelas)->name ?? '-'); ?></td>
                <td><?php echo e(optional($t->subject)->name ?? '-'); ?></td>
                <td>
                    <!-- EDIT -->
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editTeaching<?php echo e($t->id); ?>">
                        <i class="bi bi-pencil-square"></i>
                    </button>
                    
                    <!-- DELETE -->
                    <form action="<?php echo e(route('admin.teaching.destroy', $t->id)); ?>" method="POST" class="d-inline">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus penugasan ini?')">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>

            <!-- MODAL EDIT -->
            <div class="modal fade" id="editTeaching<?php echo e($t->id); ?>" tabindex="-1">
                <div class="modal-dialog">
                    <form action="<?php echo e(route('admin.teaching.update', $t->id)); ?>" method="POST" class="modal-content">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Penugasan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label>Guru</label>
                                <select name="guru_id" class="form-select" required>
                                    <option value="">Select an option</option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $guru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($g->id); ?>" <?php echo e($t->guru_id == $g->id ? 'selected' : ''); ?>>
                                            <?php echo e($g->nama); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Kelas</label>
                                <select name="kelas_id" class="form-select" required>
                                    <option value="">Select an option</option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $kelas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($k->id); ?>" <?php echo e($t->kelas_id == $k->id ? 'selected' : ''); ?>>
                                            <?php echo e($k->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Mata Pelajaran</label>
                                <select name="subject_id" class="form-select" required>
                                    <option value="">Pilih Subject</option>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $subject; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($s->id); ?>" <?php echo e($t->subject_id == $s->id ? 'selected' : ''); ?>>
                                            <?php echo e($s->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-warning">Update</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="5" class="text-center text-muted">Belum ada tugas mengajar</td>
            </tr>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </tbody>
    </table>
</div>

<!-- ========== MODAL ADD TEACHING ASSIGNMENT ========== -->
<div class="modal fade" id="addTeaching" tabindex="-1">
  <div class="modal-dialog">
    <form method="POST" action="<?php echo e(route('admin.teaching.store')); ?>" class="modal-content">
      <?php echo csrf_field(); ?>

      <div class="modal-header">
        <h5 class="modal-title">Tambah Teaching Assignment</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <div class="mb-3">
          <label>Guru</label>
          <select name="guru_id" class="form-control" required>
            <option value="">Select an option</option>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $guru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($g->id); ?>"><?php echo e($g->nama); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
          </select>
        </div>

        <div class="mb-3">
          <label>Kelas</label>
          <select name="kelas_id" class="form-control" required>
            <option value="">Select an option</option>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $kelas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($k->id); ?>"><?php echo e($k->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
          </select>
        </div>

        <div class="mb-3">
          <label>Subject</label>
          <select name="subject_id" class="form-select" required>
            <option value="">Select an option</option>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $subject; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($s->id); ?>"><?php echo e($s->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sispeka\resources\views/sispeka/teaching.blade.php ENDPATH**/ ?>