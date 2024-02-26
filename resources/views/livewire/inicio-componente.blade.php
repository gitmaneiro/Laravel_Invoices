<div>
    Componente de Laravel LiveWire...
    <h2 class="mt-5">
        {{$mensaje}}
    </h2>
    <input wire:model.live="mensaje" type="text" class="form-control mt-2" placeholder="Introduce un mensaje">

    <h2>{{$contador}}</h2>
    <button wire:click="add" class="btn btn-success">Aumentar</button>

   @if($mostrar)
    <div>
        <p>Nuevo DIV</p>
    </div>
    @endif
    
    <button type="button" wire:click="$toggle('mostrar')" class="btn btn-warning">Magic Action</button>

    <button type="button" wire:click="evento" class="btn btn-danger">Evento</button>

    <button type="button" wire:click="swal" class="btn btn-danger">Sweet alert</button>


    <div class="card mt-5">
        <div>
        <button type="button" class="btn btn-primary btn-sm m-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
            + Nuevo
        </button>
        </div>
      <div class="card-body">
          <table class="table table-hover table-striped">
              <thead>
                <tr>
                  <th scope="col">Nombre</th>
                  <th scope="col">Precio</th>
                  <th scope="col">Acciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach($productos as $producto)
                <tr wire:key="producto-{{$producto->id}}">
                    <td>{{$producto->nombre}}</td>
                    <td>{{$producto->precio}}</td>
                    <td>
                      <button class="btn btn-warning mr-2 btn-sm" data-bs-toggle="modal" data-bs-target="#actualizarModal" wire:click="editar({{$producto->id}})">Editar</button> | <button wire:click="borrar({{$producto->id}})" class="btn btn-danger btn-sm">Borrar</button>
                    </td>
                </tr>
                @endforeach
              </tbody>
          </table>
      </div>
    </div>



<!-- Modal -->
<div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Crear Producto</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
            <div class="mb-3">
              <label for="nombre" class="col-form-label">Nombre:</label>
              <input type="text" wire:model="nombre" class="form-control" id="nombre">
            </div>
            <div class="mb-3">
              <label for="precio" class="col-form-label">Precio:</label>
              <input type="text" wire:model="precio" class="form-control" id="precio">
            </div>
        
      </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="submit" wire:click.prevent="guardar" class="btn btn-primary" data-bs-dismiss="modal" >Guardar</button>  
        </div>
      </form>
    </div>
  </div>
</div>



<!-- Modal Actualizar -->
<div wire:ignore.self class="modal fade" id="actualizarModal" tabindex="-1" role="dialog" aria-labelledby="actualizarModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Actualizar Producto</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
            <div class="mb-3">
              <label for="a_nombre" class="col-form-label">Nombre:</label>
              <input type="text" wire:model="a_nombre" class="form-control" id="a_nombre">
            </div>
            <div class="mb-3">
              <label for="a_precio" class="col-form-label">Precio:</label>
              <input type="text" wire:model="a_precio" class="form-control" id="a_precio">
            </div>
        
      </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          <button type="submit" wire:click.prevent="actualizar" class="btn btn-primary" data-bs-dismiss="modal">Actualizar</button> 
        </div>
      </form>
    </div>
  </div>
</div>


</div>
