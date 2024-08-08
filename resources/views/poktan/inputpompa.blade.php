<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Satgas Pompanisasi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
        .header, .footer {
            background-color: #007b83;
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
            padding: 20px 0;
        }
        footer .contact-info p a {
            color: white;
            text-decoration: none;
        }
        .map {
            width: 100%;
            height: 200px;
            background-color: #ddd;
        }
        footer .social-links {
        margin-top: 10px;
        }
        footer .social-links a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
        }
        footer .social-links a:hover {
            text-decoration: underline;
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

<header class="header">
    <div class="container">
        <img src="/assets/img/logo_light.png" alt="Logo" style="height: 50px;">
        <div>
            <a href="{{ route('logout') }}" class="btn btn-outline-light mr-2">Logout</a>
        </div>
    </div>
</header>

<div class="container content">
    <h2>Pompanisasi</h2>
    <form action="{{ route('poktan.pompa.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="pumpaRefocusingUnit">Luas Tanam</label>
                <input type="number" name="luas_tanam" class="form-control" id="pumpaRefocusingUnit" placeholder="Hektar (HA)">
            </div>
        </div>
        <h4>Pompa Refocusing</h4>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="pumpaRefocusingUnit">Usulan</label>
                <input type="number" name="pompa_refocusing_usulan" class="form-control" id="pumpaRefocusingUnit" placeholder="Unit">
            </div>
            
            <div class="form-group col-md-3">
                <label for="pumpaRefocusingDelivered">Diterima</label>
                <input type="number" name="pompa_refocusing_diterima" class="form-control" id="pumpaRefocusingDelivered" placeholder="Unit">
            </div>
            <div class="form-group col-md-3">
                <label for="pumpaRefocusingUsed">Digunakan</label>
                <input type="number" name="pompa_refocusing_digunakan" class="form-control" id="pumpaRefocusingUsed" placeholder="Unit">
            </div>
        </div>
        <h4>Pompa ABT</h4>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label for="pumpaABTUnit">Usulan</label>
                <input type="number" name="pompa_abt_usulan" class="form-control" id="pumpaABTUnit" placeholder="Unit">
            </div>
            <div class="form-group col-md-3">
                <label for="pumpaABTDelivered">Diterima</label>
                <input type="number" name="pompa_abt_diterima" class="form-control" id="pumpaABTDelivered" placeholder="Unit">
            </div>
            <div class="form-group col-md-3">
                <label for="pumpaABTUsed">Digunakan</label>
                <input type="number" name="pompa_abt_digunakan" class="form-control" id="pumpaABTUsed" placeholder="Unit">
            </div>
        </div>

        <h2 style="margin-top: 35px;">CPCL</h2>
        <div class="form-col">
            <div class="form-group col-md-6">
                <label for="provinsi">Provinsi</label>
                <div class="d-flex align-items-center">
                    <select id="provinsi" class="form-control js-example-templating" oninput="()=>console.log(this.value)">
                        <option selected>Pilih Provinsi</option>
                        @foreach($provinsi as $prov)
                            <option value="{{ $prov->id }}">{{ $prov->nama }}</option>
                        @endforeach
                    </select>
                    {{-- <button type="button" class="btn btn-primary btn-sm d-none" id="lainnya-provinsi" data-bs-toggle="modal" data-bs-target="#provinsiModal">Lainnya...</button> --}}
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="kabupaten">Kota/Kabupaten</label>
                <div class="d-flex align-items-center">
                    <select id="kabupaten" class="form-control js-example-templating" disabled>
                        <option selected>Pilih Kota/Kabupaten</option>
                        <!-- Add options here -->
                    </select>
                    {{-- <button type="button" class="btn btn-primary btn-sm d-none" id="lainnya-kabupaten" data-bs-toggle="modal" data-bs-target="#kabupatenModal">Lainnya...</button> --}}
                </div>
            </div> 
            <div class="form-group col-md-6">
                <label for="kecamatan">Kecamatan</label>
                <div class="d-flex align-items-center">
                    <select id="kecamatan" class="form-control js-example-templating" disabled>
                        <option selected>Pilih Kecamatan</option>
                        <!-- Add options here -->
                    </select>
                    <button type="button" class="btn btn-primary btn-sm d-none" id="lainnya-kecamatan" data-bs-toggle="modal" data-bs-target="#kecamatanModal">Lainnya...</button>
                </div>
            </div>                           
            <div class="form-group col-md-6">
            <label for="desa">Desa</label>
                <div class="d-flex align-items-center">
                    <select id="desa" name="desa_id" class="form-control js-example-templating" disabled>
                        <option selected>Pilih Desa</option>
                        <!-- Add options here -->
                    </select>
                    <button type="button" class="btn btn-primary btn-sm d-none" id="lainnya-desa" data-bs-toggle="modal" data-bs-target="#desaModal">Lainnya...</button>
                </div>
            </div>

            <div class="form-group col-md-6">
                <label for="farmerGroup">Foto Bukti</label>
                <input type="file" name="gambar" class="form-control" id="foto" name="foto" accept="image/*">
            </div>
            <div class="form-group col-md-6">
                <button type="submit" class="btn btn-success" style="margin-top: 30px;">Submit</button>
            </div>
        </div>
    </form>
</div>

<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.5443994375355!2d106.78557271018322!3d-6.5790339933869735!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69c5311ad80031%3A0xae42de3ba17aceb7!2sBalai%20Besar%20Penerapan%20Standar%20Instrumen%20Pertanian%20(BBPSIP)!5e0!3m2!1sen!2sid!4v1722608683905!5m2!1sen!2sid" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="col-md-6">
                <div class="contact-info">
                    <p>KONTAK</p>
                    <p>(0251) 8531727 | WA : 085282828696</p>
                    <p>Email: bbpsip@apps.pertanian.go.id</p>
                    <p>Jl. Tentara Pelajar No.10, RT.04/RW.07, Ciwaringin, Kecamatan Bogor Tengah, Kota Bogor, Jawa Barat 16124</p>

                    <p><a href="https://bbpsip.bsip.pertanian.go.id" target="_blank">https://bbpsip.bsip.pertanian.go.id</a></p>
                <div class="social-links">
                    <a href="https://www.facebook.com/BSIPPenerapan/" target="_blank"><i class="fab fa-facebook"></i></a>
                    <a href="https://www.youtube.com/@bsippenerapan" target="_blank"><i class="fab fa-youtube"></i></a>
                    <a href="https://instagram.com/bsippenerapan" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="https://twitter.com/bsippenerapan" target="_blank"><i class="fab fa-x-twitter"></i></a>
                    <a href="https://tiktok.com/@bsippenerapan" target="_blank"><i class="fab fa-tiktok"></i></a>
                </div>
                </div>
            </div>
        </div>
    </div>
</footer>

{{-- modals --}}
{{-- <div class="modal fade" id="provinsiModal" tabindex="-1" aria-labelledby="provinsiModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="provinsiModalLabel">Modal Provinsi</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-sm btn-primary">Tambah</button>
            </div>
        </form>
    </div>
</div> --}}
{{-- <div class="modal fade" id="kabupatenModal" tabindex="-1" aria-labelledby="kabupatenModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="kabupatenModalLabel">Modal Kabupaten</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-sm btn-primary">Tambah</button>
            </div>
        </form>
    </div>
</div> --}}

<div class="modal fade" id="kecamatanModal" tabindex="-1" aria-labelledby="kecamatanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('lokasi.kecamatan.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="kecamatanModalLabel">Tambah Data Kecamatan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="number" 
                class="d-none" 
                id="kecamatan-input-kabupaten_id" name="kabupaten_id">
                <input type="text" id="tambah-kecamatan" name="nama" placeholder="Nama Kecamatan">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-sm btn-primary">Tambah</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="desaModal" tabindex="-1" aria-labelledby="desaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('lokasi.desa.store') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="desaModalLabel">Tambah Data Desa</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="number" class="d-none" id="desa-input-kecamatan_id" name="kecamatan_id">
                <input type="text" id="tambah-desa" name="nama" placeholder="Nama Kecamatan">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-sm btn-primary">Tambah</button>
            </div>
        </form>
    </div>
</div>
{{-- end modals --}}

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    // console.log($('#a a')[0].text)
    $(document).ready(function() {
        $(".js-example-templating").select2();

        $('#provinsi').change(function() {
            let provinsiId = $(this).val();
            $('#kabupaten').prop('disabled', provinsiId == '');
            $('#kecamatan').prop('disabled', true).val('');
            $('#desa').prop('disabled', true).val('');

            // let options = '<option selected>Pilih Kota/Kabupaten</option>';
            // options += '<option val="9999">Buat Baru</option>';
            if (provinsiId) {
                $.ajax({
                    url: `/api/get-kabupaten/${provinsiId}`,
                    type: 'GET',
                    success: function(data) {
                        let options = '<option selected>Pilih Kota/Kabupaten</option>';
                        data.forEach(function(kabupaten) {
                            options += `<option value="${kabupaten.id}">${kabupaten.nama}</option>`;
                        });
                        $('#kabupaten').html(options);
                    },
                    error: (err) => {
                        console.error(err);
                    }
                });
            }
        });

        $('#kabupaten').change(function() {
            let kabupatenId = $(this).val();
            $('#kecamatan').prop('disabled', kabupatenId == '');
            $('#desa').prop('disabled', true).val('');

            if (kabupatenId) {
                $.ajax({
                    url: `/api/get-kecamatan/${kabupatenId}`,
                    type: 'GET',
                    success: function(data) {
                        let options = '<option selected>Pilih Kecamatan</option>';
                        data.forEach(function(kecamatan) {
                            options += `<option value="${kecamatan.id}">${kecamatan.nama}</option>`;
                        });
                        $('#kecamatan').html(options);
                    },
                    error: (err) => {
                        console.error(err);
                    }
                });
            }
        });

        $('#kecamatan').change(function() {
            let kecamatanId = $(this).val();
            $('#desa').prop('disabled', kecamatanId == '');

            if (kecamatanId) {
                $.ajax({
                    url: `/api/get-desa/${kecamatanId}`,
                    type: 'GET',
                    success: function(data) {
                        let options = '<option selected>Pilih Desa</option>';
                        data.forEach(function(desa) {
                            options += `<option value="${desa.id}">${desa.nama}</option>`;
                        });
                        $('#desa').html(options);
                    },
                    error: (err) => {
                        console.error(err);
                    }
                });
            }
        });

        // $('#provinsi').on('select2:open', e => {
        //     const all_options = [...$('#provinsi option')]
        //     let lowercase_options = []
        //     all_options.forEach((item) => {
        //         lowercase_options.push(item.text.toLowerCase())
        //     });
            
        //     const input = $('.select2-search__field')
        //     var inputValue = '';

        //     input.on('input', () => {
        //         inputValue = input[0].value
        //         if (!lowercase_options.includes(inputValue.toLowerCase()) || inputValue == '') {
        //             $('#lainnya-provinsi').removeClass('d-none')
        //         } else {
        //             $('#lainnya-provinsi').addClass('d-none')
        //         }
        //     })
        // });

        // $('#kabupaten').on('select2:open', e => {
        //     const all_options = [...$('#kabupaten option')]
        //     let lowercase_options = []
        //     all_options.forEach((item) => {
        //         lowercase_options.push(item.text.toLowerCase())
        //     });
            
        //     const input = $('.select2-search__field')
        //     var inputValue = '';

        //     input.on('input', () => {
        //         inputValue = input[0].value
        //         if (!lowercase_options.includes(inputValue.toLowerCase()) || inputValue == '') {
        //             $('#lainnya-kabupaten').removeClass('d-none')
        //         } else {
        //             $('#lainnya-kabupaten').addClass('d-none')
        //         }
        //     })
        // });

        $('#kecamatan').on('select2:open', e => {
            const all_options = [...$('#kecamatan option')]
            let lowercase_options = []
            all_options.forEach((item) => {
                lowercase_options.push(item.text.toLowerCase())
            });
            
            const input = $('.select2-search__field')
            var inputValue = '';

            input.on('input', () => {
                inputValue = input[0].value
                if (!lowercase_options.includes(inputValue.toLowerCase()) || inputValue == '') {
                    $('#lainnya-kecamatan').removeClass('d-none')
                } else {
                    $('#lainnya-kecamatan').addClass('d-none')
                }
            })
        });

        $('#desa').on('select2:open', e => {
            const all_options = [...$('#desa option')]
            let lowercase_options = []
            all_options.forEach((item) => {
                lowercase_options.push(item.text.toLowerCase())
            });
            
            const input = $('.select2-search__field')
            var inputValue = '';

            input.on('input', () => {
                inputValue = input[0].value
                if (!lowercase_options.includes(inputValue.toLowerCase()) || inputValue == '') {
                    $('#lainnya-desa').removeClass('d-none')
                } else {
                    $('#lainnya-desa').addClass('d-none')
                }
            })
        });

        $('#lainnya-kecamatan').on('click', () => {
            // console.log($('#kabupaten')[0].value);
            
            const input = $('#kecamatan-input-kabupaten_id')[0]
            input.value = parseInt($('#kabupaten').val())
        })

        $('#lainnya-desa').on('click', () => {
            const input = $('#desa-input-kecamatan_id')[0]
            input.value = parseInt($('#kecamatan').val())
        })

    });
</script>
</body>
</html>
