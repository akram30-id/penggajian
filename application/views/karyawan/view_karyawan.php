<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-4">
            <a href="<?= base_url() . 'hrd/tambah_karyawan'; ?>" class="btn btn-primary">Tambah Data</a>
        </div>
    </div>
    <?= $this->session->flashdata('pesan'); ?>
    <div class="row justify-content-center mt-5">
        <div class="col-sm-12 my-2">
            <div class="card">
                <div class="card-body">
                    <table id="table_karyawan" class="display nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>Departemen</th>
                                <th>###</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($karyawan as $k) : ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= $k->nik; ?></td>
                                    <td><?= ucwords($k->nama); ?></td>
                                    <td><?= ucwords($k->jabatan); ?></td>
                                    <td><?= ucwords($k->posisi); ?></td>
                                    <td><a href="<?= base_url() . 'hrd/detail_karyawan/' . $k->nik; ?>" class="btn btn-warning btn-sm">Detail</a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- End of Main Content -->