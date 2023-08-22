<x-app-layout>

    <section class="flex w-full">

        <section class="w-full mt-3 sm:mt-4 p-3 flex flex-col items-center justify-center">
            <h1 class="text-2xl my-3 sm:my-6 font-bold text-gray-900">Edit {{$banner->title}}</h1>

            <form method="POST" class="flex w-full sm:w-3/4 md:w-1/2 justify-center gap-3 items-center flex-col" action="{{ route('banners.update', $banner->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="text" class="input input-bordered w-full max-w-xs" id="title" name="title" value="{{ $banner->title }}">

                <input type="text" id="link" class="input input-bordered w-full max-w-xs" name="link" value="{{ $banner->link }}">

                <select id="type" name="type" class="select select-bordered w-full max-w-xs">
                    @foreach(App\Models\Banner::TYPES as $key => $value)
                        <option value="{{ $key }}" {{ $banner->type == $key ? 'selected' : '' }}>{{ $value }}</option>
                    @endforeach
                </select>


                <input type="file" id="image" name="image" class="file-input file-input-bordered w-full max-w-xs">

                <div class="tooltip" data-tip="Confirm Edit">
                    <x-round-button class="bg-red-200" type="submit">
                        <i class="fa-solid fa-sd-card"></i>
                    </x-round-button>
                </div>
            </form>

        </section>


        <section class="w-full hidden sm:flex p-3 justify-center">
            <img src="{{ asset($banner->image_url) }}" alt="{{ $banner->title }}" class="rounded object-cover">
        </section>

    </section>
   <!--Check if there are any messages within the session-->
    @if(session('success'))
        <div class="alert rounded mt-3 alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert rounded mt-3 alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</x-app-layout>
