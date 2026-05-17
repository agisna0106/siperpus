<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Rak Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <x-primary-button tag="a" href="{{ route('bookshelves.create') }}">
                    Tambah Data Rak
                </x-primary-button>
                <x-table>
                    <x-slot name="header">
                        <tr>
                            <th>#</th>
                            <th>Kode Rak</th>
                            <th>Nama Rak</th>
                            <th>Aksi</th>
                        </tr>
                    </x-slot>

                    @php
                         $num=1;
                    @endphp
                    @foreach ($bookshelves as $bs)
                        <tr>
                            <td>{{ $num++ }}</td>
                            <td>{{ $bs->code }}</td>
                            <td>{{ $bs->name }}</td>
                            <td class="flex flex-auto">
                                <a href="{{ route('bookshelves.edit', $bs->id) }}"  class="flex items-center justify-center h-10">
                                    <i class="fa-solid fa-pencil"></i>
                                </a>
                                <form action="{{ route('bookshelves.destroy', $bs->id) }}" method="post" class="delete-form">
                                    @csrf
                                    @method('delete')
                                    <x-danger-button type="submit" class="flex items-center justify-center h-10">
                                        <i class="fa-solid fa-trash text-red-600 ml-1"></i>
                                    </x-danger-button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </x-table>
            </div>
        </div>
    </div>
</x-app-layout>

