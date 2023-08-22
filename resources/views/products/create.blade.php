<x-app-layout>

    <div class="container sm:m-6">

        <h1 class="text-2xl text-center mb-4 font-bold">Create Product</h1>

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


        <form class="flex flex-col gap-4 lg:flex-row justify-center items-start" method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="lg:w-[300px] flex flex-col w-full p-2 gap-4">
                <!-- Product Name -->
                <div class="form-control">
                    <label for="name" class="label-text">Product Name</label>
                    <input type="text" class="input input-bordered w-full" id="name" name="name" required>
                </div>

                <!-- Product Description -->
                <div class="form-control">
                    <label for="description" class="label-text">Description</label>
                    <textarea class="textarea textarea-bordered" id="description" name="description" required></textarea>
                </div>

                <!-- Product Price -->
                <div class="form-control">
                    <label for="price" class="label-text">Price</label>
                    <input type="number" class="input input-bordered w-full" id="price" name="price" required>
                </div>

                <!-- Product Color -->
                <div class="form-control">
                    <label for="color" class="label-text">Color</label>
                    <input type="text" class="input input-bordered w-full" id="color" name="color" required>
                </div>

                <!-- Product Images -->
                <div class="form-control mb-4 sm:mb-8">
                    <label for="images" class="label-text">Product Images</label>
                    <input type="file" class="file-input file-input-bordered w-full" id="images" name="images[]" multiple required>
                </div>


                <div class="flex px-3 gap-4">
                    <div class="tooltip" data-tip="Save Data">
                        <button class="btn btn-outline rounded-full w-[280px]" type="submit">{!! 'Save Product <i class="fa-solid fa-sd-card"></i>' !!}</button>
                    </div>

                </div>


            </div>


            <div class="lg:w-[300px] flex flex-col w-full p-2 gap-4">

                <!-- Product Specs -->
                <div class="form-control">
                    <label for="specs" class="label-text">Specs</label>
                    <input type="text" class="input input-bordered w-full" id="specs" name="specs" required>
                </div>

                <!-- Product Brand -->
                <div class="form-control">
                    <label for="brand" class="label-text">Brand</label>
                    <input type="text" class="input input-bordered w-full" id="brand" name="brand" required>
                </div>

                <!-- Product Category -->
                <div class="form-control">
                    <label for="category_id" class="label-text">Category</label>
                    <select class="input input-bordered w-full" id="category_id" name="category_id" required>
                        <!-- You can list the categories from the database here -->
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Product Stock -->
                <div class="form-control">
                    <label for="stock" class="label-text">Stock</label>
                    <input type="number" class="input input-bordered w-full" id="stock" name="stock" required>
                </div>

                <!-- Product Sizes -->
                <div class="flex flex-col gap-4 w-full justify-start">
                    <div class="form-control flex flex-col gap-3" id="sizesDiv">
                        <label for="sizes" class="label-text">Product Sizes</label>
                        <div class="input-group sizeInput">
                            <input type="number" class="input input-bordered w-full  size" id="sizes" name="sizes[]" placeholder="Enter size and hit Enter" required>
                        </div>
                    </div>
                    <div class="tooltip" data-tip="Add New Size">
                        <x-round-button class="btn" id="addSizeBtn">
                            <i class="fa-solid fa-plus"></i>
                        </x-round-button>
                    </div>
                </div>


            </div>

        </form>
    </div>

    <!-- Include jQuery library (use a CDN or download and host it locally) -->
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
                        //redirect to the products.index route
                        window.location.href = "{{ route('products.index') }}";
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR);
                        console.log(textStatus);
                        console.log(errorThrown);

                        // Assuming your server returns a JSON response with 'errors' object
                        if (jqXHR.responseJSON && jqXHR.responseJSON.error) {
                            var error = jqXHR.responseJSON.error;

                            // Show error in the HTML
                            $('#ajax-errors-list').html('<li>' + error + '</li>');
                            $('#ajax-errors').show();
                        }
                    },
                });
            });


        });
    </script>
</x-app-layout>
