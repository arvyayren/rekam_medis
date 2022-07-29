@extends('adminlte::page')

@section('title', 'Rekam Medis - Kunjungan')

@section('content_header')
    <h1>Index</h1>
@stop

@section('content')
    <x-adminlte-card title="Kunjungan" theme="dark" icon="fas fa-list-alt">
        
        @include('widget.flash')

        <x-adminlte-modal id="create" title="Create" theme="success"
        icon="fas fa-plus-square" size='lg'>
            <form action="/transaksi/kunjungan" method="post">
            @csrf
            <div class="row">
                <x-adminlte-input name="nama" label="Nama" placeholder="Nama..."
                fgroup-class="col-md-6" disable-feedback required/>
                <x-adminlte-input name="spesialis" label="Spesialis" placeholder="Spesialis..."
                fgroup-class="col-md-6" disable-feedback required/>
            </div>

            <div class="row">
                <x-adminlte-select name="jenis_kelamin" label="Jenis Kelamin" fgroup-class="col-md-6" required>
                    <x-adminlte-options :options="['Laki' => 'Laki', 'Perempuan' => 'Perempuan']"
                        placeholder="Pilih Jenis Kelamin..."/>
                </x-adminlte-select>
                
                <x-adminlte-input-date name="tanggal_lahir" :config="$config" placeholder="Pilih Tanggal..."
                    label="Tanggal Lahir" label-class="text-primary" fgroup-class="col-md-6" required>
                    <x-slot name="prependSlot">
                        <x-adminlte-button theme="outline-primary" icon="fas fa-calendar-alt"
                            title="Tanggal Lahir"/>
                    </x-slot>
                </x-adminlte-input-date>
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
                    
                    <form id="delete{{$row[0]}}" method="POST" action="/transaksi/kunjungan/{{$row[0]}}">
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