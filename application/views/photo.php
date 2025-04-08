<?php $this->load->view('tamplate/head'); ?>

<body>

    <div class="container">
        <h2>Photoshoot Form</h2>

        <div class="form-group">
            <label>Nama:</label>
            <input type="text" id="nama" name="nama">
        </div>

        <div class="form-group">
            <label>No. RM:</label>
            <input type="text" id="no_rm" name="no_rm">
        </div>

        <div class="camera-section">
            <div>
                <div id="my_camera"></div>
                <button onclick="take_snapshot()">Ambil Foto</button>
            </div>
            <div id="results"></div>
        </div>
    </div>

    <script type="text/javascript">
        Webcam.set({
            width: 320,
            height: 240,
            image_format: 'jpeg',
            jpeg_quality: 90
        });
        Webcam.attach('#my_camera');

        function take_snapshot() {
            let nama = $('#nama').val().trim();
            let no_rm = $('#no_rm').val().trim();

            if (!nama || !no_rm) {
                alert("Isi semua form terlebih dahulu!");
                return;
            }

            Webcam.snap(function(data_uri) {
                $('#results').html('<img src="'+data_uri+'" style="width: 100%; border-radius: 8px;" />');

                $.post("<?= site_url('photoshoot/capture') ?>", {
                    nama: nama,
                    no_rm: no_rm,
                    image: data_uri
                }, function(response) {
                    alert(response);
                });
            });
        }
    </script>

</body>
</html>
