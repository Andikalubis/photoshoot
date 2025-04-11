<!-- Modal -->
<div class="modal fade" id="modalInfoPasien" tabindex="-1" role="dialog" aria-labelledby="modalInfoPasienLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalInfoPasienLabel">Info Pasien</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="form-container" class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="no_rm">No. RM:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="no_rm" name="no_rm">
                                    <!-- <div class="input-group-append">
                                        <button class="btn btn-secondary" type="button" id="btnCariRM">Cari</button>
                                    </div> -->
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama">Nama:</label>
                            <input type="text" class="form-control" id="nama" name="nama">
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" id="startBtn">Simpan</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
