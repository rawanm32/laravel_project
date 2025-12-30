<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <title>@yield('title', __('Paradise'))</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&family=Tajawal:wght@400;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- AOS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        :root {
            --color-primary: #8a41a3; 
            --color-secondary: #fef3c7; 
        }

        body {
            font-family: 'Tajawal', sans-serif;
            background: linear-gradient(135deg, #e0b0ff 0%, #ADD8E6 100%);
            min-height: 100vh;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Cairo', sans-serif;
        }

        .cart-icon {
            position: relative;
            width: 50px;
            height: 50px;
            background: #007bff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
            transition: all 0.3s ease;
        }

        .cart-icon:hover {
            background: #0056b3;
            transform: scale(1.05);
        }

        .cart-badge {
            position: absolute;
            top: -5px;
            left: -5px;
            background: #dc3545;
            color: white;
            border-radius: 50%;
            width: 24px;
            height: 24px;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid white;
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="text-2xl font-bold text-purple-600">
                {{__('Paradise')}}
                </a>
                 <div class="p-3" style="max-width: 200px;">
    <select class="form-select form-select-sm" onchange="window.location.href=this.value">
        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            <option value="{{ LaravelLocalization::getLocalizedURL($localeCode) }}" 
                    @selected($localeCode == App::currentLocale())>
                {{ $properties['native'] }}
            </option>
        @endforeach
    </select>
</div>

                <!-- Cart Icon - SIMPLIFIED -->
                <div class="relative">
                    <a href="{{ route('cart.index') }}" class="cart-icon">
                        <i class="fas fa-shopping-cart"></i>
                    
                    </a>
                </div>

                <!-- Navigation -->
                <nav class="hidden md:flex items-center space-x-6 space-x-reverse">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-purple-600 font-medium">
                        {{__('home')}}
                    </a>
                    <a href="#" class="text-gray-700 hover:text-purple-600 font-medium">
                        {{__('Books')}}
                    </a>
                    
                    @auth
                    <div class="relative group">
                        <button class="flex items-center text-gray-700">
                            {{ Auth::user()->name }}
                            <i class="fas fa-chevron-down mr-2 text-sm"></i>
                        </button>
                        <div class="absolute hidden group-hover:block bg-white shadow-lg rounded-lg mt-2 w-48 z-10">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-right px-4 py-2 text-red-600 hover:bg-red-50">
                                   {{__('logout')}}
                                </button>
                            </form>
                        <a href="{{route('front.2fa')}}">
                                <button type="submit" class="block w-full text-right px-4 py-2 text-red-600 hover:bg-red-50">
                                   {{__('2fa')}}
                                </button>
                        </a>
                        </div>
                    </div>
                    @else
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-purple-600 font-medium">
                     {{__('login')}}
                    </a>
                    <a href="{{ route('register') }}" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700">
                      {{__('register')}}
                    </a>
                    @endauth
                    
                </nav>

                <!-- Mobile Menu Button -->
                <button class="md:hidden text-purple-600" onclick="toggleMobileMenu()">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div id="mobileMenu" class="hidden md:hidden mt-4">
                <div class="flex flex-col space-y-3">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-purple-600 py-2">
                        {{__('home')}}
                    </a>
                    <a href="#" class="text-gray-700 hover:text-purple-600 py-2">
                        {{__('home')}}
                    </a>
                    @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-red-600 hover:text-red-700 py-2 text-right">
                          {{__('logout')}}
                        </button>
                    </form>
                    @else
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-purple-600 py-2">
                      {{__('login')}}
                    </a>
                    <a href="{{ route('register') }}" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 text-center">
                     {{__('register')}}
                    </a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        {{ $slot }}
    </main>

    <!-- Footer -->
<footer class="footer" style="background: #6a11cb; color: white; padding: 30px 0; clear: both;">
    <div class="container">
        <!-- الصف الأول -->
        <div style="display: flex; flex-wrap: wrap; justify-content: space-between; margin-bottom: 30px;">
            <!-- القسم 1 -->
            <div style="width: 25%; min-width: 200px; margin-bottom: 20px;">
           
                <p style="color: rgba(255,255,255,0.8);">
                    منصة إدارة المكتبات الرقمية
                </p>
            </div>
            
            <!-- القسم 2 -->
            <div style="width: 20%; min-width: 150px; margin-bottom: 20px;">
                <h5 style="color: #ffd166;">{{__('Quick Access')}}</h5>
                <div>
                    <a href="{{ route('dashboard.index') }}" style="color: white; display: block; margin: 5px 0;">
                        {{__('Dashboard')}}
                    </a>
                    <a href="{{ route('dashboard.books.index') }}" style="color: white; display: block; margin: 5px 0;">
                        {{__('Books')}}
                    </a>
                    <a href="{{ route('dashboard.authors.index') }}" style="color: white; display: block; margin: 5px 0;">
                        {{__('Authors')}}
                    </a>
                </div>
            </div>
            
            <!-- القسم 3 -->
            <div style="width: 25%; min-width: 150px; margin-bottom: 20px;">
                <h5 style="color: #ffd166;">{{__('Information')}}</h5>
                <div>
                    <a href="#" style="color: white; display: block; margin: 5px 0;">
                        {{__('About Us')}}
                    </a>
                    <a href="#" style="color: white; display: block; margin: 5px 0;">
                        {{__('Contact')}}
                    </a>
                </div>
            </div>
        </div>
        
        <!-- حقوق النشر -->
        <div style="border-top: 1px solid rgba(255,255,255,0.2); padding-top: 20px; text-align: center;">
            <div style="color: rgba(255,255,255,0.8);">
                © <script>document.write(new Date().getFullYear())</script> 
                {{__('Paradise Dashboard')}} - 
                {{__('Developed by')}} روان وبتول | Rawaan & Batool
            </div>
        </div>
    </div>
</footer>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- AOS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
        
        function toggleMobileMenu() {
            document.getElementById('mobileMenu').classList.toggle('hidden');
        }
    </script>
</body>
</html>