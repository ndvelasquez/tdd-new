<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar repositorio
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <form action="{{ route('repositories.update', $repository) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <label class="block font-medium text-sm text-gray-700" for="url">URL *</label>
                    <input type="text" class="form-input w-full rounded-md shadow-sm" name="url" value="{{ $repository->url }}">

                    <label class="block font-medium text-sm text-gray-700" for="description">DESCRIPCION *</label>
                    <textarea class="form-input w-full rounded-md shadow-sm" name="description">{{ $repository->description }}</textarea>

                    <hr class="my-4">

                    <input type="submit" class="bg-blue-500 text-white font-bold rounded-md py-2 px-4 cursor-pointer" value="Editar">
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
