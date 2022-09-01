<?php

class M_penggajian extends CI_Model
{
    function edit_data($where, $table)
    {
        return $this->db->get_where($table, $where);
    }

    function get_data($table)
    {
        return $this->db->get($table);
    }

    function insert_data($data, $table)
    {
        $this->db->insert($table, $data);
    }

    function update_data($field, $where, $data, $table)
    {
        $this->db->where($field, $where);
        $this->db->update($table, $data);
    }

    function delete_data($field, $where, $table)
    {
        $this->db->where($field, $where);
        $this->db->delete($table);
    }

    function search_name($namaKaryawan)
    {
        $this->db->like('nama', $namaKaryawan, 'both');
        $this->db->order_by('nama', 'ASC');
        $this->db->limit(10);
        return $this->db->get('user')->result();
    }

    function suamiIstriUser($where)
    {
        return $this->db->query("SELECT * FROM user INNER JOIN suami_istri_user ON user.id = suami_istri_user.id_user WHERE user.nik = '$where'")->result();
    }

    function suamiIstriUsergetId($id_user)
    {
        return $this->db->query("SELECT * FROM user INNER JOIN suami_istri_user ON user.id = suami_istri_user.id_user WHERE user.nik = '$id_user'")->result_array();
    }

    function anakUser($where)
    {
        return $this->db->query("SELECT * FROM user INNER JOIN anak_user ON user.id = anak_user.id_user WHERE user.nik = '$where'")->result();
    }

    function anakUsergetId($id_user)
    {
        return $this->db->query("SELECT * FROM user INNER JOIN anak_user ON user.id = anak_user.id_user WHERE user.nik = '$id_user'")->result_array();
    }

    function dataLembur($year, $month)
    {
        return $this->db->query("SELECT idLembur, id_user, SUM(PoinLembur), SUM(TotalCostLembur), nama, foto, jabatan, posisi, CostPerPoinLembur, TglLembur FROM lembur_user AS lu INNER JOIN user AS u ON lu.id_user = u.id WHERE MONTH(lu.TglLembur)=$month AND YEAR(lu.TglLembur)=$year AND u.jabatan IN ('Staff', 'operator') GROUP BY lu.id_user")->result_array();
    }

    function dataLemburSpecified($id_user, $year, $month)
    {
        return $this->db->query("SELECT id_user, SUM(TotalCostLembur) FROM lembur_user AS lu INNER JOIN user AS u ON lu.id_user = u.id WHERE MONTH(lu.TglLembur)=$month AND YEAR(lu.TglLembur)=$year AND lu.id_user = '$id_user'")->result_array();
    }

    function dataPerform($year, $month)
    {
        return $this->db->query("SELECT * FROM performance_user AS pu INNER JOIN user AS u ON pu.id_user = u.id WHERE MONTH(pu.PerformPeriode)=$month AND YEAR(pu.PerformPeriode)=$year AND u.jabatan IN ('Staff', 'operator')")->result_array();
    }

    function dataPerformSpecified($id_user, $year, $month)
    {
        return $this->db->query("SELECT QtyBonusPerform FROM performance_user AS pu INNER JOIN user AS u ON pu.id_user = u.id WHERE MONTH(pu.PerformPeriode)=$month AND YEAR(pu.PerformPeriode)=$year AND u.jabatan IN ('Staff', 'operator') AND pu.id_user = $id_user")->result_array();
    }

    function dataGajiSpecified($id_user, $year, $month)
    {
        return $this->db->query("SELECT nama, nik, posisi, jabatan, GajiPokok, PeriodeApproval, HrdSignature, ManagerSignature FROM user AS u INNER JOIN gaji AS g ON u.id = g.id_user WHERE MONTH(g.PeriodeApproval) = '$month' AND YEAR(g.PeriodeApproval) = '$year' AND g.id_user = $id_user")->result_array();
    }

    function cekAbsensi($id_user, $year, $month)
    {
        return $this->db->query("SELECT QtyHariKerja, TotalAbsen FROM absen_user WHERE id_user = '$id_user' AND MONTH(PeriodeAbsen)='$month' AND YEAR(PeriodeAbsen)='$year'");
        // return $this->db->query("SELECT QtyHariKerja, TotalAbsen FROM absen_user WHERE id_user = '$id_user'");
    }

    function jumlahKaryawan()
    {
        return $this->db->query("SELECT id FROM user WHERE status='working'");
    }

    function jumlahNotSignManager()
    {
        $year = date('Y');
        $month = date('m');
        return $this->db->query("SELECT ManagerSignature FROM gaji WHERE ManagerSignature = '-' AND MONTH(PeriodeApproval) = '$month' AND YEAR(PeriodeApproval) = '$year'");
    }

    function jumlahSignedManager()
    {
        $year = date('Y');
        $month = date('m');
        return $this->db->query("SELECT ManagerSignature FROM gaji WHERE ManagerSignature != '-' AND MONTH(PeriodeApproval) = '$month' AND YEAR(PeriodeApproval) = '$year'");
    }

    function jumlahnotSignHRD()
    {
        $year = date('Y');
        $month = date('m');
        return $this->db->query("SELECT HrdSignature FROM gaji WHERE HrdSignature = '-' AND MONTH(PeriodeApproval) = '$month' AND YEAR(PeriodeApproval) = '$year'");
    }

    function overviewKaryawan()
    {
        return $this->db->query("SELECT * FROM `user` WHERE status='working' AND jabatan IN('Staff', 'operator', 'Magang') LIMIT 5");
    }

    function jumlahApproval()
    {
        $year = date('Y');
        $month = date('m');
        return $this->db->query("SELECT ManagerSignature, HrdSignature FROM gaji WHERE MONTH(PeriodeApproval)='$month' AND YEAR(PeriodeApproval)='$year'");
    }

    function dataTHR()
    {
        return $this->db->query("SELECT * FROM thr_user AS tu INNER JOIN user AS u ON tu.id_user=u.id");
    }
}
