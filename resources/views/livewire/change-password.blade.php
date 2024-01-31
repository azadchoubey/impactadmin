<div>

    <form wire:submit.prevent="changePassword" class="max-w-md mx-auto mt-8">
        @if (session()->has('message'))
            <div class="mb-4 p-2 bg-green-500 text-white rounded">
                {{ session('message') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="mb-4 p-2 bg-red-500 text-white rounded">
                {{ session('error') }}
            </div>
        @endif

        <div class="mb-4">
            <label for="currentPassword" class="block text-sm font-medium text-gray-700">Current Password</label>
            <input type="password" wire:model="currentPassword" id="currentPassword" name="currentPassword" class="mt-1 p-2 w-full border rounded-md">
            @error('currentPassword') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="newPassword" class="block text-sm font-medium text-gray-700">New Password</label>
            <input type="password" wire:model="newPassword" id="newPassword" name="newPassword" class="mt-1 p-2 w-full border rounded-md">
            @error('newPassword') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="confirmPassword" class="block text-sm font-medium text-gray-700">Confirm Password</label>
            <input type="password" wire:model="confirmPassword" id="confirmPassword" name="confirmPassword" class="mt-1 p-2 w-full border rounded-md">
            @error('confirmPassword') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <button type="submit" class="bg-blue-500 text-white p-2 rounded-md">Change Password</button>
        </div>
    </form>

</div>
