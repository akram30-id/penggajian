<?php

class ManagerAdministrasi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('M_penggajian');
        if ($this->session->userdata('status') != 'login') {
            redirect(base_url() . 'welcome?pesan=belumLogin');
        } else if ($this->session->userdata('nik') != '17191223') {
            return redirect('Error/notManagerAdmin');
        }
    }

    public function index()
    {
        $data['admin'] = $this->session->userdata('nama');
        $data['admin_foto'] = $this->session->userdata('foto');
        $data['where'] = "dashboard";
        $data['jumlah_karyawan'] = $this->M_penggajian->jumlahKaryawan()->num_rows();
        $data['jumlah_notsignmanager'] = $this->M_penggajian->jumlahNotSignManager()->num_rows();
        $data['jumlah_signedmanager'] = $this->M_penggajian->jumlahSignedManager()->num_rows();
        $data['jumlah_notsignHrd'] = $this->M_penggajian->jumlahnotSignHRD()->num_rows();
        $data['overview'] = $this->M_penggajian->overviewKaryawan()->result_array();

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/content', $data);
        $this->load->view('admin/templates/footer');
    }

    public function changePassword()
    {
        $passBaru = $this->input->post('passwordBaru');
        $admin = $this->input->post('admin');
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
            return redirect('ManagerAdministrasi');
        } else {
            $data = [
                'password' => md5($passBaru)
            ];
            $this->M_penggajian->update_data('nama', $admin, $data, 'user');
            $this->session->set_flashdata('pesan', '<div class="alert alert-success text-center" role="alert"> Password Berhasil Diubah.</div>');
            return redirect('ManagerAdministrasi');
        }
    }

    public function data_karyawan()
    {
        $data['admin'] = $this->session->userdata('nama');
        $data['admin_foto'] = $this->session->userdata('foto');
        $data['where'] = "data_karyawan";


        $data['karyawan'] = $this->M_penggajian->get_data('user')->result();
        // var_dump($data['karyawan']);
        // die();

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/karyawan/view_karyawan', $data);
        $this->load->view('templates/footer');
    }

    public function detail_karyawan($nik)
    {
        $data['detail'] = $this->db->query("SELECT * FROM user WHERE user.nik = '$nik'")->result();
        $data['detail_istri'] = $this->M_penggajian->suamiIstriUser($nik);
        $data['detail_anak'] = $this->M_penggajian->anakUser($nik);
        $data['admin'] = $this->session->userdata('nama');
        $data['admin_foto'] = $this->session->userdata('foto');
        $data['departemen'] = $this->db->query("SELECT nama_departemen FROM departemen")->result();
        $data['where'] = "data_karyawan";

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/karyawan/detail_karyawan', $data);
        $this->load->view('templates/footer');
    }

    public function tambah_karyawan()
    {
        $data['admin'] = $this->session->userdata('nama');
        $data['admin_foto'] = $this->session->userdata('foto');
        $data['where'] = "data_karyawan";

        $data['departemen'] = $this->db->query("SELECT nama_departemen FROM departemen")->result();

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/karyawan/tambah_karyawan', $data);
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
        $npwp = $this->input->post('npwp');
        $norek = $this->input->post('norek');
        $nama_bank = $this->input->post('nama_bank');
        $gapok = $this->input->post('gapok');
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
            'npwp' => $npwp,
            'tgl_masuk' => $tgl_masuk,
            'GajiPokok' => $gapok,
            'foto' => $filename
        ];

        // var_dump($data);
        // die();

        $this->M_penggajian->insert_data($data, 'user');
        if ($filename != "-") {
            $this->upload->do_upload('foto');
        }
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"> Data Berhasil Ditambahkan </div>');
        redirect(base_url() . 'ManagerAdministrasi/data_karyawan');
        // } else {
        //     $this->tambah_karyawan();
        // }
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
            'npwp' => $npwp,
            'tgl_masuk' => $tgl_masuk,
            'GajiPokok' => $gapok,
            'foto' => $foto,
        ];

        $this->M_penggajian->update_data('id', $id, $data, 'user');

        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert"> Data Berhasil Diedit </div>');

        redirect(base_url() . 'ManagerAdministrasi/detail_karyawan/' . $nik);
    }

    public function delete_karyawan($id)
    {
        $this->M_penggajian->delete_data('id', $id, 'user');
        redirect(base_url() . 'ManagerAdministrasi/data_karyawan');
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

    public function data_gaji()
    {
        // $date1 = date('Y-m-d');
        // $date2 = date('Y-m-28');
        // if($date1 <= $date2){
        //     echo "true";
        // }
        // var_dump($date2);
        // die();
        $data['admin'] = $this->session->userdata('nama');
        $data['admin_foto'] = $this->session->userdata('foto');
        $data['where'] = "data_gaji";
        $year = date('Y');
        $month = date('m');

        $data['gaji'] = $this->db->query("SELECT * FROM user AS u INNER JOIN gaji AS g ON u.id = g.id_user WHERE MONTH(g.PeriodeApproval) = '$month' AND YEAR(g.PeriodeApproval) = '$year' AND g.HrdSignature != '-'")->result_array();
        $data['manager'] = $this->db->query("SELECT * FROM user AS u INNER JOIN gaji AS g ON u.id = g.id_user WHERE MONTH(g.PeriodeApproval) = '$month' AND YEAR(g.PeriodeApproval) = '$year' AND jabatan='Manager'")->result_array();
        // var_dump($data['manager']);
        // die();

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/gaji/karyawan_gaji', $data);
        $this->load->view('templates/footer');
    }
    
    public function synchronize_gaji()
    {
        $user = $this->db->query("SELECT id, jabatan FROM user WHERE jabatan IN('HRD', 'Manager')")->result_array();
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
                    'StatusApproval' => 'Butuh Approval Manager',
                    'PeriodeApproval' => date('Y-m-28'),
                    'HrdSignature' => 'hrd.png',
                    'ManagerSignature' => '-'
                ];
                $this->M_penggajian->insert_data($dataUpdate, 'gaji');
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Sychronize data success.</div>');
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-warning" role="alert">0 Data synchronized.</div>');
            }
        }
        return redirect('ManagerAdministrasi/data_gaji');
    }

    public function detail_gaji($id_user)
    {
        $data['admin'] = $this->session->userdata('nama');
        $data['admin_foto'] = $this->session->userdata('foto');
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

        // var_dump($data['perform']);
        // die();

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

        $cekAvailableAbsen = $this->M_penggajian->edit_data(['id_user' => $id_user], 'absen_user')->num_rows();
        if ($cekAvailableAbsen == 0) {
            $data['potongAbsen'] = 0;
        } else {
            $cekAbsen = $this->M_penggajian->cekAbsensi($id_user, $year, $month)->result_array();
            $selisihAbsen = intval($cekAbsen[0]["QtyHariKerja"]) - intval($cekAbsen[0]["TotalAbsen"]);
            $costperHari = intval($data['gaji'][0]['GajiPokok']) / intval($cekAbsen[0]['QtyHariKerja']);
            $data['potongAbsen'] = $costperHari * $selisihAbsen;
        }

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/gaji/detail_gaji', $data);
        $this->load->view('templates/footer');
    }

    public function approveManager($id_gaji)
    {
        $data = [
            'StatusApproval' => 'Approved',
            'ManagerSignature' => 'manager.png'
        ];
        $this->M_penggajian->update_data('idGaji', $id_gaji, $data, 'gaji');

        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Status Approval Berhasil Diupdate.</div>');
        return redirect('ManagerAdministrasi/data_gaji');
    }

    public function updateApprovalTHR($id_thr)
    {
        $periodeTHR = $this->input->post('tglApproval');
        $data = [
            'PeriodeTHR' => $periodeTHR,
            'StatusApprovalTHR' => 'Approved',
        ];
        $this->M_penggajian->update_data('idTHR', $id_thr, $data, 'thr_user');

        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Status Approval Berhasil Diupdate.</div>');
        return redirect('ManagerAdministrasi/data_thr');
    }

    public function cancelApproveHRD($id_gaji)
    {
        $data = [
            'StatusApproval' => 'Need to Approve',
            'HrdSignature' => '-'
        ];
        $this->M_penggajian->update_data('idGaji', $id_gaji, $data, 'gaji');

        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Cancel Approval Sukses.</div>');
        return redirect('ManaegerAdministrasi/data_gaji');
    }

    public function data_thr()
    {
        $data['admin'] = $this->session->userdata('nama');
        $data['admin_foto'] = $this->session->userdata('foto');
        $data['where'] = "thr";

        $data['thr'] = $this->M_penggajian->dataTHR()->result_array();

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/thr/data_thr', $data);
        $this->load->view('templates/footer');
    }

    public function synchronize()
    {
        $user = $this->db->query("SELECT id, GajiPokok FROM user")->result_array();
        foreach ($user as $u) {
            // die();
            $idUser = $u['id'];
            $gapok = $u['GajiPokok'];
            $cekUser = $this->db->query("SELECT id_user FROM thr_user WHERE id_user=$idUser AND YEAR(PeriodeTHR) = '0000'")->num_rows();
            // var_dump($cekUser);
            if ($cekUser == 0) {
                $dataUpdate = [
                    'id_user' => $idUser,
                    'PeriodeTHR' => date('0000-00-00'),
                    'QtyTHR' => $gapok,
                    'StatusApprovalTHR' => 'Need to Approve',
                ];
                $this->M_penggajian->insert_data($dataUpdate, 'thr_user');
                $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Sychronize data success.</div>');
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-warning" role="alert">0 Data synchronized.</div>');
            }
        }
        return redirect('ManagerAdministrasi/data_thr');
    }
}
