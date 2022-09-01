<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row justify-content-between mt-5">
        <div class="col-sm-6">
            <h3>Rekapitulasi Gaji Periode <?= date('F Y'); ?></h3>
        </div>

        <div class="col-sm-2">
            <a href="<?= base_url() . 'ManagerAdministrasi/synchronize_gaji'; ?>" class="btn btn-primary btn-sm"><i class="fas fa-sync"></i> Synchronize</a>
        </div>
    </div>
    <div class="row justify-content-center mt-3 mb-2">
        <div class="col-sm-4 text-center">
            <?= $this->session->flashdata('pesan'); ?>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-sm-12 my-2">
            <div class="card">
                <div class="card-body">
                    <table id="table_karyawan" class="table table-responsive" style="width:90%">
                        <thead>
                            <tr>
                                <th>###</th>
                                <th>Nama</th>
                                <th>Gaji Pokok</th>
                                <th>Periode Approval</th>
                                <th>Status Approval</th>
                                <th>Manager Signature</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($gaji as $g) : ?>
                                <tr>
                                    <td><?php if ($g['foto'] == "-" || "") {
                                            $foto = base_url() . 'assets/img/undraw_profile.svg';
                                        } else {
                                            $foto = base_url() . 'assets/img/karyawan/' . $g['foto'];
                                        } ?>
                                        <img src="<?= $foto; ?>" style="width: 64px;">
                                    </td>
                                    <td><?= ucwords($g['nama']); ?> <br> <small><b><?= ucwords($g['jabatan']) . " - " . ucwords($g['posisi']); ?></b></small></td>
                                    <td>Rp. <?= number_format($g['GajiPokok'], 2, ',', '.'); ?></td>
                                    <td><?= date('d F Y', strtotime($g['PeriodeApproval'])); ?></td>
                                    <?php if ($g['StatusApproval'] == 'Butuh Approval Manager') {
                                        $ManagerSignation = "<p class='text-danger'>" . $g['StatusApproval'] . "</a>";
                                    } else if ($g['StatusApproval'] == 'Approved') {
                                        $ManagerSignation = "<p class='text-success'>" . $g['StatusApproval'] . "</p>";
                                    } ?>
                                    <td><?= $ManagerSignation; ?></td>
                                    <?php if ($g['ManagerSignature'] == "-") {
                                        $Managersignation = "<button class='btn btn-sm btn-primary' data-toggle='modal' data-target='#ManagerSignation" . $g['idGaji'] ."'>Approve</button>";
                                    } else {
                                        $Managersignation = "<img src='" . base_url() . "assets/img/signature/manager.png' style='width: 64px;'></img>";
                                    } ?>
                                    <td><?= $Managersignation; ?></td>
                                    <td><a href="<?= base_url() . 'ManagerAdministrasi/detail_gaji/' . $g['id_user']; ?>" class="btn btn-warning btn-sm">Detail</a></td>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="ManagerSignation<?= $g['idGaji'] ?>" aria-labelledby="ManagerSignationLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <h5 class="modal-title" id="ManagerSignationLabel">Approve Gaji <?= $g['nama']; ?> ?</h5>
                                                <div class="row justify-content-end mt-5">
                                                    <button type="button" class="btn btn-secondary mr-3" data-dismiss="modal">Cancel</button>
                                                    <button type="button" class="btn btn-primary mr-3"><a class="text-white" href="<?= base_url() . 'ManagerAdministrasi/approveManager/' . $g['idGaji']; ?>">Approve</a></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal Cancel Approval -->
                                <div class="modal fade" id="cancelApprove<?= $g['idGaji'] ?>" aria-labelledby="cancelApprove" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <h5 class="modal-title" id="cancelApprove">Cancel Aproval Gaji <?= $g['nama']; ?> ?</h5>
                                                <div class="row justify-content-end mt-5">
                                                    <button type="button" class="btn btn-secondary mr-3" data-dismiss="modal">No</button>
                                                    <button type="button" class="btn btn-primary mr-3"><a class="text-white" href="<?= base_url() . 'hrd/cancelApproveHRD/' . $g['idGaji']; ?>">Yes</a></button>
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