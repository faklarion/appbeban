<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            .word-table {
                border:1px solid black !important; 
                border-collapse: collapse !important;
                width: 100%;
            }
            .word-table tr th, .word-table tr td{
                border:1px solid black !important; 
                padding: 5px 10px;
            }
        </style>
    </head>
    <body>
        <h2>Tbl_pengajuan List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Perihal</th>
		<th>Tanggal Pengajuan</th>
		<th>File</th>
		<th>Status</th>
		<th>Catatan</th>
		
            </tr><?php
            foreach ($tbl_pengajuan_data as $tbl_pengajuan)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $tbl_pengajuan->perihal ?></td>
		      <td><?php echo $tbl_pengajuan->tanggal_pengajuan ?></td>
		      <td><?php echo $tbl_pengajuan->file ?></td>
		      <td><?php echo $tbl_pengajuan->status ?></td>
		      <td><?php echo $tbl_pengajuan->catatan ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>