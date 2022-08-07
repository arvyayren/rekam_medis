@extends('adminlte::page')

@section('title', 'Rekam Medis - Data Rekam Medis')

@section('content_header')
    <h1>Edit Rekam Medis</h1>
@stop

@section('content')
    <x-adminlte-card title="Edit Rekam Medis" theme="dark" icon="fas fa-list-alt">
        
        @include('widget.flash')
        <div class="row">
            <x-adminlte-input name="no_registrasi_pasien" label="No Registrasi" value="{{ $data->no_registrasi_pasien }}" disabled
                fgroup-class="col-md-6" disable-feedback required/>

            <x-adminlte-input name="nama" label="Nama Pasien" value="{{ $data->nama }}" disabled
                fgroup-class="col-md-6" disable-feedback required/>
        </div>
        
        <div class="row">
            <x-adminlte-input name="jenis_kelamin" label="Jenis Kelamin" value="{{ $data->jenis_kelamin }}" disabled
                fgroup-class="col-md-6" disable-feedback required/>
            
            <x-adminlte-input name="alamat" label="Alamat" value="{{ $data->alamat }}" disabled
                fgroup-class="col-md-6" disable-feedback required/>
        </div>
    </x-adminlte-card>

    <x-adminlte-card title="Detail Rekam Medis" theme="dark" icon="fas fa-list-alt">
        
        <x-adminlte-modal id="create" title="Create" theme="success"
            icon="fas fa-plus-square" size='lg'>
            
                @php
                    $config = ['format' => 'Y-m-d'];
                @endphp
                
                <form action="/transaksi/rekam_medis_detail" method="post">
                @csrf
                
                <input type="hidden" name="id_rekam_medis_header" value="{{$data->id}}" />

                <div class="row">
                    <x-adminlte-input-date name="tanggal_pemeriksaan" :config="['format' => 'Y-m-d']" placeholder="Pilih Tanggal..."
                        label="Tanggal Pemeriksaan" label-class="text-primary" fgroup-class="col-md-6" required>
                        <x-slot name="prependSlot">
                            <x-adminlte-button theme="outline-primary" icon="fas fa-calendar-alt"
                                title="Tanggal Pemeriksaan"/>
                        </x-slot>
                    </x-adminlte-input-date>
                </div>

                <div class="row">
                    <x-adminlte-select name="id_kunjungan" label="No Kunjungan" fgroup-class="col-md-6" required>
                        <option disabled selected>Pilih Pasien..</option>
                        @foreach($kunjungan as $k)
                        <option value="{{$k->id}}">{{$k->no_antrian}} - {{$k->nama_pasien}}</option>
                        @endforeach
                    </x-adminlte-select>
                    <x-adminlte-select name="id_dokter" label="Dokter" fgroup-class="col-md-6" required>
                        <option disabled selected>Pilih Dokter..</option>
                        @foreach($dokter as $d)
                        <option value="{{$d->id}}">{{$d->nama}}</option>
                        @endforeach
                    </x-adminlte-select>
                </div>
                
                <div class="row">
                    <x-adminlte-textarea fgroup-class="col-md-12" label="Anamnesa Pemeriksaan" name="anamnesa_pemeriksaan"/>
                    <x-adminlte-textarea fgroup-class="col-md-12" label="Rujuk Pengobatan Tindakan" name="rujuk_pengobatan"/>
                </div>

                <x-adminlte-button icon="fas fa-check-circle" type="submit" label="Submit" class="bg-success btn-block"/>
                </form>

                <x-slot name="footerSlot">
                    <x-adminlte-button theme="danger" label="Dismiss" data-dismiss="modal"/>
                </x-slot>
            </x-adminlte-modal>
            @if(Auth::user()->email == 'dokter@dokter.com')
            <x-adminlte-button icon="fas fa-plus-square" label="Create" data-toggle="modal" data-target="#create" class="bg-success"/>    
            <br/><br/>
            @endif

            @php
            $heads = [
                'ID',
                'No Kunjungan',
                'Tanggal Pemeriksaan',
                'Anamnesa Pemeriksaan',
                'Rujuk Pengobatan',
                ['label' => 'Actions', 'no-export' => true, 'width' => 5],
            ];

            $config_table = [
                'data' => $rekammedis,
                'order' => [[1, 'asc']],
                'columns' => [null, null, null, null, null, null,['orderable' => false]],
            ];
            @endphp

            {{-- Minimal example / fill data using the component slot --}}
            <x-adminlte-datatable id="table1" :heads="$heads">
                @foreach($config_table['data'] as $row)
                    <tr>
                        @foreach($row as $cell)
                            <td>{!! $cell !!}</td>
                        @endforeach
                        
                        <form id="delete{{$row[0]}}" method="POST" action="/transaksi/rekam_medis_detail/{{$row[0]}}">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
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