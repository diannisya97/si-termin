<?php
include 'database.php';

// Pastikan koneksi database berhasil
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Cek apakah ada chapter yang dipilih
$active_chapter = isset($_GET['chapter']) ? $_GET['chapter'] : '';
$chapter_title = "Sistem Terminologi Medis"; // Judul default jika tidak ada chapter yang dipilih

if ($active_chapter) {
    // Ambil nama chapter singkat dari database
    $query = "SELECT nomor_chapter, nama_singkat FROM chapters WHERE idchapter = '$active_chapter'";
    $result = mysqli_query($conn, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $chapter_data = mysqli_fetch_assoc($result);
        $chapter_title = "Chapter " . $chapter_data['nomor_chapter'] . " - " . $chapter_data['nama_singkat'];
    }
}
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
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    
    <!-- Sidebar Start -->
    <aside class="left-sidebar" style="width: 300px">
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="./index.php" class="text-nowrap logo-img">
            <img src="assets/images/logos/dark-logo.svg" width="180" alt="Logo" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>

        <!-- Sidebar navigation -->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu"><h4>Pilih Chapter</h4></span>
            </li>

            <?php
            // Query untuk mengambil daftar chapter
            $query = "SELECT * FROM chapters ORDER BY idchapter";
            $result = mysqli_query($conn, $query);

            // Cek jika query gagal
            if (!$result) {
                echo "<p class='text-danger p-3'>Error: " . mysqli_error($conn) . "</p>";
            } elseif (mysqli_num_rows($result) > 0) {
                // Loop untuk menampilkan daftar chapter
                while ($row = mysqli_fetch_assoc($result)) {
                    $isActive = ($active_chapter == $row['idchapter']) ? 'bg-primary text-white' : '';
                    echo '<li class="sidebar-item">';
                    echo '<a class="sidebar-link ' . $isActive . '" href="index.php?chapter=' . $row['idchapter'] . '" aria-expanded="false" style="white-space: normal; word-wrap: break-word; width: 280px;">';
                    echo '<span><i class="ti ti-book"></i></span>';
                    echo '<span class="hide-menu">Chapter ' . $row['nomor_chapter'] . ' ' . $row['namachapter'] . '</span>';
                    echo '</a>';
                    echo '</li>';
                }
            } else {
                echo "<p class='text-muted p-3'>Tidak ada chapter yang tersedia.</p>";
            }
            ?>
          </ul>
        </nav>
      </div>
    </aside>
    <!-- Sidebar End -->

    <!-- Main Content Start -->
    <div class="body-wrapper">
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-between px-3">
            <h4 class="mb-0"><?php echo $chapter_title; ?></h4>
            <form class="d-none d-md-flex" style="max-width: 300px;">
              <div class="input-group">
                <input class="form-control" type="search" placeholder="Cari istilah medis..." aria-label="Search">
                <button class="btn btn-primary" type="submit">
                  <i class="ti ti-search"></i>
                </button>
              </div>
            </form>
          </div>
        </nav>
      </header>

      <div class="container-fluid">
        <div class="card">
          <div class="card-body">
            <?php
            if ($active_chapter) {
                $query = "SELECT * FROM chapters WHERE idchapter = '$active_chapter'";
                $result = mysqli_query($conn, $query);
                $chapter = mysqli_fetch_assoc($result);

                if ($chapter) {
            ?>
                    <div class="row">
                        <div class="col-md-15 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <div class="sticky-top bg-white pt-3 pb-2">
                                        <!-- <h6 class="card-title">Chapter <?php echo $chapter['nomor_chapter']; ?></h6>
                                        <h2><?php echo $chapter['namachapter']; ?></h2> -->
                                    </div>
                                    <?php
                                    $blocks_query = "SELECT * FROM tb_blocks WHERE idchapter = '$active_chapter' ORDER BY idchapter";
                                    $blocks_result = mysqli_query($conn, $blocks_query);

                                    if (mysqli_num_rows($blocks_result) > 0) {
                                        while ($block = mysqli_fetch_assoc($blocks_result)) {
                                    ?>
                                            <div class="mt-1">
                                                <div class="card">
                                                    <div class="card-body py-2">
                                                        <h5 class="card-title mb-0" style="font-size: 0.9rem;"><?php echo $block['kodeblok']; ?> <?php echo $block['namablok']; ?></h5>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php
                                        }
                                    } else {
                                        echo '<p class="mt-4">No blocks found for this chapter.</p>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
            ?>
                <div class="row">
                    <div class="col-md-12 grid-margin">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">Welcome</h6>
                                <p>Please select a chapter from the sidebar to view its content.</p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
