@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Ordenes') }}</div>

                <div class="card-body">
                    <a href="{{ route('orden.create') }}" class="btn btn-primary">Nueva orden</a>

                    <table class="table table-bordered mt-2">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Fecha de la Orden</th>
                                <th>Cliente</th>
                                <th>Email Cliente</th>
                                <th>Productos</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($ordenes as $orden)
                            <tr data-entry-id="{{ $orden->id }}">
                                <td>
                                    {{ $orden->id ?? '' }}
                                </td>
                                <td>
                                    {{ $orden->orden_fecha ?? '' }}
                                </td>
                                <td>
                                    {{ $orden->cliente->nombre ?? '' }}
                                </td>
                                <td>
                                    {{ $orden->cliente->email ?? '' }}
                                </td>
                                <td>
                                    <ul>
                                        @foreach($orden->productos as $producto)
                                        <li>{{ $producto->nombre }} ({{ $producto->pivot->quantity * $producto->precio }})</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    <a href="{{ route("orden.show", $orden->id) }}" target="_blank" class="btn btn-danger">Factura</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection