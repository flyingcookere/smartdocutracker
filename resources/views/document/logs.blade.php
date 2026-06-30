<!-- <style>
    #logs-table-container {
        justify-self: center;
        transform: scale(0.9);
    }
</style> -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="dark:text-gray-200 text-xl font-semibold leading-tight text-gray-800">
            {{ __('Logs') }}
        </h2>
    </x-slot>
@auth
<div class="md:block hidden">
    <div id="logs-table-container" class="max-w-7xl p-5 mx-auto">
        
        {{-- Static Info Panel --}}
        <div class="bg-white/85 dark:bg-white/10 dark:text-gray-200 backdrop-blur-2xl p-6 mb-4 text-gray-800 shadow-[inset_0_0_5px_rgba(255,255,255,0.4)] rounded-2xl">
            <h2 class="mb-4 text-4xl font-bold">Document Information</h2>
            <div class="sm:grid-cols-2 grid grid-cols-1 gap-2 text-lg">
                <div class="capitalize"><strong>Title:</strong> {{ $logs->first()?->title ?? 'N/A' }}</div>
                <div><strong>UUID:</strong> {{ $logs->first()?->uuid ?? 'N/A' }}</div>
                <div><strong>Sender:</strong> {{ $logs->first()?->sender ?? 'N/A' }}</div>
                <div><strong>Sender's Email:</strong> {{ $logs->first()?->sender_email ?? 'N/A' }}</div>
                <div><strong>Sender's Department:</strong> {{ $logs->first()?->sender_dept ?? 'N/A' }}</div>
            </div>
        </div>

        {{-- Desktop Table --}}
        <div class="md:block dark:bg-white/10 hidden overflow-x-auto max-h-[310px] bg-white backdrop-blur-2xl rounded-lg shadow">
            <table class="dark:border-gray-700 min-w-full border border-gray-200 rounded table-auto">
                <thead class="dark:bg-white/10 dark:text-gray-200 text-sm font-semibold text-gray-700 uppercase bg-gray-100">
                    <tr>

                        <th class="px-4 py-3 text-left border-b">Time Stamps</th>
                        <th class="px-4 py-3 text-left border-b">Status</th>
                        <th class="px-4 py-3 text-left border-b">Recipient</th>
                        <th class="px-4 py-3 text-left border-b">Receiving Department</th>
                        <th class="px-4 py-3 text-left border-b">Recipient's Email</th>
                        <th class="px-4 py-3 text-left border-b">Communication</th>
                        <th class="px-4 py-3 text-left border-b">Remarks</th>
                        
                    </tr>
                </thead>
                <tbody class="dark:text-gray-200 text-sm text-gray-800">
                    @foreach($logs as $log)
                        <tr class="hover:bg-gray-50 dark:hover:bg-white/20 transition-colors">
                            <td class="dark:border-white/10 px-4 py-3 border-t">{{ $log->created_at }}</td>
                            <td class="dark:border-white/10 px-4 py-3 border-t">{{ $log->status }}</td>
                            <td class="dark:border-white/10 px-4 py-3 border-t">{{ $log->recipient }}</td>
                            <td class="dark:border-white/10 px-4 py-3 border-t">{{ $log->recipient_dept }}</td>
                            <td class="dark:border-white/10 px-4 py-3 border-t">{{ $log->recipient_email }}</td>
                            <td class="dark:border-white/10 px-4 py-3 border-t">{{ $log->communication }}</td>
                            <td class="dark:border-white/10 px-4 py-3 border-t">{{ $log->remarks }}</td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
    </div>
</div>
    {{-- Mobile Cards --}}
    <div class="md:hidden block">
    <div class="bg-white/80 dark:bg-black/10 backdrop-blur-2xl flex flex-col w-screen h-screen">
        
        <!-- Top Info Card -->
        <div class="rounded-3xl bg-white/90 dark:bg-white/10 shadow-[inset_0_0_5px_rgba(255,255,255,0.4)] dark:border-gray-700 p-6 mx-4 mt-4 border border-gray-200">
            <div class="dark:text-white mb-3 text-3xl font-bold text-black capitalize">
                {{ $log->title }}
            </div>
            <div class="dark:text-gray-300 space-y-1 text-base text-black">
                <p><span class="font-semibold"><strong>Sender:</strong></span> {{ $log->sender }}</p>
                <p><span class="font-semibold"><strong>Sender's Email:</strong></span> {{ $log->sender_email }}</p>
                <p><span class="font-semibold"><strong>Sender's Dept:</strong></span> {{ $log->sender_dept }}</p>
                <p><span class="font-semibold"><strong>UUID:</strong></span> {{ $log->uuid }}</p>
            </div>
        </div>

        <!-- Log Entries -->
        <div class="flex-1 mt-4 overflow-y-auto">
            @foreach($logs as $log)
                <div class="p-4 border-b-2 mx-auto dark:border-gray-200 border-black/30 max-w-[85%]">
                    <div class="dark:text-gray-300 space-y-1 text-sm text-black">
                        @if ($loop->first)
                            @if ($loop->last)
                                <p class="dark:text-green-500 text-xl font-semibold text-green-600">
                                    Your Document has been processed <strong>{{ $log->recipient_dept }}</strong>
                                </p>
                            @else
                                <p class="dark:text-green-500 text-xl font-semibold text-green-600">
                                    Your Document has Arrived at the <strong>{{ $log->recipient_dept }}</strong>
                                </p>
                            @endif
                        @else
                            @if ($loop->last)
                                <p class="text-xl font-bold">
                                    QR Code Successfully Generated {{ $log->recipient_dept }}
                                </p>
                            @else
                                <p class="text-xl font-bold">
                                    Your Document has Arrived at the {{ $log->recipient_dept }}
                                </p>
                            @endif
                        @endif

                        <p><span class="font-medium"><strong>Recipient:</strong></span> {{ $log->recipient }}</p>
                        <p><span class="font-medium"><strong>Recipient's Email:</strong></span> {{ $log->recipient_email }}</p>
                        <p><span class="font-medium"><strong>Communication:</strong></span> {{ $log->communication }}</p>
                        <p><span class="font-medium"><strong>Status:</strong></span> {{ $log->status }}</p>
                        <p><span class="font-medium"><strong>Remarks:</strong></span> {{ $log->remarks }}</p>
                        <p><span class="font-medium"><strong>Timestamp:</strong></span> {{ $log->created_at }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

@endauth



</x-app-layout>

