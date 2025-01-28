<x-app-layout>
    <section class="dark:text-white p-3 flex flex-col gap-4 items-center xl:px-36">
    <h2 class="font-bold text-xl text-center"> Detalle del producto </h2>

    @if(session('success') || session('error'))
    <x-notification></x-notification>
    @endif

    <section class="flex flex-col gap-3 w-full">
            <p>Imagenes:</p>
            <ul class="grid grid-cols-2 xl:grid-cols-4 gap-2">
                @if($producto->productImages->isNotEmpty())
                @foreach($producto->productImages as $image)
                <li class="w-full h-full border-2 rounded-md p-2 flex flex-col items-center">
                    <div class="w-[150px] h-[150px] xl:w-[250px] xl:h-[250px] p-2 flex items-center justify-center">
                        <img src="{{ asset('storage/' . $image->name) }}" class="w-full h-full object-contain">                        
                    </div>                  
                    <a href="{{ route('product.image.destroy', $image->id) }}">
                        <x-danger-button>Borrar</x-danger-button>
                    </a>
                </li>
                @endforeach
                @else
                <p>Sin imagenes agregadas</p>
                @endif
            </ul>
    </section>

    <form action="{{route('producto.update', $producto)}}" method="POST" enctype="multipart/form-data" class="grid  gap-5 w-full">
        @method('PUT')
        @csrf
        <div class="px-1">
            <x-input-label for="name"> Nombre: </x-input-label>
            <x-text-input id="name" name="name" class="block w-full p-1 text-md" :value="old('name') || $errors->has('name') ? old('name') : $producto->name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>    

        <div>
            <x-input-label for="category_id">Categoria: </x-input-label>  
            <select id="category" name="category_id" class="w-full rounded-md dark:bg-gray-800 p-1" >
                @foreach($categories as $c)
                <option @if(old('category_id') == $c->id) selected @elseif(!old('category_id') && $producto->category_id == $c->id) selected @endif value="{{ $c->id }}">{{ $c->name }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
        </div>        

        <div>
            <x-input-label for="price"> Precio: </x-input-label>
            <x-text-input id="price" name="price" class="block w-full p-1 text-md" :value="old('price') || $errors->has('price') ? old('price') : $producto->price" />
            <x-input-error :messages="$errors->get('price')" class="mt-2" />
        </div>

        <label for="status">Estado: </label>
        <label for="status" >
            <input name="status" name="status" type="radio" value="1" @if($producto->status == 1 && !old('status')) checked @elseif(old('status') == '1') checked @endif> 
            Disponible 
        </label>        
        <label for="status">
            <input name="status" name="status" type="radio" value="0" @if($producto->status == 0 && !old('status')) checked   @elseif(old('status') == '0') checked @endif>
            No disponible 
        </label>
        <x-input-error :messages="$errors->get('status')" class="mt-2" />

        <div>
            <x-input-label for="description"> Descripción: </x-input-label>
            <x-text-area id="description" name="description" class="block w-full p-1 text-md h-24" :value="old('description') || $errors->has('description') ? old('description') : $producto->description" ></x-text-area>
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>


        <div class="flex items-center gap-4 w-full" id="dropzone">
            <x-input-label for="productImages[]">Imagenes: </x-input-label>
            <label class="flex flex-col items-center w-64 h-32 border-4 border-dashed border-gray-300 hover:border-gray-400 cursor-pointer p-2">
                <div class="flex flex-col items-center justify-center px-2">
                    <svg class="w-8 h-8 text-gray-400 group-hover:text-gray-600" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M16.88 7.93A4 4 0 0 1 14 14H8v2h2v2H6v-2h2v-2H4a4 4 0 0 1-.88-7.93 3 3 0 0 1 1.54 5.43V11a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-.6a3 3 0 0 1 1.54-5.43A4 4 0 0 1 16.88 7.93z"/>
                    </svg>
                    <p class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-gray-600 text-center">Arrastra y suelta tus archivos aquí o haz clic para seleccionarlos</p>
                </div>
                <input type="file" multiple class="opacity-0" id="productImages" name="productImages[]" />
            </label>
        </div>
        @error('productImages.*')
        <x-input-error :messages="$message" class="mt-2" />
        <p class="text-center">Por favor, vuelva a seleccionar sus archivos.</p>
        @enderror
        <div id="fileList" class="flex px-2 gap-4"></div>

        
        

        <x-primary-button class="w-fit">Guardar</x-primary-button>
    </form>

    <a href="{{route('productos.index')}}">
        <x-secondary-button>Regresar</x-secondary-button>
    </a>

    </section>

    <script type="text/javascript">
        document.getElementById('productImages').addEventListener('change', function(event) {
            const fileList = document.getElementById('fileList');
            fileList.innerHTML = ''; // Limpia la lista de archivos

            for (const file of event.target.files) {
                const fileItem = document.createElement('p');
                fileItem.textContent = file.name;                
                fileList.appendChild(fileItem);
            }
        });
        const dropzone = document.getElementById('dropzone');

        dropzone.addEventListener('dragover', function(event) {
            event.preventDefault();
            dropzone.classList.add('border-blue-500');
        });
        dropzone.addEventListener('dragleave', function(event) {
            dropzone.classList.remove('border-blue-500');
        });
        dropzone.addEventListener('drop', function(event) {
            event.preventDefault();
            dropzone.classList.remove('border-blue-500');
            const files = event.dataTransfer.files;
            const fileInput = document.getElementById('productImages');
            fileInput.files = files;

            const fileList = document.getElementById('fileList');
            fileList.innerHTML = ''; // Limpia la lista de archivos

            for (const file of files) {
                const fileItem = document.createElement('p');
                fileItem.textContent = file.name;                
                fileList.appendChild(fileItem);
            }

        });
    </script>  
</x-app-layout>