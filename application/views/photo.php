<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Photoshoot App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="<?= base_url('assets/js/jquery-3.6.0.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/webcam.min.js') ?>"></script>

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1100px;
            margin: 60px auto;
            background-color: #fff;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 6px;
            color: #333;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        .camera-section {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            margin-top: 30px;
            justify-content: center;
        }

        #my_camera, #results {
            width: 480px;
            height: 360px;
            border: 2px solid #ccc;
            border-radius: 8px;
            background-color: #eee;
        }

        button {
            display: inline-block;
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 10px;
        }

        button:hover {
            background-color: #0056b3;
        }

        @media (max-width: 768px) {
            .camera-section {
                flex-direction: column;
                align-items: center;
            }

            #my_camera, #results {
                width: 100%;
                height: auto;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Photoshoot Form</h2>

    <div class="form-group">
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" class="form-control">
    </div>

    <div class="form-group">
        <label for="no_rm">No. RM:</label>
        <input type="text" id="no_rm" name="no_rm" class="form-control">
    </div>

    <div class="camera-section">
        <div>
            <div id="my_camera"></div>
        </div>
        <div id="results"></div>
    </div>
    
    <div style="margin-top: 2rem;">
        <span style="color: red;"> KLIK KANAN DIMANA SAJA UNTUK MENGAMBIL GAMBAR....!!!</span>
    </div>
</div>

<script src="<?= base_url('assets/js/sweetalert2@11.js') ?>"></script>

<script type="text/javascript">
    Webcam.set({
        width: 480,
        height: 360,
        image_format: 'jpeg',
        jpeg_quality: 90
    });
    Webcam.attach('#my_camera');

    $(document).on('contextmenu', function(e) {
        e.preventDefault();

        let nama = $('#nama').val().trim();
        let no_rm = $('#no_rm').val().trim();

        if (!nama || !no_rm) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Isi semua form terlebih dahulu!',
                confirmButtonColor: '#007bff'
            });
            return;
        }

        Webcam.snap(function(data_uri) {
            $('#results').html('<img src="' + data_uri + '" style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;" />');

            $.post("<?= site_url('photo/capture') ?>", {
                nama: nama,
                no_rm: no_rm,
                image: data_uri
            }, function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: response,
                    confirmButtonColor: '#007bff'
                });
            });
        });
    });
</script>

</body>
</html>
