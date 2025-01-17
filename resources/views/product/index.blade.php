<x-app-layout>
    <section>
        <h2> Productos </h2>

        <a href="{{ route('producto.create') }}"> Agregar producto </a>
        
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

