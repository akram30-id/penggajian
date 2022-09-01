<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url() . 'hrd'; ?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url() . 'hrd/data_lembur'; ?>">Rekap Lembur</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail Lembur</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="row my-3">
        <div class="col-sm-6">
            <h3><b>Detail Lembur <?= $detailLembur[0]['nama']; ?></b> <br>Periode <?= date('F Y'); ?></h3>
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
                                <th>Tgl. Lembur</th>
                                <th>Poin Lembur</th>
                                <th>Cost Lembur</th>
                                <th>Kepentingan Lembur</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($detailLembur as $dl) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= date('d F Y', strtotime($dl['TglLembur'])); ?></td>
                                    <td><?= $dl['PoinLembur']; ?></td>
                                    <td>Rp. <?= number_format($dl['CostPerPoinLembur'], 2, ',', '.'); ?></td>
                                    <td><?= $dl['KepentinganLembur']; ?></td>
                                    <td>
                                        <a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModalLembur<?= $dl['idLembur'] ?>"><b>Edit</b></a>
                                        <a class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteLembur<?= $dl['idLembur'] ?>"> <i class="fas fa-trash"></i></a>
                                    </td>

                                    <!-- Modal -->
                                    <div class="modal fade" id="deleteAbsen<?= $dl['idLembur'] ?>" tabindex="-1" aria-labelledby="deleteAnakLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <h5 class="modal-title mb-5" id="deleteAnakLabel">Apakah Anda Yakin?<br>Data <?= ucwords($dl['nama']); ?> Akan Dihapus</h5>
                                                    <div class="row justify-content-end">
                                                        <button type="button" class="btn btn-secondary mr-3" data-dismiss="modal">Tidak</button>
                                                        <a href="<?= base_url() . 'hrd/delete_absensi/' . $dl['idLembur']; ?>" class="btn btn-danger mr-3">Hapus</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal Edit -->
                                    <div class="modal fade" id="editModalLembur<?= $dl['idLembur'] ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="editModalLemburLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLemburLabel">Edit <?= $detailLembur[0]['nama']; ?></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="<?= base_url() . 'hrd/act_edit_lembur'; ?>" method="POST">
                                                        <div class="form-group">
                                                            <label for="namaKaryawan">Nama Karyawan</label>
                                                            <input type="text" class="form-control" id="namaKaryawan" name="namaKaryawan" value="<?= $dl['nama']; ?>" readonly>
                                                            <input type="hidden" name="idLembur" value="<?= $dl['idLembur']; ?>">
                                                            <input type="hidden" name="idUser" value="<?= $dl['id']; ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="tglLembur">Tanggal Lembur</label>
                                                            <input type="text" class="form-control" id="tglLembur" name="tglLembur" value="<?= $dl['TglLembur']; ?>" readonly>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="poinLembur">Poin Lembur</label>
                                                                    <input type="number" pattern="[0-9]+([\.,][0-9]+)?" step="1" class="form-control" id="poinLembur" name="poinLembur" value="<?= $dl['PoinLembur']; ?>" oninput="totalCPP();">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="costPerPoin">Cost Per Poin (Rp)</label>
                                                                    <input type="number" class="form-control" id="costPerPoin" name="costPerPoin" oninput="totalCPP();" value="<?= $dl['CostPerPoinLembur']; ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <small class="col-sm-10">
                                                                Total Cost = <b><i> Rp. <input type="number" style="border: 0;" id="totalCost" name="totalCost" readonly value="<?= $dl['TotalCostLembur']; ?>"> </i></b>
                                                            </small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="tglLembur">Kepentingan lembur</label>
                                                            <textarea name="kepentingan" class="form-control" id="kepentingan" rows="3" placeholder="Tulis kepentingan karyawan saat lembur disini"><?= $dl['KepentinganLembur']; ?></textarea>
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
                        <tfoot>
                            <tr>
                                <th><i>Total</i></th>
                                <th></th>
                                <th><i><?= $totalCostPeriode[0]['SUM(PoinLembur)']; ?></i></th>
                                <th><i>Rp. <?= number_format($totalCostPeriode[0]['SUM(TotalCostLembur)'], 2, ',', '.'); ?></i></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </tfoot>
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