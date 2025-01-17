<x-app-layout>
    <section>
        <h2> Crear producto </h2>

        <form action="{{route('producto.store')}}" method="POST" enctype="multipart/form-data">        
            @csrf
            <label for="name"> Nombre: </label>
            <input type="text" value="@if(@old('name')){{ @old('name') }}@endif" name="name">
            @error('name')<span>{{ $message }}</span>@enderror

            <label for="category"> Categoria: </label>        
            <select id="category" name="category_id" >
                <option value="" disabled @if(!old('category_id')) selected @endif> --Elija una categoria-- </option>
                @foreach($categories as $c)            
                <option @if(old('category_id') == $c->id) selected @endif value="{{ $c->id }}">{{ $c->name }}</option>
                @endforeach
            </select>
            @error('category_id')<span>{{ $message }}</span>@enderror

            <label for="price"> Precio: </label>
            <input type="text" value="@if(@old('price')){{ @old('price') }}@endif" name="price">
            @error('price')<span>{{ $message }}</span>@enderror

            <label for="status">Estado: </label>
            <label for="status" >
                <input name="status" @if(old('status') == 1) checked @endif name="status" type="radio" value="1"> 
                Disponible 
            </label>        
            <label for="status">
                <input name="status" @if(old('status') == 0) checked @endif name="status" type="radio" value="0">
                No disponible 
            </label>
            @error('status')<span>{{ $message }}</span>@enderror

            <label for="description">Descripción: </label>
            <input type="text" value="@if(@old('description')){{ @old('description') }}@endif" name="description"> 
            @error('description')<span>{{ $message }}</span>@enderror

            <label for="productImages">Imagenes:</label>
            <input name="productImages[]" type="file" multiple>            
            @error('productImages.*')<span >{{ $message }}</span>@enderror

            <button type="submit"> Guardar </button>
            
        </form>

    </section>
</x-app-layout>