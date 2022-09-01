<?php

class Hrd extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('M_penggajian');
        if ($this->session->userdata('status') != 'login') {
            return redirect(base_url() . 'welcome?pesan=belumLogin');
        } else if ($this->session->userdata('nik') != '17191176') {
            return redirect('Error/notHRD');
        }
    }

    public function index()
    {
        $data['hrd'] = $this->session->userdata('nama');
        $data['hrd_foto'] = $this->session->userdata('foto');
        $data['where'] = "dashboard";
        $data['jumlah_karyawan'] = $this->M_penggajian->jumlahKaryawan()->num_rows();
        $data['jumlah_notsignmanager'] = $this->M_penggajian->jumlahNotSignManager()->num_rows();
        $data['jumlah_signedmanager'] = $this->M_penggajian->jumlahSignedManager()->num_rows();
        $data['jumlah_notsignHrd'] = $this->M_penggajian->jumlahnotSignHRD()->num_rows();
        $data['overview'] = $this->M_penggajian->overviewKaryawan()->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/content', $data);
        $this->load->view('templates/footer');
    }

    public function changePassword()
    {
        $passBaru = $this->input->post('passwordBaru');
        $hrd = $this->input->post('hrd');
        $konfirmasi = $this->input->post('konfirmasiPassword');

        $this->form_validation->set_rules('passwordBaru', 'Password Baru', 'required|min_length[8]|max_length[16]', [
            'required' => 'Passwword Baru Harus Diisi',
            'min_length' => 'Password Minimal 8 Karakter',
            'max_length' => 'Password Maksimal 16 Karakter',
        ]);

        $this->form_validation->set_rules('konfirmasiPassword', 'Konfirmasi Password', 'required|matches[passwordBaru]', [
            'required' => 'Konfirmasi Password Harus Diisi',
        ]);

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger text-center" role="alert"> Password Gagal Diubah.</div>');
            return redirect('hrd');
        } else {
            $data = [
                'password' => md5($passBaru)
            ];
            $this->M_penggajian->update_data('nama', $hrd, $data, 'user');
            $this->session->set_flashdata('pesan', '<div class="alert alert-success text-center" role="alert"> Password Berhasil Diubah.</div>');
            return redirect('hrd');
        }
    }

    //KARYAWAN SECTION
    public function data_karyawan()
    {
        $data['hrd'] = $this->session->userdata('nama');
        $data['hrd_foto'] = $this->session->userdata('foto');
        $data['where'] = "data_karyawan";

        // var_dump($data['where']);
        // die();

        $data['karyawan'] = $this->db->query("SELECT * FROM user WHERE jabatan IN('Staff', 'operator', 'Magang', 'PKL')")->result();

        $this->load->view('templates/header', $data);
        $this->load->view('karyawan/view_karyawan', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_karyawan()
    {
        $data['hrd'] = $this->session->userdata('nama');
        $data['hrd_foto'] = $this->session->userdata('foto');
        $data['where'] = "data_karyawan";

        $data['departemen'] = $this->db->query("SELECT nama_departemen FROM departemen")->result();

        $this->load->view('templates/header', $data);
        $this->load->view('karyawan/tambah_karyawan', $data);
        $this->load->view('templates/footer');
    }

    public function act_tambah_karyawan()
    {
        // var_dump($_POST);
        // die();
        $nik = $this->input->post('nik');
        $nama = $this->input->post('nama');
        $jenis_kelamin = $this->input->post('jenis_kelamin');
        $tgl_lahir = $this->input->post('tgl_lahir');
        $no_telepon = $this->input->post('no_telepon');
        $email = $this->input->post('email');
        $alamat = $this->input->post('alamat');
        $bpjs = $this->input->post('bpjs');
        $npwp = $this->input->post('npwp');
        $norek = $this->input->post('norek');
        $nama_bank = $this->input->post('nama_bank');
        $jabatan = $this->input->post('jabatan');
        $departemen = $this->input->post('departemen');
        $tgl_masuk = $this->input->post('tgl_masuk');
        $foto = $_FILES['file']['name'];
        $filename = str_replace(" ", "_", $foto);

        // $this->form_validation->set_rules('nik', 'NIK', 'required', ['required' => "NIK tidak boleh kosong", 'min_length' => 6]);
        // $this->form_validation->set_rules('nama', 'Nama', 'required', ['required' => "Nama tidak boleh kosong", 'min_length' => 2]);

        if ($foto) {
            $config['upload_path'] = FCPATH . 'assets/img/karyawan/';
            $config['allowed_types'] = 'jpg|jpeg|png|svg';
            $config['max_size'] = '3000';
            $config['file_name'] = $filename;

            $this->load->library('upload');
            $this->upload->initialize($config);
            $this->upload->data('file_name');
            if (!$this->upload->do_upload('file')) {
                $error = array('error' => $this->upload->display_errors());
                echo $error;
            }
        }

        // if ($this->form_validation->run() != false) {
        if ($filename == NULL) {
            $filename = "-";
        }
        $data = [
            'idSuamiIstri' => 0,
            'idAnak' => 0,
            'nik' => $nik,
            'password' => md5($nik),
            'nama' => $nama,
            'jenis_kelamin' => $jenis_kelamin,
            'tgl_lahir' => $tgl_lahir,
            'alamat' => $alamat,
            'email' => $email,
            'status' => 'working',
            'no_telepon' => $no_telepon,
            'nama_bank' => $nama_bank,
            'no_rekening' => $norek,
            'jabatan' => $jabatan,
            'posisi' => $departemen,
            'bpjs' => $bpjs,
            'npwp' => $npwp,
            'tgl_masuk' => $tgl_masuk,
            'GajiPokok' => 0,
            'foto' => $filename
        ];

        // var_dump($data);
        // die();

        $this->M_penggajian->insert_data($data, 'user');
        if ($filename != "-") {
            $this->upload->do_upload('foto');
        }
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"> Data Berhasil Ditambahkan </div>');
        redirect(base_url() . 'hrd/data_karyawan');
        // } else {
        //     $this->tambah_karyawan();
        // }
    }

    public function detail_karyawan($nik)
    {
        $data['detail'] = $this->db->query("SELECT * FROM user WHERE user.nik = '$nik'")->result();
        $data['detail_istri'] = $this->db->query("SELECT * FROM user INNER JOIN suami_istri_user ON user.id = suami_istri_user.id_user WHERE user.nik = '$nik'")->result();
        $data['detail_anak'] = $this->db->query("SELECT * FROM user INNER JOIN anak_user ON user.id = anak_user.id_user WHERE user.nik = '$nik'")->result();
        $data['hrd'] = $this->session->userdata('nama');
        $data['hrd_foto'] = $this->session->userdata('foto');
        $data['departemen'] = $this->db->query("SELECT nama_departemen FROM departemen")->result();
        $data['where'] = "data_karyawan";

        $this->load->view('templates/header', $data);
        $this->load->view('karyawan/detail_karyawan', $data);
        $this->load->view('templates/footer');
    }

    public function act_edit_karyawan()
    {
        $id = $this->input->post('id');
        $nik = $this->input->post('nik');
        $nama = $this->input->post('nama');
        $jenis_kelamin = $this->input->post('jenis_kelamin');
        $no_telepon = $this->input->post('no_telepon');
        $norek = $this->input->post('norek');
        $nama_bank = $this->input->post('nama_bank');
        $gapok = $this->input->post('gapok');
        $tgl_lahir = $this->input->post('tgl_lahir');
        $email = $this->input->post('email');
        $alamat = $this->input->post('alamat');
        $bpjs = $this->input->post('bpjs');
        $npwp = $this->input->post('npwp');
        $jabatan = $this->input->post('jabatan');
        $departemen = $this->input->post('departemen');
        $tgl_masuk = $this->input->post('tgl_masuk');
        $status = $this->input->post('status');
        $foto = $this->input->post('file');

        $data = [
            'id' => $id,
            'nik' => $nik,
            'password' => md5($nik),
            'nama' => $nama,
            'jenis_kelamin' => $jenis_kelamin,
            'tgl_lahir' => $tgl_lahir,
            'alamat' => $alamat,
            'email' => $email,
            'status' => $status,
            'no_telepon' => $no_telepon,
            'nama_bank' => $nama_bank,
            'no_rekening' => $norek,
            'jabatan' => $jabatan,
            'posisi' => $departemen,
            'bpjs' => $bpjs,
            'npwp' => $npwp,
            'tgl_masuk' => $tgl_masuk,
            'GajiPokok' => $gapok,
            'foto' => $foto,
        ];

        $this->M_penggajian->update_data('id', $id, $data, 'user');

        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"> Data Berhasil Diedit </div>');

        redirect(base_url() . 'hrd/detail_karyawan/' . $nik);
    }

    public function delete_karyawan($id)
    {
        $this->M_penggajian->delete_data('id', $id, 'user');
        redirect(base_url() . 'hrd/data_karyawan');
    }

    public function act_tambah_istri($id, $nikKaryawan)
    {
        // var_dump($_POST);
        // die();
        $nama = $this->input->post('nama');
        $nik = $this->input->post('nik');
        $notelp = $this->input->post('notelp');
        $tempat_lahir = $this->input->post('tempat_lahir');
        $tgl_lahir = $this->input->post('tgl_lahir');
        $pendidikan = $this->input->post('pendidikan');
        $pekerjaan = $this->input->post('pekerjaan');
        $hubungan = $this->input->post('hubungan');

        $data = [
            'id_user' => $id,
            'NamaSuamiIstri' => $nama,
            'nikSuamiIstri' => $nik,
            'noTelpSuamiIstri' => $notelp,
            'TempatLahirSuamiIstri' => $tempat_lahir,
            'TglLahirSuamiIstri' => $tgl_lahir,
            'HubunganSuamiIstri' => $hubungan,
            'PendidikanSuamiIstri' => $pendidikan,
            'PekerjaanSuamiIstri' => $pekerjaan,
        ];

        // var_dump($data);
        // die();

        $this->M_penggajian->insert_data($data, 'suami_istri_user');
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"> Data ' . ucwords($hubungan) . ' Berhasil Ditambahkan </div>');
        redirect(base_url() . 'hrd/detail_karyawan/' . $nikKaryawan);
    }

    public function act_edit_istri($id, $nikKaryawan)
    {
        // var_dump($_POST);
        // die();
        $idSuamiIstri = $this->input->post('idSuamiIstri');
        $nama = $this->input->post('nama');
        $nik = $this->input->post('nik');
        $notelp = $this->input->post('notelp');
        $tempat_lahir = $this->input->post('tempat_lahir');
        $tgl_lahir = $this->input->post('tgl_lahir');
        $pendidikan = $this->input->post('pendidikan');
        $pekerjaan = $this->input->post('pekerjaan');
        $hubungan = $this->input->post('hubungan');

        $data = [
            'idSuamiIstri' => $idSuamiIstri,
            'id_user' => $id,
            'NamaSuamiIstri' => $nama,
            'nikSuamiIstri' => $nik,
            'noTelpSuamiIstri' => $notelp,
            'TempatLahirSuamiIstri' => $tempat_lahir,
            'TglLahirSuamiIstri' => $tgl_lahir,
            'HubunganSuamiIstri' => $hubungan,
            'PendidikanSuamiIstri' => $pendidikan,
            'PekerjaanSuamiIstri' => $pekerjaan,
        ];

        // var_dump($data);
        // die();

        $this->M_penggajian->update_data('idSuamiIstri', $idSuamiIstri, $data, 'suami_istri_user');
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"> Data ' . ucwords($hubungan) . ' Berhasil Ditambahkan' . '</div>');
        redirect(base_url() . 'hrd/detail_karyawan/' . $nikKaryawan);
    }

    public function delete_istri($id, $nik, $hubungan)
    {
        $this->M_penggajian->delete_data('idSuamiIstri', $id, 'suami_istri_user');

        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"> Data ' . $hubungan . 'Berhasil Dihapus' . '</div>');
        redirect(base_url() . 'hrd/detail_karyawan/' . $nik);
    }

    public function act_tambah_anak($idKaryawan, $nikKaryawan)
    {

        $nama = $this->input->post("nama");
        $hubungan = $this->input->post("hubungan");
        $tempat_lahir = $this->input->post("tempat_lahir");
        $tgl_lahir = $this->input->post("tgl_lahir");
        $pendidikan = $this->input->post("pendidikan");
        $pekerjaan = $this->input->post("pekerjaan");

        $data = [
            "id_user" => $idKaryawan,
            "NamaAnak" => $nama,
            "HubunganAnak" => $hubungan,
            "TempatLahirAnak" => $tempat_lahir,
            "TanggalLahirAnak" => $tgl_lahir,
            "PendidikanAnak" => $pendidikan,
            "PekerjaanAnak" => $pekerjaan
        ];

        $this->M_penggajian->insert_data($data, 'anak_user');

        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Anak Berhasil Ditambahkan</div>');
        redirect(base_url() . 'hrd/detail_karyawan/' . $nikKaryawan);
    }

    public function act_edit_anak($idKaryawan, $nikKaryawan)
    {
        $idAnak = $this->input->post("id_anak");
        $nama = $this->input->post("nama");
        $hubungan = $this->input->post("hubungan");
        $tempat_lahir = $this->input->post("tempat_lahir");
        $tgl_lahir = $this->input->post("tgl_lahir");
        $pendidikan = $this->input->post("pendidikan");
        $pekerjaan = $this->input->post("pekerjaan");

        $data = [
            "id_anak" => $idAnak,
            "id_user" => $idKaryawan,
            "NamaAnak" => $nama,
            "HubunganAnak" => $hubungan,
            "TempatLahirAnak" => $tempat_lahir,
            "TanggalLahirAnak" => $tgl_lahir,
            "PendidikanAnak" => $pendidikan,
            "PekerjaanAnak" => $pekerjaan
        ];

        $this->M_penggajian->update_data('id_anak', $idAnak, $data, 'anak_user');

        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"> Data Anak Berhasil Diedit </div>');
        redirect(base_url() . 'hrd/detail_karyawan/' . $nikKaryawan);
    }
    //END OF KARYAWAN SECTION

    //DATA GAJI

    public function absensi()
    {
        $data['hrd'] = $this->session->userdata('nama');
        $data['hrd_foto'] = $this->session->userdata('foto');
        $data['where'] = "data_absen";

        $month = date('m');
        $year = date('Y');
        $data['absensi'] = $this->db->query("SELECT id_user, idAbsen, nama, PeriodeAbsen, nik, TotalAbsen, foto, jabatan, posisi, QtyHariKerja FROM absen_user AS au INNER JOIN user AS u ON au.id_user=u.id WHERE MONTH(au.PeriodeAbsen)=$month AND YEAR(au.PeriodeAbsen)=$year AND u.jabatan IN('Staff', 'operator')")->result_array();
        // var_dump($data['absensi']);
        // die();

        $this->load->view('templates/header', $data);
        $this->load->view('gaji/data_absen', $data);
        $this->load->view('templates/footer');
    }

    public function autoCompleteNamaKaryawan()
    {
        if (isset($_GET['term'])) {
            $result = $this->M_penggajian->search_name($_GET['term']);
            if (count($result) > 0) {
                foreach ($result as $row) {
                    $arr_result[] = $row->nama;
                    echo json_encode($arr_result);
                }
            }
        }
    }

    public function act_tambah_absen()
    {
        // var_dump($_POST);
        // die();

        $namaKaryawan = $this->input->post('namaKaryawan');
        $periodeAbsen = $this->input->post('periodeAbsen');
        $totalAbsen = $this->input->post('totalAbsen');
        $qtyHariKerja = $this->input->post('qtyHariKerja');
        $month = date('m');
        $year = date('Y');

        $who = $this->db->query("SELECT id FROM user WHERE nama='$namaKaryawan'")->result_array();
        $id = $who[0]["id"];
        if (intval($totalAbsen) > intval($qtyHariKerja)) {
            $this->session->set_flashdata("pesan", "<div class='alert alert-danger' role='alert'> Jumlah Hari Kerja Tidak Boleh Melebihi Total Absen. </div>");
            redirect('hrd/absensi');
        } else {
            $cek = $this->db->query("SELECT * FROM absen_user WHERE id_user='$id' AND MONTH(PeriodeAbsen) = $month AND YEAR(PeriodeAbsen) = $year")->num_rows();

            if ($cek < 1) {
                $data = [
                    'id_user' => $id,
                    'PeriodeAbsen' => $periodeAbsen,
                    'TotalAbsen' => $totalAbsen,
                    'QtyHariKerja' => $qtyHariKerja,
                ];

                $this->M_penggajian->insert_data($data, 'absen_user');
                $this->session->set_flashdata("pesan", "<div class='alert alert-success' role='alert'> Data berhasil ditambahkan </div>");
                return redirect('hrd/absensi');
            } else {
                $this->session->set_flashdata("pesan", "<div class='alert alert-danger' role='alert'> Data sudah ada </div>");
                redirect('hrd/absensi');
            }
        }
        // var_dump($cek);
        // die();
    }

    public function act_edit_absen()
    {
        $idAbsen = $this->input->post('id_absen');
        $totalAbsen = $this->input->post('totalAbsen');
        $qtyHariKerja = $this->input->post('qtyHariKerja');

        if (intval($totalAbsen) > intval($qtyHariKerja)) {
            $this->session->set_flashdata("pesan", "<div class='alert alert-danger' role='alert'> Jumlah Hari Kerja Tidak Boleh Melebihi Total Absen. </div>");
            return redirect('hrd/absensi');
        } else {
            $data = [
                'idAbsen' => $idAbsen,
                'TotalAbsen' => $totalAbsen,
                'QtyHariKerja' => $qtyHariKerja
            ];

            $this->M_penggajian->update_data('idAbsen', $idAbsen, $data, 'absen_user');
            $this->session->set_flashdata("pesan", "<div class='alert alert-success' role='alert'> Data berhasil diedit </div>");
            return redirect('hrd/absensi');
        }
    }

    public function delete_absensi($idAbsen)
    {
        $this->M_penggajian->delete_data('idAbsen', $idAbsen, 'absen_user');
        $this->session->set_flashdata("pesan", "<div class='alert alert-danger' role='alert'> Data berhasil dihapus </div>");
        return redirect('hrd/absensi');
    }

    public function data_lembur()
    {
        $data['hrd'] = $this->session->userdata('nama');
        $data['hrd_foto'] = $this->session->userdata('foto');
        $data['where'] = "data_lembur";

        $month = date('m');
        $year = date('Y');
        $data['lembur'] = $this->M_penggajian->dataLembur($year, $month);

        $this->load->view('templates/header', $data);
        $this->load->view('gaji/data_lembur', $data);
        $this->load->view('templates/footer');
    }

    public function act_tambah_lembur()
    {
        $namaKaryawan = $this->input->post('namaKaryawan');
        $tglLembur = $this->input->post('tglLembur');
        $poinLembur = $this->input->post('poinLembur');
        $costPerPoin = $this->input->post('costPerPoin');
        $totalCost = $this->input->post('totalCost');
        $kepentingan = $this->input->post('kepentingan');

        $id_user = $this->db->query("SELECT id FROM user WHERE nama='$namaKaryawan'")->result_array();

        $month = date('m');
        $year = date('Y');
        $idUser = $id_user[0]['id'];
        $cek = $this->db->query("SELECT HrdSignature FROM gaji WHERE id_user = '$idUser' AND HrdSignature != '-' AND MONTH(PeriodeApproval)='$month' AND YEAR(PeriodeApproval)='$year'")->num_rows();

        if ($cek > 0) {
            $this->session->set_flashdata("pesan", "<div class='alert alert-danger text-center' role='alert'> Data lembur gagal ditambahkan. <br><small>Data " . $namaKaryawan . " Sudah Diapprove HRD. </small></div>");
            return redirect('hrd/data_lembur');
        } else {
            $data = [
                'id_user' => $id_user[0]['id'],
                'TglLembur' => $tglLembur,
                'PoinLembur' => $poinLembur,
                'KepentinganLembur' => $kepentingan,
                'CostPerPoinLembur' => $costPerPoin,
                'TotalCostLembur' => $totalCost,
            ];

            $this->M_penggajian->insert_data($data, 'lembur_user');
            $this->session->set_flashdata("pesan", "<div class='alert alert-success' role='alert'> Data lembur berhasil ditambahkan. </div>");
            return redirect('hrd/data_lembur');
        }
    }

    public function detail_lembur($idUser)
    {
        $data['hrd'] = $this->session->userdata('nama');
        $data['hrd_foto'] = $this->session->userdata('foto');
        $data['where'] = "data_lembur";

        $month = date('m');
        $year = date('Y');
        $data['detailLembur'] = $this->db->query("SELECT * FROM lembur_user AS lu INNER JOIN user AS u ON lu.id_user = u.id WHERE lu.id_user='$idUser' AND MONTH(lu.TglLembur)=$month AND YEAR(lu.TglLembur)=$year AND u.jabatan IN ('Staff', 'operator')")->result_array();

        $data['totalCostPeriode'] = $this->db->query("SELECT SUM(TotalCostLembur), SUM(PoinLembur) FROM lembur_user WHERE id_user='$idUser' AND MONTH(TglLembur)=$month AND YEAR(TglLembur)=$year")->result_array();

        // var_dump($data['totalCostPeriode']);
        // die();

        $this->load->view('templates/header', $data);
        $this->load->view('gaji/detail_lembur', $data);
        $this->load->view('templates/footer');
    }

    public function act_edit_lembur()
    {
        // var_dump($_POST);
        // die();

        $namaKaryawan = html_escape($this->input->post('namaKaryawan'));
        $idLembur = html_escape($this->input->post('idLembur'));
        $idUser = html_escape($this->input->post('idUser'));
        $tglLembur = html_escape($this->input->post('tglLembur'));
        $poinLembur = html_escape($this->input->post('poinLembur'));
        $costPerPoin = html_escape($this->input->post('costPerPoin'));
        $totalCost = html_escape($this->input->post('totalCost'));
        $kepentingan = html_escape($this->input->post('kepentingan'));

        $month = date('m');
        $year = date('Y');
        $cek = $this->db->query("SELECT HrdSignature FROM gaji WHERE id_user = '$idUser' AND HrdSignature != '-' AND MONTH(PeriodeApproval)='$month' AND YEAR(PeriodeApproval)='$year'")->num_rows();

        if ($cek > 0) {
            $this->session->set_flashdata("pesan", "<div class='alert alert-danger text-center' role='alert'> Edit lembur gagal ditambahkan. <br><small>Data " . $namaKaryawan . " Sudah Diapprove HRD. </small></div>");
            return redirect('hrd/detail_lembur/' . $idUser);
        } else {
            $data = [
                'idLembur' => $idLembur,
                'id_user' => $idUser,
                'TglLembur' => $tglLembur,
                'PoinLembur' => $poinLembur,
                'KepentinganLembur' => $kepentingan,
                'CostPerPoinLembur' => $costPerPoin,
                'TotalCostLembur' => $poinLembur * $costPerPoin
            ];

            $this->M_penggajian->update_data('idLembur', $idLembur, $data, 'lembur_user');
            $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Data Lembur ' . $namaKaryawan . ' Berhasil Diedit</div>');
            return redirect('hrd/detail_lembur/' . $idUser);
        }
    }

    public function performance()
    {
        $data['hrd'] = $this->session->userdata('nama');
        $data['hrd_foto'] = $this->session->userdata('foto');
        $data['where'] = "performance";

        $month = date('m');
        $year = date('Y');
        $data['perform'] = $this->M_penggajian->dataPerform($year, $month);

        // var_dump($data['perform']);
        // die();

        $this->load->view('templates/header', $data);
        $this->load->view('gaji/data_perform', $data);
        $this->load->view('templates/footer');
    }

    public function act_tambah_perform()
    {
        $namaKaryawan = $this->input->post('namaKaryawan');
        $periode = $this->input->post('periode');
        $score = $this->input->post('score');
        $bonus = $this->input->post('bonus');

        $id_user = $this->db->query("SELECT id FROM user WHERE nama='$namaKaryawan'")->result_array();
        $idUser = $id_user[0]['id'];
        $month = date('m');
        $year = date('Y');
        $cekData = $this->db->query("SELECT HrdSignature FROM gaji WHERE id_user = '$idUser' AND HrdSignature != '-' AND MONTH(PeriodeApproval)='$month' AND YEAR(PeriodeApproval)='$year'")->num_rows();

        if ($cekData > 0) {
            $this->session->set_flashdata("pesan", "<div class='alert alert-danger text-center' role='alert'> Tambah performance gagal ditambahkan. <br><small>Data " . $namaKaryawan . " Sudah Diapprove HRD. </small></div>");
            return redirect('hrd/performance');
        } else {
            $cek = $this->M_penggajian->edit_data(['id_user' => $id_user[0]['id']], 'performance_user')->num_rows();
            if ($cek > 0) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Data Sudah Ada</div>');
                return redirect('hrd/performance');
            } else {
                if (intval($score) > 100) {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Score Performance Tidak Boleh Lebih Dari 100</div>');
                    return redirect('hrd/performance');
                } else {
                    $data = [
                        'id_user' => $id_user[0]['id'],
                        'ScorePerform' => $score,
                        'QtyBonusPerform' => $bonus,
                        'PerformPeriode' => $periode
                    ];

                    $this->M_penggajian->insert_data($data, 'performance_user');
                    $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Tambah Data Berhasil</div>');
                    return redirect('hrd/performance');
                }
            }
        }
    }

    public function act_edit_perform()
    {
        $idPerform = $this->input->post('idPerform');
        $id_user = $this->input->post('id_user');
        $periodePerform = $this->input->post('periode');
        $score = $this->input->post('score');
        $bonus = $this->input->post('bonus');

        $month = date('m');
        $year = date('Y');
        $cekData = $this->db->query("SELECT HrdSignature FROM gaji WHERE id_user = '$id_user' AND HrdSignature != '-' AND MONTH(PeriodeApproval)='$month' AND YEAR(PeriodeApproval)='$year'")->num_rows();

        if ($cekData > 0) {
            $this->session->set_flashdata("pesan", "<div class='alert alert-danger text-center' role='alert'> Edit performance gagal ditambahkan. <br><small>Data Karyawan Sudah Diapprove HRD. </small></div>");
            return redirect('hrd/performance');
        } else {
            if (intval($score) > 100) {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Score lebih dari 100</div>');
                return redirect('hrd/performance');
            } else {
                $data = [
                    'idPerform' => $idPerform,
                    'id_user' => $id_user,
                    'ScorePerform' => $score,
                    'QtyBonusPerform' => $bonus,
                    'PerformPeriode' => $periodePerform
                ];

                $this->M_penggajian->update_data('idPerform', $idPerform, $data, 'performance_user');
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Edit Data Berhasil</div>');
                return redirect('hrd/performance');
            }
        }
    }

    public function delete_perform($idPerform)
    {
        $this->M_penggajian->delete_data('idPerform', $idPerform, 'performance_user');
        $this->session->set_flashdata('pesan', '<div class="alert alert-success text-danger" role="alert">Data Berhasil Dihapus</div>');
        return redirect('hrd/performance');
    }

    public function data_gaji()
    {
        $data['hrd'] = $this->session->userdata('nama');
        $data['hrd_foto'] = $this->session->userdata('foto');
        $data['where'] = "data_gaji";
        $year = date('Y');
        $month = date('m');

        $data['gaji'] = $this->db->query("SELECT * FROM user AS u INNER JOIN gaji AS g ON u.id = g.id_user WHERE MONTH(g.PeriodeApproval) = '$month' AND YEAR(g.PeriodeApproval) = '$year' AND u.jabatan IN('Staff', 'operator')")->result_array();

        // var_dump($data['gaji']);
        // die();

        $this->load->view('templates/header', $data);
        $this->load->view('gaji/karyawan_gaji', $data);
        $this->load->view('templates/footer');
    }

    public function detail_gaji($id_user)
    {
        $data['hrd'] = $this->session->userdata('nama');
        $data['hrd_foto'] = $this->session->userdata('foto');
        $data['where'] = "data_gaji";
        $year = date('Y');
        $month = date('m');

        $cekLembur = $this->M_penggajian->edit_data(['id_user' => $id_user], 'lembur_user')->num_rows();

        if ($cekLembur < 1) {
            $data['lembur'] = [
                0 => [
                    'SUM(TotalCostLembur)' => 0
                ]
            ];
        } else {
            $data['lembur'] = $this->M_penggajian->dataLemburSpecified($id_user, $year, $month);
        }

        $cekPerformance = $this->M_penggajian->edit_data(['id_user' => $id_user], 'performance_user')->num_rows();
        if ($cekPerformance < 1) {
            $data['perform'] = [
                0 => [
                    'QtyBonusPerform' => 0
                ]
            ];
        } else {
            $data['perform'] = $this->M_penggajian->dataPerformSpecified($id_user, $year, $month);
        }

        $cekSuamiIstri = $this->M_penggajian->edit_data(['id_user' => $id_user], 'suami_istri_user')->num_rows();
        $cekAnak = $this->M_penggajian->edit_data(['id_user' => $id_user], 'anak_user')->num_rows();
        if ($cekSuamiIstri < 1) {
            switch ($cekAnak) {
                case 1:
                    $data['PTKP'] = 58500000;
                    break;

                case 2:
                    $data['PTKP'] = 63000000;
                    break;

                case 3:
                    $data['PTKP'] = 67500000;
                    break;

                default:
                    $data['PTKP'] = 54000000;
                    break;
            }
        } else {
            switch ($cekAnak) {
                case 1:
                    $data['PTKP'] = 63000000;
                    break;

                case 2:
                    $data['PTKP'] = 67000000;
                    break;

                case 3:
                    $data['PTKP'] = 72000000;
                    break;

                default:
                    $data['PTKP'] = 58500000;
                    break;
            }
        }

        $data['gaji'] = $this->M_penggajian->dataGajiSpecified($id_user, $year, $month);
        $data['thr'] = $this->db->query("SELECT * FROM user AS u INNER JOIN thr_user AS tu ON u.id=tu.id_user WHERE tu.id_user='$id_user' AND YEAR(PeriodeTHR)='$year' AND MONTH(PeriodeTHR)='$month'")->result_array();
        // var_dump($data['thr']);
        // die();

        $cekAvailableAbsen = $this->M_penggajian->edit_data(['id_user' => $id_user], 'absen_user')->num_rows();
        if ($cekAvailableAbsen == 0) {
            $data['potongAbsen'] = 0;
        } else {
            $cekAbsen = $this->M_penggajian->cekAbsensi($id_user, $year, $month)->result_array();
            $selisihAbsen = intval($cekAbsen[0]["QtyHariKerja"]) - intval($cekAbsen[0]["TotalAbsen"]);
            $costperHari = intval($data['gaji'][0]['GajiPokok']) / intval($cekAbsen[0]['QtyHariKerja']);
            $data['potongAbsen'] = $costperHari * $selisihAbsen;
        }

        $this->load->view('templates/header', $data);
        $this->load->view('gaji/detail_gaji', $data);
        $this->load->view('templates/footer');
    }

    public function approveHRD($id_gaji)
    {
        $data = [
            'StatusApproval' => 'Butuh Approval Manager',
            'HrdSignature' => 'hrd.png'
        ];
        $this->M_penggajian->update_data('idGaji', $id_gaji, $data, 'gaji');

        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Status Approval Berhasil Diupdate.</div>');
        return redirect('hrd/data_gaji');
    }

    public function cancelApproveHRD($id_gaji)
    {
        $data = [
            'StatusApproval' => 'Need to Approve',
            'HrdSignature' => '-'
        ];
        $this->M_penggajian->update_data('idGaji', $id_gaji, $data, 'gaji');

        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Cancel Approval Sukses.</div>');
        return redirect('hrd/data_gaji');
    }

    public function synchronize()
    {
        $user = $this->db->query("SELECT id, jabatan FROM user WHERE jabatan IN('Staff', 'operator', 'Magang', 'PKL')")->result_array();
        $periodeNowMonth = date('m');
        $periodeNowYear = date('Y');
        foreach ($user as $u) {
            // die();
            $idUser = $u['id'];
            $cekUser = $this->db->query("SELECT id_user FROM gaji WHERE id_user=$idUser AND MONTH(PeriodeApproval) = '$periodeNowMonth' AND YEAR(PeriodeApproval) = '$periodeNowYear'")->num_rows();
            // var_dump($cekUser);
            if ($cekUser == 0) {
                $dataUpdate = [
                    'id_user' => $idUser,
                    'StatusApproval' => 'Need to Approve',
                    'PeriodeApproval' => date('Y-m-28'),
                    'HrdSignature' => '-',
                    'ManagerSignature' => '-'
                ];
                $this->M_penggajian->insert_data($dataUpdate, 'gaji');
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Sychronize data success.</div>');
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-warning" role="alert">0 Data synchronized.</div>');
            }
        }
        return redirect('hrd/data_gaji');
    }

    // END OF DATA GAJI SECTION
}
