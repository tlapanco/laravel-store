<x-app-layout>
    <section class="max-w-screen dark:text-white px-2 ">
        <h2 class="w-full text-center text-2xl py-3"> Productos </h2>
        @if(session('success') || session('error'))
        <x-notification></x-notification>
        @endif
        

        <a href="{{ route('producto.create') }}" class="ml-2">
            <x-primary-button>Agregar Producto</x-primary-button>
        </a>
        <section class="my-4 px-2">
            <form action="{{route('productos.index')}}" method="GET" class="flex flex-col gap-3">
                
                <h3>Filtros</h3>
                <label for="category">Categoria:</label>
                <select name="category_id" class="mx-3 dark:bg-gray-800 p-2 rounded-md">
                    @foreach($categories as $category)
                    <option value="">Todas</option>
                    <option value="{{$category->id}}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                    @endforeach
                </select>
                <label for="status">Disponibilidad:</label>
                <select name="status" class="mx-3 dark:bg-gray-800 p-2 rounded-md">
                    <option value="">Todos</option>
                    <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Disponible</option>
                    <option  value="0" {{ request('status') == '0' ? 'selected' : '' }}>No disponible</option>
                </select>

                <x-primary-button class="px-2 w-fit mx-auto">Buscar</x-primary-button>
            </form>
        </section>
        <section class="flex flex-col md:hidden gap-4 px-2">
            @foreach($products as $product)
            <div class="flex flex-col gap-4 items-center justify-center shadow-md px-3 py-5 rounded-md bg-white dark:bg-gray-700">
                @if($product->productImages->isNotEmpty())
                <div class="w-[250px] h-[250px]">
                    <img src="{{ asset('storage/' . $product->productImages->first()->name) }}"class="object-contain rounded-md w-full h-full">
                </div>
                @else
                sin imagnes
                @endif             
                <h2>{{$product->name}}</h2>
                <p>ID: {{$product->id}}</p>
                <p>Estado: <span class="text-white px-1 py-1 rounded-md @if($product->status){{'bg-green-600'}}@else{{'bg-red-500'}}@endif">
                            @if($product->status)
                            Disponible
                            @else
                            No disponible
                            @endif
                            </span>
                </p>
                <div>
                    <a href="{{ route('producto.edit', $product->id) }}">
                        <x-secondary-button>Ver detalle</x-secondary-button>
                    </a>
                </div>
            </div>
            @endforeach            
        </section>
        <div class="hidden md:block shadow-lg rounded-lg overflow-hidden mx-4 md:mx-10">
            <table class="w-full table-fixed text-center">
                <thead>
                    <tr class="bg-gray-800 text-white">
                        <th scope="col" class="p-2 tracking-wider w-1/6"> Imagen </th>
                        <th scope="col" class="p-2 tracking-wider w-1/6"> Nombre </th>
                        <th scope="col" class="p-2 tracking-wider w-1/6"> Precio </th>
                        <th scope="col" class="p-2 tracking-wider w-1/6"> Estado </th>
                        <th scope="col" class="p-2 tracking-wider w-1/6"> Categoria </th>
                        <th scope="col" class="p-2 tracking-widerw-1/6"> Acciones </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white dark:bg-gray-700">
                    @foreach($products as $product)
                    <tr>
                        <td class="whitespace-nowrap px-2 py-2 ">
                            @if($product->productImages->isNotEmpty())
                            <div class="w-14 h-14 mx-auto">
                                <img src="{{ asset('storage/' . $product->productImages->first()->name) }}" class="w-full h-full drop-shadow-xl object-contain">
                            </div>
                            @else
                            sin imagnes
                            @endif
                        </td>
                        <td class="whitespace-nowrap px-2 py-1 overflow-hidden text-ellipsis"> {{ $product->name }} </td>
                        <td class="whitespace-nowrap px-2 py-1">$ {{ $product->price }}</td>
                        <td class="whitespace-nowrap px-2 py-1 text-white text-sm"> 
                            @if($product->status)
                            <p class="bg-green-600 px-2 py-1 rounded-md w-fit mx-auto">Disponible</p>
                            @else
                            <p class="bg-red-600 px-2 py-1 rounded-md w-fit mx-auto">No disponible</p>
                            @endif
                        </td>
                        <td class="whitespace-nowrap px-2 py-1"> {{ $product->category->name }} </td>
                        <td class="whitespace-nowrap px-2 py-1 ">
                            <a href="{{ route('producto.edit', $product->id) }}">
                                <x-edit-logo class="w-7 h-auto text-gray-800 dark:text-gray-100 mx-auto" />
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-4 py-4 ">
            {{ $products->links()}}
        </div>
    </section>
</x-app-layout>

