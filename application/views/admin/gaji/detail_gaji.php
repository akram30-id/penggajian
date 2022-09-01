<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row mt-5">
        <div class="col-sm-6">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url() . 'ManagerAdministrasi'; ?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url() . 'ManagerAdministrasi/data_gaji'; ?>">Rekap Gaji</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail Gaji <?= $gaji[0]['nama']; ?></li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="d-sm-flex align-items-center justify-content-between mt-2">
        <h1>Rekapitulasi Gaji <?= $gaji[0]['nama']; ?></h1>
        <?php if ($gaji[0]['ManagerSignature'] != '-') { ?>
            <button class="btn btn-sm btn-warning" onclick="printSlipGaji('slipGaji')"><i class="fas fa-print"></i> Cetak Slip Gaji</button>
        <?php } else {
            echo "";
        } ?>
    </div>
    <div class="row justify-content-center mt-3 mb-2">
        <div class="col-4">
            <?= $this->session->flashdata('pesan'); ?>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-sm-10 my-2">
            <div class="card" id="slipGaji">
                <div class="card-body">
                    <div class="row justify-content-center mt-5">
                        <div class="col-sm-6">
                            <div class="row justify-content-center">
                                <img src="<?= base_url() . 'assets/img/favicon.png'; ?>" style="width: 20%;">
                                <h3 class="text-center text-dark mt-5 ml-3"><b>Sistem Penggajian</b></h3>
                            </div>
                            <hr style="height:3px;border:none;color:#333;background-color:#333;">
                            <p class="text-center" style="margin-top: -12px;"><b>Dibuat oleh Kelompok 5 Kelas 17.6D.11</b></p>
                            <h5 class="text-center" style="margin-top: -16px;">Universitas Bina Sarana Informatika Jatiwaringin</h5>
                        </div>
                    </div>

                    <div class="row justify-content-start mt-5">
                        <div class="col-3">
                            <p><b>NIK</b></p>
                        </div>
                        <div class="col-6"><?= $gaji[0]['nik']; ?></div>
                    </div>
                    <div class="row justify-content-start">
                        <div class="col-3">
                            <p><b>Nama</b></p>
                        </div>
                        <div class="col-6"><?= $gaji[0]['nama']; ?></div>
                    </div>
                    <div class="row justify-content-start">
                        <div class="col-3">
                            <p><b>Jabatan</b></p>
                        </div>
                        <div class="col-6"><?= $gaji[0]['jabatan']; ?> - <?= $gaji[0]['posisi']; ?></div>
                    </div>

                    <div class="row justify-content-center my-3">
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h5><b>Penghasilan</b></h5>
                                    <hr style="margin-top: -8px;">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <p><b>Gaji Pokok</b></p>
                                </div>
                                <div class="col-7">Rp. <?= number_format($gaji[0]['GajiPokok'], 2, ',', '.'); ?></div>
                            </div>
                            <?php if ($thr != NULL) {
                                $qtyTHR = $thr[0]['QtyTHR'];
                            ?>
                                <div class="row">
                                    <div class="col-5">
                                        <p><b>THR</b></p>
                                    </div>
                                    <div class="col-7">Rp. <?= number_format($thr[0]['QtyTHR'], 2, ',', '.'); ?></div>
                                </div>
                            <?php } else {
                                $qtyTHR = 0;
                            } ?>
                            <div class="row">
                                <div class="col-5">
                                    <p><b>Bonus Lembur</b></p>
                                </div>
                                <div class="col-7">Rp. <?= number_format($lembur[0]['SUM(TotalCostLembur)'], 2, ',', '.'); ?></div>
                            </div>
                            <div class="row">
                                <div class="col-5">
                                    <p><b>Bonus Performance</b></p>
                                </div>
                                <div class="col-7">Rp. <?= number_format($perform[0]['QtyBonusPerform'], 2, ',', '.'); ?></div>
                            </div>
                            <p class="text-dark text-right" style="margin-top: -32px;"><b>+</b></p>
                            <hr style="height:1px;border:none;color:#333;background-color:#333;">
                            <div class="row">
                                <div class="col-5">
                                    <p><i><b>Total Gaji</b></i></p>
                                </div>
                                <div class="col-6">
                                    <?php $totalGaji = intval($gaji[0]['GajiPokok']) + intval($lembur[0]['SUM(TotalCostLembur)']) + intval($perform[0]['QtyBonusPerform'] + intval($qtyTHR)); ?>
                                    <p>Rp. <?= number_format($totalGaji, 2, ',', '.'); ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="row mt-5">
                                <div class="col-sm-12">
                                    <h5><b>Potongan</b></h5>
                                    <hr style="margin-top: -8px;">
                                </div>
                            </div>
                            <?php
                            $gross = $totalGaji * 12;
                            $biayaJabatan = $totalGaji * 0.05;
                            if ($biayaJabatan > 500000) {
                                $biayaJabatan = 500000;
                            } else {
                                $biayaJabatan = $biayaJabatan;
                            }
                            $ptngJabatan = $biayaJabatan * 12;
                            $nett = $gross - $ptngJabatan - $PTKP;
                            // $pph21 = $nett * 0.05;
                            // if ($nett > 50000000 && $nett <= 250000000) {
                            //     $remain = $nett - 50000000;
                            //     $tax2 = $remain * 0.15;
                            //     $taxYear = $pph21 + $tax2;
                            //     $pph21 = $taxYear / 12;
                            // } else if ($nett > 250000000 && $nett <= 500000000) {
                            //     $remain = $nett - 250000000;
                            //     $tax2 = $remain * 0.25;
                            //     $taxYear = $pph21 + $tax2;
                            //     $pph21 = $taxYear / 12;
                            // } else if ($nett > 500000000) {
                            //     $remain = $nett - 500000000;
                            //     $tax2 = $remain * 0.3;
                            //     $taxYear = $pph21 + $tax2;
                            //     $pph21 = $taxYear / 12;
                            // }
                            switch ($nett) {

                                case $nett > 50000000 && $nett <= 250000000:
                                    $remain = $nett - 50000000;
                                    $tax1 = 50000000 * 0.05;
                                    $tax2 = $remain * 0.15;
                                    $pph21 = abs($tax2 - $tax1) / 12;
                                    break;

                                case $nett > 250000000 && $nett <= 500000000:
                                    $remain1 = $nett - 50000000;
                                    $remain2 = $remain1 - 250000000;
                                    $tax1 = 50000000 * 0.05;
                                    $tax2 = $remain1 * 0.15;
                                    $tax3 = $remain2 * 0.25;
                                    $pph21 = abs($tax1 - $tax2 - $tax3) / 12;
                                    break;

                                case $nett > 500000000:
                                    $remain1 = $nett - 50000000;
                                    $remain2 = $remain1 - 250000000;
                                    $remain3 = $remain2 - 500000000;
                                    $tax1 = 50000000 * 0.05;
                                    $tax2 = $remain1 * 0.15;
                                    $tax3 = $remain2 * 0.25;
                                    $tax4 = $remain3 * 0.30;
                                    $pph21 = abs($tax1 - $tax2 - $tax3 - $tax4) / 12;
                                    break;

                                default:
                                    $pph21 = ($nett * 0.05) / 12;
                                    break;
                            }

                            if ($pph21 < 0) {
                                $pph21fix = 0;
                            } else {
                                $pph21fix = $pph21;
                            }
                            ?>
                            <div class="row">
                                <div class="col-6">
                                    <p><b>PPh 21</b></p>
                                </div>
                                <div class="col-6">Rp. <?= number_format($pph21fix, 2, ',', '.'); ?></div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <p><b>Potong Absen</b></p>
                                </div>
                                <div class="col-6">Rp. <?= number_format($potongAbsen, 2, ',', '.'); ?></div>
                            </div>
                            <p class="text-dark text-right" style="margin-top: -32px;"><b>+</b></p>
                            <hr style="height:1px;border:none;color:#333;background-color:#333;">
                            <?php $totalPotongan = $pph21fix + $potongAbsen; ?>
                            <div class="row">
                                <div class="col-6">
                                    <p><i><b>Total Potongan</b></i></p>
                                </div>
                                <div class="col-4">
                                    <p>Rp. <?= number_format($totalPotongan, 2, ',', '.'); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center mt-3">
                        <div class="col-10">
                            <table class="table table-responsive">
                                <tr>
                                    <th>
                                        <h5><b>Gaji Bersih (Total Gaji - Total Potongan)</b></h5>
                                    </th>
                                    <th> = </th>
                                    <th>
                                        <h5><b>Rp. <?= number_format(($totalGaji - $totalPotongan), 2, ',', '.'); ?></b></h5>
                                    </th>
                                </tr>
                                <tr></tr>
                            </table>
                        </div>
                    </div>
                    <div class="row justify-content-end mt-5">
                        <div class="col-sm-4">
                            <p><b>Bekasi, <?= date('d F Y', strtotime($gaji[0]['PeriodeApproval'])); ?></b></p>
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="col-sm-4">
                            <p><b>Manager Administrasi,</b></p>
                        </div>
                    </div>
                    <div class="row justify-content-end mt-3 mb-2">
                        <div class="col-sm-4">
                            <?php if ($gaji[0]['ManagerSignature'] == "-") {
                                $signation = "<a>Butuh Approval Anda</a>";
                            } else {
                                $signation = "<img src='" . base_url() . "assets/img/signature/manager.png' style='width: 146px;'></img>";
                            } ?>
                            <h5 class="text-danger"><?= $signation; ?></h5>
                        </div>
                    </div>
                    <div class="row justify-content-end mb-5">
                        <div class="col-sm-4">
                            <p><b>Khofifah Indar Parawansa, S.Kom.</b></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- End of Main Content -->