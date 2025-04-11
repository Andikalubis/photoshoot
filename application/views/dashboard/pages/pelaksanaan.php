<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <p class="card-title"><?= $title ?></p>
                    <button type="button" class="btn btn-info" id="modal_pasien" data-toggle="modal" data-target="#modalInfoPasien">Tambah Pasien</button>
                    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah_management">
                        Tambah Data
                    </button> -->
                </div>
                <div class="row" style="padding-top: 1rem;">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table id="table_pelaksanaan" class="display expandable-table" style="width:100%">
                                <thead style="text-align: center;">
                                    <tr>
                                        <th style="width: 2%; text-align: center;">No</th>
                                        <th style="text-align: center;">No. RM</th>
                                        <th style="text-align: center;">Nama</th>
                                        <th style="text-align: center;">Tanggal</th>
                                        <th style="text-align: center;">Dokter</th>
                                        <th style="text-align: center; width: 15%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('dashboard/pages/modal/modal_pelaksana'); ?>

<div class="fullscreen-container" id="camera-container">
    <div class="camera-content">
        <div class="camera-left">
            <div class="camera-header">
                <h2>Ambil Foto</h2>
                <button id="backBtn">Selesai</button>
            </div>
            <div id="my_camera"></div>
            <audio id="shutterSound" src="<?= base_url("assets/audio/sound3.wav") ?>" preload="auto"></audio>
        </div>

        <div class="camera-right">
            <h3>Hasil Foto:</h3>
            <div class="results-container" id="results"></div>
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
        // getDokter: "</?= site_url('api/a_option/fetch_all'); ?>",
    }
</script>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/pelaksana.js"></script>
