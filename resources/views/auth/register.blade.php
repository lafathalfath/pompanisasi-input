<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Satgas Pompanisasi</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/logobbpsip.png') }}">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        body {
            font-family: "Poppins";
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .register-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            margin: 20px 0px;
        }
        .register-container .logo {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        .register-container h3 {
            text-align: center;
            margin-bottom: 20px;
        }
        .back-button {
            top: 10px;
            left: 10px;
            font-size: 20px;
            color: #007bff;
            text-decoration: none;
        }
        .back-button:hover {
            color: #0056b3;
        }
        .form-group label {
            font-weight: bold;
        }
        .login-link {
            text-align: center;
            margin-top: 20px;
        }
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
</head>
<body>

<div class="register-container">
    <a href="javascript:history.back()" class="back-button"><i class="fas fa-arrow-left"></i></a>
    <div class="logo">
        <img src="/assets/img/logobbpsip.png" alt="Logo">
    </div>
    <h3>Daftar Akun</h3>
    {{-- halaman daftar akun semua role kecuali admin --}}
    <form action="{{ route('register.register') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" name="nama" class="form-control" id="name" placeholder="Masukkan nama lengkap" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Masukkan email">
        </div>
        <div class="form-group">
            <label for="phone">Nomor Ponsel</label>
            <input type="number" name="no_hp" class="form-control" id="phone" placeholder="Masukkan Nomor Ponsel"required>
        </div>
        {{-- disini untuk memilih role yang dipilih user ketika mendaftar akun --}}
        <div class="form-group">
            <label for="role">Role</label>
            <select name="role_id" class="form-control" id="role" required>
                <option value="" disabled selected>Pilih Sebagai</option>
                @foreach ($role as $rl)
                    <option value="{{ $rl->id }}">PJ {{ $rl->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="pj_region">Region</label>
            <select name="region_id" class="form-control js-example-templating" id="pj_region" required disabled>
                <option selected>Pilih Region</option>
            </select>
        </div>
        <div class="form-group">
            <label for="password">Kata Sandi</label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Buat Kata Sandi" required autocomplete="new-password">
        </div>
        <div class="form-group">
            <label for="password">Konfirmasi Kata Sandi</label>
            <input type="password" name="password_confirmation" class="form-control" id="password-confirm" placeholder="Konfirmasi Kata Sandi" required autocomplete="new-password">
        </div>
        <button type="submit" class="btn btn-primary btn-block">Daftar</button>
    </form>
    <div class="login-link">
        Sudah punya akun? <a href="{{ route('login') }}" style="text-decoration: none;">Masuk</a><br>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(() => {
        $(".js-example-templating").select2();

        $('#role').change((e) => {
            if (e.target.value != 6) {
                $.ajax({
                    type: 'GET',
                    url: `/api/get-region/${e.target.value}`,
                    beforeSend: () => {
                        $('#pj_region').html('<option disabled selected>Waiting...</option>');
                    },
                    success: ({data}) => {
                        let options = '<option selected>Pilih Region</option>';
                        data.forEach((region) => {
                            options += `<option value="${region.id}">
                                ${region.nama}
                                ${region.nama_kabupaten ? `- ${region.nama_kabupaten}` : ''}
                                ${region.nama_provinsi ? `- ${region.nama_provinsi}` : ''}
                            </option>`;
                        });
                        $('#pj_region').html(options);
                    },
                    error: (err) => {
                        console.error(err)
                    },
                })

                $('#pj_region').prop('disabled', e.target.name == '')
            } else $('#pj_region').prop('disabled', true)
        })
    })
</script>
</body>
</html>
