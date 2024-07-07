<div class="content-wrapper">
    <section class="content">
        <?php echo alert('alert-info', 'Selamat Datang', 'Selamat Datang Di Halaman Utama Aplikasi') ?>
        <div class="row">
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-aqua">
                    <div class="inner">
                        <h3>
                        <?php 
                            $query = $this->db->query('SELECT * FROM tbl_pengajuan');
                            echo $query->num_rows();  
                        ?>
                        </h3>
                        <p>Total Pengajuan</p>
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
                            $query = $this->db->query('SELECT * FROM tbl_pengajuan WHERE status = 4');
                            echo $query->num_rows();  
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
                            $query = $this->db->query('SELECT * FROM tbl_pengajuan WHERE status = 7');
                            echo $query->num_rows();  
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
                            $query = $this->db->query('SELECT * FROM tbl_pengajuan WHERE status = 10');
                            echo $query->num_rows();  
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
                <h3 class="box-title">Latest Updates</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                            class="fa fa-times"></i></button>
                </div>
            </div>

            <div class="box-body">
                <div class="table-responsive">
                    <table class="table no-margin">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Update</th>
                                <th>Perihal</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $no = 1;
                                foreach ($data_update as $row) :
                            ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td>
                                    <?php 
                                        $dateString = $row->tanggal_update; // Your input date and time string
                                        $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $dateString);
                                        $indonesianDate = $dateTime->format('d F Y H:i:s');
                                        echo $indonesianDate;
                                    ?>
                                </td>
                                <td><?php echo $row->perihal ?></td>
                                <td><button class="btn btn-sm btn-success"><?php echo rename_status($row->status) ?></button></td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>

            </div>

            <div class="box-footer clearfix">
                <a href="<?php echo site_url('tbl_pengajuan')?>" class="btn btn-sm btn-info btn-flat pull-left">Lihat Data Pengajuan</a>
            </div>

        </div>
    </section>
</div>