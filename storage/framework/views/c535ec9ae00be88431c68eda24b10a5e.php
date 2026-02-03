

<?php $__env->startSection('content'); ?>
<div class="card p-3">

    <div class="d-flex justify-content-between mb-4">
        <h4>Data Kelas</h4>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addKelas">
            New Kelas
        </button>
    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <table class="table table-bordered table-striped">
        <thead class="table-primary text-center">
            <tr>
                <th>No</th>
                <th>Nama Kelas</th>
                <th>Grade</th>
                <th>Wali Kelas</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $kelas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr class="text-center">
                <td><?php echo e($loop->iteration); ?></td>
                <td><?php echo e($k->name); ?></td>
                <td><?php echo e($k->grade); ?></td>
                <td>
                    <?php echo e($k->wali_kelas_id
                        ? optional($guru->firstWhere('id',$k->wali_kelas_id))->nama
                        : '-'); ?>

                </td>
                <td>
                    <button class="btn btn-sm btn-warning"
                        data-bs-toggle="modal"
                        data-bs-target="#editKelas<?php echo e($k->id); ?>">
                        <i class="bi bi-pencil-square"></i>
                    </button>

                    <form action="<?php echo e(route('admin.kelas.destroy',$k->id)); ?>"
                          method="POST"
                          style="display:inline;">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button class="btn btn-sm btn-danger"
                            onclick="return confirm('Yakin hapus?')">
                             <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </tbody>
    </table>
</div>


<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $kelas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="modal fade" id="editKelas<?php echo e($k->id); ?>" tabindex="-1">
  <div class="modal-dialog">
    <form method="POST"
          action="<?php echo e(route('admin.kelas.update',$k->id)); ?>"
          class="modal-content">
      <?php echo csrf_field(); ?>
      <?php echo method_field('PUT'); ?>

      <div class="modal-header">
        <h5 class="modal-title">Edit Kelas</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <div class="mb-3">
          <label>Nama Kelas</label>
          <input type="text"
                 name="name"
                 value="<?php echo e($k->name); ?>"
                 class="form-control"
                 required>
        </div>

        <div class="mb-3">
          <label>Grade</label>
          <input type="number"
                 name="grade"
                 value="<?php echo e($k->grade); ?>"
                 class="form-control"
                 required>
        </div>

        <div class="mb-3">
          <label>Wali Kelas</label>
          <select name="wali_kelas_id" class="form-select">
            <option value="">Select an option</option>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $guru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($g->id); ?>"
                <?php echo e($k->wali_kelas_id == $g->id ? 'selected' : ''); ?>>
                <?php echo e($g->nama); ?>

              </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
          </select>
        </div>
      </div>

      <div class="modal-footer">
        <button class="btn btn-primary">Simpan</button>
        <button type="button"
                class="btn btn-secondary"
                data-bs-dismiss="modal">
            Batal
        </button>
      </div>

    </form>
  </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


<div class="modal fade" id="addKelas" tabindex="-1">
  <div class="modal-dialog">
    <form method="POST"  action="<?php echo e(route('admin.kelas.store')); ?>" class="modal-content">
      <?php echo csrf_field(); ?>

      <div class="modal-header">
        <h5 class="modal-title">Tambah Kelas</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <div class="mb-3">
          <label>Nama Kelas</label>
          <input type="text"
                 name="name"
                 class="form-control"
                 required>
        </div>

        <div class="mb-3">
          <label>Grade</label>
          <input type="number"
                 name="grade"
                 class="form-control"
                 required>
        </div>

        <div class="mb-3">
          <label>Wali Kelas</label>
          <select name="wali_kelas_id" class="form-select">
            <option value="">Select an option</option>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $guru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($g->id); ?>"><?php echo e($g->nama); ?></option>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sispeka\resources\views/sispeka/kelas.blade.php ENDPATH**/ ?>