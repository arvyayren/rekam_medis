@extends('adminlte::page')

@section('title', 'Rekam Medis - Daftar Pasien Baru')

@section('content_header')
    <h1>Index</h1>
@stop

@section('content')

    <x-adminlte-card title="Daftar Pasien Baru" theme="dark" icon="fas fa-list-alt">
        
        @php
        $heads = [
            'Nomor',
            'Tanggal Pendaftaran',
            'Nama',
            'No KTP',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Jenis Kelamin',
            'Umur',
            'Alamat',
            'Jenis Pasien'
        ];

        $config = [
            'data' => $data,
            'order' => [[1, 'asc']],
            'columns' => [null, null, null, null, null,null, null, null, null, null]
        ];
        @endphp

        {{-- Minimal example / fill data using the component slot --}}
        <x-adminlte-datatable id="table1" :heads="$heads">
            @foreach($config['data'] as $row)
                <tr>
                    @foreach($row as $cell)
                        <td>{!! $cell !!}</td>
                    @endforeach

                </tr>
            @endforeach
        </x-adminlte-datatable>
        
    </x-adminlte-card>
@stop

@section('css')

@stop

@section('js')

@stop