<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Activity Logs</h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="table-responsive bg-white dark:bg-gray-800 shadow rounded-lg p-6">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-200 dark:bg-gray-700">
                            <th class="p-3">ID</th>
                            <th class="p-3">Product</th>
                            <th class="p-3">Action</th>
                            <th class="p-3">Changed By</th>
                            <th class="p-3">Changes</th>
                            <th class="p-3">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($logs as $log)
                            <tr class="border-b dark:border-gray-600">
                                <td class="p-3">{{ $log->id }}</td>
                                <td class="p-3">{{ $log->product->name ?? 'Deleted Product' }}</td>
                                <td class="p-3 capitalize">{{ $log->action }}</td>
                                <td class="p-3">{{ $log->user->name ?? 'System' }}</td>
                                <td class="p-3 text-sm">
                                    <pre class="whitespace-pre-wrap text-xs">{{ json_encode($log->changes, JSON_PRETTY_PRINT) }}</pre>
                                </td>
                                <td class="p-3">{{ $log->created_at->format('Y-m-d H:i') }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="p-3 text-center">No logs yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-4">{{ $logs->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>
