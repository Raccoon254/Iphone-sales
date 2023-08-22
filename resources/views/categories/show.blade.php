<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl mb-6">{{ $category->name }}</h1>
        <p>{{ $category->description }}</p>

        <div class="mt-6">
            <a class="tooltip" data-tip="Edit {{ $category->name }}"  href="{{ route('categories.edit', $category->id) }}">
                <x-round-button >{!! '<i class="fa-solid fa-gear"></i>' !!}</x-round-button>
            </a>
        </div>
    </div>
</x-app-layout>
