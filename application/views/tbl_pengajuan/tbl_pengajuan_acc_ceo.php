<div class="content-wrapper">
	<section class="content">
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<h3 class="box-title"><?php echo strtoupper($button) ?> DATA PENGAJUAN</h3>
			</div>
			<form action="<?php echo $action; ?>" method="post" enctype='multipart/form-data'>
				<table class='table table-bordered'>
                    <tr>
						<td width='200'>Perihal </td>
                        <td>
                            <?php echo $perihal ?>
                        </td>
					</tr>

                    <tr>
						<td width='200'>Tanggal Pengajuan </td>
                        <td>
                            <?php echo tgl_indo($tanggal_pengajuan) ?>
                        </td>
					</tr>

                    <tr>
						<td width='200'>File </td>
                        <td>
                            <?php echo anchor(base_url('assets/berkas/'.$berkas),'<i class="fa fa-eye" aria-hidden="true"> Lihat File</i>','class="btn btn-primary btn-sm" target="_blank"'); ?>
                        </td>
					</tr>

                    <tr>
						<td width='200'>Status </td>
                        <td>
                        <button class="btn btn-sm btn-success"><?php echo rename_status($status) ?></button>
                        </td>
					</tr>
                    
					<tr>
						<td width='200'>Status </td>
                        <td>
                            <select name="status" id="status" class="form-control" required>
                                <option value="">-- Silakan Pilih --</option>
                                <option value="5">Ditolak</option>
                                <option value="6">Revisi</option>
                                <option value="7">Acc</option>
                            </select>
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
							<input type="hidden" name="id_pengajuan" value="<?php echo $id_pengajuan; ?>" /> 
							<button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
							<a href="<?php echo site_url('tbl_pengajuan') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a>
						</td>
					</tr>
				</table>
			</form>
		</div>
	</section>
</div>