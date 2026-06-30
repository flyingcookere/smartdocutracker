<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/style.css', 'resources/js/script.js'])
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <style>
        #reader{
            width: 350px;
            height: 350px;
            margin: auto;
            border: 0;
            border-color: none;
            border-radius: 10;
            
        }
         @media screen and (max-width: 350px) {
               #reader{
                width: 300px;
                height: 300px;
                border: 0;
                border-color: none;
               } 
        }

        #reader span{
            display: block;
            transform: translateY(5px); 
            text-align: center;
        }

        #reader button {
            text-align: center;
            padding: 10px 20px;
            background-color:rgba(110, 9, 9); /* Tailwind's blue-600 */
            color: white;
            border-radius: 80px;
            font-size: 16px;
            font-weight: 500;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease;
        }

        #reader button:hover {
            background-color: #cc1010;
            transform: scale(1.05);
        }

        
 
    </style>
</head>
<body>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="dark:text-gray-200 text-xl font-semibold leading-tight text-gray-800">
                {{ __('QR Code Scanner') }}
            </h2>
        </x-slot>
        <div class=" py-12">
            <div class="sm:max-w-xl w-full mx-auto px-4 max-w-[90%]">
            <div class="bg-white/40 dark:bg-white/10 backdrop-blur-2xl shadow-[inset_0_0_5px_rgba(255,255,255,0.4)] overflow-hidden rounded-3xl">
                <div class="dark:text-gray-100 flex flex-col items-center p-[100px] text-gray-900">
                    <center>
                    <div id="reader" class="bg-white/10 dark:bg-transparent text-crimson dark:text-gray-200 p-4 font-semibold bg-white rounded"></div>
                        <div class="result mt-30"></div>
                    </div>
                    </center>
                </div> 
            </div>
      

        <script>
            const scanner = new Html5QrcodeScanner('reader', { 
                // Scanner will be initialized in DOM inside element with id of 'reader'
                qrbox: {
                    width: 250,
                    height: 250,
                },  // Sets dimensions of scanning box (set relative to reader element width)
                fps: 20, // Frames per second to attempt a scan
            });
            scanner.render(success, error);
            function success(qrCodeMessage, decodedImage) {
                // Handle the scanned QR code message
                console.log("QR Code scanned: ", qrCodeMessage);
                // You can also display the result in the result div
                document.location.href = qrCodeMessage;
            } 
            function error(errorMessage) {
                // Handle scan error
                console.error("QR Code scan error: ", errorMessage);
            }
        </script>
    </x-app-layout>
     
</body>
</html>