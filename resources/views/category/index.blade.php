<x-app-layout>
    <section>
        <h2> Categorias </h2>

        <a href="{{ route('categoria.create') }}"> Agregar categoria </a>
        
        <table>
            <thead>
                <tr>
                    <th> id </th>
                    <th> Nombre </th>                    
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <th> {{ $category->id }} </th>
                    <th> {{ $category->name }} </th>                    
                    <th>
                        <a href="{{ route('categoria.edit', $category->id) }}"> Ver </a>
                        <form action="{{ route('categoria.destroy', $category->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Borrar</button>
                        </form>
                    </th>
                </tr>
                @endforeach
            </tbody>
        </table>

        {{ $categories->links() }}
    </section>
</x-app-layout>

