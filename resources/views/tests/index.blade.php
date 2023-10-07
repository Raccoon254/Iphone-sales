<x-app-layout>
    <center>
        <h1>Tests Product</h1>
        <h2> Price: 30$</h2>


        <form action="{{ route('paypal.payment') }}" method="POST">
            @csrf
            <input type="hidden" name="price" value="30">
            <button class="btn btn-outline" type="submit">Buy Now</button>
        </form>
    </center>
</x-app-layout>
