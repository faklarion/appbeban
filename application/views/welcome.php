<div class="content-wrapper">
    <section class="content">
        <?php echo alert('alert-info', 'Selamat Datang', 'Selamat Datang Di Halaman Utama Aplikasi') ?>
        <?php if ($this->session->flashdata('message')) {
            echo alert('alert-success', 'Action Berhasil', $this->session->flashdata('message'));
        }
        ?>
        <?php if ($this->session->userdata('id_user_level') == 1) { ?>
            <div class="mb-4">
                <?php echo anchor(site_url('tbl_pengajuan/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> Tambah Pengajuan', 'class="btn btn-danger btn-sm"'); ?>
            </div>
            <br>
        <?php } ?>
        <div class="row">
            <!-- Dashboard Admin-->
            <?php if ($this->session->userdata('id_user_level') == 1) { ?>
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-aqua" style="position: relative; overflow: hidden;">
                        <div class="inner">
                            <h3>
                                <?php
                                $query = $this->Tbl_pengajuan_model->get_all_by_status(1);
                                echo count($query);
                                ?>
                            </h3>
                            <p>Total Pengajuan Masuk Hari Ini</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-archive"></i>
                        </div>

                        <!-- Move form here -->
                        <div
                            style="position: absolute; bottom: 0; left: 0; right: 0; height: 100%; display: flex; justify-content: center; align-items: center;">
                            <form action="<?php echo site_url('tbl_pengajuan/filter') ?>" method="get"
                                style="width: 100%; height: 100%; display: flex; justify-content: center; align-items: center;">
                                <input type="hidden" name="status1" value="1">
                                <input type="hidden" name="status2" value="4">
                                <button type="submit" class="small-box-footer"
                                    style="border: none; background: rgba(0, 0, 0, 0); width: 100%; height: 100%; text-align: center; color: #fff;">
                                    
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-green" style="position: relative; overflow: hidden;">
                        <div class="inner">
                            <h3>
                                <?php
                                $query = $this->Tbl_pengajuan_model->get_all_by_status_2(4);
                                echo count($query);
                                ?>
                            </h3>
                            <p>Jumlah ACC GM Smartphone Hari Ini</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-check"></i>
                        </div>
                        <div style="position: absolute; bottom: 0; left: 0; right: 0; height: 100%; display: flex; justify-content: center; align-items: center;">
                            <form action="<?php echo site_url('tbl_pengajuan/filter_2') ?>" method="get" style="width: 100%; height: 100%; display: flex; justify-content: center; align-items: center;">
                                <input type="hidden" name="status1" value="4">
                                <button type="submit" class="small-box-footer"
                                    style="border: none; background: rgba(0, 0, 0, 0); width: 100%; height: 100%; text-align: center; color: #fff;">
                                    
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-yellow" style="position: relative; overflow: hidden;">
                        <div class="inner">
                            <h3>
                                <?php
                                $query = $this->Tbl_pengajuan_model->get_all_by_status_2(7);
                                echo count($query);
                                ?>
                            </h3>
                            <p>Jumlah ACC CEO Hari Ini</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-check"></i>
                        </div>
                        <div style="position: absolute; bottom: 0; left: 0; right: 0; height: 100%; display: flex; justify-content: center; align-items: center;">
                            <form action="<?php echo site_url('tbl_pengajuan/filter_2') ?>" method="get" style="width: 100%; height: 100%; display: flex; justify-content: center; align-items: center;">
                                <input type="hidden" name="status1" value="7">
                                <button type="submit" class="small-box-footer"
                                    style="border: none; background: rgba(0, 0, 0, 0); width: 100%; height: 100%; text-align: center; color: #fff;">
                                    
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-red" style="position: relative; overflow: hidden;">
                        <div class="inner">
                            <h3>
                                <?php
                                $query = $this->Tbl_pengajuan_model->get_all_by_status_2(10);
                                echo count($query);
                                ?>
                            </h3>
                            <p>Jumlah ACC Manager Keuangan Hari Ini</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-check"></i>
                        </div>
                        <div style="position: absolute; bottom: 0; left: 0; right: 0; height: 100%; display: flex; justify-content: center; align-items: center;">
                            <form action="<?php echo site_url('tbl_pengajuan/filter_2') ?>" method="get" style="width: 100%; height: 100%; display: flex; justify-content: center; align-items: center;">
                                <input type="hidden" name="status1" value="10">
                                <button type="submit" class="small-box-footer"
                                    style="border: none; background: rgba(0, 0, 0, 0); width: 100%; height: 100%; text-align: center; color: #fff;">
                                    
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <!-- END Dashboard Admin -->

            <!-- Dashboard GM Syihab-->
            <?php if ($this->session->userdata('id_user_level') == 2) { ?>
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-aqua" style="position: relative; overflow: hidden;">
                        <div class="inner">
                            <h3>
                                <?php
                                $query = $this->Tbl_pengajuan_model->get_all_by_status(1);
                                echo count($query);
                                ?>
                            </h3>
                            <p>Total Pengajuan Masuk Hari Ini</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-archive"></i>
                        </div>

                        <!-- Move form here -->
                        <div
                            style="position: absolute; bottom: 0; left: 0; right: 0; height: 100%; display: flex; justify-content: center; align-items: center;">
                            <form action="<?php echo site_url('tbl_pengajuan/filter') ?>" method="get"
                                style="width: 100%; height: 100%; display: flex; justify-content: center; align-items: center;">
                                <input type="hidden" name="status1" value="1">
                                <input type="hidden" name="status2" value="4">
                                <button type="submit" class="small-box-footer"
                                    style="border: none; background: rgba(0, 0, 0, 0); width: 100%; height: 100%; text-align: center; color: #fff;">
                                    
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-green" style="position: relative; overflow: hidden;">
                        <div class="inner">
                            <h3>
                                <?php
                                $query = $this->Tbl_pengajuan_model->get_all_by_status_2(4);
                                echo count($query);
                                ?>
                            </h3>
                            <p>Jumlah ACC GM Smartphone Hari Ini</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-check"></i>
                        </div>
                        <div style="position: absolute; bottom: 0; left: 0; right: 0; height: 100%; display: flex; justify-content: center; align-items: center;">
                            <form action="<?php echo site_url('tbl_pengajuan/filter_2') ?>" method="get" style="width: 100%; height: 100%; display: flex; justify-content: center; align-items: center;">
                                <input type="hidden" name="status1" value="4">
                                <button type="submit" class="small-box-footer"
                                    style="border: none; background: rgba(0, 0, 0, 0); width: 100%; height: 100%; text-align: center; color: #fff;">
                                    
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <!-- END Dashboard GM Syihab -->

            <!-- Dashboard CEO -->
            <?php if ($this->session->userdata('id_user_level') == 3) { ?>
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-green" style="position: relative; overflow: hidden;">
                        <div class="inner">
                            <h3>
                                <?php
                                $query = $this->Tbl_pengajuan_model->get_all_by_status(4);
                                echo count($query);
                                ?>
                            </h3>
                            <p>Jumlah ACC GM Smartphone Hari Ini</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-check"></i>
                        </div>
                        <div style="position: absolute; bottom: 0; left: 0; right: 0; height: 100%; display: flex; justify-content: center; align-items: center;">
                            <form action="<?php echo site_url('tbl_pengajuan/filter') ?>" method="get" style="width: 100%; height: 100%; display: flex; justify-content: center; align-items: center;">
                                <input type="hidden" name="status1" value="4">
                                <input type="hidden" name="status2" value="7">
                                <button type="submit" class="small-box-footer"
                                    style="border: none; background: rgba(0, 0, 0, 0); width: 100%; height: 100%; text-align: center; color: #fff;">
                                    
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-yellow" style="position: relative; overflow: hidden;"> 
                        <div class="inner">
                            <h3>
                                <?php
                                $query = $this->Tbl_pengajuan_model->get_all_by_status_2(7);
                                echo count($query);
                                ?>
                            </h3>
                            <p>Jumlah ACC CEO Hari Ini</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-check"></i>
                        </div>
                        <div style="position: absolute; bottom: 0; left: 0; right: 0; height: 100%; display: flex; justify-content: center; align-items: center;">
                            <form action="<?php echo site_url('tbl_pengajuan/filter_2') ?>" method="get" style="width: 100%; height: 100%; display: flex; justify-content: center; align-items: center;">
                                <input type="hidden" name="status1" value="7">
                                <button type="submit" class="small-box-footer"
                                    style="border: none; background: rgba(0, 0, 0, 0); width: 100%; height: 100%; text-align: center; color: #fff;">
                                    
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <!-- END Dashboard CEO -->

            <!-- Dashboard Keuangan -->
            <?php if ($this->session->userdata('id_user_level') == 4) { ?>
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-yellow" style="position: relative; overflow: hidden;">
                        <div class="inner">
                            <h3>
                                <?php
                                $query = $this->Tbl_pengajuan_model->get_all_by_status(7);
                                echo count($query);
                                ?>
                            </h3>
                            <p>Jumlah ACC CEO Hari Ini</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-check"></i>
                        </div>
                        <div style="position: absolute; bottom: 0; left: 0; right: 0; height: 100%; display: flex; justify-content: center; align-items: center;">
                            <form action="<?php echo site_url('tbl_pengajuan/filter') ?>" method="get" style="width: 100%; height: 100%; display: flex; justify-content: center; align-items: center;">
                                <input type="hidden" name="status1" value="7">
                                <input type="hidden" name="status2" value="10">
                                <button type="submit" class="small-box-footer"
                                    style="border: none; background: rgba(0, 0, 0, 0); width: 100%; height: 100%; text-align: center; color: #fff;">
                                    
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-red" style="position: relative; overflow: hidden;">
                            <div class="inner">
                                <h3>
                                    <?php
                                    $query = $this->Tbl_pengajuan_model->get_all_by_status_2(10);
                                    echo count($query);
                                    ?>
                                </h3>
                                <p>Jumlah ACC Manager Keuangan Hari Ini</p>
                            </div>
                            <div class="icon">
                                <i class="fa fa-check"></i>
                            </div>
                            <div style="position: absolute; bottom: 0; left: 0; right: 0; height: 100%; display: flex; justify-content: center; align-items: center;">
                                <form action="<?php echo site_url('tbl_pengajuan/filter_2') ?>" method="get" style="width: 100%; height: 100%; display: flex; justify-content: center; align-items: center;">
                                <input type="hidden" name="status1" value="10">
                                <button type="submit" class="small-box-footer"
                                    style="border: none; background: rgba(0, 0, 0, 0); width: 100%; height: 100%; text-align: center; color: #fff;">
                                    
                                </button>
                                </form>
                            </div>
                    </div>
                </div>
            
<?php } ?>
<!-- END Dashboard Keuangan -->
</div>

<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">DAFTAR RIWAYAT APPROVAL</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
    </div>

    <div class="box-body">
        <table class="table no-margin" id="tabeldashboard">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Perihal</th>
                    <th>Catatan</th>
                    <th>Status</th>
                    <th>Tanggal Update</th>
                    <th>User</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($data_update as $row):
                    ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $row->perihal ?></td>
                        <td><?php echo $row->catatan ?></td>
                        <td><?php echo rename_status($row->status) ?></td>
                        <td>
                            <?php
                            $dateString = $row->tanggal_update; // Your input date and time string
                            $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $dateString);
                            $indonesianDate = $dateTime->format('d F Y H:i:s');
                            echo $indonesianDate;
                            ?>
                        </td>
                        <td>
                            <?php
                            if ($row->status == 1) {
                                echo 'Admin';
                            } elseif (($row->status == 2) || ($row->status == 3) || ($row->status == 4)) {
                                echo 'GM Smartphone';
                            } elseif (($row->status == 5) || ($row->status == 6) || ($row->status == 7)) {
                                echo 'CEO';
                            } elseif (($row->status == 8) || ($row->status == 9) || ($row->status == 10)) {
                                echo 'Manager Keuangan';
                            }
                            ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>

    <div class="box-footer clearfix">
        <!-- <a href="<?php echo site_url('tbl_pengajuan') ?>" class="btn btn-sm btn-info btn-flat pull-left">Lihat Data Pengajuan</a> -->
    </div>

</div>
</section>
</div>