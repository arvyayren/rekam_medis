@extends('adminlte::page')

@section('title', 'Rekam Medis - Pembayaran')

@section('content_header')
    <h1>Index</h1>
@stop

@section('content')
    <x-adminlte-card title="Pembayaran" theme="dark" icon="fas fa-list-alt">
        
        @include('widget.flash')

        <x-adminlte-modal id="create" title="Create" theme="success"
        icon="fas fa-plus-square" size='lg'>
            <form action="/transaksi/pembayaran" method="post">
            @csrf
            <div class="row">
                <x-adminlte-select name="id_resep_header" label="Kunjungan" fgroup-class="col-md-6" required>
                    <option disabled selected>Pilih Kunjungan..</option>
                    @foreach($resep as $r)
                    <option value="{{$r->id}}">{{$r->no_antrian}} - {{$r->nama_pasien}}</option>
                    @endforeach
                </x-adminlte-select>
            </div>

            <div class="row">
                
            </div>
            
            <x-adminlte-button icon="fas fa-check-circle" type="submit" label="Submit" class="bg-success btn-block"/>
            </form>

            <x-slot name="footerSlot">
                <x-adminlte-button theme="danger" label="Dismiss" data-dismiss="modal"/>
            </x-slot>
        </x-adminlte-modal>

        <x-adminlte-button icon="fas fa-plus-square" label="Create" data-toggle="modal" data-target="#create" class="bg-success"/>    
        <br/><br/>

        @php
        $heads = [
            'ID',
            'Tanggal',
            'No Kunjungan',
            'Nama Pasien',
            'Tarif Pemeriksaan',
            'Biaya Obat',
            'Total Pembayaran',
            'Status',
            ['label' => 'Actions', 'no-export' => true, 'width' => 5],
        ];

        $config = [
            'data' => $data,
            'order' => [[1, 'asc']],
            'columns' => [null, null, null, null, null,['orderable' => false]],
        ];
        @endphp

        {{-- Minimal example / fill data using the component slot --}}
        <x-adminlte-datatable id="table1" :heads="$heads">
            @foreach($config['data'] as $row)
                <tr>
                    @foreach($row as $cell)
                        <td>{!! $cell !!}</td>
                    @endforeach
                    
                    <form id="delete{{$row[0]}}" method="POST" action="/transaksi/pembayaran/{{$row[0]}}">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    </form>

                    <form id="lunas{{$row[0]}}" method="POST" action="/status/pembayaran/{{$row[0]}}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                    </form>

                </tr>
            @endforeach
        </x-adminlte-datatable>
        
    </x-adminlte-card>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css" integrity="sha512-f0tzWhCwVFS3WeYaofoLWkTP62ObhewQ1EZn65oSYDZUg1+CyywGKkWzm8BxaJj5HGKI72PnMH9jYyIFz+GH7g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js" integrity="sha512-AIOTidJAcHBH2G/oZv9viEGXRqDNmfdPVPYOYKGy3fti0xIplnlgMHUGfuNRzC6FkzIo0iIxgFnr9RikFxK+sw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@stop