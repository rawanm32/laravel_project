<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{config('app.name')}}</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom styles for the Qr Code container to ensure centering and correct display */
        .qr-code-container svg {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 100%;
            height: auto;
            max-width: 250px; /* Limit Qr Code size */
        }
        /* Using Inter font as default, which is Tailwind standard */
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center bg-gray-100 p-4">
    <!-- Equivalent of .login-box -->
    <div class="w-full max-w-sm">
        <!-- Equivalent of .card .card-outline .card-primary -->
        <div class="bg-white shadow-xl rounded-xl border-t-4 border-blue-600 overflow-hidden">
            
            <div class="p-6 text-center border-b border-gray-200">
                <h1 class="text-2xl font-bold text-gray-800">{{config('app.name')}}</h1>
            </div>
            
            <div class="p-6">
                <!-- Equivalent of .login-box-msg -->
                <p class="text-center text-lg font-semibold text-gray-700 mb-6">Two Factor Authentication</p>
                
                @if ($errors->any())
                    <!-- Equivalent of .alert .alert-danger -->
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 text-sm" role="alert">
                        <ul class="list-disc pr-4 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form action=" {{route('two-factor.enable')}}" method="post">
                    @csrf

                    <div class="flex flex-col space-y-4">
                        @if (!$user->two_factor_secret)

                            <!-- Enable Button -->
                            <div class="w-full">
                                <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition duration-150 shadow-md">
                                    Enable
                                </button>
                            </div>

                            @if (session('status') == 'two-factor-authentication-enabled')
                            <div class="text-sm text-center text-green-600 bg-green-50 p-3 rounded-lg border border-green-300">
                                Please finish configuring two factor authentication below.
                            </div>
                            @endif

                        @else
                            <div class="mb-4 text-center">
                                <p class="text-gray-600 mb-3 font-medium">Scan the QR code with your Authenticator app:</p>
                                <!-- Qr Code SVG - Unchanged Laravel Directive -->
                                <div class="qr-code-container p-4 border rounded-lg bg-white inline-block">
                                    {!!$user->twoFactorQrCodeSvg()!!}
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <p class="text-gray-600 mb-2 font-medium">Recovery Codes (Save these!):</p>
                                <ul class="grid grid-cols-2 gap-2 text-sm text-gray-800 bg-gray-50 p-3 rounded-lg border">
                                    @foreach ($user->recoveryCodes() as $code)
                                        <li class="font-mono bg-white p-1 rounded text-center">{{ $code }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            
                            <!-- Disable Button Form Setup -->
                            @method('DELETE')
                            <div class="w-full">
                                <button type="submit" class="w-full px-4 py-2 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition duration-150 shadow-md">
                                    Disable
                                </button>
                            </div>
                        @endif

                        <!-- Home Button -->
                        <div class="w-full pt-2">
                            <a href=" {{route('home')}} " class="w-full block text-center px-4 py-2 bg-gray-200 text-gray-800 font-semibold rounded-lg hover:bg-gray-300 transition duration-150">
                                Home
                            </a>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</body>

</html>