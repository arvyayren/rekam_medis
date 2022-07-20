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
            <x-adminlte-input name="nama" label="Nama" value="{{$data->nama}}"
            fgroup-class="col-md-6" disable-feedback required/>
            <x-adminlte-input name="kode" label="Kode"  value="{{$data->kode}}"
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