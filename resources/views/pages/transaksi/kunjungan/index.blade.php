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
                <x-adminlte-select name="id_pasien" label="Pasien" fgroup-class="col-md-6" required>
                    <option disabled selected>Pilih Pasien..</option>
                    @foreach($pasien as $p)
                    <option value="{{$p->id}}">{{$p->nama}}</option>
                    @endforeach
                </x-adminlte-select>
            </div>

            <div class="row">
                <x-adminlte-select name="status" label="Status" fgroup-class="col-md-6" required>
                    <option disabled selected>Pilih Status..</option>
                    @foreach($status as $k => $v)
                    <option value="{{$k}}">{{$v}}</option>
                    @endforeach
                </x-adminlte-select>
                
                <x-adminlte-input-date name="tanggal_kunjungan" :config="['format' => 'Y-m-d']" placeholder="Pilih Tanggal..."
                    label="Tanggal Kunjungan" label-class="text-primary" fgroup-class="col-md-6" required>
                    <x-slot name="prependSlot">
                        <x-adminlte-button theme="outline-primary" icon="fas fa-calendar-alt"
                            title="Tanggal Kunjungan"/>
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
            'Nomor',
            'Nama Pasien',
            'Tanggal Kunjungan',
            'Nomor Antrian',
            'Status',
            ['label' => 'Actions', 'no-export' => true, 'width' => 5],
        ];

        $config = [
            'data' => $data,
            'order' => [[1, 'asc']],
            'columns' => [null, null, null, null, null,['orderable' => false]],
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css" integrity="sha512-f0tzWhCwVFS3WeYaofoLWkTP62ObhewQ1EZn65oSYDZUg1+CyywGKkWzm8BxaJj5HGKI72PnMH9jYyIFz+GH7g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js" integrity="sha512-AIOTidJAcHBH2G/oZv9viEGXRqDNmfdPVPYOYKGy3fti0xIplnlgMHUGfuNRzC6FkzIo0iIxgFnr9RikFxK+sw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@stop