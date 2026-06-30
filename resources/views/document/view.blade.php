<!-- <style>
    #update-panel{
        display:flex;
        gap: 5%;
        justify-self: center;
    }

    #statusConfirmModal{
        border-radius: 5px;
        padding: 20px;
        display:none; 
        position:fixed; top:0; 
        left:0;
        width:100%; 
        height:100%; 
        background:rgba(0,0,0,0.5);    
    }
    
    #statusConfirmation{
        background: #f8f9fa;
        margin:100px auto;
        padding:20px;
        width:400px;
        border-radius:8px;
    }

    #statusError{
        color: red;
    }
</style> -->
<x-app-layout>

    @auth
    <div class="min-h-screeen overflow-hidden">
    <div id="container-qrGen" class="justify-items-center flex">
        <div class="text-crimson bg-white/40 dark:bg-white/10 dark:text-white flex flex-col sm:flex-row justify-center w-full sm:max-w-3xl max-w-lg rounded-3xl overflow-hidden font-semibold backdrop-blur-2xl shadow-[inset_0_0_5px_rgba(255,255,255,0.4)]">
            <div class="text-crimson dark:text-white dark:bg-black/35 xs:p-8 bg-white/30 flex-col justify-center max-w-2xl p-6 font-normal">               
                <h1 class="mb-5 text-2xl font-bold">Update Document Status</h1>
                <p class="my-2 text-lg"><strong>Document Title:</strong> {{ $document->title }}</p>
                <p class="my-2 text-lg"><strong>Created By:</strong> {{ $document->sender }}</p>
                <p class="my-2 text-lg"><strong>Email:</strong> {{ $document->sender_email }}</p>
                <p class="my-2 text-lg"><strong>Department:</strong> {{ $document->sender_dept }}</p>
                <p class="my-2 text-lg"><strong>Destination Department:</strong> {{ $document->recipient_dept }}</p>
                <p class="my-2 text-lg"><strong>Generation Date:</strong> {{ $document->created_at }}</p>
                <p class="my-2 text-lg"><strong>Status:</strong> {{ $log?->status ?? 'No status' }}</p>
            </div>
                <form method="POST" id="statusSubmitForm" action="{{ route('document.updateStatus', $document->uuid) }}"
                class="sm:p-10 w-full max-w-lg px-8 pt-2 pb-6 border-none">
                    @csrf
                    <label for="recipient"><strong>Receiver:</strong></label>
                    <input type="text" id="recipient" name="recipient" value="{{ Auth::user()->name }}" readonly
                    class="text-crimson bg-gray-200/50 dark:bg-gray-900/50 dark:text-white focus:border-crimson dark:focus:border-red-600 focus:ring-crimson dark:focus:ring-red-600 w-full max-w-xl my-1 text-lg border-transparent rounded-full shadow-sm"
                    >
                    <br>

                    <label for="recipient_dept"><strong>Recipient Department:</strong></label>
                    <input type="text" id="recipient_dept" name="recipient_dept" value="{{ Auth::user()->department}}" readonly
                    class="text-crimson bg-gray-200/50 dark:bg-gray-900/50 dark:text-white focus:border-crimson dark:focus:border-red-600 focus:ring-crimson dark:focus:ring-red-600 w-full max-w-xl my-1 text-lg border-transparent rounded-full shadow-sm"
                    >
                    <br>
                    
                    <label for="recipient_email"><strong>Recipient Email:</strong></label>
                    <input type="text" id="recipient_email" name="recipient_email" value="{{ Auth::user()->email}}" readonly
                    class="text-crimson bg-gray-200/50 dark:bg-gray-900/50 dark:text-white focus:border-crimson dark:focus:border-red-600 focus:ring-crimson dark:focus:ring-red-600 w-full max-w-xl my-1 text-lg border-transparent rounded-full shadow-sm">
                    <br>

                    <label for="status"><strong>Status Update:</strong></label>
                    <select name="status" id="status" required
                    class="text-crimson bg-gray-200/50 dark:bg-gray-900/50 dark:text-white focus:border-crimson dark:focus:border-red-600 focus:ring-crimson dark:focus:ring-red-600 w-full max-w-xl my-1 text-lg border-transparent rounded-full shadow-sm"
                    >
                        <option value="Pending" {{ $document->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Processing" {{ $document->status == 'Processing' ? 'selected' : '' }}>Processing</option>
                        <option value="Done" {{ $document->status == 'Done' ? 'selected' : '' }}>Done</option>
                        <option value="Returned" {{ $document->status == 'Returned' ? 'selected' : '' }}>Returned</option>
                    </select>
                    <div id="statusError"></div>

                    <label for="remarks"><strong>Remarks:</strong></label>
                    <br>
                    <textarea name="remarks" id="remarks" maxlength="255" placeholder=""
                    class="text-crimson bg-gray-200/50 dark:bg-gray-900/50 dark:text-white focus:border-crimson dark:focus:border-red-600 focus:ring-crimson dark:focus:ring-red-600 w-full max-w-xl my-1 text-sm border-transparent rounded-full shadow-sm"
                    ></textarea>
                    <br><br><center>
                    <button type="button" onclick="validateStatusForm()" class="hover:bg-red-600 bg-crimson px-6 py-3 mx-auto text-xl font-bold text-white transition rounded-full">Update Status</button></center>

                    @if(session('success'))
                        <p style="color:green;">{{ session('success') }}</p>
                    @endif

                </form>
            </div>
        </div> 
    </div>
    <div id="statusConfirmModal">
        <div id="statusConfirmation">
            <h3><strong>Confirm Submission?</strong></h3>
            <p id="previewStatusConfirm"></p>
            <button onclick="statusSubmitForm()" class="hover:bg-green-700 px-4 py-2 font-bold text-white bg-green-500 rounded-full" type="button">Confirm</button>
            <button onclick="statusCloseModal()" class="hover:bg-red-700 px-4 py-2 font-bold text-white bg-red-500 rounded-full" type="button">Cancel</button>
        </div>
    </div>
    @endauth
</x-app-layout>