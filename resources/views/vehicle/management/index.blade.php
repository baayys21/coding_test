@extends('app.layouts.app')
@section('css')
    <style>
        .upword *{
            text-transform: capitalize
        }
    </style>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 p-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="col-md-6">
                            <h3 class="card-title"><b>Daftar Kendaraan</b></h3>
                        </div>
                        <div class="col-md-6 d-flex justify-content-end">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-create">
                                Tambah Kendaraan
                            </button>
                            <button type="button" class="btn btn-info mx-2" data-toggle="modal" data-target="#modal-rent">
                                Peminjaman Kendaraan
                            </button>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-return">
                                Pengembalian Kendaraan
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped table-hover compact" id="table_data" width="100%">
                            <thead>
                                <tr class="upword text-center">
                                    <th>merek</th>
                                    <th>model</th>
                                    <th>nomor plat</th>
                                    <th>tarif sewa perhari</th>
                                    <th>ketersediaan</th>
                                    <th>Sampai Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $dt)
                                    <tr class="upword text-center">
                                        <td>{{ $dt->merek }}</td>
                                        <td>{{ $dt->model }}</td>
                                        <td>{{ $dt->nomor_plat }}</td>
                                        <td>{{ $dt->tarif }}</td>
                                        <td>
                                            <span class="badge badge-{{ isset($dt->flag_used)? (($dt->flag_used == 1)? 'danger' : 'success') : '' }}">
                                                {{ isset($dt->flag_used)? (($dt->flag_used == 1)? 'Sedang di sewa' : 'Tersedia') : '' }}
                                            </span>
                                        </td>
                                        <td>{{ $dt->dateto == null? '-' : $dt->dateto }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Form --}}

    <div class="modal fade" id="modal-create">
        <form action="/kendaraan/manajemen/store" method="POST">
            @csrf
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Input data:</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="merek" class="text-uppercase">merek</label>
                            <input type="text" class="form-control" id="merek" name="merek" placeholder="Masukkan Merek" required>
                        </div>
                        <div class="form-group">
                            <label for="model" class="text-uppercase">model</label>
                            <input type="text" class="form-control" id="model" name="model" placeholder="Masukkan Model" required>
                        </div>
                        <div class="form-group">
                            <label for="nomor_plat" class="text-uppercase">nomor plat</label>
                            <input type="text" class="form-control" id="nomor_plat" name="nomor_plat" placeholder="Masukkan Nomor Plat" required>
                        </div>
                        <div class="form-group">
                            <label for="tarif_sewa_perhari" class="text-uppercase">tarif sewa perhari</label>
                            <input type="text" class="form-control" id="tarif_sewa_perhari" name="tarif_sewa_perhari" placeholder="Masukkan Tarif" required>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-end">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="modal fade" id="modal-rent">
        <form id="rent_form" action="/kendaraan/rent/store" method="POST">
            @csrf
        </form>
        <div class="modal-dialog modal-lg" id='rent_body'>
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Input data:</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="merek" class="text-uppercase">merek</label>
                            <input type="text" class="form-control" id="rent_merek" name="merek" placeholder="Masukkan Merek" required onkeydown="getListVehicle(event.key, this.value)">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="model" class="text-uppercase">model</label>
                            <select name="id_vehicle" class="form-control" id="rent_model" disabled></select>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="datefrom" class="text-uppercase">Dari tanggal</label>
                                <input type="date" name="datefrom" class="form-control" id="datefrom" value="{{ date('Y-m-d') }}" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="dateto" class="text-uppercase">Sampai tanggal</label>
                                <input type="date" name="dateto" class="form-control" id="dateto" value="{{ date('Y-m-d') }}" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-end">
                    <button class="btn btn-primary" id="btnRent" onclick="rentSubmit()">Sewa</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-return">
        <form action="/kendaraan/manajemen/store" method="POST">
            @csrf
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Input data:</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="merek" class="text-uppercase">merek</label>
                            <input type="text" class="form-control" id="merek" name="merek" placeholder="Masukkan Merek" required>
                        </div>
                        <div class="form-group">
                            <label for="model" class="text-uppercase">model</label>
                            <input type="text" class="form-control" id="model" name="model" placeholder="Masukkan Model" required>
                        </div>
                        <div class="form-group">
                            <label for="nomor_plat" class="text-uppercase">nomor plat</label>
                            <input type="text" class="form-control" id="nomor_plat" name="nomor_plat" placeholder="Masukkan Nomor Plat" required>
                        </div>
                        <div class="form-group">
                            <label for="tarif_sewa_perhari" class="text-uppercase">tarif sewa perhari</label>
                            <input type="text" class="form-control" id="tarif_sewa_perhari" name="tarif_sewa_perhari" placeholder="Masukkan Tarif" required>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-end">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @section('js')
        <script>
            $('#table_data').DataTable({
                scrollX : true,
                scrollY : '500px'
            });

            function getListVehicle(button, value) {
                let select = document.getElementById('rent_model');
                let datefrom = document.getElementById('datefrom');
                let dateto = document.getElementById('dateto');
                datefrom.disabled = true;
                dateto.disabled = true;
                select.disabled = true;
                if(select.firstChild){
                    select.innerHTML = '';
                }
                if(button.toLowerCase() == 'enter'){
                    axios.post('{{ url("kendaraan/getlistvehicle") }}', {
                            'merek' : value
                    }, {
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRFToken': '{{ csrf_token() }}'
                        }
                    }).then(response => {
                        console.log(response.data);
                        for (const dt of response.data) {
                            let opt = document.createElement('option');
                            opt.value = dt.id;
                            opt.textContent = dt.model + ' (' + dt.nomor_plat + ')';
                            select.appendChild(opt);
                        }
                    }).finally(() => {
                        select.disabled = false;
                        datefrom.disabled = false;
                        dateto.disabled = false;
                    })
                }
            }
            function rentSubmit() {
                var form = document.getElementById('rent_form');
                var body = document.getElementById('rent_body');

                form.appendChild(body);
                form.submit();
                console.log('test');
            }
        </script>
    @endsection

@endsection
