<?php
include 'database.php';
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistem Terminologi Medis</title>
  <link rel="shortcut icon" type="image/png" href="assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="assets/css/styles.min.css" />
  <style>
    body {
      background-color: #f5f5f5;
    }
    .page-wrapper {
      background-color: #f5f5f5;
    }
    .body-wrapper {
      background-color: #f5f5f5;
    }
  </style>
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="./index.php" class="text-nowrap logo-img">
            <img src="assets/images/logos/dark-logo.svg" width="180" alt="" style="display: block;" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Pilih Chapter</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./index.php" aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>
            <div class="sidebar-body">
              <ul class="nav">
                <?php
                // Query untuk mengambil semua chapter dari database
                $query = "SELECT * FROM chapters ORDER BY idchapter";
                $result = mysqli_query($conn, $query);

                // Mendapatkan chapter yang sedang aktif dari parameter URL
                $active_chapter = isset($_GET['chapter']) ? $_GET['chapter'] : '';

                // Menampilkan setiap chapter sebagai item navigasi
                while ($row = mysqli_fetch_assoc($result)) {
                  $isActive = ($active_chapter == $row['idchapter']) ? 'active' : '';
                ?>
                  <li class="nav-item">
                    <a href="index.php?chapter=<?php echo $row['idchapter']; ?>" 
                       class="nav-link sidebar-link <?php echo $isActive; ?>"
                       style="white-space: normal; padding: 0.75rem 1.5rem;">
                      <span>
                        <i class="ti ti-book"></i>
                      </span>
                      <span class="link-title">
                        <?php echo $row['nomor_chapter'] . ' ' . $row['namachapter']; ?>
                      </span>
                    </a>
                  </li>
                <?php
                }
                ?>
                </ul>
            </div>
            </div>
          </ul>
        </nav>
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->
    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-between px-0" id="navbarNav">
            <div class="d-flex align-items-center">
              <form class="d-none d-md-flex w-200" style="max-width: 1000px;">
                <div class="input-group">
                  <input class="form-control" type="search" placeholder="Cari istilah medis..." aria-label="Search">
                  <button class="btn btn-primary" type="submit">
                    <i class="ti ti-search"></i>
                  </button>
                </div>
              </form>
            </div>
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <i class="ti ti-user"></i>
                </a>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->
      <div class="container-fluid">
        <div class="card">
          <div class="card-body">
            <h3 class="card-title fw-semibold mb-4">Sample Page</h3>
            <p class="mb-0">This is a sample page </p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/sidebarmenu.js"></script>
  <script src="assets/js/app.min.js"></script>
  <script src="assets/libs/simplebar/dist/simplebar.js"></script>
</body>

</html>
