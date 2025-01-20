<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <main>
        <h3>Estadisticas</h3>
        <section>
            <table class="border-2 border-black">
                <thead>
                    <tr>
                        <th>Categoria</th>
                        <th>Disponibles</th>
                        <th>No disponibles</th>
                        <th>Total</th>
                        <th>Acciones</th>
                    </tr>                    
                </thead>
                <tbody>
                    @foreach($categoriesWithTotals as $category)
                    <tr>
                        <th>{{ $category->name }}</th>
                        <th>{{ $category->avaiableProductsCount }}</th>
                        <th>{{ $category->unavaiableProductsCount }}</th>
                        <th>{{ $category->total }}</th>
                        <th>
                            <a  href="{{route('productos.index', ['category_id' => $category->id])}}">Ver</a>
                        </th>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </main>
</x-app-layout>
