<x-app-layout>

    <div class="flex">
        <section class="z-50">
            @include('admin.sidebar')
        </section>

        <div class="mx-auto py-10 w-full sm:px-6 lg:px-8">
            <table class="table w-full table-zebra table-md ">
                <thead>
                <tr>
                    <th class="border px-4 py-2 text-center">Title</th>
                    <th class="border px-4 py-2 text-center">Image</th>
                    <th class="border px-4 py-2 text-center">Type</th>
                    <th class="border px-4 py-2 text-center">Link</th>
                    <th class="border px-4 py-2 text-center">Edit</th>
                    <th class="border px-4 py-2 text-center">Delete</th>
                </tr>
                </thead>


                @foreach($banners as $banner)
                    <tr>
                        <td class="border px-4 py-2 text-center">
                            <h2 class="font-bold">{{ $banner->title }}</h2>
                        </td>
                        <td class="border px-4 py-2 text-center">
                            <img src="{{ asset($banner->image_url) }}" alt="{{ $banner->title }}" class="w-24 rounded h-24 object-cover">
                        </td>

                        <td class="border px-4 py-2 text-center">
                            <h2 class="font-bold">{{ $banner->type }}</h2>
                        </td>

                        <td class="border px-4 py-2 text-center">
                            <a data-tip="Go to {{$banner->link}}" class="tooltip" href="{{ $banner->link }}">
                                <x-round-button class="btn bg-white btn-primary">
                                    <i class="fas fa-link"></i>
                                </x-round-button>
                            </a>
                        </td>
                        <td class="border px-4 py-2 text-center">
                            <a data-tip="Edit {{$banner->title}}" class="tooltip" href="{{ route('banners.edit', $banner->id) }}">
                                <x-round-button class="btn btn-secondary">
                                    <i class="fas fa-pencil-alt"></i>
                                </x-round-button>
                            </a>
                        </td>
                        <td class="border px-4 py-2 text-center">
                            <form class="tooltip" data-tip="Delete {{$banner->title}}" method="POST" action="{{ route('banners.destroy', $banner->id) }}">
                                @csrf
                                @method('DELETE')
                                <x-round-button type="submit" class="btn btn-error">
                                    <i class="fas fa-trash"></i>
                                </x-round-button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
            <div data-tip="Create a new banner" class="my-4 tooltip">
                <a href="{{ route('banners.create') }}">
                    <x-round-button class="btn bg-blue-200">
                        <i class="fas fa-plus"></i>
                    </x-round-button>
                </a>
            </div>

            <!--Check if there are any messages within the session-->
            @if(session('success'))
                <div class="alert rounded alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert rounded alert-error">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>

</x-app-layout>
