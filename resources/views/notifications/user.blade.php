<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    @isset($allNotifications)
                        <center class="font-semibold text-2xl">All Notifications: {{ $allNotifications->count() }}</center>
                        @foreach ($allNotifications as $notification)
                            <section class="flex justify-between shadow items-center mb-2 {{ $notification->isReadByUser(Auth::id()) ? 'bg-green-400' : 'bg-white' }}">
                                <div class="px-4 pt-4 mb-4 rounded">
                                    <div class="font-semibold uppercase text-xl">{{ $notification->title }}</div>
                                    <div class="text-sm">{{ $notification->message }}</div>
                                    <div class="text-xs text-gray-500">{{ $notification->created_at->diffForHumans() }}</div>
                                    <div class="text-xs mt-2 italic {{ $notification->isReadByUser(Auth::id()) ? 'text-gray-500' : 'text-blue-500' }}">
                                        {{ $notification->isReadByUser(Auth::id()) ? 'Read' : 'Unread' }}
                                    </div>
                                </div>

                                <a class="tooltip tooltip-left mx-6" data-tip="View {{ $notification->title }}" href="{{ route('notifications.show', $notification->id) }}">
                                    <x-round-button class="z-20">{!! '<i class="fa-solid fa-mountain"></i>' !!}</x-round-button>
                                </a>
                            </section>
                        @endforeach
                    @endisset

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
