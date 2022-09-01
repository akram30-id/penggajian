<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-5 mt-5">
        <h1 class="h3 mb-0 text-gray-800"><b>Rekapitulasi Gaji Periode <?= date('F Y'); ?></b></h1>
        <a href="<?= base_url() . 'hrd/synchronize'; ?>" class="btn btn-sm btn-primary"><i class="fas fa-sync"></i> Sychronize</a>
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
                                    <?php if ($g['HrdSignature'] == "-") {
                                        $HRDsignation = "<a data-toggle='modal' data-target='#approve" . $g['idGaji'] . "' class='text-danger'>" . $g['StatusApproval'] . "</a>";
                                    } else if ($g['StatusApproval'] == 'Butuh Approval Manager') {
                                        $HRDsignation = "<a data-toggle='modal' data-target='#cancelApprove" . $g['idGaji'] . "' class='text-success'>" . $g['StatusApproval'] . "</a>";
                                    } else if ($g['StatusApproval'] == 'Approved') {
                                        $HRDsignation = "<p class='text-success'>" . $g['StatusApproval'] . "</p>";
                                    } ?>
                                    <td class="text-danger"><?= $HRDsignation; ?></td>
                                    <?php if ($g['ManagerSignature'] == "-") {
                                        $Managersignation = "N/A";
                                    } else {
                                        $Managersignation = "<img src='" . base_url() . "assets/img/signature/manager.png' style='width: 64px;'></img>";
                                    } ?>
                                    <td class="text-danger"><?= $Managersignation; ?></td>
                                    <td><a href="<?= base_url() . 'hrd/detail_gaji/' . $g['id_user']; ?>" class="btn btn-warning btn-sm">Detail</a></td>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="approve<?= $g['idGaji'] ?>" aria-labelledby="approveLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <h5 class="modal-title" id="approveLabel">Approve Gaji <?= $g['nama']; ?> ?</h5>
                                                <div class="row justify-content-end mt-5">
                                                    <button type="button" class="btn btn-secondary mr-3" data-dismiss="modal">Cancel</button>
                                                    <button type="button" class="btn btn-primary mr-3"><a class="text-white" href="<?= base_url() . 'hrd/approveHRD/' . $g['idGaji']; ?>">Approve</a></button>
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