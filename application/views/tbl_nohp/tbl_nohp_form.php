<div class="content-wrapper">
	<section class="content">
		<div class="box box-warning box-solid">
			<div class="box-header with-border">
				<h3 class="box-title"><?php echo strtoupper($button) ?> DATA TBL_NOHP</h3>
			</div>
			<form action="<?php echo $action; ?>" method="post">
			
				<table class='table table-bordered'>
	
					<tr>
						<td width='200'>No Admin <?php echo form_error('no_admin') ?></td><td><input type="text" class="form-control" name="no_admin" id="no_admin" placeholder="No Admin" value="<?php echo $no_admin; ?>" /></td>
					</tr>
	
					<tr>
						<td width='200'>No Ceo <?php echo form_error('no_ceo') ?></td><td><input type="text" class="form-control" name="no_ceo" id="no_ceo" placeholder="No Ceo" value="<?php echo $no_ceo; ?>" /></td>
					</tr>
	
					<tr>
						<td width='200'>No Gm <?php echo form_error('no_gm') ?></td><td><input type="text" class="form-control" name="no_gm" id="no_gm" placeholder="No Gm" value="<?php echo $no_gm; ?>" /></td>
					</tr>
	
					<tr>
						<td width='200'>No Keuangan <?php echo form_error('no_keuangan') ?></td><td><input type="text" class="form-control" name="no_keuangan" id="no_keuangan" placeholder="No Keuangan" value="<?php echo $no_keuangan; ?>" /></td>
					</tr>
	
					<tr>
						<td></td>
						<td>
							<input type="hidden" name="id_nohp" value="<?php echo $id_nohp; ?>" /> 
							<button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> <?php echo $button ?></button> 
							<a href="<?php echo site_url('tbl_nohp') ?>" class="btn btn-info"><i class="fa fa-sign-out"></i> Kembali</a>
						</td>
					</tr>
	
				</table>
			</form>
		</div>
	</section>
</div>