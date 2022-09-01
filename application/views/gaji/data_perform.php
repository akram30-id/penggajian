<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-4">
            <a data-toggle="modal" data-target="#tambahPerform" class="btn btn-primary">Tambah Data</a>
            <!-- Modal Tambah Rekap Absensi -->
            <div class="modal fade" id="tambahPerform" data-backdrop="static" aria-labelledby="tambahPerformLabel">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tambahPerformLabel">Tambah Data Performance</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body ui-front">
                            <form action="<?= base_url() . 'hrd/act_tambah_perform'; ?>" method="POST">
                                <div class="form-group">
                                    <label for="namaKaryawan">Nama Karyawan</label>
                                    <input type="text" class="form-control" id="namaKaryawan" name="namaKaryawan">
                                </div>
                                <div class="form-group">
                                    <label for="tglLembur">Periode Performance</label>
                                    <input type="date" class="form-control" id="periode" name="periode">
                                </div>
                                <div class="form-group">
                                    <label for="tglLembur">Score Performance (1-100)</label>
                                    <input type="number" class="form-control" id="score" name="score">
                                </div>
                                <div class="form-group">
                                    <label for="poinLembur">Bonus Performance</label>
                                    <input type="number" class="form-control" id="bonus" name="bonus">
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
            <h3>Rekapitulasi Performance Periode <?= date('F Y'); ?></h3>
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
                                <th>Score</th>
                                <th>Bonus</th>
                                <th>Periode</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($perform as $p) : ?>
                                <tr>
                                    <td>
                                        <?php if ($p['foto'] == "-" || "") {
                                            $foto = base_url() . 'assets/img/undraw_profile.svg';
                                        } else {
                                            $foto = base_url() . 'assets/img/karyawan/' . $p['foto'];
                                        } ?>
                                        <img src="<?= $foto; ?>" style="width: 64px;">
                                    </td>
                                    <td><?= ucwords($p['nama']); ?> <br> <small><b><?= ucwords($p['jabatan']) . " - " . ucwords($p['posisi']); ?></b></small></td>
                                    <td><?= $p['ScorePerform']; ?></td>
                                    <?php //$TotalCost = intval($p['SUM(PoinLembur)']) * intval($p['CostPerPoinLembur']); 
                                    ?>
                                    <?php $TotalCost = intval($p['QtyBonusPerform']); ?>
                                    <td>Rp. <?= number_format($TotalCost, 2, ',', '.'); ?></td>
                                    <td><?= date('F Y', strtotime($p['PerformPeriode'])); ?></td>
                                    <td>
                                        <a class="btn btn-warning btn-sm" data-target="#editPerform<?= $p['idPerform'] ?>" data-toggle="modal"><b>Edit</b></a>
                                        <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deletePerform<?= $p['idPerform'] ?>"><i class="fas fa-trash"></i></a>
                                    </td>
                                    <!-- Modal Delete Perform -->
                                    <div class="modal fade" id="deletePerform<?= $p['idPerform'] ?>" tabindex="-1" aria-labelledby="deletePerformLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <h5 class="modal-title mb-5" id="deletePerformLabel">Apakah Anda Yakin?<br>Data Performance <?= ucwords($p['nama']); ?> Akan Dihapus</h5>
                                                    <div class="row justify-content-end">
                                                        <a href="<?= base_url() . 'hrd/delete_perform/' . $p['idPerform']; ?>" class="btn btn-danger mr-3">Hapus</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal Tambah Rekap Absensi -->
                                    <div class="modal fade" id="editPerform<?= $p['idPerform'] ?>" data-backdrop="static" aria-labelledby="editPerformLabel">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editPerformLabel">Edit Performance <?= ucwords($p['nama']); ?></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body ui-front">
                                                    <form action="<?= base_url() . 'hrd/act_edit_perform'; ?>" method="POST">
                                                        <div class="form-group">
                                                            <label for="namaKaryawan">Nama Karyawan</label>
                                                            <input type="text" class="form-control" id="namaKaryawan" name="namaKaryawan" value="<?= ucwords($p['nama']); ?>">
                                                            <input type="hidden" name="idPerform" value="<?= $p['idPerform']; ?>">
                                                            <input type="hidden" name="id_user" value="<?= $p['id_user']; ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="tglLembur">Periode Performance</label>
                                                            <input type="text" class="form-control" id="periode" name="periode" value="<?= date('Y-m-d', strtotime($p['PerformPeriode'])); ?>" readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="tglLembur">Score Performance (1-100)</label>
                                                            <input type="number" class="form-control" id="score" name="score" value="<?= $p['ScorePerform']; ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="poinLembur">Bonus Performance</label>
                                                            <input type="number" class="form-control" id="bonus" name="bonus" value="<?= $TotalCost; ?>">
                                                        </div>
                                                        <hr>
                                                        <button type="submit" class="btn btn-primary btn-block mt-3">Edit Data</button>
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
            <a href="<?= base_url() . 'hrd/data_gaji'; ?>" class="btn btn-success btn-sm">Lanjut ke Rekap Gaji</a>
        </div>
    </div>

</div>
<!-- End of Main Content -->