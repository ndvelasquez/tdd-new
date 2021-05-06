<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Listado de repositorios
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <p class="text-right mb-4">
                <a class="bg-blue-500 hover:bg-blue-700 cursor-pointer py-2 px-4 rounded-md text-white font-bold text-xs" href="{{ route('repositories.create') }}">Añadir repositorio</a>
            </p>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>URL</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($repositories as $repository)
                            <tr>
                                <td class="border px-4 py-2">{{ $repository->id }}</td>
                                <td class="border px-4 py-2">{{ $repository->url }}</td>
                                <td class="px-4 py-2">
                                    <a href="{{ route('repositories.show', $repository) }}">Ver detalles</a>
                                </td>
                                <td class="px-4 py-2">
                                    <a href="{{ route('repositories.edit', $repository) }}">Editar</a>
                                </td>
                                <td>
                                    <form action="{{ route('repositories.destroy', $repository) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input class="bg-red-500 hover:bg-red-700 text-white text-bold text-sm rounded-md cursor-pointer py-2 px-4" type="submit" value="Eliminar" onclick="return confirm('¿Estas seguro de eliminar el repositorio?')">
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No hay repositorios creados</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
