

<?php $__env->startSection('content'); ?>
<div class="card p-3">

    <div class="d-flex justify-content-between mb-4">
        <h4>Data Mata Pelajaran</h4>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSubject">
            New Subject
        </button>
    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <table class="table table-bordered table-striped">
        <thead class="table-primary text-center">
            <tr>
                <th>No</th>
                <th>Nama Mata Pelajaran</th>
                <th>Kode</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $subject; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr class="text-center">
                <td><?php echo e($loop->iteration); ?></td>
                <td class="text-start"><?php echo e($s->name); ?></td>
                <td><?php echo e($s->code); ?></td>
                <td>
                    <!-- EDIT -->
                    <button class="btn btn-sm btn-warning"
                        data-bs-toggle="modal"
                        data-bs-target="#editSubject<?php echo e($s->id); ?>">
                        <i class="bi bi-pencil-square"></i>
                    </button>

                    <!-- DELETE -->
                    <form action="<?php echo e(route('admin.subject.destroy', $s->id)); ?>"
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


<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $subject; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<div class="modal fade" id="editSubject<?php echo e($s->id); ?>" tabindex="-1">
  <div class="modal-dialog">
    <form method="POST"
          action="<?php echo e(route('admin.subject.update', $s->id)); ?>"
          class="modal-content">
      <?php echo csrf_field(); ?>
      <?php echo method_field('PUT'); ?>

      <div class="modal-header">
        <h5 class="modal-title">Edit Mata Pelajaran</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <div class="mb-3">
          <label>Nama Mata Pelajaran</label>
          <input type="text" name="name" value="<?php echo e($s->name); ?>" class="form-control" required>
        </div>

        <div class="mb-3">
          <label>Kode</label>
          <input type="text" name="code" value="<?php echo e($s->code); ?>" class="form-control" required>
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


<div class="modal fade" id="addSubject" tabindex="-1">
  <div class="modal-dialog">
    <form method="POST" action="<?php echo e(route('admin.subject.store')); ?>" class="modal-content">
      <?php echo csrf_field(); ?>

      <div class="modal-header">
        <h5 class="modal-title">Tambah Mata Pelajaran</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <div class="mb-3">
          <label>Nama Mata Pelajaran</label>
          <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
          <label>Kode</label>
          <input type="text" name="code" class="form-control" required>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sispeka\resources\views/sispeka/subject.blade.php ENDPATH**/ ?>