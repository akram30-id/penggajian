<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Penggajian extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        //cek login
        if ($this->session->userdata('status') != 'login') {
            redirect(base_url() . 'welcome?pesan=belumLogin');
        } else {
            if ($this->session->userdata('nik') == '17191176') {
                redirect(base_url() . 'hrd');
            } else if($this->session->userdata('nik') == '17191223'){
                redirect('ManagerAdministrasi');
            }
        }
    }

    public function index()
    {
        $data = $this->db->query("SELECT nik, nama, foto FROM user = '17111976'")->result();
        var_dump($data);
        die();
        $this->load->view('templates/header');
        $this->load->view('templates/content');
        $this->load->view('templates/footer');
    }
}
