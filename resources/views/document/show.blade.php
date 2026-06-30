<!-- <style>
    #detail_container{
        padding: 20px;
        margin: 20px auto;
        width: 80%;
        display: flex;
        gap: 20%;
    }
</style> -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="dark:text-gray-200 text-xl font-semibold leading-tight text-gray-800">
            {{ __('Document Details') }}
        </h2>
    </x-slot>
    
    <div class="bg-white/40 dark:bg-white/10 dark:text-gray-200 backdrop-blur-2xl shadow-[inset_0_0_5px_rgba(255,255,255,0.4)] flex flex-col max-w-3xl py-4 rounded-xl" id="detail_container">
        <div>
        <a href="{{ route('dashboard') }}" class="w3-large inline-block"><i class="fa fa-home w3-large"></i></a>
        </div>
        <div class="sm:flex-row flex flex-col items-center justify-center gap-8">
            <div class="m-4">
                <p><strong>Document Title:</strong> {{ $document->title }}</p>
                <p><strong>Created By:</strong> {{ $document->sender }}</p>
                <p><strong>Email:</strong> {{ $document->sender_email }}</p>
                <p><strong>Department:</strong> {{ $document->sender_dept }}</p>
                <p><strong>Receiving Department:</strong> {{ $document->recipient_dept }}</p>
                <p><strong>Communication:</strong> {{ $document->communication }}</p>
                <p><strong>Generation Date:</strong> {{ $document->created_at }}</p>
            </div>
            <div>
                @if($qrCodeDataURI)
                <h3><strong>Download This QR CODE:</strong></h3>
                    <img src="{{ $qrCodeDataURI }}" alt="qr code" width="200">
                    <br>
                    <label for="uuid"><strong>DOCUMENT UUID:</strong></label>
                    <p id="uuid"><strong>{{ $document->uuid }}</strong></p>
                    <button onclick="copyUUID()" class="hover:bg-green-600 px-4 py-2 font-bold text-white bg-green-700 rounded-full">COPY UUID</button>
                    <a href="{{ $qrCodeDataURI}}" download="{{$document->uuid}}.png">
                        <button class="hover:bg-red-600 bg-crimson px-4 py-2 font-bold text-white rounded-full">DOWNLOAD</button>
                    </a>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>