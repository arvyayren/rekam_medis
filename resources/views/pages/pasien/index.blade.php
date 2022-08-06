@extends('adminlte::page')

@section('title', 'Rekam Medis - Master Pasien')

@section('content_header')
    <h1>Index</h1>
@stop

@section('content')

    <x-adminlte-card title="List Pasien" theme="dark" icon="fas fa-list-alt">
        
        @include('widget.flash')

        <x-adminlte-modal id="create" title="Create" theme="success"
        icon="fas fa-plus-square" size='lg'>
            <form action="/master/pasien" method="post">
            @csrf
            <div class="row">
                <x-adminlte-input name="nama" label="Nama" placeholder="Nama..."
                fgroup-class="col-md-6" disable-feedback required/>

                <x-adminlte-input name="no_ktp" label="No KTP" placeholder="No KTP..."
                fgroup-class="col-md-6" disable-feedback required/>
            </div>
            
            <div class="row">
                @php
                $config = ['format' => 'Y-m-d'];
                @endphp
                
                <x-adminlte-input name="tempat_lahir" label="Tempat Lahir" placeholder="Tempat Lahir..."
                fgroup-class="col-md-6" disable-feedback required/>

                <x-adminlte-input-date name="tanggal_lahir" :config="$config" placeholder="Pilih Tanggal..."
                    label="Tanggal Lahir" label-class="text-primary" fgroup-class="col-md-6" required>
                    <x-slot name="prependSlot">
                        <x-adminlte-button theme="outline-primary" icon="fas fa-calendar-alt"
                            title="Tanggal Lahir"/>
                    </x-slot>
                </x-adminlte-input-date>
            </div>

            
            <div class="row">
                <x-adminlte-select name="jenis_kelamin" label="Jenis Kelamin" fgroup-class="col-md-6" required>
                    <x-adminlte-options :options="['Laki' => 'Laki', 'Perempuan' => 'Perempuan']"
                        placeholder="Pilih Jenis Kelamin..."/>
                </x-adminlte-select>

                <x-adminlte-input name="umur" label="Umur" placeholder="Umur..."
                fgroup-class="col-md-6" disable-feedback required/>
            </div>
            
            <div class="row">
                <x-adminlte-textarea name="alamat" fgroup-class="col-md-6" label="Alamat" placeholder="Alamat..." required/>

                <x-adminlte-input name="jenis_pasien" label="Jenis Pasien" placeholder="Jenis Pasien..."
                fgroup-class="col-md-6" disable-feedback required/>
            </div>

            <input type="hidden" name="tanggal_pendaftaran" value="{{date('Y-m-d')}}"/>
            
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
            'No Registrasi',
            'Nama',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Jenis Kelamin',
            ['label' => 'Actions', 'no-export' => true, 'width' => 5],
        ];

        $config = [
            'data' => $data,
            'order' => [[1, 'asc']],
            'columns' => [null, null, null, null, null, ['orderable' => false]],
        ];
        @endphp

        {{-- Minimal example / fill data using the component slot --}}
        <x-adminlte-datatable id="table1" :heads="$heads">
            @foreach($config['data'] as $row)
                <tr>
                    @foreach($row as $cell)
                        <td>{!! $cell !!}</td>
                    @endforeach
                    
                    <form id="delete{{$row[0]}}" method="POST" action="/master/pasien/{{$row[0]}}">
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