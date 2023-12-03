<x-admin.index>
    <div class="flex">
        <section class="z-50">
            @include('admin.sidebar')
        </section>

        <section class="px-4 w-full">
            <h1>Payment Details</h1>

            {{-- Payment details here --}}

            <form method="POST" action="{{ route('admin.payments.updateStatus', $payment) }}">
                @csrf
                <label for="status">Status:</label>
                <select name="status" id="status">
                    <option value="pending" {{ $payment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="verified" {{ $payment->status == 'verified' ? 'selected' : '' }}>Verified</option>
                    <option value="failed" {{ $payment->status == 'failed' ? 'selected' : '' }}>Failed</option>
                </select>

                <button type="submit">Update Status</button>
            </form>

        </section>
    </div>
</x-admin.index>
