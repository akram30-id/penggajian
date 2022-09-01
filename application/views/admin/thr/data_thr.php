<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="container-lg">
        <div class="d-flex align-items-center justify-content-between my-5">
            <h3>Rekapitulasi THR Periode <?= date('Y'); ?></h3>
            <a href="<?= base_url() . 'ManagerAdministrasi/synchronize'; ?>" class="btn btn-sm btn-primary"><i class="fas fa-sync"></i> Sychronize</a>
        </div>
    </div>
    <div class="row justify-content-center mt-3 mb-2">
        <div class="col-sm-4 text-center">
            <?= $this->session->flashdata('pesan'); ?>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-sm-8 my-2">
            <div class="card">
                <div class="card-body">
                    <table id="table_karyawan" class="table table-responsive">
                        <thead>
                            <tr>
                                <th>###</th>
                                <th>Nama</th>
                                <th>Tunjangan Hari Raya</th>
                                <th>Periode THR</th>
                                <th>Status Approval</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($thr as $t) : ?>
                                <tr>
                                    <td><?php if ($t['foto'] == "-" || "") {
                                            $foto = base_url() . 'assets/img/undraw_profile.svg';
                                        } else {
                                            $foto = base_url() . 'assets/img/karyawan/' . $t['foto'];
                                        } ?>
                                        <img src="<?= $foto; ?>" style="width: 64px;">
                                    </td>
                                    <td><?= ucwords($t['nama']); ?> <br> <small><b><?= ucwords($t['jabatan']) . " - " . ucwords($t['posisi']); ?></b></small></td>
                                    <td>Rp. <?= number_format($t['QtyTHR'], 2, ',', '.'); ?></td>
                                    <?php
                                    if ($t['PeriodeTHR'] == "0000-00-00") {
                                        $periodeTHR = "Not Set";
                                    } else {
                                        $periodeTHR = date('d F Y', strtotime($t['PeriodeTHR']));
                                    }
                                    ?>
                                    <td><?= $periodeTHR; ?></td>
                                    <?php if ($t['StatusApprovalTHR'] == 'Need to Approve') {
                                        $ManagerSignation = "<a data-toggle='modal' data-target='#ManagerSignation" . $t['idTHR'] . "' class='text-danger'>" . $t['StatusApprovalTHR'] . "</a>";
                                    } else if ($t['StatusApprovalTHR'] == 'Approved') {
                                        $ManagerSignation = "<p class='text-success'>" . $t['StatusApprovalTHR'] . "</p>";
                                    } ?>
                                    <td><?= $ManagerSignation; ?></td>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="ManagerSignation<?= $t['idTHR'] ?>" aria-labelledby="ManagerSignationLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <h5 class="modal-title" id="ManagerSignationLabel">Approve THR <?= $t['nama']; ?> ?</h5>
                                                <form action="<?= base_url() . 'ManagerAdministrasi/updateApprovalTHR/' . $t['idTHR']; ?>" method="POST">
                                                    <div class="form-group row mt-3 justify-content-center">
                                                        <div class="col-sm-6">
                                                            <label for="tglApproval" class="col-form-label">Tanggal Approval</label>
                                                            <input type="date" class="form-control" id="tglApproval" name="tglApproval">
                                                        </div>
                                                    </div>
                                                    <div class="row justify-content-end mt-5">
                                                        <button type="button" class="btn btn-secondary mr-3" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-primary mr-3"> Approve</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal Cancel Approval -->
                                <div class="modal fade" id="cancelApprove<?= $t['idTHR'] ?>" aria-labelledby="cancelApprove" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <h5 class="modal-title" id="cancelApprove">Cancel Aproval Gaji <?= $t['nama']; ?> ?</h5>
                                                <div class="row justify-content-end mt-5">
                                                    <button type="button" class="btn btn-secondary mr-3" data-dismiss="modal">No</button>
                                                    <button type="button" class="btn btn-primary mr-3"><a class="text-white" href="<?= base_url() . 'hrd/cancelApproveHRD/' . $t['idTHR']; ?>">Yes</a></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- End of Main Content -->