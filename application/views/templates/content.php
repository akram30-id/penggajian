<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Overview Sistem Penggajian <br><?= date('F Y'); ?></h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Jumlah Karyawan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_karyawan; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                Belum Diapprove Manager</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_notsignmanager; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Sudah Diapprove Manager</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_signedmanager; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Butuh Approval HRD</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $jumlah_notsignHrd; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-ban fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->

    <!-- Content Row -->
    <div class="row justify-content-around mt-5">
        <div class="col-lg-4 mb-5">
            <canvas id="ChartGaji" style="margin-top: 128px;"></canvas>
            <a class="mt-5" href="<?= base_url() . 'hrd/data_gaji'; ?>">Lihat Data Gaji &rarr;</a>
            <!-- CDN Chart JS -->
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                const labels = [
                    'Butuh Approval HRD',
                    'Sudah Diapprove Manager',
                    'Belum Diapprove Manager',
                ];

                const data = {
                    labels: labels,
                    datasets: [{
                        label: 'My First dataset',
                        backgroundColor: [
                            'rgba(186, 0, 31, 1)',
                            'rgba(49, 189, 36, 1)',
                            'rgba(125, 140, 123, 1)',
                        ],
                        borderColor: [
                            'rgba(49, 189, 36, 0)',
                            'rgba(125, 140, 123, 0)',
                            'rgba(186, 0, 31, 0)',
                        ],
                        data: [<?= $jumlah_notsignHrd ?>, <?= $jumlah_signedmanager ?>, <?= $jumlah_notsignmanager ?>],
                    }]
                };

                const config = {
                    type: 'pie',
                    data: data,
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                align: 'center',
                                position: 'bottom',
                                display: true,
                                boxWidth: 2,
                                boxHeight: 2
                            }
                        }
                    },
                };
            </script>
            <script>
                const ChartGaji = new Chart(
                    document.getElementById('ChartGaji'),
                    config
                );
            </script>

        </div>
        <div class="col-lg-6 mb-4">

            <!-- Approach -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Overview Data Karyawan</h6>
                </div>
                <div class="card-body">
                    <div class="container-fluid">

                        <!-- Page Heading -->
                        <h1 class="h3 mb-2 text-gray-800">Data Karyawan</h1>

                        <!-- Data Karyawan -->
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Nama</th>
                                                <th>Jabatan</th>
                                                <th>Posisi</th>
                                                <th>Gaji Pokok</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($overview as $o) : ?>
                                                <tr>
                                                    <td><?= $o['nama']; ?></td>
                                                    <td><?= $o['jabatan']; ?></td>
                                                    <td><?= $o['posisi']; ?></td>
                                                    <td><?= $o['GajiPokok']; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <a target="_blank" rel="nofollow" href="<?= base_url() . 'hrd/data_karyawan'; ?>">Lihat Data Selengkapnya &rarr;</a>
                            </div>
                        </div>

                    </div>
                    <!-- /.container-fluid -->
                </div>
            </div>

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->