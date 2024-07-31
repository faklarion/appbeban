<div class="content-wrapper">
    <section class="content">
        <?php echo alert('alert-info', 'Selamat Datang', 'Selamat Datang Di Halaman Utama Aplikasi') ?>
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>
                        <?php 
                            $query = $this->Tbl_pengajuan_model->get_all_by_status(1);
                            
                            echo count($query);  
                        ?>
                        </h3>
                        <p>Total Pengajuan Masuk</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-archive"></i>
                    </div>
                    <a href="<?php echo site_url('tbl_pengajuan') ?>" class="small-box-footer">More info <i
                            class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <?php if(($this->session->userdata('id_user_level') == 1) || ($this->session->userdata('id_user_level') == 2)) { ?>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>
                        <?php 
                            $query = $this->Tbl_pengajuan_model->get_all_by_status(4);
                            echo count($query);  
                        ?>
                        </h3>
                        <p>Jumlah ACC GM Smartphone</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-check"></i>
                    </div>
                    <a href="<?php echo site_url('tbl_pengajuan') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <?php } ?>

            <?php if(($this->session->userdata('id_user_level') == 1) || ($this->session->userdata('id_user_level') == 3)) { ?>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>
                        <?php 
                            $query = $this->Tbl_pengajuan_model->get_all_by_status(7);
                            echo count($query); 
                        ?>
                        </h3>
                        <p>Jumlah ACC CEO</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-check"></i>
                    </div>
                    <a href="<?php echo site_url('tbl_pengajuan') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <?php } ?>
            
            <?php if(($this->session->userdata('id_user_level') == 1) || ($this->session->userdata('id_user_level') == 4)) { ?>
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>
                        <?php 
                            $query = $this->Tbl_pengajuan_model->get_all_by_status(10);
                            echo count($query); 
                        ?>
                        </h3>
                        <p>Jumlah ACC Manager Keuangan</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-check"></i>
                    </div>
                    <a href="<?php echo site_url('tbl_pengajuan') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <?php } ?>
        </div>

        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">DAFTAR RIWAYAT APPROVAL</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                            class="fa fa-times"></i></button>
                </div>
            </div>

            <div class="box-body">
                    <table class="table no-margin" id="tabeldashboard">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Perihal</th>
                                <th>User</th>
                                <th>Tanggal Update</th>
                                <th>Status</th>
                                <th>Catatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $no = 1;
                                foreach ($data_update as $row) :
                            ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $row->perihal ?></td>
                                <td>
                                    <?php 
                                        if($row->status == 1) {
                                            echo 'Admin';
                                        } elseif(($row->status == 2) || ($row->status == 3) || ($row->status == 4)) {
                                            echo 'GM Smartphone';
                                        } elseif(($row->status == 5) || ($row->status == 6) || ($row->status == 7)) {
                                            echo 'CEO';
                                        } elseif(($row->status == 8) || ($row->status == 9) || ($row->status == 10)) {
                                            echo 'Manager Keuangan';
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php 
                                        $dateString = $row->tanggal_update; // Your input date and time string
                                        $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $dateString);
                                        $indonesianDate = $dateTime->format('d F Y H:i:s');
                                        echo $indonesianDate;
                                    ?>
                                </td>
                                <td><?php echo rename_status($row->status) ?></td>
                                <td><?php echo $row->catatan ?></td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
            </div>

            <div class="box-footer clearfix">
                <a href="<?php echo site_url('tbl_pengajuan')?>" class="btn btn-sm btn-info btn-flat pull-left">Lihat Data Pengajuan</a>
            </div>

        </div>
    </section>
</div>