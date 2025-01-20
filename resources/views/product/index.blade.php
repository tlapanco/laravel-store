<x-app-layout>
    <section>
        <h2> Productos </h2>

        <a href="{{ route('producto.create') }}"> Agregar producto </a>

        <section>
            <form action="{{route('productos.index')}}" method="GET">
                
                <h3>Filtros</h3>
                <label for="category">Categoria:</label>
                <select name="category_id">
                    @foreach($categories as $category)
                    <option value="">Todas</option>
                    <option value="{{$category->id}}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                    @endforeach
                </select>
                <label for="status">Disponibilidad:</label>
                <select name="status">
                    <option value="">Todos</option>
                    <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Disponible</option>
                    <option  value="0" {{ request('status') == '0' ? 'selected' : '' }}>No disponible</option>
                </select>

                <button type="submit">Buscar</button>
            </form>
        </section>
        
        <table>
            <thead>
                <tr>
                    <th> Imagen </th>
                    <th> Nombre </th>
                    <th> Precio </th>
                    <th> Estado </th>
                    <th> Categoria </th>
                    <th> Acciones </th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <th>
                        @if($product->productImages->isNotEmpty())
                        <img src="{{ asset('storage/' . $product->productImages->first()->name) }}" width="20" height="auto">
                        @else
                        sin imagnes
                        @endif
                    </th>
                    <th> {{ $product->name }} </th>
                    <th> {{ $product->price }} </th>
                    <th> 
                        @if($product->status)
                        Disponible
                        @else
                        No disponible
                        @endif
                    </th>
                    <th> {{ $product->category->name }} </th>
                    <th>
                        <a href="{{ route('producto.edit', $product->id) }}"> Ver detalle </a>
                    </th>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $products->links()}}
    </section>
</x-app-layout>

