  <!-- ======= Sidebar ======= -->
<style>
  .sidebar-nav .nav-link.active {
    background-color: #007bff !important; /* Warna latar belakang */
    color: white !important; /* Warna teks */
  }

  .sidebar-nav .nav-content a.active {
    color: #007bff !important; /* Warna teks untuk submenu */
    font-weight: bold;
  }

</style>
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= base_url('admin') ?>">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-question-circle-fill"></i><span>Informasi</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li> 
            <a href="<?= base_url('admin/setting') ?>">
              <i class="bi bi-circle"></i><span>Tentang Kami</span>
            </a>
          </li>
          
        </ul>
      </li><!-- End Components Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-folder-fill"></i><span>Data Master</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
            <a href="<?= base_url('data-master/supir') ?>">
              <i class="bi bi-circle"></i><span>Supir</span>
            </a>
          </li>
          <li>
            <a href=<?= base_url('data-master/kendaraan') ?>>
              <i class="bi bi-circle"></i><span>Kendaraan</span>
            </a>
          </li>
          <!-- <li>
            <a href=<?= base_url('data-master/pelanggan') ?>>
              <i class="bi bi-circle"></i><span>Pelanggan</span>
            </a>
          </li> -->
        </ul>
      </li><!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= base_url('pengiriman')?>">
          <i class="bi bi-clipboard-check"></i>
          <span>Pengiriman</span>
        </a>
      </li><!-- End Tables Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= base_url('komplain')?>">
          <i class="ri-customer-service-2-fill"></i>
          <span>Komplain Pelanggan</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= base_url('user')?>">
          <i class="bi bi-person-lines-fill"></i>
          <span>Kelola User</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= base_url('profil')?>">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Charts Nav -->

    </ul>

  </aside><!-- End Sidebar-->

  <script>
  document.addEventListener("DOMContentLoaded", function () {
      let currentUrl = window.location.href;
      let sidebarLinks = document.querySelectorAll(".sidebar-nav .nav-link, .sidebar-nav .nav-content a");

      sidebarLinks.forEach(function (link) {
          if (link.href === currentUrl) {
              link.classList.add("active");

              // Untuk menu dropdown, buka parent-nya jika ada
              let parentMenu = link.closest(".nav-content.collapse");
              if (parentMenu) {
                  parentMenu.classList.add("show"); // Membuka menu dropdown
                  let parentLink = parentMenu.previousElementSibling;
                  if (parentLink) {
                      parentLink.classList.remove("collapsed");
                  }
              }
          }
      });
  });
</script>
