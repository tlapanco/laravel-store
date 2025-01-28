<x-app-layout>
    <section class="max-w-screen dark:text-white p-2 flex flex-col gap-4">
        <h2 class="w-full text-center text-2xl py-5"> Categorias </h2>

        @if(session('success') || session('error'))
        <x-notification></x-notification>
        @endif

        <a href="{{ route('categoria.create') }}">
            <x-primary-button type="button">Agregar categoria</x-primary-button>
        </a>
        <div class="shadow-lg rounded-lg overflow-hidden mx-4 md:mx-10 my-4">
        <table class="w-full table-fixed text-center">
            <thead>
                <tr class="bg-gray-800 text-white">
                    <th class="py-2 hidden md:block">id</th>
                    <th class="py-2">Nombre</th>
                    <th class="py-2">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 bg-white dark:bg-gray-700">
                @foreach($categories as $category)
                <tr>
                    <th class="py-2 hidden md:block"> {{ $category->id }} </th>
                    <th> {{ $category->name }} </th>                    
                    <th class="flex mt-1 gap-2 items-center justify-center">
                        <a href="{{ route('categoria.edit', $category->id) }}">
                            <x-edit-logo class="w-7 h-auto text-gray-800 dark:text-gray-100 mx-auto"></x-edit-logo>
                        </a>
                        <form onsubmit="return confirmSubmission()" action="{{ route('categoria.destroy', $category->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="flex items-center justify-center">
                                <x-delete-logo class="w-7 h-auto text-red-500 flex"></x-delete-logo>
                            </button>

                        </form>
                    </th>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
        <div class="px-20 py-4">
        {{ $categories->links() }}
        </div>
    </section>
    <script type="text/javascript">
        function confirmSubmission(){
            return confirm("¿Estás seguro de querer eliminar esta categoria?")
        }
    </script>
</x-app-layout>

