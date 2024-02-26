@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @livewire('inicio-componente')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    console.log('javascript funcionando...');
    window.addEventListener('livewire:initialized', () => {
        Livewire.on('evento', () => {
            alert('Ahora si esta funcionando......');
        })

        Livewire.on('swal', () => {
            Swal.fire({
                title: 'Felicidades',
                text: 'Funcionando con exito',
                 icon: 'success',
                confirmButtonText: 'Listo'
            })
        })




        Livewire.on('show-modal', () => {
           $('#user-modal').modal(show);
        })
    })
</script>
@endsection
