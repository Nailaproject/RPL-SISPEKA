

<?php $__env->startSection('content'); ?>
<div class="container d-flex justify-content-center align-items-center" style="height:100vh">
    <div class="card shadow p-4" style="width:400px">

        <h4 class="text-center fw-bold mb-3">Login SISPEKA</h4>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <?php echo e($errors->first()); ?>

            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <form method="POST" action="<?php echo e(route('login.process')); ?>">
            <?php echo csrf_field(); ?>

            <div class="mb-3">
                <label>Login Sebagai</label>
                <select name="role" id="role" class="form-select" required>
                    <option value="">Pilih Role</option>
                    <option value="admin">Admin</option>
                    <option value="guru">Guru</option>
                    <option value="wali">Wali</option>
                </select>
            </div>

            <div class="mb-3">
                <label id="login-label">Email / NIP / NIS</label>
                <input type="text"
                       name="login"
                       id="login-input"
                       class="form-control"
                       placeholder="Masukkan Email / NIP / NIS"
                       required>
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password"
                       name="password"
                       class="form-control"
                       required>
            </div>

            <button class="btn btn-primary w-100 mb-2">Login</button>

            <div class="text-center">
                <a href="<?php echo e(route('register')); ?>">Buat akun baru</a>
            </div>
        </form>

    </div>
</div>

<script>
document.getElementById('role').addEventListener('change', function () {
    const label = document.getElementById('login-label');
    const input = document.getElementById('login-input');

    if (this.value === 'admin') {
        label.textContent = 'Email';
        input.placeholder = 'Masukkan Email';
        input.type = 'email';
    } else if (this.value === 'guru') {
        label.textContent = 'NIP';
        input.placeholder = 'Masukkan NIP';
        input.type = 'text';
    } else if (this.value === 'wali') {
        label.textContent = 'NIS';
        input.placeholder = 'Masukkan NIS';
        input.type = 'text';
    } else {
        label.textContent = 'Email / NIP / NIS';
        input.placeholder = 'Masukkan Email / NIP / NIS';
        input.type = 'text';
    }
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\sispeka\resources\views/auth/login.blade.php ENDPATH**/ ?>