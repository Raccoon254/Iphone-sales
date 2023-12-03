<x-admin.index>
    <div class="flex">
        <section class="z-50">
            @include('admin.sidebar')
        </section>

        <section class="px-4 w-full">
            <h1 class="text-center my-3">Payments</h1>
            <table class="table w-full">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($payments as $payment)
                    <tr>
                        <td>{{ $payment->id }}</td>
                        <td>{{ $payment->user->name }}</td>
                        <td>{{ $payment->amount }}</td>
                        <td>{{ $payment->status }}</td>
                        <td>
                            <a href="{{ route('admin.payments.show', $payment) }}">View</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </section>
    </div>
</x-admin.index>
