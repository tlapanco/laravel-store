<x-app-layout>
    <section class="w-full p-2 flex flex-col gap-4">
    <h2 class="w-full text-center text-xl font-bold dark:text-white"> Detalle de la categoria </h2>

    <form action="{{route('categoria.update', $category)}}" method="POST" class="flex flex-col gap-5">
        @method('PUT')
        @csrf

        <div class="px-1 max-w-md">
            <x-input-label for="name"> Nombre: </x-input-label>
            <x-text-input id="name" name="name" class="block w-full p-1 text-md" :value="old('name') || $errors->has('name') ? old('name') : $category->name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>        

        <x-primary-button class="w-fit">Guardar</x-primary-button>
    </form>

    <a href="{{route('categorias.index')}}">
        <x-secondary-button>Regresar</x-secondary-button>
    </a>

    </section>
</x-app-layout>