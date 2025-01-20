<x-app-layout>
    <section>
    <h2> Detalle del producto </h2>

    <section>
            <p>Imagenes:</p>
            <ul>
                @if($producto->productImages->isNotEmpty())
                @foreach($producto->productImages as $image)
                <li>
                    <img src="{{ asset('storage/' . $image->name) }}" width="150" height="auto">

                    <a href="{{ route('product.image.destroy', $image->id) }}">Borrar</a>
                </li>
                @endforeach
                @else
                <p>Sin imagenes agregadas</p>
                @endif
            </ul>
        </section>

    <form action="{{route('producto.update', $producto)}}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <label for="name"> Nombre: </label>
        <input type="text" value="@if(@old('name')){{ @old('name') }}@else{{ $producto->name }}@endif" name="name">
        @error('name')<span>{{ $message }}</span>@enderror

        <label for="category"> Categoria: </label>        
        <select id="category" name="category_id" >
            @foreach($categories as $c)
            <option @if(old('category_id') == $c->id) selected @elseif(!old('category_id') && $producto->category_id == $c->id) selected @endif value="{{ $c->id }}">{{ $c->name }}</option>
            @endforeach
        </select>
        @error('category_id')<span>{{ $message }}</span>@enderror

        <label for="price"> Precio: </label>
        <input type="text" value="@if(@old('price')){{ @old('price') }}@else{{ $producto->price }}@endif" name="price">
        @error('price')<span>{{ $message }}</span>@enderror

        <label for="status">Estado: </label>
        <label for="status" >
            <input name="status" @if($producto->status == 1) checked @endif name="status" type="radio" value="1"> 
            Disponible 
        </label>        
        <label for="status">
            <input name="status" @if($producto->status == 0) checked @endif name="status" type="radio" value="0">
            No disponible 
        </label>
        @error('status')<span>{{ $message }}</span>@enderror

        <label for="description">Descripción: </label>
        <input type="text" value="@if(@old('description')){{ @old('description') }}@else{{ $producto->description }}@endif" name="description"> 
        @error('description')<span>{{ $message }}</span>@enderror        

        <label for="productImages">Imagenes:</label>
        <input name="productImages[]" type="file" multiple>            
        @error('productImages.*')<span >{{ $message }}</span>@enderror

        <button type="submit"> Guardar </button>
    </form>

    <a href="{{url()->previous()}}">Regresar</a>

    </section>
</x-app-layout>