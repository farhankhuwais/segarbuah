<x-app-layout title="Notifications">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center gap-3">
                <i class="ph-bold ph-bell text-emerald-500" aria-hidden="true"></i>
                Notifications
            </h1>
            @if (auth()->user()->unreadNotifications->count() > 0)
                <form action="{{ route('notifications.readAll') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-sm text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 font-medium inline-flex items-center gap-1">
                        Mark all as read
                        <i class="ph-bold ph-check-circle text-xs" aria-hidden="true"></i>
                    </button>
                </form>
            @endif
        </div>

        @if (session('success'))
            <div class="mb-6 p-4 bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 rounded-xl text-sm text-emerald-700 dark:text-emerald-300 flex items-center gap-2">
                <i class="ph-bold ph-check-circle text-lg" aria-hidden="true"></i>
                {{ session('success') }}
            </div>
        @endif

        @forelse ($notifications as $notification)
            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 p-5 mb-3 transition-colors {{ $notification->read_at ? '' : 'border-l-4 border-l-emerald-500' }}">
                <div class="flex items-start gap-3">
                    <div class="w-10 h-10 rounded-xl bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center shrink-0 mt-0.5">
                        <i class="ph-bold ph-package text-emerald-600 dark:text-emerald-400" aria-hidden="true"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-medium text-gray-900 dark:text-white text-sm">{{ $notification->data['title'] ?? 'Notification' }}</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400 mt-0.5">{{ $notification->data['message'] ?? '' }}</p>
                        <div class="flex items-center gap-3 mt-2">
                            <span class="text-xs text-gray-500 dark:text-gray-400">{{ $notification->created_at->diffForHumans() }}</span>
                            @if (!$notification->read_at)
                                <a href="{{ route('notifications.read', $notification->id) }}" class="text-xs text-emerald-600 dark:text-emerald-400 hover:underline">Mark read</a>
                            @endif
                        </div>
                        @if (isset($notification->data['order_number']))
                            <a href="{{ route('orders.show', $notification->data['order_id']) }}" class="inline-flex items-center gap-1 text-xs text-emerald-600 dark:text-emerald-400 hover:underline mt-2">
                                View order
                                <i class="ph-bold ph-arrow-right text-xs" aria-hidden="true"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-16">
                <i class="ph-bold ph-bell-slash text-6xl text-gray-300 dark:text-gray-600 mb-4" aria-hidden="true"></i>
                <p class="text-gray-500 dark:text-gray-400">No notifications yet.</p>
            </div>
        @endforelse

        <div class="mt-6">
            {{ $notifications->links() }}
        </div>
    </div>
</x-app-layout>
