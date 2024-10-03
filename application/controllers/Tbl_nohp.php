<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tbl_nohp extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Tbl_nohp_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->uri->segment(3));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . '.php/c_url/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'index.php/tbl_nohp/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'index.php/tbl_nohp/index/';
            $config['first_url'] = base_url() . 'index.php/tbl_nohp/index/';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = FALSE;
        $config['total_rows'] = $this->Tbl_nohp_model->total_rows($q);
        $tbl_nohp = $this->Tbl_nohp_model->get_limit_data($config['per_page'], $start, $q);
        $config['full_tag_open'] = '<ul class="pagination pagination-sm no-margin pull-right">';
        $config['full_tag_close'] = '</ul>';
        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'tbl_nohp_data' => $tbl_nohp,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->template->load('template','tbl_nohp/tbl_nohp_list', $data);
    }

    public function read($id) 
    {
        $row = $this->Tbl_nohp_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_nohp' => $row->id_nohp,
		'no_admin' => $row->no_admin,
		'no_ceo' => $row->no_ceo,
		'no_gm' => $row->no_gm,
		'no_keuangan' => $row->no_keuangan,
	    );
            $this->template->load('template','tbl_nohp/tbl_nohp_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_nohp'));
        }
    }

    public function create() 
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('tbl_nohp/create_action'),
	    'id_nohp' => set_value('id_nohp'),
	    'no_admin' => set_value('no_admin'),
	    'no_ceo' => set_value('no_ceo'),
	    'no_gm' => set_value('no_gm'),
	    'no_keuangan' => set_value('no_keuangan'),
	);
        $this->template->load('template','tbl_nohp/tbl_nohp_form', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'no_admin' => $this->input->post('no_admin',TRUE),
		'no_ceo' => $this->input->post('no_ceo',TRUE),
		'no_gm' => $this->input->post('no_gm',TRUE),
		'no_keuangan' => $this->input->post('no_keuangan',TRUE),
	    );

            $this->Tbl_nohp_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('tbl_nohp'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Tbl_nohp_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tbl_nohp/update_action'),
		'id_nohp' => set_value('id_nohp', $row->id_nohp),
		'no_admin' => set_value('no_admin', $row->no_admin),
		'no_ceo' => set_value('no_ceo', $row->no_ceo),
		'no_gm' => set_value('no_gm', $row->no_gm),
		'no_keuangan' => set_value('no_keuangan', $row->no_keuangan),
	    );
            $this->template->load('template','tbl_nohp/tbl_nohp_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_nohp'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_nohp', TRUE));
        } else {
            $data = array(
		'no_admin' => $this->input->post('no_admin',TRUE),
		'no_ceo' => $this->input->post('no_ceo',TRUE),
		'no_gm' => $this->input->post('no_gm',TRUE),
		'no_keuangan' => $this->input->post('no_keuangan',TRUE),
	    );

            $this->Tbl_nohp_model->update($this->input->post('id_nohp', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tbl_nohp'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Tbl_nohp_model->get_by_id($id);

        if ($row) {
            $this->Tbl_nohp_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('tbl_nohp'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_nohp'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('no_admin', 'no admin', 'trim|required');
	$this->form_validation->set_rules('no_ceo', 'no ceo', 'trim|required');
	$this->form_validation->set_rules('no_gm', 'no gm', 'trim|required');
	$this->form_validation->set_rules('no_keuangan', 'no keuangan', 'trim|required');

	$this->form_validation->set_rules('id_nohp', 'id_nohp', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Tbl_nohp.php */
/* Location: ./application/controllers/Tbl_nohp.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2024-10-03 02:14:56 */
/* http://harviacode.com */