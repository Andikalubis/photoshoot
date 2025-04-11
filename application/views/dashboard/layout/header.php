<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Ananda Group || Endoskopi</title>
    <link rel="icon" type="image/png" href="<?= asset_url('img/logo/group.png') ?>">

    <link href="<?= asset_url('tamplate/dash/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="<?= asset_url('tamplate/dash/css/sb-admin-2.min.css') ?>" rel="stylesheet">
    <!-- <script src="<= asset_url('js/jquery-3.6.0.min.js') ?>"></script> -->
    <script src="<?= asset_url('js/jquery-3.7.1.min.js') ?>"></script>
    <script src="<?= asset_url('js/jquery.dataTables.min.js') ?>"></script>
    <link href="<?= asset_url('css/jquery.dataTables.min.css') ?>" rel="stylesheet"></link>
    <link href="<?= asset_url('css/select2.min.css') ?>" rel="stylesheet"></link>
    <script src="<?= asset_url('js/select2.min.js') ?>"></script>
    <script src="<?= asset_url('js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= asset_url('js/bootstrap.min.js') ?>"></script>
    <script src="<?= asset_url('js/sweetalert2@11.js') ?>"></script>
    <script src="<?= asset_url('js/webcam.min.js') ?>"></script>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .container {
            max-width: 1000px;
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
        
        .custom-select-options li {
            padding: 8px 12px;
            cursor: pointer;
        }

        .custom-select-options li:hover {
            background-color: #f0f0f0;
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