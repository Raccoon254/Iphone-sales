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
                <label for="color" class="label-text">Color</label>
                <input type="text" class="input input-bordered w-full" id="color" name="color" value="{{ $product->color }}" required>
            </div>

                <!-- Product Specs -->
                <div class="form-control">
                    <label for="specs" class="label-text">Specs</label>

                    @foreach($product->specs as $key => $value)
                        <div class="mb-4">
                            <label for="spec_{{ $key }}" class="block text-sm font-medium text-gray-700">{{ ucfirst(str_replace('_', ' ', $key)) }}</label>
                            @if(is_array($value))
                                <select name="specs[{{ $key }}][]" multiple id="spec_{{ $key }}" class="input input-bordered w-full">
                                    <!-- Assuming you have predefined options for arrays like colors -->
                                    @foreach(['Red', 'White', 'Blue', 'Green'] as $option) <!-- replace with actual options -->
                                    <option value="{{ $option }}" {{ in_array($option, $value) ? 'selected' : '' }}>{{ $option }}</option>
                                    @endforeach
                                </select>
                            @else
                                <input type="text" class="input input-bordered w-full" id="spec_{{ $key }}" name="specs[{{ $key }}]" value="{{ $value }}">
                            @endif
                        </div>
                    @endforeach
                </div>


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
                <x-round-button type="submit">{!! '<i class="fa-solid fa-sd-card"></i>' !!}</x-round-button>
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
