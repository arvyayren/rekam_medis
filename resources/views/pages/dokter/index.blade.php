@extends('adminlte::page')

@section('title', 'Rekam Medis - Master Dokter')

@section('content_header')
    <h1>Index</h1>
@stop

@section('content')
    <x-adminlte-card title="List Dokter" theme="dark" icon="fas fa-list-alt">
        
        @include('widget.flash')

        <x-adminlte-modal id="create" title="Create" theme="success"
        icon="fas fa-plus-square" size='lg'>
            <form action="/master/dokter" method="post">
            @csrf
            <div class="row">
                <x-adminlte-input name="nama" label="Nama Lengkap" placeholder="Nama..."
                fgroup-class="col-md-6" disable-feedback required/>
                <x-adminlte-input name="no_ktp" label="No KTP" placeholder="No KTP..." max="16"
                fgroup-class="col-md-6" disable-feedback required/>
                <x-adminlte-input name="tempat_tgl_lahir" label="Tempat Tanggal Lahir" placeholder="Tempat Tgl Lahir..."
                fgroup-class="col-md-6" disable-feedback required/>
                <x-adminlte-select label="Jenis Kelamin" fgroup-class="col-md-6" name="jenis_kelamin" required>
                    <option value="-">-</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </x-adminlte-select>
                <x-adminlte-input name="umur" label="Umur" placeholder="Umur..."
                fgroup-class="col-md-6" disable-feedback required/>
                <x-adminlte-input name="alamat" label="Alamat" placeholder="Alamat..."
                fgroup-class="col-md-6" disable-feedback required/>
                <x-adminlte-input name="spesialis" label="Spesialis" placeholder="Spesialis..."
                fgroup-class="col-md-6" disable-feedback required/>
                <x-adminlte-input name="no_hp" label="No HP" placeholder="No HP..."
                fgroup-class="col-md-6" disable-feedback required/>
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
            'Nama',
            'Spesialis',
            ['label' => 'Actions', 'no-export' => true, 'width' => 5],
        ];

        $config = [
            'data' => $data,
            'order' => [[1, 'asc']],
            'columns' => [null, null, null, ['orderable' => false]],
        ];
        @endphp

        {{-- Minimal example / fill data using the component slot --}}
        <x-adminlte-datatable id="table1" :heads="$heads">
            @foreach($config['data'] as $row)
                <tr>
                    @foreach($row as $cell)
                        <td>{!! $cell !!}</td>
                    @endforeach
                    
                    <form id="delete{{$row[0]}}" method="POST" action="/master/dokter/{{$row[0]}}">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                    </form>

                </tr>
            @endforeach
        </x-adminlte-datatable>
        
    </x-adminlte-card>
@stop

@section('css')

@stop

@section('js')

@stop