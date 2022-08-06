@extends('adminlte::page')

@section('title', 'Rekam Medis - Master Obat')

@section('content_header')
    <h1>Index</h1>
@stop

@section('content')

    <x-adminlte-card title="List Obat" theme="dark" icon="fas fa-list-alt">
        
        @include('widget.flash')

        <x-adminlte-modal id="create" title="Create" theme="success"
        icon="fas fa-plus-square" size='lg'>
            <form action="/master/obat" method="post">
            @csrf
            <div class="row">
                @php
                $config = ['format' => 'Y-m-d'];
                @endphp
                <x-adminlte-input name="nama" label="Nama" placeholder="Nama..."
                fgroup-class="col-md-6" disable-feedback required/>
                <x-adminlte-input name="kode" label="Kode" placeholder="Kode..."
                fgroup-class="col-md-6" disable-feedback required/>
                <x-adminlte-input-date name="tgl_registrasi" :config="$config" placeholder="Pilih Tanggal..."
                    label="Tanggal Registrasi" label-class="text-primary" fgroup-class="col-md-6" required>
                    <x-slot name="prependSlot">
                        <x-adminlte-button theme="outline-primary" icon="fas fa-calendar-alt"
                            title="Tanggal Registrasi"/>
                    </x-slot>
                </x-adminlte-input-date>
                <x-adminlte-input-date name="tgl_expired" :config="$config" placeholder="Pilih Tanggal..."
                    label="Tanggal Expired" label-class="text-primary" fgroup-class="col-md-6" required>
                    <x-slot name="prependSlot">
                        <x-adminlte-button theme="outline-primary" icon="fas fa-calendar-alt"
                            title="Tanggal Expired"/>
                    </x-slot>
                </x-adminlte-input-date>
                <x-adminlte-input name="jenis" label="Jenis Obat" placeholder="Jenis..."
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
            'Kode',
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
                    
                    <form id="delete{{$row[0]}}" method="POST" action="/master/obat/{{$row[0]}}">
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