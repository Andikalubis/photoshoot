<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Photoshoot App</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="<?= base_url('assets/js/jquery-3.6.0.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/sweetalert2@11.js') ?>"></script>
    <script src="<?= base_url('assets/js/webcam.min.js') ?>"></script>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .container {
            max-width: 600px;
            margin: 80px auto;
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
            border: 1.5px solid #00AAC1;
            border-radius: 6px;
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
            margin-top: 20px;
        }

        button:hover {
            background-color: #0056b3;
        }

        .fullscreen-container {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 100vw;
            background-color: #fff;
            z-index: 999;
            padding: 20px;
            box-sizing: border-box;
            overflow: auto;
        }

        .camera-content {
            display: flex;
            height: 100%;
            gap: 20px;
            flex-direction: row;
        }

        .camera-left {
            flex: 3;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            gap: 10px;
        }

        .camera-right {
            flex: 2;
            overflow-y: auto;
            border-left: 2px solid #ccc;
            padding-left: 20px;
        }

        #my_camera {
            width: 100%;
            max-width: 100%;
            height: auto;
            aspect-ratio: 4 / 3;
            border: 2px solid #ccc;
            border-radius: 8px;
            background-color: #eee;
        }

        .results-container {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-top: 10px;
        }

        .result-image {
            width: 100%;
            height: auto;
            border-radius: 8px;
            border: 2px solid #00AAC1;
            object-fit: cover;
        }

        .camera-header {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .camera-header h2 {
            margin: 0;
            color: #333;
        }

        #backBtn {
            background-color: #dc3545;
            padding: 8px 14px;
            font-size: 14px;
            border-radius: 5px;
        }

        #backBtn:hover {
            background-color: #b02a37;
        }

        .note {
            text-align: left;
            color: red;
            font-weight: bold;
            font-size: 14px;
            margin-bottom: 10px;
            width: 100%;
        }

        @media (max-width: 768px) {
            .camera-content {
                flex-direction: column;
            }

            .camera-left,
            .camera-right {
                flex: unset;
                width: 100%;
            }

            .camera-right {
                border-left: none;
                padding-left: 0;
            }

            .camera-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            #backBtn {
                align-self: flex-end;
            }
        }
    </style>
</head>
<body>

<div class="container" id="form-container">
    <h2>Info Pasien</h2>

    <div class="form-group">
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama">
    </div>

    <div class="form-group">
        <label for="no_rm">No. RM:</label>
        <input type="text" id="no_rm" name="no_rm">
    </div>

    <div style="text-align: right;">
        <button id="startBtn">Mulai</button>
    </div>
</div>

<div class="fullscreen-container" id="camera-container">
    <div class="camera-content">
        <div class="camera-left">
            <div class="camera-header">
                <h2>Ambil Foto</h2>
                <button id="backBtn">Selesai</button>
            </div>
            <div class="note">Klik kanan di mana saja untuk mengambil gambar (maksimal 8)...!!!</div>
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
    Webcam.set({
        width: 1280,
        height: 720,
        image_format: 'jpeg',
        jpeg_quality: 90
    });

    let photoCount = 0;
    const maxPhotos = 20;

    $('#startBtn').on('click', function () {
        let nama = $('#nama').val().trim();
        let no_rm = $('#no_rm').val().trim();

        if (!nama || !no_rm) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Isi semua form terlebih dahulu!',
                timer: 1000,
                showConfirmButton: false,
                timerProgressBar: true
            });
            return;
        }

        $('#form-container').hide();
        $('#camera-container').css('display', 'block');
        Webcam.attach('#my_camera');
    });

    const shutterSound = document.getElementById('shutterSound');

    $('#backBtn').on('click', function () {
        window.location.reload();
    });

    $(document).on('contextmenu', function (e) {
        if (!$('#camera-container').is(':visible')) return;
        e.preventDefault();

        if (photoCount >= maxPhotos) {
            Swal.fire({
                icon: 'info',
                title: 'Batas Tercapai',
                text: 'Anda hanya bisa mengambil maksimal 8 foto.',
                timer: 1000,
                showConfirmButton: false,
                timerProgressBar: true
            });
            return;
        }

        let nama = $('#nama').val().trim();
        let no_rm = $('#no_rm').val().trim();

        shutterSound.currentTime = 0;
        shutterSound.play();

        Webcam.snap(function (data_uri) {
            photoCount++;

            const imageElement = `<img src="${data_uri}" class="result-image" />`;
            $('#results').append(imageElement);

            $.post("<?= site_url('photo/capture') ?>", {
                nama: nama,
                no_rm: no_rm,
                image: data_uri
            }, function (response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: response,
                    timer: 1000,
                    showConfirmButton: false,
                    timerProgressBar: true
                });
            });
        });
    });
</script>

</body>
</html>
