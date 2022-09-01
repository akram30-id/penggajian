<div class="container-fluid">
    <div class="row">
        <div class="col-sm-4">
            <a href="<?= base_url() . 'ManagerAdministrasi/data_karyawan'; ?>" class="btn btn-secondary mb-5">Back to Datasets</a>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-5">Tambah Data Karyawan Baru</h4>
                    <form class="form-group" action="<?= base_url() . 'ManagerAdministrasi/act_tambah_karyawan'; ?>" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="nik" class="form-label">NIK</label>
                            <input type="number" name="nik" class="form-control" id="nik">
                            <div class="form-text"><?= form_error('nik'); ?></div>
                        </div>
                        <div class="mb-4">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" id="nama">
                            <div class="form-text"><?= form_error('nama'); ?></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="mb-4">
                                    <label for="jenis_kelamin" class="sr-only">Jenis Kelamin</label>
                                    <select class="custom-select" name="jenis_kelamin" id="jenis_kelamin">
                                        <option value="">- Pilih Jenis Kelamin -</option>
                                        <option value="Pria">Pria</option>
                                        <option value="Wanita">Wanita</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="tgl_lahir">Tanggal Lahir</label>
                                    <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir">
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="no_telepon" class="form-label">Nomor Telepon</label>
                            <input type="number" name="no_telepon" class="form-control" id="no_telepon">
                            <div class="form-text"><?= form_error('no_telepon'); ?></div>
                        </div>
                        <div class="mb-4">
                            <label for="email" class="form-label">Alamat Email</label>
                            <input type="email" name="email" class="form-control" id="email">
                            <div class="form-text"><?= form_error('email'); ?></div>
                        </div>
                        <div class="mb-4">
                            <label for="alamat" class="form-label">Alamat Rumah</label>
                            <textarea class="form-control" id="alamat" rows="5" name="alamat"></textarea>
                            <div class="form-text"><?= form_error('alamat'); ?></div>
                        </div>
                        <div class="mb-4">
                            <label for="npwp" class="form-label">No. NPWP</label>
                            <input type="text" name="npwp" class="form-control" id="npwp">
                            <div class="form-text"><?= form_error('npwp'); ?></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="mb-4">
                                    <label for="norek" class="form-label">Nomor Rekening</label>
                                    <input type="number" name="norek" class="form-control" id="norek">
                                    <div class="form-text"><?= form_error('norek'); ?></div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-4">
                                    <label for="nama_bank" class="form-label">Nama Bank</label>
                                    <input type="text" name="nama_bank" class="form-control" id="nama_bank">
                                    <div class="form-text"><?= form_error('nama_bank'); ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 mb-4">
                                <label for="jabatan" class="sr-only">Jabatan</label>
                                <select class="custom-select" name="jabatan" id="jabatan">
                                    <option value="">- Pilih Jabatan -</option>
                                    <option value="PKL">PKL</option>
                                    <option value="Magang">Magang</option>
                                    <option value="Operator">Operator</option>
                                    <option value="Staff">Staff</option>
                                    <option value="Manager">Manager</option>
                                </select>
                            </div>
                            <div class="col-sm-4 mb-4">
                                <label for="departemen" class="sr-only">Departemen</label>
                                <select class="custom-select" name="departemen" id="departemen">
                                    <option value="">- Pilih Departemen -</option>
                                    <?php foreach ($departemen as $d) : ?>
                                        <option value="<?= $d->nama_departemen; ?>"><?= $d->nama_departemen; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="tgl_masuk">Tanggal Masuk Kerja</label>
                                    <input type="date" class="form-control" name="tgl_masuk" id="tgl_masuk">
                                </div>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="gapok" class="form-label">Gaji Pokok</label>
                            <input type="text" name="gapok" class="form-control" id="gapok">
                            <div class="form-text"><?= form_error('gapok'); ?></div>
                        </div>
                        <label for="foto" class="form-label">Upload Foto</label>
                        <div class="input-group mb-5">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="file" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                            </div>
                        </div>
                        <input type="submit" class="btn btn-primary btn-block" value="Submit Data">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>