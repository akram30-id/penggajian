<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-4">
            <a href="<?= base_url() . 'hrd/tambah_absensi'; ?>" data-toggle="modal" data-target="#tambahAbsensi" class="btn btn-primary">Tambah Data</a>
            <!-- Modal Tambah Rekap Absensi -->
            <div class="modal fade" id="tambahAbsensi" data-backdrop="static" aria-labelledby="tambahAbsensiLabel">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tambahAbsensiLabel">Tambah Rekap Absensi</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body ui-front">
                            <form action="<?= base_url() . 'hrd/act_tambah_absen'; ?>" method="POST">
                                <div class="form-group">
                                    <label for="namaKaryawan">Nama Karyawan</label>
                                    <input type="text" class="form-control" id="namaKaryawan" name="namaKaryawan">
                                </div>
                                <div class="form-group">
                                    <label for="namaKaryawan">Periode Absen</label>
                                    <input type="date" class="form-control" id="periodeAbsen" name="periodeAbsen">
                                </div>
                                <div class="row mb-4">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="totalAbsen">Total Absen</label>
                                            <input type="number" class="form-control" id="totalAbsen" name="totalAbsen">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="namaKaryawan">Jumlah Hari Kerja</label>
                                            <input type="number" class="form-control" id="qtyHariKerja" name="qtyHariKerja">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <button type="submit" class="btn btn-primary btn-block mt-3">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-sm-6">
            <h3>Rekapitulasi Absen Periode <?= date('F Y'); ?></h3>
        </div>
    </div>
    <div class="row justify-content-center">
        <?= $this->session->flashdata('pesan'); ?>
        <div class="col-sm-12 my-2">
            <div class="card">
                <div class="card-body">
                    <table id="table_absensi" class="display nowrap" style="width:85%">
                        <thead>
                            <tr>
                                <th>###</th>
                                <th>Nama</th>
                                <th>Departemen</th>
                                <th>Total Absen / Jml. Hari Kerja</th>
                                <th>Periode</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($absensi as $a) : ?>
                                <tr>
                                    <td>
                                        <?php if ($a['foto'] == "-" || "") {
                                            $foto = base_url() . 'assets/img/undraw_profile.svg';
                                        } else {
                                            $foto = base_url() . 'assets/img/karyawan/' . $a['foto'];
                                        } ?>
                                        <img src="<?= $foto; ?>" style="width: 64px;">
                                    </td>
                                    <td><?= ucwords($a['nama']); ?></td>
                                    <td><?= ucwords($a['jabatan']) . " - " . ucwords($a['posisi']); ?></td>
                                    <td><?= $a['TotalAbsen']; ?> / <?= $a['QtyHariKerja']; ?></td>
                                    <td><?= date('F Y', strtotime($a['PeriodeAbsen'])); ?></td>
                                    <td>
                                        <a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editAbsen<?= $a['idAbsen'] ?>">Edit <i class="fas fa-marker"></i></a>
                                        <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteAbsen<?= $a['idAbsen'] ?>"> <i class="fas fa-trash"></i></a>
                                    </td>

                                    <!-- Modal -->
                                    <div class="modal fade" id="deleteAbsen<?= $a['idAbsen'] ?>" tabindex="-1" aria-labelledby="deleteAnakLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <h5 class="modal-title mb-5" id="deleteAnakLabel">Apakah Anda Yakin?<br>Data <?= ucwords($a['nama']); ?> Akan Dihapus</h5>
                                                    <div class="row justify-content-end">
                                                        <button type="button" class="btn btn-secondary mr-3" data-dismiss="modal">Tidak</button>
                                                        <a href="<?= base_url() . 'hrd/delete_absensi/' . $a['idAbsen']; ?>" class="btn btn-danger mr-3">Hapus</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal -->
                                    <div class="modal fade" id="editAbsen<?= $a['idAbsen'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="editAbsenLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editAbsenLabel">Edit Data Absen</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="<?= base_url() . 'hrd/act_edit_absen'; ?>" method="POST">
                                                        <div class="form-group">
                                                            <label for="namaKaryawan">Nama Karyawan</label>
                                                            <input type="text" class="form-control" id="namaKaryawan" name="namaKaryawan" value="<?= $a['nama']; ?>" readonly>
                                                            <input type="hidden" name="id_absen" value="<?= $a['idAbsen']; ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="namaKaryawan">Periode Absen</label>
                                                            <input type="text" class="form-control" id="periodeAbsen" name="periodeAbsen" value="<?= date('F Y', strtotime($a['PeriodeAbsen'])); ?>" readonly>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="totalAbsen">Total Absen</label>
                                                                    <input type="number" class="form-control" id="totalAbsen" name="totalAbsen" value="<?= $a['TotalAbsen']; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="namaKaryawan">Jumlah Hari Kerja</label>
                                                                    <input type="number" class="form-control" id="qtyHariKerja" name="qtyHariKerja" value="<?= $a['QtyHariKerja']; ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <button type="submit" class="btn btn-primary btn-block mt-3">Submit</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-end my-3">
        <div class="col-sm-3">
            <a href="<?= base_url() . 'hrd/data_lembur'; ?>" class="btn btn-success btn-sm">Lanjut ke Data Lembur</a>
        </div>
    </div>

</div>
<!-- End of Main Content -->