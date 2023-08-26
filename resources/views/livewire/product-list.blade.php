<div class="flex">
    <section class="z-50">
        @include('admin.sidebar')
    </section>

    <div class="container mx-3">

        <section class="Raccoon Search m-3 w-full flex items-center justify-end">

            <span class="tooltip" data-tip="Create new product">
                <a class="btn btn-sm btn-circle ring" href="{{ route('products.create') }}">
                    <i class="fa-solid fa-plus"></i>
                </a>
            </span>

            <div class="w-full sm:w-1/4 mx-4">
                <label class="relative">
                    <input class="input input-bordered h-10 w-full max-w-xs" wire:model="search" type="text" placeholder="Search any text...">
                    <span class="absolute top-[-10px] right-1 text-[10px] text-gray-500">Powered by Raccoon</span>
                </label>
            </div>

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

        <!-- Check if any products exist -->
        @if($products->isEmpty())
            <div class="flex flex-col gap-4 h-[80vh] items-center justify-center mb-4">
                <section class="flex flex-col gap-4">
                    <h1 class="text-2xl text-center font-bold">No products found</h1>
                    <a href="{{ route('products.create') }}" class="btn ring btn-outline btn-warning w-[200px]">
                        <i class="fa-solid fa-plus"></i>
                        Add Product
                    </a>
                </section>
            </div>
        @else
            <!-- Display all products -->

            <table class="table table-zebra">
                <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Price</th>
                    <th scope="col">Color</th>
                    <th scope="col">Discount</th>
                    <th scope="col">Category</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Sizes</th>
                    <th scope="col">Images</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->color }}</td>
                        <td>{{ $product->discount_percentage }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>
                            <div class="flex flex-wrap gap-1">
                                @foreach($product->sizes as $size)
                                    <div class="p-2 rounded bg-gray-300">
                                        {{ $size->size }}
                                    </div>
                                @endforeach
                            </div>
                        </td>
                        <td>
                            <div class="flex flex-wrap gap-1">
                                @foreach($product->images as $image)
                                    <img src="{{ asset('images/' . $image->image_path) }}" alt="{{ $product->name }}" class="img-fluid rounded" style="max-width: 100px; max-height: 100px;">
                                @endforeach
                            </div>
                        </td>

                        <td>
                            <div class="flex gap-4">
                                <a class="tooltip" data-tip="View {{ $product->name }}" href="{{ route('products.show', $product->id) }}">
                                    <x-round-button >{!! '<i class="fa-solid fa-mountain"></i>' !!}</x-round-button>
                                </a>
                                <a class="tooltip" data-tip="Edit {{ $product->name }}"  href="{{ route('products.edit', $product->id) }}">
                                    <x-round-button >{!! '<i class="fa-solid fa-gear"></i>' !!}</x-round-button>
                                </a>

                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="tooltip" data-tip="Delete {{ $product->name }}">
                                    @csrf
                                    @method('DELETE')
                                    <x-round-button type="submit">{!! '<i class="fa-solid fa-trash"></i>' !!}</x-round-button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <section class="w-full my-3">
                {{ $products->links() }}
            </section>
        @endif
    </div>

</div>
