<style>
    #log-edit-container {
        background-color: #f8f9fa;
        border-radius: 5px;
        padding: 20px;
        margin: 20px auto;
        display:grid;
        justify-self: center;
        overflow-x: auto;
        transform: scale(0.8);
    }
    table {
        width: 20px;
    }

    
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Logs') }}
        </h2>
    </x-slot>
    <br>
    <br>
    <div id="log-edit-container">
        @auth
            <div>
                <h2>(Within 1 hour you can only edit this log, otherwise it is permanent)</h2>
            </div>
            <br>
            <br>
            <table class="table-auto border border-collapse border-gray-300" align="center" id="logs-table">
                <thead class="bg-gray-100">
                    <th class="border border-gray-300 px-4 py-2">UUID</th>
                    <th class="border border-gray-300 px-4 py-2">Title</th>
                    <th class="border border-gray-300 px-4 py-2">Sender</th>
                    <th class="border border-gray-300 px-4 py-2">Sender's Email</th>
                    <th class="border border-gray-300 px-4 py-2">Sender's Department</th>
                    <th class="border border-gray-300 px-4 py-2">Recepient</th>
                    <th class="border border-gray-300 px-4 py-2">Recepient's Email</th>
                    <th class="border border-gray-300 px-4 py-2">Receiving Department</th>
                    <th class="border border-gray-300 px-4 py-2">Communication</th>
                    <th class="border border-gray-300 px-4 py-2">Status</th>
                    <th class="border border-gray-300 px-4 py-2">Remarks</th>
                    <th class="border border-gray-300 px-4 py-2">Time Stamps</th>
                </thead>
                <tbody>
                    @foreach($logs as $log)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">{{ $log->uuid }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $log->title }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $log->sender }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $log->sender_email }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $log->sender_dept }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $log->recepient }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $log->recepient_email }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $log->recepient_dept }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $log->communication }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $log->status }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $log->remarks }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $log->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endauth
</x-app-layout>

