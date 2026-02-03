
<?php $__env->startSection('title','Laporan Siswa'); ?>

<?php $__env->startSection('content'); ?>
<div class="card p-3">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold">Laporan Siswa</h4>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->role !== 'wali'): ?>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahLaporan">
                New Laporan
            </button>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <table class="table table-bordered table-sm bg-white">
        <thead class="table-primary text-center">
            <tr>
                <th>No</th>
                <th>Siswa</th>
                <th>Guru</th>
                <th>Jenis</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->role !== 'wali'): ?>
                    <th>Aksi</th>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </tr>
        </thead>

        <tbody>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $laporan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td class="text-center"><?php echo e($loop->iteration); ?></td>
                    <td><?php echo e($item->siswa->name); ?></td>
                    <td><?php echo e(optional($item->guru)->nama ?? '-'); ?></td>
                    <td class="text-center">
                        <?php
                            $badgeClass = $item->jenis === 'perilaku'
                                ? 'bg-success'
                                : 'bg-danger';
                        ?>
                        <span class="badge <?php echo e($badgeClass); ?>">
                            <?php echo e(ucfirst($item->jenis)); ?>

                        </span>
                    </td>
                    <td class="text-center"><?php echo e($item->tanggal); ?></td>
                    <td><?php echo e($item->keterangan); ?></td>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->role !== 'wali'): ?>
                        <td class="text-center">
                            <button
                                class="btn btn-warning btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#editModal<?php echo e($item->id); ?>"
                            >
                                <i class="bi bi-pencil-square"></i>
                            </button>

                            <form
                                action="<?php echo e(route('guru.laporan.destroy',$item->id)); ?>"
                                method="POST"
                                class="d-inline"
                            >
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin hapus laporan?')"
                                >
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="7" class="text-center text-muted">
                        Belum ada laporan
                    </td>
                </tr>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </tbody>
    </table>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->role !== 'wali'): ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $laporan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="modal fade" id="editModal<?php echo e($item->id); ?>" tabindex="-1">
                <div class="modal-dialog">
                    <form
                        method="POST"
                        action="<?php echo e(route('guru.laporan.update',$item->id)); ?>"
                        class="modal-content"
                    >
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>

                        <div class="modal-header">
                            <h5>Edit Laporan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            <div class="mb-3">
                                <label>Jenis</label>
                                <select name="jenis" class="form-select" required>
                                    <option value="perilaku" <?php echo e($item->jenis=='perilaku'?'selected':''); ?>>
                                        Perilaku
                                    </option>
                                    <option value="insiden" <?php echo e($item->jenis=='insiden'?'selected':''); ?>>
                                        Insiden
                                    </option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Tanggal</label>
                                <input
                                    type="date"
                                    name="tanggal"
                                    class="form-control"
                                    value="<?php echo e($item->tanggal); ?>"
                                    required
                                >
                            </div>

                            <div class="mb-3">
                                <label>Keterangan</label>
                                <textarea
                                    name="keterangan"
                                    class="form-control"
                                    required
                                ><?php echo e($item->keterangan); ?></textarea>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-warning">Update</button>
                            <button
                                type="button"
                                class="btn btn-secondary"
                                data-bs-dismiss="modal"
                            >
                                Batal
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->user()->role !== 'wali'): ?>
        <div class="modal fade" id="tambahLaporan" tabindex="-1">
            <div class="modal-dialog">
                <form
                    method="POST"
                    action="<?php echo e(route('guru.laporan.store')); ?>"
                    class="modal-content"
                >
                    <?php echo csrf_field(); ?>

                    <div class="modal-header">
                        <h5>Tambah Laporan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Siswa</label>
                            <select name="siswa_id" class="form-select" required>
                                <option value="">Pilih Siswa</option>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $siswa; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($s->id); ?>"><?php echo e($s->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Jenis</label>
                            <select name="jenis" class="form-select" required>
                                <option value="">Pilih Jenis</option>
                                <option value="perilaku">Perilaku</option>
                                <option value="insiden">Insiden</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Keterangan</label>
                            <textarea name="keterangan" class="form-control" required></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-primary">Simpan</button>
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal"
                        >
                            Batal
                        </button>
                    </div>

                </form>
            </div>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sispeka\resources\views/sispeka/LaporanSiswa.blade.php ENDPATH**/ ?>