<?php
function cmb_dinamis($name,$table,$field,$pk,$selected=null,$order=null){
    $ci = get_instance();
    $cmb = "<select name='$name' class='form-control'>";
    if($order){
        $ci->db->order_by($field,$order);
    }
    $data = $ci->db->get($table)->result();
    foreach ($data as $d){
        $cmb .="<option value='".$d->$pk."'";
        $cmb .= $selected==$d->$pk?" selected='selected'":'';
        $cmb .=">".  strtoupper($d->$field)."</option>";
    }
    $cmb .="</select>";
    return $cmb;  
}

function select2_dinamis($name,$table,$field,$placeholder){
    $ci = get_instance();
    $select2 = '<select name="'.$name.'" class="form-control select2 select2-hidden-accessible" multiple="" 
               data-placeholder="'.$placeholder.'" style="width: 100%;" tabindex="-1" aria-hidden="true">';
    $data = $ci->db->get($table)->result();
    foreach ($data as $row){
        $select2.= ' <option>'.$row->$field.'</option>';
    }
    $select2 .='</select>';
    return $select2;
}

function datalist_dinamis($name,$table,$field,$value=null){
    $ci = get_instance();
    $string = '<input value="'.$value.'" name="'.$name.'" list="'.$name.'" class="form-control">
    <datalist id="'.$name.'">';
    $data = $ci->db->get($table)->result();
    foreach ($data as $row){
        $string.='<option value="'.$row->$field.'">';
    }
    $string .='</datalist>';
    return $string;
}

function rename_string_is_aktif($string){
        return $string=='y'?'Aktif':'Tidak Aktif';
    }

    function tgl_indo($tanggal){
        $bulan = array (
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $tanggal);
        
        // variabel pecahkan 0 = tanggal
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tahun
     
        return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
    }

    function getUserName($status) {
        switch($status) {
            case 1:
                return 'Admin';
            case 2:
            case 3:
            case 4:
                return 'GM Smartphone';
            case 5:
            case 6:
            case 7:
                return 'CEO';
            case 8:
            case 9:
            case 10:
                return 'Manager Keuangan';
            default:
                return 'Unknown';
        }
    }

    
function rename_status($statusCode) {
    $status = [
        1 => '<button class="btn btn-sm btn-info">Input Admin</button>',
        2 => '<button class="btn btn-sm btn-danger">Ditolak (GM Smartphone)</button>',
        3 => '<button class="btn btn-sm btn-warning">Revisi (GM Smartphone)</button>',
        4 => '<button class="btn btn-sm btn-success">Acc (GM Smartphone)</button>',
        5 => '<button class="btn btn-sm btn-danger">Ditolak (CEO)</button>',
        6 => '<button class="btn btn-sm btn-warning">Revisi (CEO)</button>',
        7 => '<button class="btn btn-sm btn-success">Acc (CEO)</button>',
        8 => '<button class="btn btn-sm btn-danger">Ditolak (Manager Keuangan)</button>',
        9 => '<button class="btn btn-sm btn-warning">Revisi Manager Keuangan</button>',
        10 => '<button class="btn btn-sm btn-success">Acc (Manager Keuangan)</button>',
    ];
    
    // Contoh penggunaan:
    return $status[$statusCode];
}
    

function is_login(){
    $ci = get_instance();
    if(!$ci->session->userdata('id_users')){
        redirect('auth');
    }else{
        $modul = $ci->uri->segment(1);
        
        $id_user_level = $ci->session->userdata('id_user_level');
        // dapatkan id menu berdasarkan nama controller
        $menu = $ci->db->get_where('tbl_menu',array('url'=>$modul))->row_array();
        $id_menu = $menu['id_menu'];
        // chek apakah user ini boleh mengakses modul ini
       
    }
}

function alert($class,$title,$description){
    return '<div class="alert '.$class.' alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-ban"></i> '.$title.'</h4>
                '.$description.'
              </div>';
}

// untuk chek akses level pada modul peberian akses
function checked_akses($id_user_level,$id_menu){
    $ci = get_instance();
    $ci->db->where('id_user_level',$id_user_level);
    $ci->db->where('id_menu',$id_menu);
    $data = $ci->db->get('tbl_hak_akses');
    if($data->num_rows()>0){
        return "checked='checked'";
    }
}


function autocomplate_json($table,$field){
    $ci = get_instance();
    $ci->db->like($field, $_GET['term']);
    $ci->db->select($field);
    $collections = $ci->db->get($table)->result();
    foreach ($collections as $collection) {
        $return_arr[] = $collection->$field;
    }
    echo json_encode($return_arr);
}

function get_user_role($status) {
    switch ($status) {
        case 1:
            return 'Admin';
        case 2:
        case 3:
        case 4:
            return 'GM Smartphone';
        case 5:
        case 6:
        case 7:
            return 'CEO';
        case 8:
        case 9:
        case 10:
            return 'Manager Keuangan';
        default:
            return 'Unknown Role';
    }
}

function get_action_buttons($tbl_pengajuan, $user_level) {
    $buttons = '';

    // Jika user level adalah Admin
    if ($user_level == 1) {
        if (in_array($tbl_pengajuan->status, [1, 3, 6, 9])) {
            $buttons .= anchor(site_url('tbl_pengajuan/update/' . $tbl_pengajuan->id_pengajuan), 
                               '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', 
                               'class="btn btn-danger btn-sm"'); 
            $buttons .= '  '; 
            $buttons .= anchor(site_url('tbl_pengajuan/delete/' . $tbl_pengajuan->id_pengajuan), 
                               '<i class="fa fa-trash-o" aria-hidden="true"></i>', 
                               'class="btn btn-danger btn-sm" Delete onclick="javascript: return confirm(\'Are You Sure ?\')"');
        }
    }

    // Jika user level adalah GM Smartphone
    if ($user_level == 2) {
        if ($tbl_pengajuan->status == 1) {
            $buttons .= '<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalGm' . $tbl_pengajuan->id_pengajuan . '"><i class="fa fa-check"></i></button>';
        }
    }

    // Jika user level adalah CEO
    if ($user_level == 3) {
        if ($tbl_pengajuan->status == 4) {
            $buttons .= '<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalCeo' . $tbl_pengajuan->id_pengajuan . '"><i class="fa fa-check"></i></button>';
        }
    }

    // Jika user level adalah Manager Keuangan
    if ($user_level == 4) {
        if ($tbl_pengajuan->status == 7) {
            $buttons .= '<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalKeuangan' . $tbl_pengajuan->id_pengajuan . '"><i class="fa fa-check"></i></button>';
        }
    }

    return $buttons;
}

