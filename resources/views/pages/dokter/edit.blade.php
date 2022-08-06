@extends('adminlte::page')

@section('title', 'Rekam Medis - Master Dokter')

@section('content_header')
    <h1>Edit</h1>
@stop

@section('content')
    <x-adminlte-card title="Edit Dokter" theme="dark" icon="fas fa-list-alt">
        
        @include('widget.flash')

        <form action="/master/dokter/{{$data->id}}" method="post">
        @csrf
        {{ method_field('PUT') }}
        <div class="row">
            <x-adminlte-input name="nama" label="Nama" value="{{$data->nama}}"
            fgroup-class="col-md-6" disable-feedback required/>
            <x-adminlte-input name="no_ktp" label="No KTP" value="{{$data->no_ktp}}" max="16"
            fgroup-class="col-md-6" disable-feedback required/>
            <x-adminlte-input name="tempat_tgl_lahir" label="Tempat Tanggal Lahir" value="{{$data->tempat_tgl_lahir}}"
            fgroup-class="col-md-6" disable-feedback required/>
            <x-adminlte-select label="Jenis Kelamin" fgroup-class="col-md-6" name="jenis_kelamin" required>
                <option value="-" <?php if($data->jenis_kelamin == '-'){ echo 'selected';} ?>>-</option>
                <option value="Laki-laki" <?php if($data->jenis_kelamin == 'Laki-laki'){ echo 'selected';} ?>>Laki-laki</option>
                <option value="Perempuan" <?php if($data->jenis_kelamin == 'Perempuan'){ echo 'selected';} ?>>Perempuan</option>
            </x-adminlte-select>
            <x-adminlte-input name="umur" label="Umur" value="{{$data->umur}}"
            fgroup-class="col-md-6" disable-feedback required/>
            <x-adminlte-input name="alamat" label="Alamat" value="{{$data->alamat}}"
            fgroup-class="col-md-6" disable-feedback required/>
            <x-adminlte-input name="spesialis" label="Spesialis"  value="{{$data->spesialis}}"
            fgroup-class="col-md-6" disable-feedback required/>
            <x-adminlte-input name="no_hp" label="No HP" placeholder="No HP..." value="{{$data->no_hp}}"
                fgroup-class="col-md-6" disable-feedback required/>
        </div>
        
        <x-adminlte-button icon="fas fa-check-circle" type="submit" label="Submit" class="bg-success btn-block"/>
        </form>

    </x-adminlte-card>
@stop

@section('css')

@stop

@section('js')

@stop