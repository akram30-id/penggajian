<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('M_Penggajian');
	}

	public function index()
	{
		if ($this->session->userdata('nik') == '17191176') {
			return redirect('hrd');
		} else if ($this->session->userdata('nik') == '17191123') {
			return redirect('ManagerAdministrasi');
		} else {
			$this->load->view('login');
		}
	}

	public function login()
	{
		$nik = $this->input->post('nik');
		$password = md5($this->input->post('password'));
		$nik_convert = (int)$nik;

		$this->form_validation->set_rules('nik', 'NIK', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		if ($this->form_validation->run() != false) {
			$data = $this->db->query("SELECT * FROM user WHERE nik = $nik_convert AND password = '$password'");
			$d = $data->row();
			$cek = $data->num_rows();
			if ($cek > 0) {
				$session = [
					'id' => $d->id,
					'nik' => $d->nik,
					'nama' => $d->nama,
					'foto' => $d->foto,
					'status' => 'login',
				];
				$this->session->set_userdata($session);
				redirect(base_url() . 'penggajian');
			} else {
				redirect(base_url() . 'welcome?pesan=gagal');
			}
		} else {
			$this->load->view('login');
		}
	}

	function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url() . 'welcome');
	}
}
