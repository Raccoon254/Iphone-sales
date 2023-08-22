<x-app-layout>
    <center class="text-2xl font-semibold mb-4">
        All Users
    </center>
    <div class="container mx-auto px-4 py-8">

        <div class="overflow-x-auto">
            <table class="min-w-full table-auto border-collapse border border-gray-200">
                <thead>
                <tr>
                    <th class="border border-gray-300 px-4 py-2">Username</th>
                    <th class="border border-gray-300 px-4 py-2">Email</th>
                    <th class="border border-gray-300 px-4 py-2">Phone</th>
                    <th class="border border-gray-300 px-4 py-2">Last Login</th>
                    <th class="border border-gray-300 px-4 py-2">Joined</th>
                    <th class="border border-gray-300 px-4 py-2">View</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $user->name }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $user->email}}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $user->phone_number }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $user->last_login_at }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $user->created_at->diffForHumans() }}</td>
                        <td class="border border-gray-300 py-2">
                            <a href="{{ route('users.show', $user->id)}}" class="btn mx-[25%] btn-sm btn-circle hover:text-blue-700">
                                <i class="fa-solid fa-mountain"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
