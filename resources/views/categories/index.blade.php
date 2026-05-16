<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Kategori') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <x-primary-button tag="a" href="{{ route('categories.create') }}">Tambah Kategori</x-primary-button>

            </div>

            <x-table>
                <x-slot name="header">
                    <tr>
                        <th>#</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </x-slot>

                @php $num=1; @endphp
                @foreach($categories as $ct)
                    <tr>
                        <td>{{ $num++ }}</td>
                        <td>{{ $ct->category }}</td>
                        <td class="flex flex-auto">
                            <a href="{{ route('categories.edit', $ct->id) }}" class="flex items-center justify-center h-20"><i class="fa-solid fa-pencil"></i></a>
                            <form action="{{ route('categories.destroy', $ct->id) }}" method="post" class="delete-form">
                                @csrf
                                @method('delete')
                                <x-danger-button type="submit" class="flex items-center justify-center h-20"><i class="fa-solid fa-trash text-red-600 ml-1"></i></x-danger-button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </x-table>
        </div>
    </div>

</x-app-layout>
