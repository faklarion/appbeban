<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-warning box-solid">
                    <div class="box-header">
                        <h3 class="box-title">KELOLA DATA PENGAJUAN</h3>
                    </div>

                    <div class="box-body">
                        <div class='row'>
                            <div class='col-md-9'>
                                <div style="padding-bottom: 10px;">
                                    <?php if ($this->session->userdata('id_user_level') == 1) { ?>
                                        <?php echo anchor(site_url('tbl_pengajuan/create'), '<i class="fa fa-wpforms" aria-hidden="true"></i> Tambah Data', 'class="btn btn-danger btn-sm"'); ?>
                                    <?php } ?>
                                </div>
                            </div>
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
                        <h4 class="text-center">Data Yang Belum di-ACC</h4>
                        <table class="table table-bordered table-responsive" id="tableBelumAcc" data-toggle="table"
                            data-search="true" data-pagination="true" data-sortable="true">
                            <thead>
                                <tr>
                                    <th data-sortable="true">No</th>
                                    <th data-sortable="true">Action</th>
                                    <th data-sortable="true">Perihal</th>
                                    <th data-sortable="true">Keterangan</th>
                                    <th data-sortable="true">Catatan</th>
                                    <th data-sortable="true">User</th>
                                    <th data-sortable="true">Tanggal Pengajuan</th>
                                    <th data-sortable="true">File</th>
                                    <th data-sortable="true">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $start = 0;
                                foreach ($data_status1 as $tbl_pengajuan) {
                                    ?>
                                    <tr>
                                        <td><?php echo ++$start ?></td>
                                        <td style="text-align:center">
                                            <?php echo get_action_buttons($tbl_pengajuan, $this->session->userdata('id_user_level')); ?>
                                        </td>
                                        <td><?php echo $tbl_pengajuan->perihal ?></td>
                                        <td><?php echo $tbl_pengajuan->keterangan ?></td>
                                        <td><?php echo $tbl_pengajuan->catatan ?></td>
                                        <td><?php echo get_user_role($tbl_pengajuan->status) ?></td>
                                        <td><?php echo tgl_indo($tbl_pengajuan->tanggal_pengajuan) ?></td>
                                        <td><?php echo anchor(base_url('assets/berkas/' . $tbl_pengajuan->berkas), '<i class="fa fa-eye" aria-hidden="true"> Lihat File</i>', 'class="btn btn-primary btn-sm" target="_blank"'); ?>
                                        </td>
                                        <td><?php echo rename_status($tbl_pengajuan->status) ?></td>  
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>

                        <h4 class="text-center">Data Yang Sudah di-ACC</h4>
                        <table class="table table-bordered table-responsive" id="tableSudahAcc" data-toggle="table"
                            data-search="true" data-pagination="true" data-sortable="true">
                            <thead>
                                <tr>
                                    <th data-sortable="true">No</th>
                                    <th data-sortable="true">Action</th>
                                    <th data-sortable="true">Perihal</th>
                                    <th data-sortable="true">Keterangan</th>
                                    <th data-sortable="true">Catatan</th>
                                    <th data-sortable="true">User</th>
                                    <th data-sortable="true">Tanggal Pengajuan</th>
                                    <th data-sortable="true">File</th>
                                    <th data-sortable="true">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $start = 0;
                                foreach ($data_status2 as $tbl_pengajuan) {
                                    ?>
                                    <tr>
                                        <td><?php echo ++$start ?></td>
                                        <td style="text-align:center">
                                            <?php echo get_action_buttons($tbl_pengajuan, $this->session->userdata('id_user_level')); ?>
                                        </td>
                                        <td><?php echo $tbl_pengajuan->perihal ?></td>
                                        <td><?php echo $tbl_pengajuan->keterangan ?></td>
                                        <td><?php echo $tbl_pengajuan->catatan ?></td>
                                        <td><?php echo get_user_role($tbl_pengajuan->status) ?></td>
                                        <td><?php echo tgl_indo($tbl_pengajuan->tanggal_pengajuan) ?></td>
                                        <td><?php echo anchor(base_url('assets/berkas/' . $tbl_pengajuan->berkas), '<i class="fa fa-eye" aria-hidden="true"> Lihat File</i>', 'class="btn btn-primary btn-sm" target="_blank"'); ?>
                                        </td>
                                        <td><?php echo rename_status($tbl_pengajuan->status) ?></td>  
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>

                        <?php if($this->session->userdata('id_user_level') == 1) { ?>
                        <h4 class="text-center">Data Yang Harus di-Revisi</h4>
                        <table class="table table-bordered table-responsive" id="tableRevisi" data-toggle="table"
                            data-search="true" data-pagination="true" data-sortable="true">
                            <thead>
                                <tr>
                                    <th data-sortable="true">No</th>
                                    <th data-sortable="true">Action</th>
                                    <th data-sortable="true">Perihal</th>
                                    <th data-sortable="true">Keterangan</th>
                                    <th data-sortable="true">Catatan</th>
                                    <th data-sortable="true">User</th>
                                    <th data-sortable="true">Tanggal Pengajuan</th>
                                    <th data-sortable="true">File</th>
                                    <th data-sortable="true">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $start = 0;
                                foreach ($data_revisi as $tbl_pengajuan) {
                                    ?>
                                    <tr>
                                        <td><?php echo ++$start ?></td>
                                        <td style="text-align:center">
                                            <?php echo get_action_buttons($tbl_pengajuan, $this->session->userdata('id_user_level')); ?>
                                        </td>
                                        <td><?php echo $tbl_pengajuan->perihal ?></td>
                                        <td><?php echo $tbl_pengajuan->keterangan ?></td>
                                        <td><?php echo $tbl_pengajuan->catatan ?></td>
                                        <td><?php echo get_user_role($tbl_pengajuan->status) ?></td>
                                        <td><?php echo tgl_indo($tbl_pengajuan->tanggal_pengajuan) ?></td>
                                        <td><?php echo anchor(base_url('assets/berkas/' . $tbl_pengajuan->berkas), '<i class="fa fa-eye" aria-hidden="true"> Lihat File</i>', 'class="btn btn-primary btn-sm" target="_blank"'); ?>
                                        </td>
                                        <td><?php echo rename_status($tbl_pengajuan->status) ?></td>  
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>

                        <h4 class="text-center">Data Yang di-Tolak</h4>
                        <table class="table table-bordered table-responsive" id="tableTolak" data-toggle="table"
                            data-search="true" data-pagination="true" data-sortable="true">
                            <thead>
                                <tr>
                                    <th data-sortable="true">No</th>
                                    <th data-sortable="true">Action</th>
                                    <th data-sortable="true">Perihal</th>
                                    <th data-sortable="true">Keterangan</th>
                                    <th data-sortable="true">Catatan</th>
                                    <th data-sortable="true">User</th>
                                    <th data-sortable="true">Tanggal Pengajuan</th>
                                    <th data-sortable="true">File</th>
                                    <th data-sortable="true">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $start = 0;
                                foreach ($data_ditolak as $tbl_pengajuan) {
                                    ?>
                                    <tr>
                                        <td><?php echo ++$start ?></td>
                                        <td style="text-align:center">
                                            <?php echo get_action_buttons($tbl_pengajuan, $this->session->userdata('id_user_level')); ?>
                                        </td>
                                        <td><?php echo $tbl_pengajuan->perihal ?></td>
                                        <td><?php echo $tbl_pengajuan->keterangan ?></td>
                                        <td><?php echo $tbl_pengajuan->catatan ?></td>
                                        <td><?php echo get_user_role($tbl_pengajuan->status) ?></td>
                                        <td><?php echo tgl_indo($tbl_pengajuan->tanggal_pengajuan) ?></td>
                                        <td><?php echo anchor(base_url('assets/berkas/' . $tbl_pengajuan->berkas), '<i class="fa fa-eye" aria-hidden="true"> Lihat File</i>', 'class="btn btn-primary btn-sm" target="_blank"'); ?>
                                        </td>
                                        <td><?php echo rename_status($tbl_pengajuan->status) ?></td>  
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- ModalGm -->
<?php foreach ($data_status1 as $tbl_pengajuan): ?>
    <div id="modalGm<?php echo $tbl_pengajuan->id_pengajuan ?>" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- konten modal-->
            <div class="modal-content">
                <!-- heading modal -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <?php $row = $this->Tbl_pengajuan_model->get_by_id($tbl_pengajuan->id_pengajuan); ?>
                    <h4 class="modal-title">Approval Pengajuan <?php echo $row->perihal ?></h4>
                </div>
                <!-- body modal -->
                <div class="modal-body">
                    <form action="<?php echo site_url('tbl_pengajuan/acc_gm_action') ?>" method="post"
                        enctype='multipart/form-data'>
                        <table class='table table-bordered'>
                            <tr>
                                <td width='200'>Perihal </td>
                                <td>
                                    <?php echo $row->perihal ?>
                                </td>
                            </tr>

                            <tr>
                                <td width='200'>Tanggal Pengajuan </td>
                                <td>
                                    <?php echo tgl_indo($row->tanggal_pengajuan) ?>
                                </td>
                            </tr>

                            <tr>
                                <td width='200'>File </td>
                                <td>
                                    <?php echo anchor(base_url('assets/berkas/' . $row->berkas), '<i class="fa fa-eye" aria-hidden="true"> Lihat File</i>', 'class="btn btn-primary btn-sm" target="_blank"'); ?>
                                </td>
                            </tr>

                            <tr>
                                <td width='200'>Status </td>
                                <td>
                                    <?php echo rename_status($row->status) ?>
                                </td>
                            </tr>

                            <tr>
                                <td width='200'>Approval </td>
                                <td>
                                    <input type="radio" name="status" value="2" id="status2" required>
                                    <label for="status2">Ditolak</label><br>
                                    <input type="radio" name="status" value="3" id="status3">
                                    <label for="status3">Revisi</label><br>
                                    <input type="radio" name="status" value="4" id="status4">
                                    <label for="status4">Acc</label>
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
                                    <input type="hidden" name="id_pengajuan" value="<?php echo $row->id_pengajuan; ?>" />
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i>
                                        Submit</button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
                <!-- footer modal -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>
<!-- End Modal -->

<!-- ModalCeo -->
<?php foreach ($data_status1 as $tbl_pengajuan): ?>
    <div id="modalCeo<?php echo $tbl_pengajuan->id_pengajuan ?>" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- konten modal-->
            <div class="modal-content">
                <!-- heading modal -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <?php $row = $this->Tbl_pengajuan_model->get_by_id($tbl_pengajuan->id_pengajuan); ?>
                    <h4 class="modal-title">Approval Pengajuan <?php echo $row->perihal ?></h4>
                </div>
                <!-- body modal -->
                <div class="modal-body">
                    <form action="<?php echo site_url('tbl_pengajuan/acc_ceo_action') ?>" method="post"
                        enctype='multipart/form-data'>
                        <table class='table table-bordered'>
                            <tr>
                                <td width='200'>Perihal </td>
                                <td>
                                    <?php echo $row->perihal ?>
                                </td>
                            </tr>

                            <tr>
                                <td width='200'>Tanggal Pengajuan </td>
                                <td>
                                    <?php echo tgl_indo($row->tanggal_pengajuan) ?>
                                </td>
                            </tr>

                            <tr>
                                <td width='200'>File </td>
                                <td>
                                    <?php echo anchor(base_url('assets/berkas/' . $row->berkas), '<i class="fa fa-eye" aria-hidden="true"> Lihat File</i>', 'class="btn btn-primary btn-sm" target="_blank"'); ?>
                                </td>
                            </tr>

                            <tr>
                                <td width='200'>Status </td>
                                <td>
                                    <?php echo rename_status($row->status) ?>
                                </td>
                            </tr>

                            <tr>
                                <td width='200'>Approval </td>
                                <td>
                                    <input type="radio" name="status" value="5" id="status2" required>
                                    <label for="status2">Ditolak</label><br>
                                    <input type="radio" name="status" value="6" id="status3">
                                    <label for="status3">Revisi</label><br>
                                    <input type="radio" name="status" value="7" id="status4">
                                    <label for="status4">Acc</label>
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
                                    <input type="hidden" name="id_pengajuan" value="<?php echo $row->id_pengajuan; ?>" />
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i>
                                        Submit</button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
                <!-- footer modal -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>
<!-- End Modal -->

<!-- ModalKeuangan -->
<?php foreach ($data_status1 as $tbl_pengajuan): ?>
    <div id="modalKeuangan<?php echo $tbl_pengajuan->id_pengajuan ?>" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- konten modal-->
            <div class="modal-content">
                <!-- heading modal -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <?php $row = $this->Tbl_pengajuan_model->get_by_id($tbl_pengajuan->id_pengajuan); ?>
                    <h4 class="modal-title">Approval Pengajuan <?php echo $row->perihal ?></h4>
                </div>
                <!-- body modal -->
                <div class="modal-body">
                    <form action="<?php echo site_url('tbl_pengajuan/acc_ceo_action') ?>" method="post"
                        enctype='multipart/form-data'>
                        <table class='table table-bordered'>
                            <tr>
                                <td width='200'>Perihal </td>
                                <td>
                                    <?php echo $row->perihal ?>
                                </td>
                            </tr>

                            <tr>
                                <td width='200'>Tanggal Pengajuan </td>
                                <td>
                                    <?php echo tgl_indo($row->tanggal_pengajuan) ?>
                                </td>
                            </tr>

                            <tr>
                                <td width='200'>File </td>
                                <td>
                                    <?php echo anchor(base_url('assets/berkas/' . $row->berkas), '<i class="fa fa-eye" aria-hidden="true"> Lihat File</i>', 'class="btn btn-primary btn-sm" target="_blank"'); ?>
                                </td>
                            </tr>

                            <tr>
                                <td width='200'>Status </td>
                                <td>
                                    <?php echo rename_status($row->status) ?>
                                </td>
                            </tr>

                            <tr>
                                <td width='200'>Approval </td>
                                <td>
                                    <input type="radio" name="status" value="8" id="status2" required>
                                    <label for="status2">Ditolak</label><br>
                                    <input type="radio" name="status" value="9" id="status3">
                                    <label for="status3">Revisi</label><br>
                                    <input type="radio" name="status" value="10" id="status4">
                                    <label for="status4">Acc</label>
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
                                    <input type="hidden" name="id_pengajuan" value="<?php echo $row->id_pengajuan; ?>" />
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i>
                                        Submit</button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
                <!-- footer modal -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach ?>
<!-- End Modal -->