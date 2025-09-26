<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Tenant') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <div class="mb-4">
                    <a href="{{ route('admin.tenants.index') }}"
                       class="inline-block bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300 shadow">
                        ← Back
                    </a>
                </div>

                <form action="{{ route('admin.tenants.update', $tenant->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="building_id" class="block text-gray-700 font-medium mb-1">Select Building</label>
                        <select name="building_id" id="building_id"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">
                            <option value="">-- Select Building --</option>
                            @foreach($buildings as $building)
                                <option value="{{ $building->id }}" {{ $tenant->building_id == $building->id ? 'selected' : '' }}>
                                    {{ $building->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('building_id')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <label for="flat_id" class="block text-gray-700 font-medium mb-1">Select Flat</label>
                        <select name="flat_id" id="flat_id"
                                class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200">
                            <option value="">-- Select Flat --</option>
                            @foreach($flats as $flat)
                                <option value="{{ $flat->id }}" {{ $tenant->flat_id == $flat->id ? 'selected' : '' }}>
                                    {{ $flat->flat_number }} - {{ $flat->building->name ?? '-' }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('flat_id')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-medium mb-1">Tenant Name</label>
                        <input type="text" name="name" id="name"
                               value="{{ old('name', $tenant->name) }}"
                               class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200"
                               required>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
                        <input type="email" name="email" id="email"
                               value="{{ old('email', $tenant->email) }}"
                               class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200"
                               required>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="mb-4">
                        <label for="contact" class="block text-gray-700 font-medium mb-1">Contact</label>
                        <input type="text" name="contact" id="contact"
                               value="{{ old('contact', $tenant->contact) }}"
                               class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200"
                               required>
                        <x-input-error :messages="$errors->get('contact')" class="mt-2" />
                    </div>

                    <div class="flex items-center space-x-4">
                        <x-primary-button class="bg-blue-700 hover:bg-blue-800">
                            Update
                        </x-primary-button>

                        <a href="{{ route('admin.tenants.index') }}" class="ml-2">
                            <x-danger-button class="bg-gray-500 hover:bg-gray-600">
                                Cancel
                            </x-danger-button>
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
