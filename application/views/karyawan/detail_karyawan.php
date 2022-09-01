<div class="container">
    <div class="row">
        <a href="<?= base_url() . 'hrd/data_karyawan'; ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back to Datasets</a>
    </div>
    <?= $this->session->flashdata('pesan'); ?>
    <div class="row justify-content-center mt-5">
        <div class="col-sm-10">
            <div class="card mb-3">
                <?php foreach ($detail as $d) : ?>
                    <div class="row">
                        <div class="col-sm-3 p-5 mt-5">
                            <?php if ($d->foto == "-" || "") {
                                $foto = base_url() . 'assets/img/undraw_profile.svg';
                            } else {
                                $foto = base_url() . 'assets/img/karyawan/' . $d->foto;
                            } ?>
                            <img src="<?= $foto; ?>" style="width: 156px;">
                        </div>
                        <div class="col-sm-8">
                            <div class="card-body">
                                <h5 class="card-title"><b><?= ucwords($d->nama); ?></b></h5>
                                <table class="table table-borderless table-sm">
                                    <tr>
                                        <td>
                                            <p class="card-text">Jenis Kelamin</p>
                                        </td>
                                        <td>
                                            <p class="card-text"><?= $d->jenis_kelamin; ?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="card-text">NIK</p>
                                        </td>
                                        <td>
                                            <p class="card-text"><?= $d->nik; ?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="card-text">No. Telepon</p>
                                        </td>
                                        <td>
                                            <p class="card-text"><?= $d->no_telepon; ?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="card-text">No. Rekening</p>
                                        </td>
                                        <td>
                                            <p class="card-text"><?= $d->no_rekening; ?> (<?= $d->nama_bank; ?>)</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="card-text">Tanggal Lahir</p>
                                        </td>
                                        <td>
                                            <p class="card-text"><?= date('d F Y', strtotime($d->tgl_lahir)); ?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="card-text">Alamat Email</p>
                                        </td>
                                        <td>
                                            <a href="mailto:<?= $d->email; ?>" class="card-text"><?= $d->email; ?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="card-text">Tanggal Lahir</p>
                                        </td>
                                        <td>
                                            <p class="card-text"><?= date('d F Y', strtotime($d->tgl_lahir)); ?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="card-text">Alamat</p>
                                        </td>
                                        <td>
                                            <p class="card-text"><?= $d->alamat; ?></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p class="card-text">No. NPWP</p>
                                        </td>
                                        <td>
                                            <p class="card-text"><?= $d->npwp; ?></p>
                                        </td>
                                    </tr>
                                </table>
                                <p class="card-text"><i>Work as</i> <br> <b><?= ucwords($d->jabatan); ?> <?= ucwords($d->posisi); ?></b></p>
                                <p class="card-text"><small class="text-muted">Registered since <?= date('d F Y', strtotime($d->tgl_masuk)); ?></small></p>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#staticBackdrop">
                                            Edit
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Edit <?= ucwords($d->nama); ?></h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="form-group" action="<?= base_url() . 'hrd/act_edit_karyawan'; ?>" method="POST">
                                                            <div class="mb-3">
                                                                <label for="nik" class="form-label">NIK</label>
                                                                <input type="number" name="nik" class="form-control" name="nik" id="nik" value="<?= $d->nik; ?>">
                                                                <input type="hidden" name="id" value="<?= $d->id; ?>">
                                                                <div class="form-text"><?= form_error('nik'); ?></div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="nama" class="form-label">Nama Lengkap</label>
                                                                <input type="text" name="nama" class="form-control" id="nama" value="<?= ucwords($d->nama); ?>">
                                                                <div class="form-text"><?= form_error('nama'); ?></div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-4">
                                                                    <div class="mb-3">
                                                                        <label for="jenis_kelamin">Jenis Kelamin</label>
                                                                        <select class="custom-select" name="jenis_kelamin" id="jenis_kelamin">
                                                                            <?php $jk = array("Pria", "Wanita"); ?>
                                                                            <?php foreach ($jk as $j) : ?>
                                                                                <option <?php if ($j == $d->jenis_kelamin) {
                                                                                            echo "selected='selected'";
                                                                                        } ?> value="<?= $j; ?>"><?= $j; ?></option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mb-4">
                                                                <label for="no_telepon" class="form-label">Nomor Telepon</label>
                                                                <input type="number" name="no_telepon" class="form-control" id="no_telepon" value="<?= $d->no_telepon; ?>">
                                                                <div class="form-text"><?= form_error('no_telepon'); ?></div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-8">
                                                                    <div class="mb-4">
                                                                        <label for="norek" class="form-label">Nomor Rekening</label>
                                                                        <input type="number" name="norek" class="form-control" id="norek" value="<?= $d->no_rekening; ?>">
                                                                        <div class="form-text"><?= form_error('norek'); ?></div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-4">
                                                                    <div class="mb-4">
                                                                        <label for="nama_bank" class="form-label">Nama Bank</label>
                                                                        <input type="text" name="nama_bank" class="form-control" id="nama_bank" value="<?= $d->nama_bank; ?>">
                                                                        <div class="form-text"><?= form_error('nama_bank'); ?></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-2">
                                                                <div class="col-sm-5">
                                                                    <div class="form-group">
                                                                        <label for="tgl_lahir">Tanggal Lahir</label>
                                                                        <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir" value="<?= $d->tgl_lahir; ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mb-4">
                                                                <label for="email" class="form-label">Alamat Email</label>
                                                                <input type="email" name="email" class="form-control" id="email" value="<?= $d->email; ?>">
                                                                <div class="form-text"><?= form_error('email'); ?></div>
                                                            </div>
                                                            <div class="mb-4">
                                                                <label for="alamat" class="form-label">Alamat Rumah</label>
                                                                <textarea class="form-control" id="alamat" rows="5" name="alamat"><?= $d->alamat; ?></textarea>
                                                                <div class="form-text"><?= form_error('alamat'); ?></div>
                                                            </div>
                                                            <div class="mb-4">
                                                                <label for="npwp" class="form-label">No. NPWP</label>
                                                                <input type="text" name="npwp" class="form-control" id="npwp" value="<?= $d->npwp; ?>">
                                                                <div class="form-text"><?= form_error('npwp'); ?></div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-6 mb-4">
                                                                    <label for="jabatan">Jabatan</label>
                                                                    <select class="custom-select" name="jabatan" id="jabatan">
                                                                        <?php $jbt = array('PKL', 'Magang', 'operator', 'Staff', 'Manager'); ?>
                                                                        <?php foreach ($jbt as $j) : ?>
                                                                            <option <?php if ($j == $d->jabatan) {
                                                                                        echo "selected = 'selected'";
                                                                                    } ?> value="<?= ucwords($j); ?>"><?= ucwords($j); ?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                </div>
                                                                <div class="col-sm-6 mb-4">
                                                                    <label for="departemen">Departemen</label>
                                                                    <select class="custom-select" name="departemen" id="departemen">
                                                                        <?php foreach ($departemen as $n) : ?>
                                                                            <option <?php if ($n->nama_departemen == ucwords($d->posisi)) {
                                                                                        echo "selected = 'selected'";
                                                                                    } ?> value="<?= $n->nama_departemen; ?>"><?= $n->nama_departemen; ?></option>
                                                                        <?php endforeach; ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-2">
                                                                <div class="col-sm-5">
                                                                    <div class="form-group">
                                                                        <label for="tgl_masuk">Tanggal Masuk Kerja</label>
                                                                        <input type="date" class="form-control" name="tgl_masuk" id="tgl_masuk" value="<?= $d->tgl_masuk; ?>">
                                                                        <input type="hidden" name="file" value="<?= $d->foto; ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mb-4">
                                                                <label for="status">Status</label>
                                                                <select class="custom-select" name="status" id="status">
                                                                    <?php $status = array('working', 'phk', 'fired', 'resign', 'overcontract'); ?>
                                                                    <?php foreach ($status as $s) : ?>
                                                                        <option <?php if ($s == $d->status) {
                                                                                    echo "selected = 'selected'";
                                                                                } ?> value="<?= $s; ?>"><?= strtoupper($s); ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                            </div>
                                                            <input type="submit" class="btn btn-primary btn-block" value="Edit Data">
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <a href="<?= base_url() . 'hrd/delete_karyawan/' . $d->id; ?>" onclick="confirm('Are you sure want to delete <?= $d->nama; ?> ?')" type="button" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-sm-12">
            <div class="accordion" id="accordionExample">
                <div class="card">
                    <?php foreach ($detail as $d) : ?>
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                                <?php
                                $title;
                                if ($d->jenis_kelamin == "Pria") {
                                    $title = "Data Istri";
                                } else if ($d->jenis_kelamin == "Wanita") {
                                    $title = "Data Suami";
                                }
                                ?>
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <?= $title; ?>
                                </button>
                            </h2>
                        </div>

                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body my-3">
                                <div class="container">
                                    <div class="row mb-5">
                                        <!-- Button trigger modal -->

                                        <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambahDataIstri">
                                            Tambah Data
                                        </a>
                                        <!-- Modal -->
                                        <div class="modal fade" id="tambahDataIstri" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="tambahDataIstriLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="tambahDataIstriLabel">Tambah Data</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <?php
                                                    $label;
                                                    if ($d->jenis_kelamin == "Pria") {
                                                        $label = "Istri";
                                                    } else if ($d->jenis_kelamin == "Wanita") {
                                                        $label = "Suami";
                                                    }
                                                    ?>
                                                    <div class="modal-body">
                                                        <form action="<?= base_url() . 'hrd/act_tambah_istri/' . $d->id . '/' . $d->nik; ?>" method="POST">
                                                            <div class="form-group">
                                                                <label for="nama">Nama <?= $label; ?></label>
                                                                <input type="text" class="form-control" id="nama" name="nama">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="nik">NIK <?= $label; ?> Berdasarkan KTP</label>
                                                                <input type="number" class="form-control" id="nik" name="nik">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="notelp">No. Telepon</label>
                                                                <input type="number" class="form-control" id="notelp" name="notelp">
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-7">
                                                                    <div class="form-group">
                                                                        <label for="tempat_lahir">Tempat Lahir</label>
                                                                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <div class="form-group">
                                                                        <label for="tgl_lahir">Tgl. Lahir</label>
                                                                        <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="pendidikan">Pendidikan <?= $label; ?></label>
                                                                <select name="pendidikan" class="custom-select" id="pendidikan">
                                                                    <option value="">-Pilih Pendidikan-</option>
                                                                    <option value="SD">SD</option>
                                                                    <option value="SMP">SMP / Sederajat</option>
                                                                    <option value="SMA">SMA / Sederajat</option>
                                                                    <option value="S1">S1</option>
                                                                    <option value="S2">S2</option>
                                                                    <option value="S3">S3</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="pekerjaan">Pekerjaan <?= $label; ?></label>
                                                                <input type="text" class="form-control" id="pekerjaan" name="pekerjaan">
                                                                <input type="hidden" class="form-control" id="hubungan" name="hubungan" value="<?= $label; ?>">
                                                            </div>
                                                            <button type="submit" class="btn btn-primary btn-block mt-5 mb-2">Submit</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <table id="tableIstri" class="display" style="width: 85%;">
                                    <thead>
                                        <th>Nama</th>
                                        <th>NIK</th>
                                        <th>No. Telepon</th>
                                        <th>Tempat, Tanggal Lahir</th>
                                        <th>Hubungan Keluarga</th>
                                        <th>Pendidikan Terakhir</th>
                                        <th>Profesi</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($detail_istri as $da) : ?>
                                            <tr>
                                                <td><?= $da->NamaSuamiIstri; ?></td>
                                                <td><?= $da->nikSuamiIstri; ?></td>
                                                <td><?= $da->noTelpSuamiIstri; ?></td>
                                                <td><?= $da->TempatLahirSuamiIstri; ?>, <?= date('d F Y', strtotime($da->TglLahirSuamiIstri)); ?></td>
                                                <td><?= $da->HubunganSuamiIstri; ?></td>
                                                <td><?= $da->PendidikanSuamiIstri; ?></td>
                                                <td><?= $da->PekerjaanSuamiIstri; ?></td>
                                                <td>
                                                    <div class="row">
                                                        <!-- Button trigger modal -->
                                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalIstri">
                                                            <i class="fas fa-user-edit"></i>
                                                        </button>
                                                        <!-- Button trigger modal -->
                                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteSuamiIstri">
                                                            <i class="fas fa-trash"></i>
                                                        </button>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="deleteSuamiIstri" tabindex="-1" aria-labelledby="deleteSuamiIstriLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-body">
                                                                        <h5 class="modal-title mb-5" id="deleteSuamiIstriLabel">Apakah Anda Yakin?<br>Data <?= $da->NamaSuamiIstri; ?> Akan Dihapus</h5>
                                                                        <div class="row justify-content-end">
                                                                            <button type="button" class="btn btn-secondary mr-3" data-dismiss="modal">Tidak</button>
                                                                            <a href="<?= base_url() . 'hrd/delete_istri/' . $da->idSuamiIstri . '/' . $d->nik . '/' . $da->HubunganSuamiIstri; ?>" class="btn btn-danger mr-3">Hapus</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="modalIstri" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <?php
                                                                $label;
                                                                if ($d->jenis_kelamin == "Pria") {
                                                                    $label = "Istri";
                                                                } else if ($d->jenis_kelamin == "Wanita") {
                                                                    $label = "Suami";
                                                                }
                                                                ?>
                                                                <div class="modal-body">
                                                                    <form action="<?= base_url() . 'hrd/act_edit_istri/' . $d->id . '/' . $d->nik; ?>" method="POST">
                                                                        <div class="form-group">
                                                                            <label for="nama">Nama <?= $label; ?></label>
                                                                            <input type="text" class="form-control" id="nama" name="nama" value="<?= $da->NamaSuamiIstri; ?>">
                                                                            <input type="hidden" name="idSuamiIstri" value="<?= $da->idSuamiIstri; ?>">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="nik">NIK <?= $label; ?> Berdasarkan KTP</label>
                                                                            <input type="number" class="form-control" id="nik" name="nik" value="<?= $da->nikSuamiIstri; ?>">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="notelp">No. Telepon</label>
                                                                            <input type="number" class="form-control" id="notelp" name="notelp" value="<?= $da->noTelpSuamiIstri; ?>">
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-sm-7">
                                                                                <div class="form-group">
                                                                                    <label for="tempat_lahir">Tempat Lahir</label>
                                                                                    <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" value="<?= $da->TempatLahirSuamiIstri; ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <div class="form-group">
                                                                                    <label for="tgl_lahir">Tgl. Lahir</label>
                                                                                    <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" value="<?= $da->TglLahirSuamiIstri; ?>">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group mb-2">
                                                                            <label for="pendidikan">Pendidikan <?= $label; ?></label>
                                                                            <select name="pendidikan" class="custom-select" id="pendidikan">
                                                                                <?php
                                                                                $pend = array("SD", "SMP", "SMA", "S1", "S2", "S3");
                                                                                foreach ($pend as $p) :
                                                                                ?>
                                                                                    <option <?php if ($p == $da->PendidikanSuamiIstri) {
                                                                                                echo "selected='selected'";
                                                                                            } ?> value="<?= $p; ?>"><?= $p; ?></option>
                                                                                <?php endforeach; ?>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group mt-3 mb-3">
                                                                            <label for="pekerjaan">Pekerjaan <?= $label; ?></label>
                                                                            <input type="text" class="form-control" id="pekerjaan" name="pekerjaan" value="<?= $da->PekerjaanSuamiIstri; ?>">
                                                                            <input type="hidden" class="form-control" id="hubungan" name="hubungan" value="<?= $label; ?>">
                                                                        </div>
                                                                        <button type="submit" class="btn btn-primary btn-block mt-5 mb-2" id="btnEditAnak">Submit</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="card">
                    <?php foreach ($detail as $d) : ?>
                        <div class="card-header" id="headingTwo">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseAnak" aria-expanded="false" aria-controls="collapseTwo">
                                    Data Anak
                                </button>
                            </h2>
                        </div>
                        <div id="collapseAnak" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="container">
                                    <div class="row mb-5">
                                        <!-- Button trigger modal -->

                                        <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#tambahDataAnak">
                                            Tambah Data
                                        </a>
                                        <!-- Modal -->
                                        <div class="modal fade" id="tambahDataAnak" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="tambahDataAnakLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="tambahDataAnakLabel">Tambah Data</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="<?= base_url() . 'hrd/act_tambah_anak/' . $d->id . '/' . $d->nik; ?>" method="POST">
                                                            <div class="form-group">
                                                                <label for="nama">Nama Anak</label>
                                                                <input type="text" class="form-control" id="nama" name="nama">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="nik">Hubungan Keluarga</label>
                                                                <input type="text" class="form-control" id="hubungan" name="hubungan" placeholder="Contoh: Anak Kandung">
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-7">
                                                                    <div class="form-group">
                                                                        <label for="tempat_lahir">Tempat Lahir</label>
                                                                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <div class="form-group">
                                                                        <label for="tgl_lahir">Tgl. Lahir</label>
                                                                        <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="pendidikan">Pendidikan Anak</label>
                                                                <select name="pendidikan" class="custom-select" id="pendidikan">
                                                                    <option value="">-Pilih Pendidikan-</option>
                                                                    <option value="SD">SD</option>
                                                                    <option value="SMP">SMP / Sederajat</option>
                                                                    <option value="SMA">SMA / Sederajat</option>
                                                                    <option value="S1">S1</option>
                                                                    <option value="S2">S2</option>
                                                                    <option value="S3">S3</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="pekerjaan">Pekerjaan Anak</label>
                                                                <input type="text" class="form-control" id="pekerjaan" name="pekerjaan">
                                                            </div>
                                                            <button type="submit" class="btn btn-primary btn-block mt-5 mb-2">Submit</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <table id="tableAnak" class="display">
                                    <thead>
                                        <th>Nama</th>
                                        <th>Tempat, Tgl Lahir</th>
                                        <th>Pendidikan</th>
                                        <th>Profesi</th>
                                        <th>Hubungan Keluarga</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($detail_anak as $dn) : ?>
                                            <tr>
                                                <td><?= $dn->NamaAnak; ?></td>
                                                <td><?= $dn->TempatLahirAnak; ?>, <?= date('d F Y', strtotime($dn->TanggalLahirAnak)); ?></td>
                                                <td><?= $dn->PendidikanAnak; ?></td>
                                                <td><?= $dn->PekerjaanAnak; ?></td>
                                                <td><?= ucwords($dn->HubunganAnak); ?></td>
                                                <td>
                                                    <div class="row">
                                                        <a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalAnak<?= $dn->id_anak ?>">
                                                            <i class="fas fa-user-edit"></i>
                                                        </a>
                                                        <!-- Button trigger modal -->
                                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteAnak">
                                                            <i class="fas fa-trash"></i>
                                                        </button>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="deleteAnak" tabindex="-1" aria-labelledby="deleteAnakLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-body">
                                                                        <h5 class="modal-title mb-5" id="deleteAnakLabel">Apakah Anda Yakin?<br>Data <?= $dn->NamaAnak; ?> Akan Dihapus</h5>
                                                                        <div class="row justify-content-end">
                                                                            <button type="button" class="btn btn-secondary mr-3" data-dismiss="modal">Tidak</button>
                                                                            <a href="<?= base_url() . 'hrd/delete_anak/' . $dn->id_anak . '/' . $d->nik; ?>" class="btn btn-danger mr-3">Hapus</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="modalAnak<?= $dn->id_anak ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="staticBackdropLabel">Edit Data Anak</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="<?= base_url() . 'hrd/act_edit_anak/' . $d->id . '/' . $d->nik; ?>" method="POST">
                                                                            <div class="form-group">
                                                                                <label for="nama">Nama Anak</label>
                                                                                <input type="text" class="form-control" id="NamaAnak" name="nama" value="<?= $dn->NamaAnak; ?>">
                                                                                <input type="hidden" name="id_anak" id="id_anak" value="<?= $dn->id_anak; ?>">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="nik">Hubungan Keluarga</label>
                                                                                <input type="text" class="form-control" id="HubunganAnak" name="hubungan" placeholder="Contoh: Anak Kandung" value="<?= $dn->HubunganAnak; ?>">
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-sm-7">
                                                                                    <div class="form-group">
                                                                                        <label for="tempat_lahir">Tempat Lahir</label>
                                                                                        <input type="text" class="form-control" id="TempatLahirAnak" name="tempat_lahir" value="<?= $dn->TempatLahirAnak; ?>">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-5">
                                                                                    <div class="form-group">
                                                                                        <label for="tgl_lahir">Tgl. Lahir</label>
                                                                                        <input type="date" class="form-control" id="TanggalLahirAnak" name="tgl_lahir" value="<?= $dn->TanggalLahirAnak; ?>">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="pendidikan">Pendidikan Anak</label>
                                                                                <select name="pendidikan" id="pendidikan" class="custom-select">
                                                                                    <?php $pend = array("SD", "SMP", "SMA", "S1", "S2", "S3");
                                                                                    foreach ($pend as $p) :
                                                                                    ?>
                                                                                        <option <?php if ($p == $dn->PendidikanAnak) {
                                                                                                    echo "selected='selected'";
                                                                                                } ?> value="<?= $p; ?>"><?= $p; ?></option>
                                                                                    <?php endforeach; ?>
                                                                                </select>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="pekerjaan">Pekerjaan Anak</label>
                                                                                <input type="text" class="form-control" id="PekerjaanAnak" name="pekerjaan" value="<?= $dn->PekerjaanAnak; ?>">
                                                                            </div>
                                                                            <button type="submit" class="btn btn-primary btn-block mt-5 mb-2">Submit</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>