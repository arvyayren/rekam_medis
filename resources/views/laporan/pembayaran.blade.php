@extends('adminlte::page')

@section('title', 'Rekam Medis - Laporan Pembayaran ' .$tanggal_awal.' s/d '.$tanggal_akhir)

@section('content_header')
    <h1>Laporan Pembayaran</h1>
@stop

@section('content')

    <div class="card p-5">
        <h5 class="pb-5">Pilih Parameter</h5>
        <form action="" method="get">
            <div class="row">
                <div class="col-md-6">
                    <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control" 
                    @isset($data)
                        value="{{ $tanggal_awal }}"
                    @endisset
                    >
                </div>
                <div class="col-md-6">
                    <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control"
                    @isset($data)
                        value="{{ $tanggal_akhir }}"
                    @endisset
                    >
                </div>
                <div class="col-md-6 pt-3">
                    <button class="btn btn-primary" type="submit">
                        Cari
                    </button>
                </div>
            </div>
        </form>
    </div>

    @if(count($data) > 0)
    <div class="card p-5">
    <table id="example" class="display nowrap" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>No Kunjungan</th>
                <th>Nama Pasien</th>
                <th>Total Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $datas)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $datas->no_antrian}}</td>
                <td>{{ $datas->nama_pasien }}</td>
                <td>{{ $datas->total_pembayaran }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3" style="text-align:right">Total:</th>
                <th></th>
            </tr>
        </tfoot>
    </table>
    </div>
    @endif
    
@stop

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script>
    $(document).ready(function() {
        $('#example').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                { extend: 'copyHtml5', footer: true },
                { extend: 'excelHtml5', footer: true },
                { extend: 'csvHtml5', footer: true },
                { extend: 'pdfHtml5', footer: true },
                { extend: 'print', footer: true }
            ],
            footerCallback: function (row, data, start, end, display) {
                var api = this.api();
    
                // Remove the formatting to get integer data for summation
                var intVal = function (i) {
                    return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                };
    
                // Total over all pages
                total = api
                    .column(3)
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);
    
                // Total over this page
                pageTotal = api
                    .column(3, { page: 'current' })
                    .data()
                    .reduce(function (a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);
    
                // Update footer
                $(api.column(3).footer()).html('Rp' + pageTotal + ' ( Rp' + total + ' total)');
            },
        } );
    } );
</script>
@stop