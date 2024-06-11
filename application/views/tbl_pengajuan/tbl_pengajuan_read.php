
<div class="content-wrapper">
	
	<section class="content">
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<h3 class="box-title">DETAIL DATA TBL_PENGAJUAN</h3>
			</div>
		
		<table class='table table-bordered'>        

	
			<tr>
				<td>Perihal</td>
				<td><?php echo $perihal; ?></td>
			</tr>
	
			<tr>
				<td>Tanggal Pengajuan</td>
				<td><?php echo $tanggal_pengajuan; ?></td>
			</tr>
	
			<tr>
				<td>File</td>
				<td><?php echo $file; ?></td>
			</tr>
	
			<tr>
				<td>Status</td>
				<td><?php echo $status; ?></td>
			</tr>
	
			<tr>
				<td>Catatan</td>
				<td><?php echo $catatan; ?></td>
			</tr>
	
			<tr>
				<td></td>
				<td><a href="<?php echo site_url('tbl_pengajuan') ?>" class="btn btn-default">Kembali</a></td>
			</tr>
	
		</table>
		</div>
	</section>
</div>