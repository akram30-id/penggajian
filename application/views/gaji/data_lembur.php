<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-4">
            <a href="<?= base_url() . 'hrd/tambah_lembur'; ?>" data-toggle="modal" data-target="#tambahLembur" class="btn btn-primary">Tambah Data</a>
            <!-- Modal Tambah Rekap Absensi -->
            <div class="modal fade" id="tambahLembur" data-backdrop="static" aria-labelledby="tambahLemburLabel">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="tambahLemburLabel">Tambah Rekap Lembur</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body ui-front">
                            <form action="<?= base_url() . 'hrd/act_tambah_lembur'; ?>" method="POST">
                                <div class="form-group">
                                    <label for="namaKaryawan">Nama Karyawan</label>
                                    <input type="text" class="form-control" id="namaKaryawan" name="namaKaryawan">
                                </div>
                                <div class="form-group">
                                    <label for="tglLembur">Tanggal Lembur</label>
                                    <input type="date" class="form-control" id="tglLembur" name="tglLembur">
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="poinLembur">Poin Lembur</label>
                                            <input type="number" pattern="[0-9]+([\.,][0-9]+)?" step="1" class="form-control" id="poinLembur" name="poinLembur" oninput="totalCPP();">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="costPerPoin">Cost Per Poin (Rp)</label>
                                            <input type="number" class="form-control" id="costPerPoin" name="costPerPoin" oninput="totalCPP();">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <small class="col-sm-10">
                                        Total Cost = <b><i> Rp. <input type="number" style="border: 0;" id="totalCost" name="totalCost" readonly> </i></b>
                                    </small>
                                </div>
                                <div class="form-group">
                                    <label for="tglLembur">Kepentingan lembur</label>
                                    <textarea name="kepentingan" class="form-control" id="kepentingan" rows="3" placeholder="Tulis kepentingan karyawan saat lembur disini"></textarea>
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
            <h3>Rekapitulasi Lembur Periode <?= date('F Y'); ?></h3>
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
                                <th>Total Poin Lembur</th>
                                <th>Total Cost Lembur</th>
                                <th>Periode</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($lembur as $l) : ?>
                                <tr>
                                    <td>
                                        <?php if ($l['foto'] == "-" || "") {
                                            $foto = base_url() . 'assets/img/undraw_profile.svg';
                                        } else {
                                            $foto = base_url() . 'assets/img/karyawan/' . $l['foto'];
                                        } ?>
                                        <img src="<?= $foto; ?>" style="width: 64px;">
                                    </td>
                                    <td><?= ucwords($l['nama']); ?> <br> <small><b><?= ucwords($l['jabatan']) . " - " . ucwords($l['posisi']); ?></b></small></td>
                                    <td><?= $l['SUM(PoinLembur)']; ?></td>
                                    <?php //$TotalCost = intval($l['SUM(PoinLembur)']) * intval($l['CostPerPoinLembur']); ?>
                                    <?php $TotalCost = intval($l['SUM(TotalCostLembur)']); ?>
                                    <td>Rp. <?= number_format($TotalCost, 2, ',', '.'); ?></td>
                                    <td><?= date('F Y', strtotime($l['TglLembur'])); ?></td>
                                    <td>
                                        <a class="btn btn-warning btn-sm" href="<?= base_url() . 'hrd/detail_lembur/' . $l['id_user']; ?>"><b>Details</b></a>
                                    </td>
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
            <a href="<?= base_url() . 'hrd/performance'; ?>" class="btn btn-success btn-sm">Lanjut ke Data Performance</a>
        </div>
    </div>

</div>
<!-- End of Main Content -->