<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pompanaisasi</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
        .header, .footer {
            background-color: #006400;
            color: white;
            padding: 10px 0;
        }
        .header .container, .footer .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        h4 {
            margin: 25px 0;
        }
        .form-group label {
            font-weight: bold;
        }
        .content {
            padding: 30px 15px;
        }
        .content h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        .footer {
            margin-top: 30px;
        }
        .footer .map {
            width: 100%;
            height: 200px;
            background-color: #ddd;
        }
    </style>
</head>
<body>

<header class="header">
    <div class="container">
        <img src="/assets/img/logobbpsip.png" alt="Logo" style="height: 50px;">
        <div>
            <a href="/register" class="btn btn-outline-light mr-2">Daftar</a>
            <a href="/login" class="btn btn-light">Masuk</a>
        </div>
    </div>
</header>

<div class="container content">
    <h2>Pompanisasi</h2>
    <form>
        <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="pumpaRefocusingUnit">Luas Tanam</label>
                    <input type="text" class="form-control" id="pumpaRefocusingUnit" placeholder="Hektar (HA)">
                </div>
        </div>
        <h4>Pompa Refocusing</h4>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="pumpaRefocusingUnit">Usulan</label>
                <input type="text" class="form-control" id="pumpaRefocusingUnit" placeholder="Unit">
            </div>
            
            <div class="form-group col-md-3">
                <label for="pumpaRefocusingDelivered">Diterima</label>
                <input type="text" class="form-control" id="pumpaRefocusingDelivered" placeholder="Unit">
            </div>
            <div class="form-group col-md-3">
                <label for="pumpaRefocusingUsed">Digunakan</label>
                <input type="text" class="form-control" id="pumpaRefocusingUsed" placeholder="Unit">
            </div>
        </div>
        <h4>Pompa ABT</h4>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="pumpaABTUnit">Usulan</label>
                <input type="text" class="form-control" id="pumpaABTUnit" placeholder="Unit">
            </div>
            <div class="form-group col-md-3">
                <label for="pumpaABTDelivered">Diterima</label>
                <input type="text" class="form-control" id="pumpaABTDelivered" placeholder="Unit">
            </div>
            <div class="form-group col-md-3">
                <label for="pumpaABTUsed">Digunakan</label>
                <input type="text" class="form-control" id="pumpaABTUsed" placeholder="Unit">
            </div>
        </div>

        <h2>CPCL</h2>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="province">Provinsi</label>
                <select id="province" class="form-control">
                    <option selected>Pilih Provinsi</option>
                    <!-- Add options here -->
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="district">Kabupaten</label>
                <select id="district" class="form-control">
                    <option selected>Pilih Kabupaten</option>
                    <!-- Add options here -->
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="subdistrict">Kecamatan</label>
                <select id="subdistrict" class="form-control">
                    <option selected>Pilih Kecamatan</option>
                    <!-- Add options here -->
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="village">Desa</label>
                <select id="village" class="form-control">
                    <option selected>Pilih Desa</option>
                    <!-- Add options here -->
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="farmerGroup">Nama Petani</label>
                <input type="text" class="form-control" id="farmerGroup" placeholder="Nama Petani">
            </div>
            <div class="form-group col-md-6">
                <label for="uploadFile">Bukti Foto & File</label>
                <input type="file" class="form-control-file" id="uploadFile">
            </div>
        </div>
    </form>
</div>

<footer class="footer">
    <div class="container">
        <div class="contact-info">
            <p>Kontak:</p>
            <p>(0251) 8531727 | WA : 085282828696</p>
            <p>Email: bbpsip@apps.pertanian.go.id</p>
            <p>Jl. Tentara Pelajar No.10, RT.04/RW.07, Ciwaringin, Kecamatan Bogor Tengah, Kota Bogor, Jawa Barat 16124</p>
        </div>
        <div class="map">
            <p>Map Placeholder</p>
        </div>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
