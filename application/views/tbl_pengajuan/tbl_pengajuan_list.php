<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">KELOLA DATA PENGAJUAN</h3>
                    </div>
        
        <div class="box-body">
            <div class='row'>
            <div class='col-md-9'>
            <div style="padding-bottom: 10px;">
                <?php if($this->session->userdata('id_user_level') == 1) { ?>
                    <?php echo anchor(site_url('tbl_pengajuan/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> Tambah Data', 'class="btn btn-danger btn-sm"'); ?>
                <?php } ?>
            </div>
            </div>
            <div class='col-md-3'>
            <form action="<?php echo site_url('tbl_pengajuan/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('tbl_pengajuan'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
            </div>
        
   
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                
            </div>
        </div>
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
                <th>Perihal</th>
                <th>Tanggal Pengajuan</th>
                <th>File</th>
                <th>Status</th>
                <th>Catatan</th>
                <th>Action</th>
            </tr><?php
            foreach ($tbl_pengajuan_data as $tbl_pengajuan)
            {
                ?>
                <tr>
			<td width="10px"><?php echo ++$start ?></td>
			<td><?php echo $tbl_pengajuan->perihal ?></td>
			<td><?php echo tgl_indo($tbl_pengajuan->tanggal_pengajuan) ?></td>
			<td><?php echo anchor(base_url('assets/berkas/'.$tbl_pengajuan->berkas),'<i class="fa fa-eye" aria-hidden="true"> Lihat File</i>','class="btn btn-primary btn-sm" target="_blank"'); ?></td>
			<td><?php echo rename_status($tbl_pengajuan->status) ?></td>
			<td><?php echo $tbl_pengajuan->catatan ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				//echo anchor(site_url('tbl_pengajuan/read/'.$tbl_pengajuan->id_pengajuan),'<i class="fa fa-eye" aria-hidden="true"></i>','class="btn btn-danger btn-sm"'); 
				//echo '  '; 
                if($this->session->userdata('id_user_level') == 1) {
                    if(($tbl_pengajuan->status == 1) && ($tbl_pengajuan->status == 99)) {
                        echo anchor(site_url('tbl_pengajuan/update/'.$tbl_pengajuan->id_pengajuan),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm"'); 
                        echo '  '; 
                        echo anchor(site_url('tbl_pengajuan/delete/'.$tbl_pengajuan->id_pengajuan),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" Delete onclick="javascript: return confirm(\'Are You Sure ?\')"'); 
                    }
                }
                if($this->session->userdata('id_user_level') == 2) {
                    if($tbl_pengajuan->status == 1) {
                        echo anchor(site_url('tbl_pengajuan/acc_gm/'.$tbl_pengajuan->id_pengajuan),'<i class="fa fa-check" aria-hidden="true"></i>','class="btn btn-danger btn-sm"'); 
                    }
                }
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
        </div>
                    </div>
            </div>
            </div>
    </section>
</div>