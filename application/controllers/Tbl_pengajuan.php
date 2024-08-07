<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tbl_pengajuan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Tbl_pengajuan_model');
        $this->load->model('User_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));

        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/tbl_pengajuan/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/tbl_pengajuan/index/';
            $config['first_url'] = base_url() . 'index.php/tbl_pengajuan/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->Tbl_pengajuan_model->total_rows($q);
        $tbl_pengajuan = $this->Tbl_pengajuan_model->get_all();
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'tbl_pengajuan_data' => $tbl_pengajuan,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template', 'tbl_pengajuan/tbl_pengajuan_list', $data);
    }

    public function laporan() {
        $data = array(
            'start' => 0,
            'tbl_pengajuan_data' => $this->Tbl_pengajuan_model->get_all_laporan(),
        );

        $this->template->load('template', 'tbl_pengajuan/tbl_pengajuan_laporan', $data);
    }

    public function read($id)
    {
        $row = $this->Tbl_pengajuan_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id_pengajuan' => $row->id_pengajuan,
                'perihal' => $row->perihal,
                'tanggal_pengajuan' => $row->tanggal_pengajuan,
                'berkas' => $row->berkas,
                'keterangan' => $row->keterangan,
                'status' => $row->status,
                'catatan' => $row->catatan,
            );
            $this->template->load('template', 'tbl_pengajuan/tbl_pengajuan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_pengajuan'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tbl_pengajuan/create_action'),
            'id_pengajuan' => set_value('id_pengajuan'),
            'perihal' => set_value('perihal'),
            'tanggal_pengajuan' => set_value('tanggal_pengajuan'),
            'berkas' => set_value('berkas'),
            'keterangan' => set_value('keterangan'),
            'status' => set_value('status'),
            'catatan' => set_value('catatan'),
        );
        $this->template->load('template', 'tbl_pengajuan/tbl_pengajuan_form', $data);
    }

    function upload_file(){
        $config['upload_path']          = './assets/berkas';
        $config['allowed_types']        = 'pdf|jpg|png|jpeg';
        //$config['max_size']             = 100;
        //$config['max_width']            = 1024;
        //$config['max_height']           = 768;
        $this->load->library('upload', $config);
        $this->upload->do_upload('berkas');
        return $this->upload->data();
    }

    public function create_action()
    {
        $this->_rules();
        $berkas = $this->upload_file();
        date_default_timezone_set('Asia/Makassar'); # add your city to set local time zone
        $nowHari = date('Y-m-d');

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'perihal' => $this->input->post('perihal', TRUE),
                'tanggal_pengajuan' => $this->input->post('tanggal_pengajuan', TRUE),
                'tanggal_acc' => $nowHari,
                'keterangan' => $this->input->post('keterangan', TRUE),
                'berkas' => $berkas['file_name'],
                'status' => 1,
                'catatan' => "Baru di Input",
            );

            $id_pengajuan = $this->Tbl_pengajuan_model->insert($data);
            date_default_timezone_set('Asia/Makassar'); # add your city to set local time zone
            $now = date('Y-m-d H:i:s');

            $data_update = array(
                'id_pengajuan' => $id_pengajuan,
                'tanggal_update' => $now,
                'status' => 1,
                'catatan' => "Baru di Input",
            );
            
            $this->Tbl_pengajuan_model->insert_update($data_update);
            $this->session->set_flashdata('message', 'Create Record Success !');
            redirect(site_url('tbl_pengajuan'));
        }
    }

    

    public function update($id)
    {
        $row = $this->Tbl_pengajuan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tbl_pengajuan/update_action'),
                'id_pengajuan' => set_value('id_pengajuan', $row->id_pengajuan),
                'perihal' => set_value('perihal', $row->perihal),
                'tanggal_pengajuan' => set_value('tanggal_pengajuan', $row->tanggal_pengajuan),
                'berkas' => set_value('berkas', $row->berkas),
                'status' => set_value('status', $row->status),
                'catatan' => set_value('catatan', $row->catatan),
                'keterangan' => set_value('keterangan', $row->keterangan),
            );
            $this->template->load('template', 'tbl_pengajuan/tbl_pengajuan_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_pengajuan'));
        }
    }

    public function acc_gm($id)
    {
        $row = $this->Tbl_pengajuan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'ACC',
                'action' => site_url('tbl_pengajuan/acc_gm_action'),
                'id_pengajuan' => set_value('id_pengajuan', $row->id_pengajuan),
                'perihal' => set_value('perihal', $row->perihal),
                'tanggal_pengajuan' => set_value('tanggal_pengajuan', $row->tanggal_pengajuan),
                'berkas' => set_value('berkas', $row->berkas),
                'status' => set_value('status', $row->status),
                'keterangan' => set_value('keterangan', $row->keterangan),
                'catatan' => set_value('catatan', $row->catatan),
            );
            $this->template->load('template', 'tbl_pengajuan/tbl_pengajuan_acc_gm', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_pengajuan'));
        }
    }

    public function acc_gm_action()
    {
            date_default_timezone_set('Asia/Makassar'); # add your city to set local time zone
            $now     = date('Y-m-d H:i:s');
            $nowHari = date('Y-m-d');
      
            $data = array(
                'status' => $this->input->post('status', TRUE),
                'catatan' => $this->input->post('catatan', TRUE),
                'tanggal_acc' => $nowHari,
            );


            $data_update = array(
                'id_pengajuan' => $this->input->post('id_pengajuan', TRUE),
                'tanggal_update' => $now,
                'status' => $this->input->post('status', TRUE),
                'catatan' => $this->input->post('catatan', TRUE),
            );
            
            $this->Tbl_pengajuan_model->insert_update($data_update);
            $this->Tbl_pengajuan_model->update($this->input->post('id_pengajuan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success !');
            redirect(site_url('tbl_pengajuan'));
    }

    public function acc_ceo($id)
    {
        $row = $this->Tbl_pengajuan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'ACC',
                'action' => site_url('tbl_pengajuan/acc_ceo_action'),
                'id_pengajuan' => set_value('id_pengajuan', $row->id_pengajuan),
                'keterangan' => set_value('keterangan', $row->keterangan),
                'perihal' => set_value('perihal', $row->perihal),
                'tanggal_pengajuan' => set_value('tanggal_pengajuan', $row->tanggal_pengajuan),
                'berkas' => set_value('berkas', $row->berkas),
                'status' => set_value('status', $row->status),
                'catatan' => set_value('catatan', $row->catatan),
            );
            $this->template->load('template', 'tbl_pengajuan/tbl_pengajuan_acc_ceo', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_pengajuan'));
        }
    }

    public function acc_ceo_action()
    {
            date_default_timezone_set('Asia/Makassar'); # add your city to set local time zone
            $now     = date('Y-m-d H:i:s');
            $nowHari = date('Y-m-d');
    
            $data = array(
                'status' => $this->input->post('status', TRUE),
                'catatan' => $this->input->post('catatan', TRUE),
                'tanggal_acc' => $nowHari,
            );

            $data_update = array(
                'id_pengajuan' => $this->input->post('id_pengajuan', TRUE),
                'tanggal_update' => $now,
                'status' => $this->input->post('status', TRUE),
                'catatan' => $this->input->post('catatan', TRUE),
            );
            
            $this->Tbl_pengajuan_model->insert_update($data_update);
            $this->Tbl_pengajuan_model->update($this->input->post('id_pengajuan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success !');
            redirect(site_url('tbl_pengajuan'));
    }

    public function acc_keuangan($id)
    {
        $row = $this->Tbl_pengajuan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'ACC',
                'action' => site_url('tbl_pengajuan/acc_keuangan_action'),
                'id_pengajuan' => set_value('id_pengajuan', $row->id_pengajuan),
                'keterangan' => set_value('keterangan', $row->keterangan),
                'perihal' => set_value('perihal', $row->perihal),
                'tanggal_pengajuan' => set_value('tanggal_pengajuan', $row->tanggal_pengajuan),
                'berkas' => set_value('berkas', $row->berkas),
                'status' => set_value('status', $row->status),
                'catatan' => set_value('catatan', $row->catatan),
            );
            $this->template->load('template', 'tbl_pengajuan/tbl_pengajuan_acc_keuangan', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_pengajuan'));
        }
    }

    public function acc_keuangan_action()
    {
            date_default_timezone_set('Asia/Makassar'); # add your city to set local time zone
            $now     = date('Y-m-d H:i:s');
            $nowHari = date('Y-m-d');
    
            $data = array(
                'status' => $this->input->post('status', TRUE),
                'catatan' => $this->input->post('catatan', TRUE),
                'tanggal_acc' => $nowHari,
            );

            $data_update = array(
                'id_pengajuan' => $this->input->post('id_pengajuan', TRUE),
                'tanggal_update' => $now,
                'status' => $this->input->post('status', TRUE),
                'catatan' => $this->input->post('catatan', TRUE),
            );
            
            $this->Tbl_pengajuan_model->insert_update($data_update);
            $this->Tbl_pengajuan_model->update($this->input->post('id_pengajuan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success !');
            redirect(site_url('tbl_pengajuan'));
    }

    public function update_action()
    {
        $this->_rules();
        $berkas = $this->upload_file();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_pengajuan', TRUE));
        } else {
            $data = array(
               'perihal' => $this->input->post('perihal', TRUE),
                'tanggal_pengajuan' => $this->input->post('tanggal_pengajuan', TRUE),
                'keterangan' => $this->input->post('keterangan', TRUE),
                'berkas' => $berkas['file_name'],
                'status' => 1,
                'catatan' => "Baru di Input",
            );

            $this->Tbl_pengajuan_model->update($this->input->post('id_pengajuan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success !');
            redirect(site_url('tbl_pengajuan'));
        }
    }

    public function delete($id)
    {
        $row = $this->Tbl_pengajuan_model->get_by_id($id);

        if ($row) {
            $this->Tbl_pengajuan_model->delete($id);
            $this->db->where('id_pengajuan', $id);
            $this->db->delete('tbl_update'); 
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('tbl_pengajuan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_pengajuan'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('perihal', 'perihal', 'trim|required');
        $this->form_validation->set_rules('tanggal_pengajuan', 'tanggal pengajuan', 'trim|required');
        //$this->form_validation->set_rules('berkas', 'berkas', 'trim|required');
        //$this->form_validation->set_rules('status', 'status', 'trim|required');
        //$this->form_validation->set_rules('catatan', 'catatan', 'trim|required');

        $this->form_validation->set_rules('id_pengajuan', 'id_pengajuan', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=tbl_pengajuan.doc");

        $data = array(
            'tbl_pengajuan_data' => $this->Tbl_pengajuan_model->get_all(),
            'start' => 0
        );

        $this->load->view('tbl_pengajuan/tbl_pengajuan_doc', $data);
    }

}

/* End of file Tbl_pengajuan.php */
/* Location: ./application/controllers/Tbl_pengajuan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2024-06-11 07:59:52 */
/* http://harviacode.com */