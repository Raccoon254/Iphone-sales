<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl mb-6">Edit Category</h1>

        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block mb-2">Name</label>
                <input type="text" id="name" name="name"  placeholder="Type here" value="{{ $category->name }}" required class="input input-bordered input-primary w-full max-w-xs" />
            </div>

            <div class="mb-4">
                <label for="description" class="block mb-2">Description</label>
                <textarea id="description" name="description" class="textarea textarea-secondary w-full h-48" required>{{ $category->description }}</textarea>
            </div>

            <div class="tooltip" data-tip="Save Data">
                <x-round-button type="submit">{!! '<i class="fa-solid fa-sd-card"></i>' !!}</x-round-button>
            </div>
        </form>
    </div>
</x-app-layout>
