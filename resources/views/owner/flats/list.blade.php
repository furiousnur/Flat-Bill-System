<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Flat') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="mb-4 px-4 py-3 rounded bg-green-100 text-green-800 text-sm"
                >
                    {{ session('success') }}
                </p>
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium">Flat List</h3>
                        <a href="{{ route('owner.flats.create') }}">
                            <x-primary-button class="bg-gray-500 hover:bg-gray-600">
                                Add New
                            </x-danger-button>
                        </a>
                    </div>
                    <table class="w-full border border-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 border">#</th>
                                <th class="px-4 py-2 border">House Owner Name</th>
                                <th class="px-4 py-2 border">Building Name</th>
                                <th class="px-4 py-2 border">Flat Number</th>
                                <th class="px-4 py-2 border">Flat Owner Name</th>
                                <th class="px-4 py-2 border">Flat Owner Contact</th>
                                <th class="px-4 py-2 border">Created At</th>
                                <th class="px-4 py-2 border">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($flats as $flat)
                                <tr class="text-center">
                                    <td class="px-4 py-2 border">{{ $loop->iteration + ($flats->currentPage() - 1) * $flats->perPage() }}</td>
                                    <td class="px-4 py-2 border">{{ $flat->building->houseOwner->name }}</td>
                                    <td class="px-4 py-2 border">{{ $flat->building->name }}</td>
                                    <td class="px-4 py-2 border">{{ $flat->flat_number }}</td>
                                    <td class="px-4 py-2 border">{{ $flat->flat_owner_name }}</td>
                                    <td class="px-4 py-2 border">{{ $flat->flat_owner_contact }}</td>
                                    <td class="px-4 py-2 border">{{ $flat->created_at->format('d M, Y') }}</td>
                                    <td class="px-4 py-2 border">
                                        <x-primary-button class="bg-blue-600 hover:bg-blue-700">
                                            <a href="{{ route('owner.flats.edit', $flat->id) }}" class="inline-block">
                                                Edit
                                            </a>
                                        </x-primary-button>
                                        <form action="{{ route('owner.flats.destroy', $flat->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <x-danger-button class="bg-red-600 hover:bg-red-700 ml-2" onclick="return confirm('Are you sure you want to delete this owner?')">
                                                Delete
                                            </x-danger-button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-2 border text-center">No Flat found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $flats->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
