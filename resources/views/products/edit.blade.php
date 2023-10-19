<x-app-layout>

    <div class="container sm:m-6">

        <h1 class="text-2xl text-center mb-4 font-bold">Edit Product {{ $product->name }}</h1>

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

        <div id="ajax-errors" class="alert rounded mt-3 alert-danger" style="display: none;">
            <ul id="ajax-errors-list">
            </ul>
        </div>

        <form class="flex flex-col gap-4 lg:flex-row justify-center items-start" method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="lg:w-[300px] flex flex-col w-full p-2 gap-4">
            <!-- Product Name -->
            <div class="form-control">
                <label for="name" class="label-text">Product Name</label>
                <input type="text" class="input input-bordered w-full" id="name" name="name" value="{{ $product->name }}" required>
            </div>

            <!-- Product Description -->
            <div class="form-control">
                <label for="description" class="label-text">Description</label>
                <textarea class="textarea textarea-bordered" id="description" name="description" required>{{ $product->description }}</textarea>
            </div>

            <!-- Product Price -->
            <div class="form-control">
                <label for="price" class="label-text">Price</label>
                <input type="number" class="input input-bordered w-full" id="price" name="price" value="{{ $product->price }}" required>
            </div>

            <!-- Product Color -->
            <div class="form-control">
                <label for="color" class="label-text">Main Color</label>
                <input type="text" class="input input-bordered w-full" id="color" name="color" value="{{ $product->color }}" required>
            </div>

                <!-- Product Specs -->
                <!-- {"ram":"4GB","rom":"32GB","screen_size":"5.5 inches","processor":"Snapdragon 865","camera":"12MP","battery_capacity":"5000 mAh","operating_system":"One UI 3.0","connectivity":"Bluetooth 5.2","colors":["Red","White"]} -->

                <div class="bg-gray-50 p-2 rounded-md">

                    <div class="label-text text-white bg-gray-500 w-full text-2xl uppercase rounded flex justify-center mb-4">Specs</div>

                    <div class="flex gap-4">
                        <div class="mb-4">
                            <label for="ram">RAM</label>
                            <input type="text" class="input input-bordered w-full" id="ram" value="{{ $product->specs['ram'] ?? '' }}">
                        </div>
                        <div class="mb-4">
                            <label for="rom">ROM</label>
                            <input type="text" class="input input-bordered w-full" id="rom" value="{{ $product->specs['rom'] ?? '' }}">
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="mb-4">
                            <label for="screen_size">Screen Size</label>
                            <input type="text" class="input input-bordered w-full" id="screen_size" value="{{ $product->specs['screen_size'] ?? '' }}">
                        </div>
                        <div class="mb-4">
                            <label for="processor">Processor</label>
                            <input type="text" class="input input-bordered w-full" id="processor" value="{{ $product->specs['processor'] ?? '' }}">
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="mb-4">
                            <label for="camera">Camera</label>
                            <input type="text" class="input input-bordered w-full" id="camera" value="{{ $product->specs['camera'] ?? '' }}">
                        </div>
                        <div class="mb-4">
                            <label for="battery_capacity">Battery Capacity</label>
                            <input type="text" class="input input-bordered w-full" id="battery_capacity" value="{{ $product->specs['battery_capacity'] ?? '' }}">
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="mb-4">
                            <label for="operating_system">Operating System</label>
                            <input type="text" class="input input-bordered w-full" id="operating_system" value="{{ $product->specs['operating_system'] ?? '' }}">
                        </div>
                        <div class="mb-4">
                            <label for="connectivity">Connectivity</label>
                            <input type="text" class="input input-bordered w-full" id="connectivity" value="{{ $product->specs['connectivity'] ?? '' }}">
                        </div>
                    </div>


                    <div class="">
                        <label for="colors">Colors (comma-separated)</label>
                        <input type="text" class="input input-bordered w-full" id="colors" value="{{ implode(',', $product->specs['colors'] ?? []) }}">
                    </div>

                    <input type="hidden" name="specs" id="specs">
                </div>

                <script>
                    function combineSpecs() {
                        let specs = {
                            ram: document.getElementById('ram').value,
                            rom: document.getElementById('rom').value,
                            screen_size: document.getElementById('screen_size').value,
                            processor: document.getElementById('processor').value,
                            camera: document.getElementById('camera').value,
                            battery_capacity: document.getElementById('battery_capacity').value,
                            operating_system: document.getElementById('operating_system').value,
                            connectivity: document.getElementById('connectivity').value,
                            colors: document.getElementById('colors').value.split(',')
                        };

                        document.getElementById('specs').value = JSON.stringify(specs);
                    }
                </script>


                <!-- Product Brand -->
            <div class="form-control">
                <label for="brand" class="label-text">Brand</label>
                <input type="text" class="input input-bordered w-full" id="brand" name="brand" value="{{ $product->brand }}" required>
            </div>

                <!-- Product Discount -->
                <div class="form-control">
                    <label for="discount" class="label-text">Discount Percentage</label>
                    <input type="number" class="input input-bordered w-full" id="discount" name="discount_percentage" value="{{ $product->discount_percentage }}" required>
                </div>

            <!-- Product Category -->
            <div class="form-control">
                <label for="category_id" class="label-text">Category</label>
                <select class="input input-bordered w-full" id="category_id" name="category_id" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id === $product->category_id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            </div>

            <div class="lg:w-[300px] flex flex-col w-full p-2 gap-4">

            <!-- Product Stock -->
            <div class="form-control">
                <label for="stock" class="label-text">Stock</label>
                <input type="number" class="input input-bordered w-full" id="stock" name="stock" value="{{ $product->stock }}" required>
            </div>

            <!-- Product Sizes -->
            <div class="form-control flex flex-col gap-4" id="sizesDiv">
                <label for="sizes" class="label-text">Product Sizes</label>
                @foreach($product->sizes as $size)
                    <div class="input-group sizeInput">
                        <input type="text" class="input input-bordered w-full size" id="sizes" name="sizes[]" value="{{ $size->size }}" placeholder="Enter size and hit Enter" required>
                    </div>
                @endforeach
            </div>
            <div class="tooltip" data-tip="Add New Size">
                <x-round-button class="btn" id="addSizeBtn">
                    <i class="fa-solid fa-plus"></i>
                </x-round-button>
            </div>

            <!-- Product Images -->
            <div class="form-control">
                <label for="images" class="label-text">Product Images</label>

                <div data-tip="New Files Will Override these ones" class="flex flex-wrap my-4 tooltip gap-4">
                    @foreach($product->images as $image)
                        <img src="{{ asset('images/' . $image->image_path) }}" alt="{{ $product->name }}" class="img-fluid rounded" style="max-width: 100px; max-height: 100px;">
                    @endforeach
                </div>

                <div class="relative">
                    <input type="file" class="file-input file-input-bordered w-full max-w-xs" id="images" name="images[]" multiple required>
                    <!-- The button to open modal -->
                    <div class="tooltip absolute right-2 top-[25%]" data-tip="Upload Guide ⚡">
                        <label for="my_modal_6" class="btn btn-circle btn-xs ring ring-error ring-inset">
                            <i class="fa-solid fa-info"></i>
                        </label>
                    </div>

                    <!-- Put this part before </body> tag -->
                    <input type="checkbox" id="my_modal_6" class="modal-toggle" />
                    <div class="modal">
                        <div class="modal-box rounded">
                            <h3 class="font-bold text-lg">Info</h3>
                            <p class="py-4">
                                If you want to add new images, you have to select all images again.
                                <br>
                                New images will override the old ones.
                            </p>
                            <div class="modal-action">
                                <label for="my_modal_6" class="btn btn-circle btn-sm absolute right-2 top-2 ring ring-inset">
                                    <i class="fa-solid fa-xmark"></i>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="tooltip" data-tip="Save Data">
                <x-round-button onClick="combineSpecs()" type="submit">{!! '<i class="fa-solid fa-sd-card"></i>' !!}</x-round-button>
            </div>

            </div>
        </form>
    </div>

    <!-- Include jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            var maxField = 10; // Maximum input boxes allowed
            var addButton = $('#addSizeBtn'); // Add button selector
            var wrapper = $('#sizesDiv'); // Input field wrapper

            $(addButton).click(function(e) { // On add input button click
                e.preventDefault();
                var newSize = $('.sizeInput:last .size').val();
                if(newSize === ''){
                    alert("Please enter a size before adding a new field.");
                } else if ($('.sizeInput').length < maxField) { // Check maximum number of input fields
                    $('.sizeInput:last').append('<button class="btn btn-outline removeSizeBtn"><i class="fa-solid fa-trash"></i></button>'); // Add remove button to the last size input
                    $(wrapper).append('<div class="input-group sizeInput"><input type="number" class="input input-bordered w-full max-w-xs size" id="sizes" name="sizes[]" placeholder="Enter size and hit Enter" required></div>'); // Add field html
                }
            });

            $(wrapper).on('blur', '.size', function() { // When a size input loses focus
                var sizeValue = $(this).val();
                var sizeCount = 0;
                $('.size').each(function() {
                    if ($(this).val() === sizeValue) {
                        sizeCount++;
                    }
                });
                if (sizeCount > 1) {
                    alert("This size already exists. Please enter a new size.");
                    $(this).val(''); // Clear the input field
                }
            });

            $(wrapper).on('click', '.removeSizeBtn', function(e) { // On remove button click
                e.preventDefault();
                $(this).parent('.sizeInput').remove(); // Remove field html
            });


            $('form').on('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                var sizes = [];

                $('.sizeInput .size').each(function() {
                    var size = $(this).val();
                    if (size !== '') {
                        sizes.push(size);
                    }
                });

                formData.delete('sizes[]'); // delete the sizes that were included from the form
                sizes.forEach(function(size, index) {
                    formData.append('sizes[' + index + ']', size); // re-add the sizes after processing
                });

                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        //redirect to the products page
                        window.location.href = "{{ route('products.index') }}";
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR);
                        console.log(textStatus);
                        console.log(errorThrown);

                        // Assuming your server returns a JSON response with 'errors' object
                        if (jqXHR.responseJSON && jqXHR.responseJSON.errors) {
                            var errors = jqXHR.responseJSON.errors;
                            var errorsHtml = '';
                            $.each(errors, function(key, value) {
                                errorsHtml += '<li>' + value[0] + '</li>'; // Show first error message only
                            });

                            // Show errors in the HTML
                            $('#ajax-errors-list').html(errorsHtml);
                            $('#ajax-errors').show();
                        }
                    },
                });
            });


        });
    </script>

</x-app-layout>
