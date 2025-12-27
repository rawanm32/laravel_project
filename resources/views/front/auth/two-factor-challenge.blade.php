<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{config('app.name')}} </title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Ensuring Inter font for a modern look */
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
                <!-- Equivalent of .card-header text-center -->
                <h1 class="text-2xl font-bold text-gray-800">{{config('app.name')}}</h1>
            </div>
            
            <div class="p-6">
                <!-- Equivalent of .login-box-msg -->
                <p class="text-center text-lg font-semibold text-gray-700 mb-6">Enter 2fa code</p>
                
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
                
                @if ($errors->has('code'))
                    <!-- Display specific 'code' error message -->
                    <div class="text-red-500 text-sm mb-4">
                        {{ $errors->first('code') }}
                    </div>
                @endif
                
                <form action=" {{route('two-factor.login')}}" method="post">
                    @csrf
                    
                    <!-- Equivalent of .input-group .mb-3 -->
                    <div class="mb-4">
                        <input type="text" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 placeholder-gray-500" 
                               placeholder="2fa code" 
                               name="code" 
                               autocomplete="off">
                    </div>
                    
                    <!-- Equivalent of .input-group .mb-3 -->
                    <div class="mb-6">
                        <input type="text" 
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 placeholder-gray-500" 
                               placeholder="recovery code (Optional)" 
                               name="recovery_code"
                               autocomplete="off">
                    </div>

                    <!-- Equivalent of .row -->
                    <div class="flex justify-end">
                        <!-- Equivalent of .col-4 -->
                        <div>
                            <button type="submit" class="w-full px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition duration-150 shadow-md">
                                Submit
                            </button>
                        </div>
                    </div>
                </form>

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->
</body>

</html>