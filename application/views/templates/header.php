<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistem Penggajian - <?= $hrd; ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url() . 'assets/vendor/fontawesome-free/css/all.min.css'; ?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url() . 'assets/css/sb-admin-2.min.css'; ?>" rel="stylesheet">
    <link rel="shortcut icon" href="<?= base_url() . 'assets/img/favicon.ico'; ?>">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">

    <style>
        .preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background-color: #fff;
        }

        .preloader .loading {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            font: 14px arial;
        }
    </style>

</head>

<body id="page-top">

    <div class="preloader">
        <div class="loading">
            <img src="<?= base_url() . 'assets/img/preloader/loading.gif'; ?>" width="720">
            <!-- <p style="text-align: center;"><b>Please Wait</b></p> -->
        </div>
    </div>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
                <div class="sidebar-brand-icon rotate-n-15">
                    <!-- <i class="fas fa-laugh-wink"></i> -->
                    <i class="fas fa-file-invoice-dollar"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Penggajian</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li <?php $here = 'dashboard'; ?> class="nav-item <?php if ($where === $here) {
                                                                    echo "active";
                                                                } else {
                                                                    echo "";
                                                                } ?>">
                <a class="nav-link" href="<?= base_url() . 'hrd'; ?>">
                    <i class="fas fa-chart-pie"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Pages Collapse Menu -->
            <li <?php $here = "data_karyawan"; ?> class="nav-item <?php if ($where === $here || "data_absen") {
                                                                        echo "active";
                                                                    } else {
                                                                        echo "";
                                                                    } ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-users"></i>
                    <span>Penggajian</span>
                </a>
                <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Data Penggajian</h6>
                        <a <?php if ($where === "data_karyawan") {
                                $status = "active";
                            } else {
                                $status = "";
                            } ?> class="collapse-item <?= $status; ?>" href="<?= base_url() . 'hrd/data_karyawan'; ?>">Data Master Karyawan</a>
                        <a <?php if ($where === "data_absen") {
                                $status = "active";
                            } else {
                                $status = "";
                            } ?> class="collapse-item <?= $status; ?>" href="<?= base_url() . 'hrd/absensi'; ?>">Rekap Absensi</a>
                        <a <?php if ($where === "data_lembur") {
                                $status = "active";
                            } else {
                                $status = "";
                            } ?> class="collapse-item <?= $status; ?>" href="<?= base_url() . 'hrd/data_lembur'; ?>">Data Lembur</a>
                        <a <?php if ($where === "performance") {
                                $status = "active";
                            } else {
                                $status = "";
                            } ?> class="collapse-item <?= $status; ?>" href="<?= base_url() . 'hrd/performance'; ?>">Data Performance</a>
                        <a <?php if ($where === "data_gaji") {
                                $statusTabGaji = "active";
                            } else {
                                $statusTabGaji = "bg-success text-white rounded-pill mt-1";
                            } ?> class="collapse-item <?= $statusTabGaji; ?>" href="<?= base_url() . 'hrd/data_gaji'; ?>">Rekap Gaji</a>
                    </div>
                </div>
            </li>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $hrd; ?></span>
                                <?php if ($hrd_foto == "-") {
                                    $foto = base_url() . 'assets/img/undraw_profile.svg';
                                } else {
                                    $foto = base_url() . 'assets/img/karyawan/' . $hrd_foto;
                                } ?>
                                <img class="img-profile rounded-circle" src="<?= $foto; ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?= base_url() . 'welcome/logout'; ?>" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->
                <!-- Logout Modal-->
                <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                <a class="btn btn-primary" href="<?= base_url() . 'welcome/logout'; ?>">Logout</a>
                            </div>
                        </div>
                    </div>
                </div>