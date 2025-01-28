<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <main class="p-2 w-full">
        <h3 class="w-full text-center text-xl font-bold dark:text-white">Total productos por categoria</h3>
        <section class="flex flex-col gap-4 items-center justify-center sm:shadow-lg sm:rounded-lg overflow-hidden mx-4 md:mx-10 my-4">
            {{-- Mobile version --}}
            @foreach($categoriesWithTotals as $category)
            <div class="sm:hidden w-full flex flex-col gap-5 shadow-md py-4 px-2 rounded-md bg-white dark:text-white dark:bg-gray-700 font-bold ">
                <h2 class="font-normal bg-gray-500 text-white px-2 py-1 rounded-md w-fit mx-auto">{{$category->name}}</h2>
                <p>Disponibles: <span>{{$category->avaiableProductsCount}}</span></p>
                <p>No disponibles: <span>{{$category->unavaiableProductsCount}}</span></p>
                <p>Total: <span>{{$category->total}}</span></p>
                <a  href="{{route('productos.index', ['category_id' => $category->id])}}" class="w-fit" >
                    <x-primary-button type="button" class="w-fit">Ver</x-primary-button>
                </a>
            </div>
            @endforeach

            {{-- Desktop version --}}
            <table class="hidden sm:table w-full table-fixed text-center dark:text-white">
                <thead>
                    <tr class="bg-gray-800 text-white">
                        <th class="py-2">Categoria</th>
                        <th class="py-2">Disponibles</th>
                        <th class="py-2">No disponibles</th>
                        <th class="py-2">Total</th>
                        <th class="py-2">Acciones</th>
                    </tr>                    
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white dark:bg-gray-700">
                    @foreach($categoriesWithTotals as $category)
                    <tr>
                        <th class="py-2">{{ $category->name }}</th>
                        <th>{{ $category->avaiableProductsCount }}</th>
                        <th>{{ $category->unavaiableProductsCount }}</th>
                        <th>{{ $category->total }}</th>
                        <th>
                            <a  href="{{route('productos.index', ['category_id' => $category->id])}}" class="bg-gray-800 hover:shadow-md hover:shadow-black text-white px-2 py-1 rounded-md">Ver</a>
                        </th>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </main>
</x-app-layout>
