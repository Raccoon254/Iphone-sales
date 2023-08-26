<x-admin.index>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl mb-6">Create Category</h1>

        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block mb-2">Name</label>
                <input type="text" id="name" name="name" class="input input-bordered input-primary w-full max-w-xs" required>
            </div>

            <div class="mb-4">
                <label for="description" class="block mb-2">Description</label>
                <textarea id="description" name="description" class="textarea textarea-secondary w-full h-48" required></textarea>
            </div>

            <div class="tooltip" data-tip="Save Data">
                <x-round-button type="submit">{!! '<i class="fa-solid fa-sd-card"></i>' !!}</x-round-button>
            </div>
        </form>
    </div>
</x-admin.index>
