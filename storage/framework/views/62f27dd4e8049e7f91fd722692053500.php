

<?php $__env->startSection('content'); ?>
<div class="container d-flex justify-content-center align-items-center" style="height:100vh">
    <div class="card shadow p-4" style="width:420px">

        <h4 class="text-center fw-bold mb-3">Registrasi Akun</h4>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <?php echo e($errors->first()); ?>

            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <form method="POST" action="<?php echo e(route('register.process')); ?>">
            <?php echo csrf_field(); ?>

            <div class="mb-3">
                <label>Nama Lengkap</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Role</label>
                <select name="role" id="role" class="form-select" required>
                    <option value="">Pilih Role</option>
                    <option value="guru">Guru</option>
                    <option value="wali">Wali</option>
                </select>
            </div>

            <div class="mb-3" id="nip-field" style="display:none">
                <label>NIP</label>
                <input type="text" name="nip" class="form-control">
            </div>

            <div class="mb-3" id="nis-field" style="display:none">
                <label>NIS</label>
                <input type="text" name="nis" class="form-control">
            </div>

            <div class="mb-3">
                <label>Email (opsional)</label>
                <input type="email" name="email" class="form-control">
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>

            <button class="btn btn-primary w-100">Register</button>
        </form>

    </div>
</div>

<script>
document.getElementById('role').addEventListener('change', function () {
    document.getElementById('nip-field').style.display =
        this.value === 'guru' ? 'block' : 'none';

    document.getElementById('nis-field').style.display =
        this.value === 'wali' ? 'block' : 'none';
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sispeka\resources\views/auth/register.blade.php ENDPATH**/ ?>