<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <p class="card-title"><?= $title ?></p>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah_management">
                        Tambah Data
                    </button>
                </div>
                <div class="row" style="padding-top: 1rem;">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table id="table_management" class="display expandable-table" style="width:100%">
                                <thead style="text-align: center;">
                                    <tr>
                                        <th style="width: 5%; text-align: center;">No</th>
                                        <th style="text-align: center;">NIP</th>
                                        <th style="text-align: center;">Username</th>
                                        <th style="text-align: center;">Nama</th>
                                        <th style="width: 15%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody style="text-align: center;">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <php $this->load->view('pages/dashboard/user_management/modal/modal_management'); ?> -->
<script>
    let browse = false;

    let URL = {
        getData: "<?= site_url('api/a_management/getData'); ?>",
        get_management: "<?= site_url('api/a_management/get_management'); ?>",
    }
</script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/user_management.js"></script>