<style>
    #container-qrGen {
        padding: 0;
        margin: 20px auto;
        display:grid;
        justify-self: center;
        transform: scale(0.9);
    }
    #qrForm {
        border-radius: 0;
    }
    #confirmModal {
        border-radius: 5px;
        padding: 20px;
        display:none; 
        position:fixed; top:0; 
        left:0;
        width:100%; 
        height:100%; 
        background:rgba(0,0,0,0.5);    
    }

    #confirmation{
        background: #f8f9fa;
        margin:100px auto;
        padding:20px;
        width:400px;
        border-radius:8px;
    }

    #documentTitleError, #departmentError, #communicationError{
        color: red;
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="dark:text-gray-200 text-xl font-semibold leading-tight text-gray-800">
            {{ __('Generate QR Code') }}
        </h2>
    </x-slot>
<div class="min-h-screeen overflow-hidden">
    <div id="container-qrGen" class="justify-items-center flex">
        <div class="text-crimson bg-white/40 dark:bg-white/10 dark:text-white flex flex-col sm:flex-row justify-center w-full sm:max-w-3xl max-w-lg rounded-3xl overflow-hidden font-semibold backdrop-blur-2xl shadow-[inset_0_0_5px_rgba(255,255,255,0.4)]">
            <div class="text-crimson dark:text-white dark:bg-black/35 xs:p-8 bg-white/30 flex-col justify-center max-w-2xl p-6 font-normal">

                <h1 class="mb-8 font-bold">Sender's Information</h1>

                <label for="sender" class="text-xl font-extrabold">Recipient: </label>
                <h2 class="mb-4">{{ Auth::user()->name }}</h2>
                <label for="email" class="text-xl font-extrabold">Sender's Email: </label>
                <h2 class="mb-4">{{ Auth::user()->email }}</h2>
                <label for="sender_dept" class="text-xl font-extrabold">Sender's Department: </label>
                <h2 class="mb-4">{{ Auth::user()->department }}</h2>

            </div>
            
            <form method="POST" action="{{ route('document.store') }}" id="qrForm"
            class="sm:p-10 w-full max-w-lg px-8 pt-2 pb-6 border-none"
            >
                <h1 class="text-center">Document Details</h1>
                @csrf
                <br>
                <label for="sender" class="hidden">Recipient: </label>
                <input type="text" id="sender" name="sender" placeholder="Sender Name" value="{{ Auth::user()->name }}"required readonly 
                class="hidden"
                >
                <label for="email" class="hidden">Sender's Email: </label>
                <input type="text" name="sender_email" placeholder="Sender Email" id = "email" value="{{ Auth::user()->email }}" required readonly
                class="hidden"
                >
                <label for="sender_dept" class="sender_dept hidden">Sender's Department:</label>
                <input type="text" name="sender_dept" id="sender_dept" placeholder="Sender Email" value="{{ Auth::user()->department }}" required readonly
                class="hidden"
                >
                <label for="title" class="text-xl font-extrabold">Document: </label><br>
                <input type="text" name="title" required id="title" 
                class="text-crimson bg-gray-200/50 dark:bg-gray-900/50 dark:text-white focus:border-crimson dark:focus:border-red-600 focus:ring-crimson dark:focus:ring-red-600 w-full max-w-xl my-1 text-lg border-transparent rounded-full shadow-sm"
                ><br>
                <div id="documentTitleError"></div>
                
                <label for="department" class="text-xl font-extrabold">Destination: </label><br>
                <select name="recipient_dept" id="department" placeholder="Recipient Department"
                class="text-crimson dark:bg-gray-900/50 dark:text-white focus:border-crimson dark:focus:border-red-600 focus:ring-crimson dark:focus:ring-red-600 bg-gray-200/50 w-full max-w-xl my-1 text-lg border-transparent rounded-full shadow-sm"
                >
                    <option value="" disabled selected>Destination Department</option>
                    <option value="College of Engineering">College of Engineering</option>
                    <option value="Office of The President">Office of the President</option>
                    <option value="Accounting Office">Accounting Office</option>
                    <option value="Office of The Chancellor">Office of The Chancellor</option>
                    <option value="Office of The VPAA">Office of The VPAA</option>
                </select>    
                <div id="departmentError"></div>
                <br>
                <h3 class="text-xl font-extrabold">Communication:</h3> 
                <br>
                <input type="radio" name="communication" id="internal" value="IC" required class="text-red-600">
                <label for="internal">Internal Communication (IC)</label> <br>
                <div class="mt-2">
                <input type="radio" name="communication" id="external" value="EC" required class="text-red-600">
                <label for="external">External Communication (EC)</label>
                </div>
                <div id="communicationError"></div>
                <br><center>
                <button class="hover:bg-red-600 bg-crimson px-10 py-4 mx-auto text-xl font-bold text-white transition rounded-full" type="button" onclick="validateForm()" >Generate QR Code</button></center>
            </form>
        </div>
    </div>
</div>
    <div id="confirmModal" class="w-1/2">
        <div id="confirmation">
            <h3><strong>Confirm Submission?</strong></h3>
            <p id="previewText"></p>
            <button onclick="submitForm()" class="hover:bg-red-700 px-4 py-2 font-bold text-white bg-green-600 rounded-full" type="button">Confirm</button>
            <button onclick="closeModal()" class="hover:bg-red-700 px-4 py-2 font-bold text-white bg-red-500 rounded-full" type="button">Cancel</button>
        </div>
    </div>
</x-app-layout>