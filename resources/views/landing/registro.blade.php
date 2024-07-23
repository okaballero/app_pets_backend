@extends('app')
@section('content')
    <form action="{{ url('/registro') }}" method="POST">
    @csrf
        {{-- errores --}}
    <div class="row mt-3">
        @if($errors->any())
            @foreach ($errors->all() as $error)        
            <div class="col-12">        
                <div class="alert alert-danger" role="alert">
                    {{ $error }}
                </div>
            </div>                
            @endforeach            
            @if(session('success'))
                <div class="col-12">        
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                </div>              
            @endif
        @endif

    </div>   
    <div class="row mt-3">
        <div class="col-12">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Correo</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="name@example.com" value="{{  old('email') }}">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Asunto</label>
                <input type="text" class="form-control" id="subject" name="subject" placeholder="ej. Compra realizada" value="{{  old('subject') }}">
            </div>
            <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Contenido</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{  old('description') }}</textarea>
            </div>
            
        </div>
        <div class="flex justify-content-end items-end col-12">
            <button type="submit"> Enviar Correo </button>
        </div>
    </div>
    </form>

    <div class="row mt-3">
        <h1> Datos del formulario </h1>
        <ul>
            <li> <strong>Correo:</strong> {{ (isset($correo))? $correo:null }} </li>
            <li> <strong>Descripción:</strong> {{ (isset($description)) ? $description: null }} </li> 
        </ul>
    </div>


    <div class="row">
        <div class=" col-12 table-responsive"> 
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Correo</th>                        
                    </tr>
                </thead>
                <tbody>
                    @foreach ($Lista_asociaciones as  $item)
                    <tr>
                        <td> {{  $item->name }} </td>
                        <td> {{  $item->phone }}  </td>
                        <td>  {{  $item->email }} </td>
                    </tr>    
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
@endsection