<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <title>Sistem Informasi Pompanisasi</title>
  <style>
    body {
  font-family: Poppins, sans-serif;
  margin: 0;
  padding: 0;
  display: flex;
}

.sidebar {
  width: 180px;
  background-color: #007b83;
  color: white;
  height: 100%;
  position: fixed;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.sidebar-header {
  text-align: center;
  padding: 20px;
}

.logo {
  width: 80px;
  height: 80px;
}

.sidebar h1 {
  font-size: 18px;
  margin: 10px 0 0;
}

.sidebar-menu {
  list-style: none;
  padding: 0;
  margin: 0;
  width: 100%;
}

.sidebar-menu li {
  width: 100%;
}

.sidebar-menu li a {
  display: block;
  padding: 15px 20px;
  color: white;
  text-decoration: none;
}

.sidebar-menu li a:hover {
  background-color: #005f62;
}

.logout {
  margin-top: auto;
  padding: 15px 20px;
  width: 100%;
  text-align: center;
  color: white;
  text-decoration: none;
}

.logout:hover {
  background-color: #005f62;
}

.content {
  margin-left: 150px;
  padding: 20px;
  flex-grow: 1;
}

  </style>
</head>
<body>
  <div class="sidebar">
    <div class="sidebar-header">
      <img src="/assets/img/logobbpsip.png" alt="Logo" class="logo">
      <h1>Pompanisasi <br> Kab. Simeulue</h1>
    </div>
    <ul class="sidebar-menu">
      <li><a href="#dashboard">Dashboard</a></li>
      <li><a href="#verifikasi-data">Verifikasi Data</a></li>
    </ul>
    <a href="#logout" class="logout">Logout</a>
  </div>
  <div class="content">
    <!-- Main content goes here -->
  </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Verifikasi Data</h2>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th colspan="3">Pompa Refocusing</th>
            <th colspan="3">Pompa ABT</th>
            <th></th>
        </tr>
        <tr>
            <th>No</th>
            <th>Kecamatan</th>
            <th>Nama Poktan</th>
            <th>Luas <br> Tanam</th>
            <th>Usulan</th>
            <th>Diterima</th>
            <th>Digunakan</th>
            <th>Usulan</th>
            <th>Diterima</th>
            <th>Digunakan</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>1</td>
            <td>Teupah Selatan</td>
            <td>Bambang Rahmadi</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>
                <button class="btn btn-primary btn-sm">Edit</button>
                <button class="btn btn-success btn-sm"><span>&#10003;</span></button>
                <button class="btn btn-danger btn-sm"><span>&#x292C;</span></button>
            </td>
        </tr>
        <tr>
            <td>2</td>
            <td>Simeulue Timur</td>
            <td>Ahyu Puspita Sari, SP</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>
                <button class="btn btn-primary btn-sm">Edit</button>
                <button class="btn btn-success btn-sm"><span>&#10003;</span></button>
                <button class="btn btn-danger btn-sm"><span>&#x292C;</span></button>
            </td>
        </tr>
        <tr>
            <td>3</td>
            <td>Teupah Barat</td>
            <td>Mislosi Dayanti</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>
                <button class="btn btn-primary btn-sm">Edit</button>
                <button class="btn btn-success btn-sm"><span>&#10003;</span></button>
                <button class="btn btn-danger btn-sm"><span>&#x292C;</span></button>
            </td>
        </tr>
        <tr>
            <td>4</td>
            <td>Teupah Tengah</td>
            <td>Fitriana, A. Md</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>
                <button class="btn btn-primary btn-sm">Edit</button>
                <button class="btn btn-success btn-sm"><span>&#10003;</span></button>
                <button class="btn btn-danger btn-sm"><span>&#x292C;</span></button>
            </td>
        </tr>
        <tr>
            <td>5</td>
            <td>Simeulue Tengah</td>
            <td>Herliansah</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>
                <button class="btn btn-primary btn-sm">Edit</button>
                <button class="btn btn-success btn-sm"><span>&#10003;</span></button>
                <button class="btn btn-danger btn-sm"><span>&#x292C;</span></button>
            </td>
        </tr>
        <tr>
            <td>6</td>
            <td>Teluk Dalam</td>
            <td>Faisal Sukri</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>
                <button class="btn btn-primary btn-sm">Edit</button>
                <button class="btn btn-success btn-sm"><span>&#10003;</span></button>
                <button class="btn btn-danger btn-sm"><span>&#x292C;</span></button>
            </td>
        </tr>
        <tr>
            <td>7</td>
            <td>Simeulue Cut</td>
            <td>Sri Irwani</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>
                <button class="btn btn-primary btn-sm">Edit</button>
                <button class="btn btn-success btn-sm"><span>&#10003;</span></button>
                <button class="btn btn-danger btn-sm"><span>&#x292C;</span></button>
            </td>
        </tr>
        <tr>
            <td>8</td>
            <td>Salang</td>
            <td>Muhammad Ashari, S.TP</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>
                <button class="btn btn-primary btn-sm">Edit</button>
                <button class="btn btn-success btn-sm"><span>&#10003;</span></button>
                <button class="btn btn-danger btn-sm"><span>&#x292C;</span></button>
            </td>
        </tr>
        <tr>
            <td>9</td>
            <td>Simeulue Barat</td>
            <td>Imran Fajri, SP</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>
                <button class="btn btn-primary btn-sm">Edit</button>
                <button class="btn btn-success btn-sm"><span>&#10003;</span></button>
                <button class="btn btn-danger btn-sm"><span>&#x292C;</span></button>
            </td>
        </tr>
        <tr>
            <td>10</td>
            <td>Alafan</td>
            <td>Suldahna, SP</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>
                <button class="btn btn-primary btn-sm">Edit</button>
                <button class="btn btn-success btn-sm"><span>&#10003;</span></button>
                <button class="btn btn-danger btn-sm"><span>&#x292C;</span></button>
            </td>
        </tr>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
