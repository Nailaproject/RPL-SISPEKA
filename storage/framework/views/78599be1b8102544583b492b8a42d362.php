<ul class="nav nav-pills flex-column mb-3">
   <li class="nav-item mb-2">
        <a href="<?php echo e(route('admin.dashboard')); ?>"
           class="nav-link <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
            <i class="bi bi-speedometer2 me-2"></i> Dashboard
        </a>
    </li>
</ul>

<h6 class="sidebar-title text-uppercase mb-2">Master Data</h6>
<ul class="nav nav-pills flex-column mb-3">
    <li class="nav-item mb-2">
        <a href="<?php echo e(route('admin.guru.index')); ?>"
           class="nav-link <?php echo e(request()->routeIs('admin.guru.*') ? 'active' : ''); ?>">
            <i class="bi bi-person-workspace me-2"></i> Guru
        </a>
    </li>
    <li class="nav-item mb-2">
        <a href="<?php echo e(route('admin.siswa.index')); ?>"
           class="nav-link <?php echo e(request()->routeIs('admin.siswa.*') ? 'active' : ''); ?>">
            <i class="bi bi-people-fill me-2"></i> Siswa
        </a>
    </li>
    <li class="nav-item mb-2">
        <a href="<?php echo e(route('admin.kelas.index')); ?>"
           class="nav-link <?php echo e(request()->routeIs('admin.kelas.*') ? 'active' : ''); ?>">
            <i class="bi bi-door-open me-2"></i> Kelas
        </a>
    </li>
    <li class="nav-item mb-2">
        <a href="<?php echo e(route('admin.subject.index')); ?>"
           class="nav-link <?php echo e(request()->routeIs('admin.subject.*') ? 'active' : ''); ?>">
            <i class="bi bi-book-fill me-2"></i> Mata Pelajaran
        </a>
    </li>
    <li class="nav-item mb-2">
    <a href="<?php echo e(route('admin.teaching.index')); ?>"
       class="nav-link <?php echo e(request()->routeIs('admin.teaching.*') ? 'active' : ''); ?>">
        <i class="bi bi-journal-check me-2"></i> Penugasan Mengajar
    </a>
</li>

</ul>
<?php /**PATH C:\laragon\www\sispeka\resources\views/sidebar/admin.blade.php ENDPATH**/ ?>