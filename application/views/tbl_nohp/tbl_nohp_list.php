<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">
    
                    <div class="box-header">
                        <h3 class="box-title">KELOLA DATA NO HP</h3>
                    </div>
        
        <div class="box-body">
            <div class='row'>
            <div class='col-md-9'>
            <div style="padding-bottom: 10px;">
                <!-- <?php echo anchor(site_url('tbl_nohp/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> Tambah Data', 'class="btn btn-danger btn-sm"'); ?> -->
            </div>
            </div>
            <!-- <div class='col-md-3'>
            <form action="<?php echo site_url('tbl_nohp/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('tbl_nohp'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div> -->
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
                <th>No Admin</th>
                <th>No CEO</th>
                <th>No GM Smartphone</th>
                <th>No Manager Keuangan</th>
                <th>Action</th>
            </tr>
            <?php
            foreach ($tbl_nohp_data as $tbl_nohp)
            {
                ?>
                <tr>
			<td width="10px"><?php echo ++$start ?></td>
			<td><?php echo $tbl_nohp->no_admin ?></td>
			<td><?php echo $tbl_nohp->no_ceo ?></td>
			<td><?php echo $tbl_nohp->no_gm ?></td>
			<td><?php echo $tbl_nohp->no_keuangan ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				//echo anchor(site_url('tbl_nohp/read/'.$tbl_nohp->id_nohp),'<i class="fa fa-eye" aria-hidden="true"></i>','class="btn btn-danger btn-sm"'); 
				//echo '  '; 
				echo anchor(site_url('tbl_pengajuan/update_nohp/'.$tbl_nohp->id_nohp),'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm"'); 
				//echo '  '; 
				//echo anchor(site_url('tbl_nohp/delete/'.$tbl_nohp->id_nohp),'<i class="fa fa-trash-o" aria-hidden="true"></i>','class="btn btn-danger btn-sm" Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
        
        </div>
                    </div>
            </div>
            </div>
    </section>
</div>