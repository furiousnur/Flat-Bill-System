<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create House Owner') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <div class="mb-4">
                    <a href="{{ route('admin.house-owners.index') }}"
                       class="inline-block bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300 shadow">
                        ← Back
                    </a>
                </div>
                <form action="{{ route('admin.house-owners.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-medium mb-1">Name</label>
                        <input type="text" name="name" id="name"
                               value="{{ old('name') }}"
                               class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200"
                               required>
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
                        <input type="email" name="email" id="email"
                               value="{{ old('email') }}"
                               class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200"
                               required>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div class="mb-4">
                        <label for="contact" class="block text-gray-700 font-medium mb-1">Contact</label>
                        <input type="contact" name="contact" id="contact"
                               value="{{ old('contact') }}"
                               class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200"
                               required>
                        <x-input-error :messages="$errors->get('contact')" class="mt-2" />
                    </div>
                    <div class="mb-6">
                        <label for="password" class="block text-gray-700 font-medium mb-1">Password</label>
                        <input type="password" name="password" id="password"
                               class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring focus:ring-blue-200"
                               required>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center space-x-4">
                        <x-primary-button class="bg-blue-700 hover:bg-blue-800">
                            Create
                        </x-primary-button>

                        <a href="{{ route('admin.house-owners.index') }}" class="ml-2">
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
