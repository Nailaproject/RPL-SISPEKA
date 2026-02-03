<ul class="nav nav-pills flex-column mb-3">
  <li class="nav-item mb-2">
        <a href="<?php echo e(route('guru.dashboard')); ?>"
           class="nav-link <?php echo e(request()->routeIs('guru.dashboard') ? 'active' : ''); ?>">
            <i class="bi bi-speedometer2 me-2"></i> Dashboard
        </a>
    </li>
</ul>

<h6 class="sidebar-title text-uppercase mb-2">Akademik</h6>
<ul class="nav nav-pills flex-column mb-3">
    <li class="nav-item mb-2">
        <a href="<?php echo e(route('guru.attendance.index')); ?>"
           class="nav-link <?php echo e(request()->routeIs('attendance.*') ? 'active' : ''); ?>">
            <i class="bi bi-calendar-check me-2"></i> Kehadiran
        </a>
    </li>
    <li class="nav-item mb-2">
        <a href="<?php echo e(route('guru.grade.index')); ?>"
           class="nav-link <?php echo e(request()->routeIs('grade.*') ? 'active' : ''); ?>">
            <i class="bi bi-bar-chart-fill me-2"></i> Nilai
        </a>
    </li>
   <li class="nav-item mb-2">
        <a href="<?php echo e(route('guru.laporan.index')); ?>"
           class="nav-link <?php echo e(request()->routeIs('laporan.*') ? 'active' : ''); ?>">
            <i class="bi bi-journal-text me-2"></i> Catatan Perilaku
        </a>
    </li>
</ul>
<?php /**PATH C:\laragon\www\sispeka\resources\views/sidebar/guru.blade.php ENDPATH**/ ?>