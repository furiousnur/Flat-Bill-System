<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('House Owners') }}
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
                        <h3 class="text-lg font-medium">House Owner List</h3>
                        <a href="{{ route('admin.house-owners.create') }}">
                            <x-primary-button class="bg-gray-500 hover:bg-gray-600">
                                Add New
                            </x-danger-button>
                        </a>
                    </div>
                    <table class="w-full border border-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 border">#</th>
                                <th class="px-4 py-2 border">Name</th>
                                <th class="px-4 py-2 border">Email</th>
                                <th class="px-4 py-2 border">Contact</th>
                                <th class="px-4 py-2 border">Created At</th>
                                <th class="px-4 py-2 border">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($owners as $owner)
                                <tr class="text-center">
                                    <td class="px-4 py-2 border">{{ $loop->iteration + ($owners->currentPage() - 1) * $owners->perPage() }}</td>
                                    <td class="px-4 py-2 border">{{ $owner->name }}</td>
                                    <td class="px-4 py-2 border">{{ $owner->email }}</td>
                                    <td class="px-4 py-2 border">{{ $owner->contact }}</td>
                                    <td class="px-4 py-2 border">{{ $owner->created_at->format('d M, Y') }}</td>
                                    <td class="px-4 py-2 border">
                                        <x-primary-button class="bg-blue-600 hover:bg-blue-700">
                                            <a href="{{ route('admin.house-owners.edit', $owner->id) }}" class="inline-block">
                                                Edit
                                            </a>
                                        </x-primary-button>
                                        <form action="{{ route('admin.house-owners.destroy', $owner->id) }}" method="POST" class="inline-block">
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
                                    <td colspan="5" class="px-4 py-2 border text-center">No House Owners found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-4">
                        {{ $owners->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
