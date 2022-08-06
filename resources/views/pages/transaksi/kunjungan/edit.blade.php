@extends('adminlte::page')

@section('title', 'Rekam Medis - Master Dokter')

@section('content_header')
    <h1>Edit</h1>
@stop

@section('content')
    <x-adminlte-card title="Edit Dokter" theme="dark" icon="fas fa-list-alt">
        
        @include('widget.flash')

        <form action="/transaksi/kunjungan/{{$data->id}}" method="post">
        @csrf
        {{ method_field('PUT') }}
        <div class="row">
            <x-adminlte-select name="id_pasien" label="Pasien" fgroup-class="col-md-6" disabled required>
                <option disabled selected>Pilih Pasien..</option>
                @foreach($pasien as $p)
                <option value="{{$p->id}}" <?php if($p->id == $data->id_pasien){echo 'selected';} ?>>{{$p->nama}}</option>
                @endforeach
            </x-adminlte-select>
        </div>

        <div class="row">
            <x-adminlte-select name="status" label="Status" fgroup-class="col-md-6" required>
                <option disabled selected>Pilih Status..</option>
                @foreach($status as $k => $v)
                <option value="{{$k}}" <?php if($k == $data->status){echo 'selected';} ?>>{{$v}}</option>
                @endforeach
            </x-adminlte-select>
            
            <input type="hidden" name="tanggal_kunjungan" value="{{date('Y-m-d')}}"/>
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