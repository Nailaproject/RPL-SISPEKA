<ul class="nav nav-pills flex-column mb-3">
    <li class="nav-item mb-2">
        <a href="<?php echo e(route('wali.dashboard')); ?>"
           class="nav-link <?php echo e(request()->routeIs('wali.dashboard') ? 'active' : ''); ?>">
            <i class="bi bi-speedometer2 me-2"></i> Dashboard
        </a>
    </li>
</ul>

<h6 class="sidebar-title text-uppercase mb-2">Informasi Siswa</h6>
<ul class="nav nav-pills flex-column">
    <li class="nav-item mb-2">
        <a href="<?php echo e(route('wali.attendance')); ?>"
           class="nav-link <?php echo e(request()->routeIs('wali.attendance') ? 'active' : ''); ?>">
            <i class="bi bi-calendar-check me-2"></i> Kehadiran
        </a>
    </li>
    <li class="nav-item mb-2">
        <a href="<?php echo e(route('wali.grade')); ?>"
           class="nav-link <?php echo e(request()->routeIs('wali.grade') ? 'active' : ''); ?>">
            <i class="bi bi-bar-chart-fill me-2"></i> Nilai
        </a>
    </li>
    <li class="nav-item mb-2">
        <a href="<?php echo e(route('wali.laporan')); ?>"
           class="nav-link <?php echo e(request()->routeIs('wali.laporan') ? 'active' : ''); ?>">
            <i class="bi bi-journal-text me-2"></i> Catatan Perilaku
        </a>
    </li>
</ul>
<?php /**PATH C:\laragon\www\sispeka\resources\views/sidebar/wali.blade.php ENDPATH**/ ?>