<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tbl_pengajuan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Tbl_pengajuan_model');
        $this->load->model('Tbl_nohp_model');
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


    public function kirim_wa($target, $pesan){
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://api.fonnte.com/send',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => array(
        'target' => $target,
        'message' => $pesan, 
        'countryCode' => '62', //optional
        ),
          CURLOPT_HTTPHEADER => array(
            'Authorization: R-WQbHaFWhQRxzDGb2LH' //change TOKEN to your actual token
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        return $response;
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
        $rowHp = $this->Tbl_pengajuan_model->get_nomer();

        $noHpGM = $rowHp->no_gm;

        $tanggalPengajuan = $this->input->post('tanggal_pengajuan', TRUE);
        $perihal = $this->input->post('perihal', TRUE);
        $pesan = 'Halo GM Smartphone, Ada Pengajuan baru pada tanggal '.tgl_indo($tanggalPengajuan).' dengan perihal '.$perihal.', silakan cek website https://beban.gskstore.id/, terimakasih.';
        
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

            $this->kirim_wa($noHpGM, $pesan);
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
            redirect(site_url('welcome'));
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

    public function update_nohp($id)
    {
        
        $row = $this->Tbl_nohp_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('tbl_pengajuan/update_action_nohp'),
                'id_nohp' => set_value('id_nohp', $row->id_nohp),
                'no_admin' => set_value('no_admin', $row->no_admin),
                'no_ceo' => set_value('no_ceo', $row->no_ceo),
                'no_gm' => set_value('no_gm', $row->no_gm),
                'no_keuangan' => set_value('no_keuangan', $row->no_keuangan),
	    );
            $this->template->load('template','tbl_nohp/tbl_nohp_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('tbl_pengajuan/no_hp'));
        }
    }

    public function update_action_nohp() 
    {
        
            $data = array(
		'no_admin' => $this->input->post('no_admin',TRUE),
		'no_ceo' => $this->input->post('no_ceo',TRUE),
		'no_gm' => $this->input->post('no_gm',TRUE),
		'no_keuangan' => $this->input->post('no_keuangan',TRUE),
	    );

            $this->Tbl_nohp_model->update($this->input->post('id_nohp', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('tbl_pengajuan/no_hp'));
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
            redirect(site_url('welcome'));
        }
    }

    public function acc_gm_action()
    {

            $rowHp      = $this->Tbl_pengajuan_model->get_nomer();
            $noHpCeo    = $rowHp->no_ceo;
            $noHpAdmin  = $rowHp->no_admin;

            $rowPengajuan = $this->Tbl_pengajuan_model->get_by_id($this->input->post('id_pengajuan'));

            $tanggalPengajuan   = $rowPengajuan->tanggal_pengajuan;

            $perihal            = $rowPengajuan->perihal;
            $pesanAcc           = 'Halo CEO, Ada pengajuan yang telah di Disetujui oleh GM Smartphone pada tanggal '.tgl_indo($tanggalPengajuan).' dengan perihal '.$perihal.', silakan cek website https://beban.gskstore.id/, terimakasih.';
            $pesanRevisi        = 'Halo Admin, Ada pengajuan yang Harus direvisi, oleh GM Smartphone pada tanggal '.tgl_indo($tanggalPengajuan).' dengan perihal '.$perihal.', silakan cek website https://beban.gskstore.id/, terimakasih.';
            $pesanTolak         = 'Halo Admin, Ada pengajuan yang ditolak, oleh GM Smartphone pada tanggal '.tgl_indo($tanggalPengajuan).' dengan perihal '.$perihal.', silakan cek website https://beban.gskstore.id/, terimakasih.';

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

            if($this->input->post('status', TRUE) == 2) {
                $this->kirim_wa($noHpAdmin, $pesanTolak);
            } elseif($this->input->post('status', TRUE) == 3) {
                $this->kirim_wa($noHpAdmin, $pesanRevisi);
            } elseif($this->input->post('status', TRUE) == 4) {
                $this->kirim_wa($noHpCeo, $pesanAcc);
            }
            
            $this->Tbl_pengajuan_model->insert_update($data_update);
            $this->Tbl_pengajuan_model->update($this->input->post('id_pengajuan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success !');
            redirect(site_url('welcome'));
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
            redirect(site_url('welcome'));
        }
    }

    public function acc_ceo_action()
    {
            $rowHp          = $this->Tbl_pengajuan_model->get_nomer();
            $noHpKeuangan   = $rowHp->no_keuangan;
            $noHpAdmin      = $rowHp->no_admin;
            $noGM           = $rowHp->no_gm;

            $rowPengajuan = $this->Tbl_pengajuan_model->get_by_id($this->input->post('id_pengajuan'));

            $tanggalPengajuan   = $rowPengajuan->tanggal_pengajuan;

            $perihal            = $rowPengajuan->perihal;
            $pesanAcc           = 'Halo Manager Keuangan, Ada pengajuan yang telah di Disetujui oleh CEO pada tanggal '.tgl_indo($tanggalPengajuan).' dengan perihal '.$perihal.', silakan cek website https://beban.gskstore.id/, terimakasih.';
            $pesanRevisi        = 'Halo Admin, Ada pengajuan yang Harus direvisi, oleh CEO pada tanggal '.tgl_indo($tanggalPengajuan).' dengan perihal '.$perihal.', silakan cek website https://beban.gskstore.id/, terimakasih.';
            $pesanRevisiGM      = 'Halo GM Smartphone, Ada pengajuan yang Harus direvisi, oleh CEO pada tanggal '.tgl_indo($tanggalPengajuan).' dengan perihal '.$perihal.', silakan cek website https://beban.gskstore.id/, terimakasih.';
            $pesanTolak         = 'Halo Admin, Ada pengajuan yang ditolak, oleh CEO pada tanggal '.tgl_indo($tanggalPengajuan).' dengan perihal '.$perihal.', silakan cek website https://beban.gskstore.id/, terimakasih.';
            $pesanTolakGM       = 'Halo GM Smartphone, Ada pengajuan yang ditolak, oleh CEO pada tanggal '.tgl_indo($tanggalPengajuan).' dengan perihal '.$perihal.', silakan cek website https://beban.gskstore.id/, terimakasih.';

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

            if($this->input->post('status', TRUE) == 5) {
                $this->kirim_wa($noGM, $pesanTolakGM);
                $this->kirim_wa($noHpAdmin, $pesanTolak);
            } elseif($this->input->post('status', TRUE) == 6) {
                $this->kirim_wa($noGM, $pesanRevisiGM);
                $this->kirim_wa($noHpAdmin, $pesanRevisi);
            } elseif($this->input->post('status', TRUE) == 7) {
                $this->kirim_wa($noHpKeuangan, $pesanAcc);
            }
            
            $this->Tbl_pengajuan_model->insert_update($data_update);
            $this->Tbl_pengajuan_model->update($this->input->post('id_pengajuan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success !');
            redirect(site_url('welcome'));
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
            redirect(site_url('welcome'));
        }
    }

    public function acc_keuangan_action()
    {
            $rowHp          = $this->Tbl_pengajuan_model->get_nomer();
            $noCeo          = $rowHp->no_ceo;
            $noGM           = $rowHp->no_gm;
            $noHpAdmin      = $rowHp->no_admin;

            $rowPengajuan = $this->Tbl_pengajuan_model->get_by_id($this->input->post('id_pengajuan'));

            $tanggalPengajuan   = $rowPengajuan->tanggal_pengajuan;

            $perihal            = $rowPengajuan->perihal;
            $pesanAcc           = 'Halo Admin, Ada pengajuan yang telah di Disetujui oleh Manager Keuangan pada tanggal '.tgl_indo($tanggalPengajuan).' dengan perihal '.$perihal.', silakan cek website https://beban.gskstore.id/, terimakasih.';
            $pesanRevisi        = 'Halo Admin, Ada pengajuan yang Harus direvisi, oleh Manager Keuangan pada tanggal '.tgl_indo($tanggalPengajuan).' dengan perihal '.$perihal.', silakan cek website https://beban.gskstore.id/, terimakasih.';
            $pesanRevisiGM      = 'Halo GM Smartphone, Ada pengajuan yang Harus direvisi, oleh Manager Keuangan pada tanggal '.tgl_indo($tanggalPengajuan).' dengan perihal '.$perihal.', silakan cek website https://beban.gskstore.id/, terimakasih.';
            $pesanRevisiCEO     = 'Halo CEO, Ada pengajuan yang Harus direvisi, oleh Manager Keuangan pada tanggal '.tgl_indo($tanggalPengajuan).' dengan perihal '.$perihal.', silakan cek website https://beban.gskstore.id/, terimakasih.';
            $pesanTolak         = 'Halo Admin, Ada pengajuan yang ditolak, oleh Manager Keuangan pada tanggal '.tgl_indo($tanggalPengajuan).' dengan perihal '.$perihal.', silakan cek website https://beban.gskstore.id/, terimakasih.';
            $pesanTolakGM       = 'Halo GM Smartphone, Ada pengajuan yang ditolak, oleh Manager Keuangan pada tanggal '.tgl_indo($tanggalPengajuan).' dengan perihal '.$perihal.', silakan cek website https://beban.gskstore.id/, terimakasih.';
            $pesanTolakCEO      = 'Halo CEO, Ada pengajuan yang ditolak, oleh Manager Keuangan pada tanggal '.tgl_indo($tanggalPengajuan).' dengan perihal '.$perihal.', silakan cek website https://beban.gskstore.id/, terimakasih.';

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

            if($this->input->post('status', TRUE) == 8) {
                $this->kirim_wa($noCeo, $pesanTolakCEO);
                $this->kirim_wa($noGM, $pesanTolakGM);
                $this->kirim_wa($noHpAdmin, $pesanTolak);
            } elseif($this->input->post('status', TRUE) == 9) {
                $this->kirim_wa($noGM, $pesanRevisiGM);
                $this->kirim_wa($noCeo, $pesanRevisiCEO);
                $this->kirim_wa($noHpAdmin, $pesanRevisi);
            } elseif($this->input->post('status', TRUE) == 10) {
                $this->kirim_wa($noHpAdmin, $pesanAcc);
            }
            
            $this->Tbl_pengajuan_model->insert_update($data_update);
            $this->Tbl_pengajuan_model->update($this->input->post('id_pengajuan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success !');
            redirect(site_url('welcome'));
    }

    public function update_action()
    {
        $rowHp = $this->Tbl_pengajuan_model->get_nomer();

        $noHpGM = $rowHp->no_gm;

        $tanggalPengajuan = $this->input->post('tanggal_pengajuan', TRUE);
        $perihal = $this->input->post('perihal', TRUE);
        $pesan = 'Halo GM Smartphone, Ada update pengajuan yang pada tanggal '.tgl_indo($tanggalPengajuan).' dengan perihal '.$perihal.', silakan cek website https://beban.gskstore.id/, terimakasih.';
        
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
            
            $this->kirim_wa($noHpGM, $pesan);

            $this->Tbl_pengajuan_model->update($this->input->post('id_pengajuan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success !');
            redirect(site_url('welcome'));
        }
    }

    public function delete($id)
    {
        $row = $this->Tbl_pengajuan_model->get_by_id($id);
    
        if ($row) {
            // Dapatkan path berkas dari database
            $file_path = FCPATH . 'assets/berkas/' . $row->berkas;
    
            // Cek apakah berkas ada, kemudian hapus
            if (file_exists($file_path)) {
                unlink($file_path);
            }
    
            // Hapus data dari tbl_pengajuan
            $this->Tbl_pengajuan_model->delete($id);
            
            // Hapus data terkait di tbl_update
            $this->db->where('id_pengajuan', $id);
            $this->db->delete('tbl_update');
    
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('tbl_pengajuan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('welcome'));
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

    public function filter()
    { 
        $status1 = $this->input->get('status1');
        $status2 = $this->input->get('status2');

        $data = array(
            'start'          => 0,
            'status1'        => $status1,
            'data_status1'   => $this->Tbl_pengajuan_model->get_all_by_status($status1),
            'data_status2'   => $this->Tbl_pengajuan_model->get_all_by_status_between($status2),
            'data_revisi'    => $this->Tbl_pengajuan_model->get_all_by_status_revisi(),
            'data_ditolak'   => $this->Tbl_pengajuan_model->get_all_by_status_ditolak(),
            'tbl_pengajuan_data' => $this->Tbl_pengajuan_model->get_all_laporan(),
        );

        $this->template->load('template', 'tbl_pengajuan/tbl_pengajuan_filter', $data);
    }

    public function filter_2()
    { 
        $status1 = $this->input->get('status1');

        $data = array(
            'start'          => 0,
            'status1'        => $status1,
            'tbl_pengajuan_data'   => $this->Tbl_pengajuan_model->get_all_by_status_2($status1),
        );

        $this->template->load('template', 'tbl_pengajuan/tbl_pengajuan_list', $data);
    }

    public function no_hp()
    { 

        $data = array(
            'start'          => 0,
            'tbl_nohp_data'   => $this->Tbl_nohp_model->get_all(),
        );

        $this->template->load('template', 'tbl_nohp/tbl_nohp_list', $data);
    }

}

/* End of file Tbl_pengajuan.php */
/* Location: ./application/controllers/Tbl_pengajuan.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2024-06-11 07:59:52 */
/* http://harviacode.com */