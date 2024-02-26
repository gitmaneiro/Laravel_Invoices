<?php

namespace App\Livewire;

use App\Models\Producto;
use Livewire\Component;

class InicioComponente extends Component
{

    public $mensaje="mensajes";
    public $contador=0;
    public $mostrar="true";
    public $modal=false;
    public $productos, $nombre, $precio;
    public $artualizarModal=0; 
    public $id_producto;
    public $a_nombre; 
    public $a_precio;
   
   
    public function add()
    {
        return $this->contador++;
    }

    public function evento()
    {
        $this->dispatch('evento');
    }

    public function swal()
    {
        $this->dispatch('swal');
    }


    public function limpiarCampos(){
        $this->nombre ='';
        $this->precio ='';
        $this->id_producto ='';
        $this->a_nombre='';
        $this->a_precio='';
    }



    public function guardar()
    {
        $this->validate([
            'nombre' => 'required',
            'precio' => 'required|numeric'
        ]);

        Producto::create([
            'nombre' => $this->nombre,
            'precio' => $this->precio
        ]);

        $this->limpiarCampos();
        
    }


    public function editar($id)
    {
        $producto = Producto::find($id);

    if($producto){
        $this->id_producto = $id;
        $this->a_nombre =$producto->nombre;
        $this->a_precio = $producto->precio;
    }

    
        
    }


    public function actualizar()
    {
        $this->validate([
            'a_nombre' => 'required',
            'a_precio' => 'required|numeric'
        ]);

        if ($this->id_producto) {
            $producto = Producto::find($this->id_producto);

            $producto->update([
                'nombre' => $this->a_nombre,
                'precio' => $this->a_precio
            ]);

            $this->limpiarCampos();
           
        }
    }

    public function borrar($id)
    {
        if ($id) {
            Producto::find($id)->delete();
        }
    }

    public function render()
    {
        $this->productos=Producto::all();

        return view('livewire.inicio-componente');
    }



}
