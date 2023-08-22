<x-app-layout>

    <section class="w-full mt-3 sm:mt-6 flex flex-col items-center justify-center">

        <h1 class="text-2xl my-3 sm:my-6 font-bold text-gray-900">Create a new banner</h1>

        <form method="POST" class="flex w-full sm:w-3/4 md:w-1/2 justify-center gap-3 items-center flex-col" action="{{ route('banners.store') }}" enctype="multipart/form-data">
            @csrf

            <input placeholder="Title" class="input input-bordered w-full max-w-xs" type="text" id="title" name="title">

            <input placeholder="Link" class="input input-bordered w-full max-w-xs" type="text" id="link" name="link">

            <select class="select select-bordered w-full max-w-xs" id="type" name="type">
                <option disabled selected>Choose a type</option>
                @foreach(App\Models\Banner::TYPES as $key => $value)
                    <option value="{{ $key }}" {{ isset($banner) && $banner->type == $key ? 'selected' : '' }}>{{ $value }}</option>
                @endforeach
            </select>


            <input class="file-input file-input-bordered w-full max-w-xs" type="file" id="image" name="image">

            <div class="tooltip" data-tip="Submit">
                <x-round-button type="submit">
                    <i class="fa-solid fa-sd-card"></i>
                </x-round-button>
            </div>
        </form>

    </section>


    <!--Check if there are any messages within the session-->
    @if(session('success'))
        <div class="alert rounded mt-3 alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert rounded mt-3 bg-red-500 alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

</x-app-layout>
