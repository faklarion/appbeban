<div class="content-wrapper">
	<section class="content">
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<h3 class="box-title"><?php echo strtoupper($button) ?> DATA PENGAJUAN</h3>
			</div>
			<form action="<?php echo $action; ?>" method="post" enctype='multipart/form-data'>
			
				<table class='table table-bordered'>
	
					<tr>
						<td width='200'>Status </td>
                        <td>
                            <select name="status" id="status" class="form-control" required>
                                <option value="">-- Silakan Pilih --</option>
                                <option value="2">Acc (GM Smartphone)</option>
                                <option value="99">Revisi</option>
                                <option value="88">Ditolak</option>
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