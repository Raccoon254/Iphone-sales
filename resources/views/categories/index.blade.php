<x-admin.index>
    <div class="container flex w-full">

        <section class="z-50">
            @include('admin.sidebar')
        </section>

       <div class="w-full sm:px-2">

           <div class="mb-2 sm:mb-6 p-1 sm:p-6 w-full">
               <a class="tooltip float-right" data-tip="Create a new category"  href="{{ route('categories.create') }}">
                   <x-round-button class="hover:bg-base-100" >{!! '<i class="fa-solid fa-plus"></i>' !!}</x-round-button>
               </a>
           </div>

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
           @foreach($categories as $category)
               <div class="p-1 sm:p-6 shadow bordered border-base-100 rounded mb-4">
                   <h2 class="text-2xl mb-2">{{ $category->name }}</h2>
                   <div class="block mb-4 sm:hidden">
                       <p>{{ \Illuminate\Support\Str::words($category->description, 40) }}</p>
                   </div>
                   <div class="hidden sm:block">
                       <p>{{ $category->description }}</p>
                   </div>
                   <div class="mt-4 z-20 w-full justify-end flex gap-4">

                       <a class="tooltip z-20" data-tip="View {{ $category->name }}" href="{{ route('categories.show', $category->id) }}">
                           <x-round-button class="z-20" >{!! '<i class="fa-solid fa-mountain"></i>' !!}</x-round-button>
                       </a>

                       <a class="tooltip z-20" data-tip="Edit {{ $category->name }}"  href="{{ route('categories.edit', $category->id) }}">
                           <x-round-button >{!! '<i class="fa-solid fa-gear"></i>' !!}</x-round-button>
                       </a>

                       <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="tooltip z-20" data-tip="Delete {{ $category->name }}">
                           @csrf
                           @method('DELETE')
                           <x-round-button class="z-20" type="submit">{!! '<i class="fa-solid fa-trash"></i>' !!}</x-round-button>
                       </form>


                   </div>
               </div>
           @endforeach
       </div>
    </div>
</x-admin.index>
