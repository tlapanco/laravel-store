<x-app-layout>
    <section>
    <h2> Detalle de la categoria </h2>

    <form action="{{route('categoria.store')}}" method="POST">        
        @csrf
        <label for="name"> Nombre: </label>
        <input type="text" value="@if(@old('name')){{ @old('name') }}@endif" name="name">
        @error('name')<span>{{ $message }}</span>@enderror

        <button type="submit"> Guardar </button>
    </form>

    </section>
</x-app-layout>