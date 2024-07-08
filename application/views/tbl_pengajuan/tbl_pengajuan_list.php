<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<link href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap4.css" rel="stylesheet" />
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap4.js"></script>

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
        <div style="width: 100%;">
        <div class="table-responsive">
        <table class="table table-bordered" id="example" style="margin-bottom: 10px">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Perihal</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Keterangan</th>
                    <th>File</th>
                    <th>Status</th>
                    <th>Catatan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach ($tbl_pengajuan_data as $tbl_pengajuan)
            {
                ?>
                <tr>
			<td><?php echo ++$start ?></td>
			<td><?php echo $tbl_pengajuan->perihal ?></td>
			<td><?php echo tgl_indo($tbl_pengajuan->tanggal_pengajuan) ?></td>
            <td><?php echo $tbl_pengajuan->keterangan ?></td>
			<td><?php echo anchor(base_url('assets/berkas/'.$tbl_pengajuan->berkas),'<i class="fa fa-eye" aria-hidden="true"> Lihat File</i>','class="btn btn-primary btn-sm" target="_blank"'); ?></td>
			<td><button class="btn btn-sm btn-success"><?php echo rename_status($tbl_pengajuan->status) ?></button></td>
			<td><?php echo $tbl_pengajuan->catatan ?></td>
			<td style="text-align:center" >
				<?php 
				//echo anchor(site_url('tbl_pengajuan/read/'.$tbl_pengajuan->id_pengajuan),'<i class="fa fa-eye" aria-hidden="true"></i>','class="btn btn-danger btn-sm"'); 
				//echo '  '; 
                if($this->session->userdata('id_user_level') == 1) {
                    if(($tbl_pengajuan->status == 1) || ($tbl_pengajuan->status == 3) || ($tbl_pengajuan->status == 6) || ($tbl_pengajuan->status == 9)) {
                        echo anchor(site_url('tbl_pengajuan/update/'.$tbl_pengajuan->id_pengajuan),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm"'); 
                        echo '  '; 
                        echo anchor(site_url('tbl_pengajuan/delete/'.$tbl_pengajuan->id_pengajuan),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" Delete onclick="javascript: return confirm(\'Are You Sure ?\')"'); 
                    }
                }
                if($this->session->userdata('id_user_level') == 2) {
                    if($tbl_pengajuan->status == 1) {
                       echo '<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalGm'.$tbl_pengajuan->id_pengajuan.'"><i class="fa fa-check"></i></button>';
                    }
                }
                if($this->session->userdata('id_user_level') == 3) {
                    if($tbl_pengajuan->status == 4) {
                        echo '<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalCeo'.$tbl_pengajuan->id_pengajuan.'"><i class="fa fa-check"></i></button>'; 
                    }
                }
                if($this->session->userdata('id_user_level') == 4) {
                    if($tbl_pengajuan->status == 7) {
                        echo '<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalKeuangan'.$tbl_pengajuan->id_pengajuan.'"><i class="fa fa-check"></i></button>';
                    }
                }
				?>
			</td>
		</tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        </div>
    </div>
        </div>
                    </div>
            </div>
            </div>
    </section>
</div>
<script>
    $(document).ready(function () {
                $('#example').DataTable( {
            responsive: true
        } );
    });
</script>

<!-- ModalGm -->
<?php foreach ($tbl_pengajuan_data as $tbl_pengajuan) : ?>
<div id="modalGm<?php echo $tbl_pengajuan->id_pengajuan ?>" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- konten modal-->
			<div class="modal-content">
				<!-- heading modal -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
                    <?php $row = $this->Tbl_pengajuan_model->get_by_id($tbl_pengajuan->id_pengajuan); ?>
					<h4 class="modal-title">Approval Pengajuan <?php echo $row->perihal ?></h4>
				</div>
				<!-- body modal -->
				<div class="modal-body">
                    <form action="<?php echo site_url('tbl_pengajuan/acc_gm_action') ?>" method="post" enctype='multipart/form-data'>
                    <table class='table table-bordered'>
                        <tr>
                            <td width='200'>Perihal </td>
                            <td>
                                <?php echo $row->perihal ?>
                            </td>
                        </tr>

                        <tr>
                            <td width='200'>Tanggal Pengajuan </td>
                            <td>
                                <?php echo tgl_indo($row->tanggal_pengajuan) ?>
                            </td>
                        </tr>

                        <tr>
                            <td width='200'>File </td>
                            <td>
                                <?php echo anchor(base_url('assets/berkas/'.$row->berkas),'<i class="fa fa-eye" aria-hidden="true"> Lihat File</i>','class="btn btn-primary btn-sm" target="_blank"'); ?>
                            </td>
                        </tr>

                        <tr>
                            <td width='200'>Status </td>
                            <td>
                            <button class="btn btn-sm btn-success"><?php echo rename_status($row->status) ?></button>
                            </td>
                        </tr>
                        
                        <tr>
                            <td width='200'>Approval </td>
                            <td>
                                <input type="radio" name="status" value="2" id="status2" required>
                                <label for="status2">Ditolak</label><br>
                                <input type="radio" name="status" value="3" id="status3">
                                <label for="status3">Revisi</label><br>
                                <input type="radio" name="status" value="4" id="status4">
                                <label for="status4">Acc</label>
                            </td>
                        </tr>
        
                        <tr>
                            <td width='200'>Catatan </td>
                            <td>
                                <textarea class="form-control" name="catatan" id="catatan" required></textarea>
                            </td>
                        </tr>
        
                        <tr>
                            <td></td>
                            <td>
                                <input type="hidden" name="id_pengajuan" value="<?php echo $row->id_pengajuan; ?>" /> 
                                <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> Submit</button>
                            </td>
                        </tr>
                    </table>
                </form>
				</div>
				<!-- footer modal -->
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
				</div>
			</div>
		</div>
</div>
<?php endforeach ?>
<!-- End Modal -->

<!-- ModalCeo -->
<?php foreach ($tbl_pengajuan_data as $tbl_pengajuan) : ?>
<div id="modalCeo<?php echo $tbl_pengajuan->id_pengajuan ?>" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- konten modal-->
			<div class="modal-content">
				<!-- heading modal -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
                    <?php $row = $this->Tbl_pengajuan_model->get_by_id($tbl_pengajuan->id_pengajuan); ?>
					<h4 class="modal-title">Approval Pengajuan <?php echo $row->perihal ?></h4>
				</div>
				<!-- body modal -->
				<div class="modal-body">
                    <form action="<?php echo site_url('tbl_pengajuan/acc_ceo_action') ?>" method="post" enctype='multipart/form-data'>
                    <table class='table table-bordered'>
                        <tr>
                            <td width='200'>Perihal </td>
                            <td>
                                <?php echo $row->perihal ?>
                            </td>
                        </tr>

                        <tr>
                            <td width='200'>Tanggal Pengajuan </td>
                            <td>
                                <?php echo tgl_indo($row->tanggal_pengajuan) ?>
                            </td>
                        </tr>

                        <tr>
                            <td width='200'>File </td>
                            <td>
                                <?php echo anchor(base_url('assets/berkas/'.$row->berkas),'<i class="fa fa-eye" aria-hidden="true"> Lihat File</i>','class="btn btn-primary btn-sm" target="_blank"'); ?>
                            </td>
                        </tr>

                        <tr>
                            <td width='200'>Status </td>
                            <td>
                            <button class="btn btn-sm btn-success"><?php echo rename_status($row->status) ?></button>
                            </td>
                        </tr>
                        
                        <tr>
                            <td width='200'>Approval </td>
                            <td>
                                <input type="radio" name="status" value="5" id="status2" required>
                                <label for="status2">Ditolak</label><br>
                                <input type="radio" name="status" value="6" id="status3">
                                <label for="status3">Revisi</label><br>
                                <input type="radio" name="status" value="7" id="status4">
                                <label for="status4">Acc</label>
                            </td>
                        </tr>
        
                        <tr>
                            <td width='200'>Catatan </td>
                            <td>
                                <textarea class="form-control" name="catatan" id="catatan" required></textarea>
                            </td>
                        </tr>
        
                        <tr>
                            <td></td>
                            <td>
                                <input type="hidden" name="id_pengajuan" value="<?php echo $row->id_pengajuan; ?>" /> 
                                <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> Submit</button>
                            </td>
                        </tr>
                    </table>
                </form>
				</div>
				<!-- footer modal -->
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
				</div>
			</div>
		</div>
</div>
<?php endforeach ?>
<!-- End Modal -->

<!-- ModalKeuangan -->
<?php foreach ($tbl_pengajuan_data as $tbl_pengajuan) : ?>
<div id="modalKeuangan<?php echo $tbl_pengajuan->id_pengajuan ?>" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- konten modal-->
			<div class="modal-content">
				<!-- heading modal -->
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
                    <?php $row = $this->Tbl_pengajuan_model->get_by_id($tbl_pengajuan->id_pengajuan); ?>
					<h4 class="modal-title">Approval Pengajuan <?php echo $row->perihal ?></h4>
				</div>
				<!-- body modal -->
				<div class="modal-body">
                    <form action="<?php echo site_url('tbl_pengajuan/acc_ceo_action') ?>" method="post" enctype='multipart/form-data'>
                    <table class='table table-bordered'>
                        <tr>
                            <td width='200'>Perihal </td>
                            <td>
                                <?php echo $row->perihal ?>
                            </td>
                        </tr>

                        <tr>
                            <td width='200'>Tanggal Pengajuan </td>
                            <td>
                                <?php echo tgl_indo($row->tanggal_pengajuan) ?>
                            </td>
                        </tr>

                        <tr>
                            <td width='200'>File </td>
                            <td>
                                <?php echo anchor(base_url('assets/berkas/'.$row->berkas),'<i class="fa fa-eye" aria-hidden="true"> Lihat File</i>','class="btn btn-primary btn-sm" target="_blank"'); ?>
                            </td>
                        </tr>

                        <tr>
                            <td width='200'>Status </td>
                            <td>
                            <button class="btn btn-sm btn-success"><?php echo rename_status($row->status) ?></button>
                            </td>
                        </tr>
                        
                        <tr>
                            <td width='200'>Approval </td>
                            <td>
                                <input type="radio" name="status" value="8" id="status2" required>
                                <label for="status2">Ditolak</label><br>
                                <input type="radio" name="status" value="9" id="status3">
                                <label for="status3">Revisi</label><br>
                                <input type="radio" name="status" value="10" id="status4">
                                <label for="status4">Acc</label>
                            </td>
                        </tr>
        
                        <tr>
                            <td width='200'>Catatan </td>
                            <td>
                                <textarea class="form-control" name="catatan" id="catatan" required></textarea>
                            </td>
                        </tr>
        
                        <tr>
                            <td></td>
                            <td>
                                <input type="hidden" name="id_pengajuan" value="<?php echo $row->id_pengajuan; ?>" /> 
                                <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> Submit</button>
                            </td>
                        </tr>
                    </table>
                </form>
				</div>
				<!-- footer modal -->
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
				</div>
			</div>
		</div>
</div>
<?php endforeach ?>
<!-- End Modal -->