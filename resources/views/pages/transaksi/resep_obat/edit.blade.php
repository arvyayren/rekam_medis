@extends('adminlte::page')

@section('title', 'Rekam Medis - Resep Obat')

@section('content_header')
    <h1>Edit Resep Obat</h1>
@stop

@section('content')
    <x-adminlte-card title="Edit Resep Obat" theme="dark" icon="fas fa-list-alt">
        
        @include('widget.flash')

        <form action="/transaksi/resep_obat/{{$data->id}}" method="post">
        @csrf
        {{ method_field('PUT') }}
        <div class="row">
            <x-adminlte-input name="created_at" label="Tanggal" value="{{ $data->created_at }}" disabled
                fgroup-class="col-md-6" disable-feedback required/>
                
            <x-adminlte-input name="id_kunjungan" label="No Kunjungan" value="{{ $data->no_antrian }}" disabled
                fgroup-class="col-md-6" disable-feedback required/>
        </div>
        
        <div class="row">
            <x-adminlte-input name="nama" label="Nama Pasien" value="{{ $data->nama_pasien }}" disabled
                fgroup-class="col-md-6" disable-feedback required/>

            <x-adminlte-input name="biaya_obat" label="Biaya Obat" value="{{ $data->biaya_obat }}" 
                fgroup-class="col-md-6" disable-feedback required/>
        </div>
        <x-adminlte-button icon="fas fa-check-circle" type="submit" label="Submit" class="bg-success btn-block"/>
        </form>
    </x-adminlte-card>
    

    <x-adminlte-card title="Detail Resep Obat" theme="dark" icon="fas fa-list-alt">
        
        <x-adminlte-modal id="create" title="Create" theme="success"
            icon="fas fa-plus-square" size='lg'>
                        
                <form action="/transaksi/resep_obat_detail" method="post">
                @csrf
                
                <input type="hidden" name="id_resep_header" value="{{$data->id}}" />

                <div class="row">
                    <x-adminlte-select name="id_obat" label="Obat" fgroup-class="col-md-6" required>
                        <option disabled selected>Pilih Obat..</option>
                        @foreach($obat as $o)
                        <option value="{{$o->id}}">{{$o->kode}} - {{$o->nama}}</option>
                        @endforeach
                    </x-adminlte-select>
                    <x-adminlte-input name="jumlah" label="Jumlah" value="" 
                        fgroup-class="col-md-6" disable-feedback required/>
                </div>
                
                <div class="row">
                    <x-adminlte-textarea fgroup-class="col-md-12" label="Keterangan" name="keterangan"/>
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
                'Kode Obat',
                'Nama Obat',
                'Jumlah',
                'Keterangan',
                ['label' => 'Actions', 'no-export' => true, 'width' => 5],
            ];

            $config_table = [
                'data' => $resepobat,
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
                        
                        <form id="delete{{$row[0]}}" method="POST" action="/transaksi/resep_obat_detail/{{$row[0]}}">
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