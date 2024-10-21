<div class="content-wrapper">
	<section class="content">
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<h3 class="box-title"><?php echo strtoupper($button) ?> DATA PENGAJUAN</h3>
			</div>
			<form action="<?php echo $action; ?>" method="post" enctype='multipart/form-data'>
			
				<table class='table table-bordered' >
	
					<tr>
						<td width='200'>Perihal <?php echo form_error('perihal') ?></td><td><input type="text" class="form-control" name="perihal" id="perihal" placeholder="Perihal" value="<?php echo $perihal; ?>" /></td>
					</tr>
	
					<tr>
						<td width='200'>Tanggal Pengajuan <?php echo form_error('tanggal_pengajuan') ?></td>
						<td><input type="date" class="form-control" name="tanggal_pengajuan" id="tanggal_pengajuan" placeholder="Tanggal Pengajuan" value="<?php echo $tanggal_pengajuan; ?>" onclick="this.showPicker();" /></td>
					</tr>
	    
					<tr>
						<td width='200'>File</td>
						<td> <input type="file" class="form-control" value="<?php echo $berkas; ?>" name="berkas" id="berkas" placeholder="File" required></td>
					</tr>

					<tr>
						<td width='200'>Keterangan</td>
						<td> <textarea class="form-control" name="keterangan" id="keterangan" placeholder="keterangan" required><?php echo $keterangan; ?></textarea></td>
					</tr>
	
					<tr>
						<td></td>
						<td>
							<input type="hidden" name="id_pengajuan" value="<?php echo $id_pengajuan; ?>" /> 
							<button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
							<!-- <a href="<?php echo site_url('tbl_pengajuan') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a> -->
						</td>
					</tr>
	
				</table>
			</form>
		</div>
	</section>
</div>