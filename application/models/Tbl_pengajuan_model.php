<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tbl_pengajuan_model extends CI_Model
{

    public $table = 'tbl_pengajuan';
    public $id = 'id_pengajuan';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        if (($this->session->userdata('id_user_level') == 1) || ($this->session->userdata('id_user_level') == 2)) {
            $this->db->where('status >= 1');
        }
        if ($this->session->userdata('id_user_level') == 3) {
            $this->db->where('status >= 4');
        }
        if ($this->session->userdata('id_user_level') == 4) {
            $this->db->where('status >= 7');
        }
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    function get_all_laporan()
    {
        
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    function get_all_update()
    {
        date_default_timezone_set('Asia/Makassar'); # add your city to set local time zone
        $today = date("Y-m-d");

        $this->db->select('*, tbl_update.status, tbl_update.catatan');
        $this->db->join('tbl_pengajuan', 'tbl_pengajuan.id_pengajuan = tbl_update.id_pengajuan');
        $this->db->where('DATE(tanggal_update)', $today);
        $this->db->order_by('id_update', $this->order);
       
        return $this->db->get('tbl_update')->result();
    }

    function get_all_by_status($status)
    {
        date_default_timezone_set('Asia/Makassar'); # add your city to set local time zone
        $today = date("Y-m-d");

        // Kondisi: (tanggal_acc adalah hari ini DAN status adalah 'acc') OR (tanggal_acc adalah besok DAN status bukan 'acc')
        $this->db->group_start();
        $this->db->where('tanggal_acc', $today);
        $this->db->where('status', $status);
        $this->db->group_end();
        $this->db->or_group_start();
        $this->db->where('status', $status);
        $this->db->where('tanggal_acc <', $today);
        $this->db->group_end();
        return $this->db->get($this->table)->result();
    }


    function get_all_by_status_2($status)
    {
        date_default_timezone_set('Asia/Makassar'); # add your city to set local time zone
        $today = date("Y-m-d");

        // Kondisi: (tanggal_acc adalah hari ini DAN status adalah 'acc') OR (tanggal_acc adalah besok DAN status bukan 'acc')
        $this->db->where('tanggal_acc', $today);
        $this->db->where('status', $status);
        
        return $this->db->get($this->table)->result();
    }

    function get_all_by_status_between($status1)
    {
        date_default_timezone_set('Asia/Makassar'); # add your city to set local time zone
        $today = date("Y-m-d");

        // Kondisi: (tanggal_acc adalah hari ini DAN status adalah 'acc') OR (tanggal_acc adalah besok DAN status bukan 'acc')
        $this->db->where('tanggal_acc', $today);
        $this->db->where("status", $status1);
        
        return $this->db->get($this->table)->result();
    }

    function get_all_by_status_revisi()
    {
        $this->db->group_start();
        $this->db->where("status", 3);
        $this->db->or_where("status", 6);
        $this->db->or_where("status", 9);
        $this->db->group_end();
        
        return $this->db->get($this->table)->result();
    }

    function get_all_by_status_ditolak()
    {
        $this->db->group_start();
        $this->db->where("status", 2);
        $this->db->or_where("status", 5);
        $this->db->or_where("status", 8);
        $this->db->group_end();
        
        return $this->db->get($this->table)->result();
    }
    

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // get total rows
    function total_rows($q = NULL)
    {
        $this->db->like('id_pengajuan', $q);
        $this->db->or_like('perihal', $q);
        $this->db->or_like('tanggal_pengajuan', $q);
        $this->db->or_like('berkas', $q);
        $this->db->or_like('status', $q);
        $this->db->or_like('catatan', $q);
        $this->db->from($this->table);
        if (($this->session->userdata('id_user_level') == 1) || ($this->session->userdata('id_user_level') == 2)) {
            $this->db->where('status >= 1');
        }
        if ($this->session->userdata('id_user_level') == 3) {
            $this->db->where('status >= 4');
        }
        if ($this->session->userdata('id_user_level') == 4) {
            $this->db->where('status >= 7');
        }
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL)
    {
        $this->db->order_by($this->id, $this->order);
        if (($this->session->userdata('id_user_level') == 1) || ($this->session->userdata('id_user_level') == 2)) {
            $this->db->where('status >= 1');
        }
        if ($this->session->userdata('id_user_level') == 3) {
            $this->db->where('status >= 4');
        }
        if ($this->session->userdata('id_user_level') == 4) {
            $this->db->where('status >= 7');
        }
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
        $id = $this->db->insert_id();
        return (isset($id)) ? $id : FALSE;
    }

    function insert_update($data)
    {
        $this->db->insert('tbl_update', $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

}

/* End of file Tbl_pengajuan_model.php */
/* Location: ./application/models/Tbl_pengajuan_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2024-06-11 07:59:52 */
/* http://harviacode.com */