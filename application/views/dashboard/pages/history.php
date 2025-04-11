<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <p class="card-title"><?= $title ?></p>
                    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah_management">
                        Tambah Data
                    </button> -->
                </div>
                <div class="row" style="padding-top: 1rem;">
                    <div class="col-12">
                        <div class="table-responsive">
                            <table id="table_history" class="display expandable-table" style="width:100%">
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
        getData: "<?= site_url('api/a_history/getData'); ?>",
        get_history: "<?= site_url('api/a_history/get_history'); ?>",
    }
</script>
<script>
$(document).ready(function() {
    fetchHistoryData();

    function fetchHistoryData() {
        $.ajax({
            url: '<?= base_url("pages/history/getData") ?>',
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                let html = '';
                if (response.length > 0) {
                    console.log(response);                    
                } else {
                    html = `<tr><td colspan="4">Tidak ada data</td></tr>`;
                }
                $('#history-table tbody').html(html);
            },
            error: function(xhr, status, error) {
                console.error('Gagal memuat data:', error);
            }
        });
    }
});
</script>

<script type="text/javascript" src="<?= base_url(); ?>assets/js/history.js"></script>