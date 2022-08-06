@extends('adminlte::page')

@section('title', 'Rekam Medis - Master Obat')

@section('content_header')
    <h1>Edit</h1>
@stop

@section('content')
    <x-adminlte-card title="Edit Obat" theme="dark" icon="fas fa-list-alt">
        
        @include('widget.flash')

        <form action="/master/obat/{{$data->id}}" method="post">
        @csrf
        {{ method_field('PUT') }}
        <div class="row">
            @php
            $config = ['format' => 'Y-m-d'];
            @endphp
            <x-adminlte-input name="nama" label="Nama" value="{{$data->nama}}"
            fgroup-class="col-md-6" disable-feedback required/>
            <x-adminlte-input name="kode" label="Kode"  value="{{$data->kode}}"
            fgroup-class="col-md-6" disable-feedback required/>
            <x-adminlte-input-date name="tgl_registrasi"  value="{{$data->tgl_registrasi}}" :config="$config" placeholder="Pilih Tanggal..."
                label="Tanggal Registrasi" label-class="text-primary" fgroup-class="col-md-6" required>
                <x-slot name="prependSlot">
                    <x-adminlte-button theme="outline-primary" icon="fas fa-calendar-alt"
                        title="Tanggal Registrasi"/>
                </x-slot>
            </x-adminlte-input-date>
            <x-adminlte-input-date name="tgl_expired"  value="{{$data->tgl_expired}}" :config="$config" placeholder="Pilih Tanggal..."
                label="Tanggal Expired" label-class="text-primary" fgroup-class="col-md-6" required>
                <x-slot name="prependSlot">
                    <x-adminlte-button theme="outline-primary" icon="fas fa-calendar-alt"
                        title="Tanggal Expired"/>
                </x-slot>
            </x-adminlte-input-date>
            <x-adminlte-input name="jenis" label="Jenis Obat" value="{{$data->jenis}}"
            fgroup-class="col-md-6" disable-feedback required/>
        </div>
        
        <x-adminlte-button icon="fas fa-check-circle" type="submit" label="Submit" class="bg-success btn-block"/>
        </form>

    </x-adminlte-card>
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css" integrity="sha512-f0tzWhCwVFS3WeYaofoLWkTP62ObhewQ1EZn65oSYDZUg1+CyywGKkWzm8BxaJj5HGKI72PnMH9jYyIFz+GH7g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js" integrity="sha512-AIOTidJAcHBH2G/oZv9viEGXRqDNmfdPVPYOYKGy3fti0xIplnlgMHUGfuNRzC6FkzIo0iIxgFnr9RikFxK+sw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@stop