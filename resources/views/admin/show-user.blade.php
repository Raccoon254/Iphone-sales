<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 border-b flex justify-between border-gray-200 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    User Details
                </h3>
                <h3 class="text-lg leading-6 font-medium flex gap-4 items-center justify-center text-gray-900">
                    <i class="fas fa-file-lines mr-1"></i>{{ $user->id }}
                </h3>
            </div>
            <div class="px-4 py-5 sm:p-6">
                <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">
                            <i class="fas fa-id-card-alt mr-1"></i> User ID
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{ $user->id }}
                        </dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">
                            <i class="fas fa-user mr-1"></i> Name
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{ $user->name }}
                        </dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">
                            <i class="fas fa-envelope mr-1"></i> Email
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{ $user->email }}
                        </dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">
                            <i class="fas fa-phone-alt mr-1"></i> Phone Number
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{ $user->phone_number }}
                        </dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">
                            <i class="fas fa-address-card mr-1"></i> Address
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{ $user->address }}
                        </dd>
                    </div>
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">
                            <i class="fas fa-credit-card mr-1"></i> Billing Information
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{ $user->billing_information ?? 'No billing information provided.' }}
                        </dd>
                    </div>
                    <!-- Add more user details with icons as needed -->
                </dl>
            </div>
        </div>
    </div>
</x-app-layout>
