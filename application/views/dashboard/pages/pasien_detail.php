<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <h5 class="card-title"><?= $title ?></h5>
                    <div>
                        <a href="<?= base_url('pelaksanaan') ?>">
                            <button type="button" class="btn btn-secondary" id="modal_pasien">kembali</button>
                        </a>
                    </div>
                </div>
                <div class="row" style="padding-top: 1rem;">
                    <div class="col-12">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    const base_url = "<?= base_url(); ?>";
    let URL = {
        getPasien: "<?= site_url('api/a_pelaksanaan/get_pasien'); ?>",
        getData: "<?= site_url('api/a_pelaksanaan/getData'); ?>",
        get_pelaksana: "<?= site_url('api/a_pelaksanaan/get_pelaksana'); ?>",
        save_photo: "<?= site_url('api/a_pelaksanaan/capture'); ?>",
    }
</script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/pasien_detail.js"></script>