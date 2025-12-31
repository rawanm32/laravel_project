<x-front-layout title="{{ $book->title }}">

    <!-- Header with Gradient Background -->
    <div class="relative bg-gradient-to-r from-purple-600 via-purple-500 to-indigo-600 rounded-2xl shadow-2xl overflow-hidden mb-10">
        <!-- Decorative Elements -->
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-black opacity-10"></div>
            <div class="absolute top-0 left-0 w-64 h-64 bg-white opacity-5 rounded-full -translate-x-32 -translate-y-32"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-white opacity-5 rounded-full translate-x-48 translate-y-48"></div>
        </div>
        
        <div class="relative z-10 px-8 py-12">
            <div class="flex flex-col lg:flex-row items-center justify-between">
                <div class="lg:w-2/3 mb-8 lg:mb-0">
                    <!-- Book Title -->
                    <h1 class="text-4xl md:text-5xl font-black text-white mb-4 leading-tight drop-shadow-lg">
                        {{ $book->title ?: 'لايوجد عنوان' }}
                    </h1>
                    
                    <!-- Book Meta Info -->
                    <div class="flex flex-wrap items-center gap-4 text-white/90">
                        <div class="flex items-center bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full">
                            <i class="fas fa-user-edit ml-2"></i>
                            <span class="font-semibold">{{ $book->author->name ?: 'لايوجد مؤلف' }}</span>
                        </div>
                        <div class="flex items-center bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full">
                            <i class="fas fa-tag ml-2"></i>
                            <span class="font-semibold">{{ $book->category->name ?: 'لايوجد تصنيف' }}</span>
                        </div>
                        <div class="flex items-center bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full">
                            <i class="fas fa-file-alt ml-2"></i>
                            <span class="font-semibold">{{ $book->pages ?: '0' }} {{ __('pages') }}</span>
                        </div>
                    </div>
                </div>
                
                <!-- Home Button -->
                <a href="{{ route('home') }}" 
                   class="group bg-white/20 hover:bg-white/30 backdrop-blur-sm border-2 border-white/40 text-white px-8 py-4 rounded-xl font-bold text-lg transition-all duration-300 hover:scale-105 hover:shadow-2xl transform flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-2 group-hover:rotate-12 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                     {{ __('home') }}
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex flex-col lg:flex-row gap-8 mb-12">
        
        <!-- Left Column - Book Cover & Download -->
        <div class="lg:w-2/5">
            
            <!-- Book Cover with Glow Effect -->
            <div class="relative group mb-8">
                <div class="absolute -inset-4 bg-gradient-to-r from-purple-500 to-pink-500 rounded-3xl blur-xl opacity-30 group-hover:opacity-50 transition duration-500"></div>
                <img src="{{ Storage::url($book->image) }}" 
                     alt="غلاف الكتاب: {{ $book->title }}" 
                     onerror="this.onerror=null; this.src='https://placehold.co/600x800/7C3AED/FFFFFF?text=Book+Cover';"
                     class="relative w-full h-auto rounded-2xl shadow-2xl transform group-hover:scale-[1.02] transition duration-500 ease-out z-10">
                
                <!-- Floating Badge -->
               
            </div>
            
            <!-- Download Section - PROMINENT -->
            @if($book->book_url)
            <div class="relative overflow-hidden rounded-2xl shadow-2xl mb-8">
                <!-- Animated Background -->
                <div class="absolute inset-0 bg-gradient-to-r from-emerald-500 via-green-500 to-teal-600">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                    <div class="absolute top-0 left-0 w-32 h-32 bg-white/10 rounded-full -translate-x-16 -translate-y-16"></div>
                    <div class="absolute bottom-0 right-0 w-40 h-40 bg-white/10 rounded-full translate-x-20 translate-y-20"></div>
                </div>
                
                <!-- Content -->
                <div class="relative z-10 p-8 text-center">
                    <!-- Icon -->
                    <div class="mb-6">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-white/20 backdrop-blur-sm rounded-full border-4 border-white/30">
                            <i class="fas fa-download text-white text-3xl"></i>
                        </div>
                    </div>
       
                    <!-- Download Button -->
                    <a href="{{ $book->book_url }}" 
                       target="_blank"
                       onclick="trackDownload({{ $book->id }})"
                       class="inline-flex items-center justify-center w-full bg-white hover:bg-gray-100 text-emerald-700 hover:text-emerald-800 px-8 py-5 rounded-xl font-black text-xl shadow-lg hover:shadow-2xl transform hover:scale-[1.02] transition-all duration-300 group">
                        <i class="fas fa-cloud-download-alt text-2xl ml-3 group-hover:animate-bounce"></i>
                        <span class="flex-1">⬇{{ __('download') }}</span>
                        <i class="fas fa-external-link-alt text-lg opacity-70"></i>
                    </a>
                    
                    <!-- Stats -->
                    <div class="mt-6 pt-6 border-t border-white/20">
                        <div class="grid grid-cols-3 gap-4">
                            
                            <div class="text-center">
                                <div class="text-white font-black text-2xl">{{ $book->pages ?: '0' }}</div>
                                <div class="text-white/70 text-sm">{{__('pages')}}</div>
                            </div>
                            <div class="text-center">
                                <div class="text-white font-black text-2xl">{{ $book->price ?: '0' }}</div>
                                <div class="text-white/70 text-sm">{{__('price')}}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            
            <!-- Quick Actions -->
            <div class="bg-gradient-to-br from-gray-50 to-white rounded-2xl shadow-xl p-6 border border-gray-200">
                <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-bolt text-yellow-500 ml-2"></i>
                   {{__('Actions')}}
                </h3>
                <div class="space-y-3">
               
                    <button class="w-full bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white px-4 py-3 rounded-lg font-semibold flex items-center justify-center transition duration-300 hover:shadow-lg">
                        <i class="fas fa-share-alt mr-2"></i>
                       {{__('share')}}
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Right Column - Book Details -->
        <div class="lg:w-3/5">
            
            <!-- Book Description -->
            <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-xl p-8 mb-8 border border-gray-200">
                <div class="flex items-center mb-6">
                    <div class="w-12 h-12 bg-gradient-to-r from-purple-100 to-purple-200 rounded-xl flex items-center justify-center ml-3">
                        <i class="fas fa-book-open text-purple-600 text-xl"></i>
                    </div>
                    <h2 class="text-2xl font-black text-gray-800">{{ __('Description') }}</h2>
                </div>
                <div class="prose prose-lg max-w-none">
                    <p class="text-gray-700 leading-relaxed text-lg bg-gradient-to-r from-gray-50 to-transparent p-6 rounded-xl">
                        {{ $book->description ?: 'لا يوجد وصف متاح حاليًا لهذا الكتاب.' }}
                    </p>
                </div>
            </div>
            
            <!-- Pricing & Cart -->
            <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-xl p-8 mb-8 border border-gray-200">
                <div class="flex items-center mb-8">
                    <div class="w-12 h-12 bg-gradient-to-r from-green-100 to-green-200 rounded-xl flex items-center justify-center ml-3">
                        <i class="fas fa-shopping-cart text-green-600 text-xl"></i>
                    </div>
                    <h2 class="text-2xl font-black text-gray-800">{{ __('Orders') }}</h2>
                </div>
                
                <!-- Pricing -->
                <div class="mb-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gradient-to-r from-gray-100 to-white p-6 rounded-xl border border-gray-300">
                            <div class="text-gray-600 mb-2">{{ __('price') }}</div>
                            <div class="text-4xl font-black text-gray-800">
                                {{ number_format($book->price, 2) }} <span class="text-lg">$</span>
                            </div>
                        </div>
                        <div class="bg-gradient-to-r from-red-100 to-white p-6 rounded-xl border border-gray-300">
                            <div class="text-gray-600 mb-2">ا{{ _('compare price') }}</div>
                            <div class="text-3xl font-black text-gray-500 line-through">
                                {{ number_format($book->compare_price, 2) }} <span class="text-lg">$</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Discount Badge -->
                    @if($book->compare_price && $book->compare_price > $book->price)
                    <div class="mt-6">
                        <div class="inline-flex items-center bg-gradient-to-r from-red-500 to-pink-600 text-white px-6 py-3 rounded-full font-bold shadow-lg">
                            <i class="fas fa-percentage ml-2"></i>
                            {{ __('Discount') }} {{ number_format((($book->compare_price - $book->price) / $book->compare_price) * 100, 0) }}%
                        </div>
                    </div>
                    @endif
                </div>
                
                <!-- Add to Cart Form -->
                <div class="bg-gradient-to-r from-purple-50 to-indigo-50 p-6 rounded-xl border border-purple-200">
         <form id="cartForm" action="{{ route('cart.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                        
                        <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                            <!-- Quantity -->
                            <div class="w-full md:w-1/3">
                                <label class="block text-gray-700 font-bold mb-3">{{ __('Quantity') }}</label>
                                <div class="relative">
                                    <div class="flex items-center bg-white border-2 border-purple-300 rounded-xl overflow-hidden shadow-inner">
                                        <button type="button" onclick="decrementQuantity()" class="px-4 py-3 bg-purple-100 hover:bg-purple-200 text-purple-700 font-bold">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <input type="number" 
                                               name="quantity" 
                                               id="quantity" 
                                               value="1" 
                                               min="1" 
                                               class="flex-1 text-center text-2xl font-bold w-16 py-3 border-0 focus:ring-0 focus:outline-none">
                                        <button type="button" onclick="incrementQuantity()" class="px-4 py-3 bg-purple-100 hover:bg-purple-200 text-purple-700 font-bold">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Add to Cart Button -->
                            <div class="w-full md:w-2/3">
                                <button type="submit" 
                                        class="w-full bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white px-8 py-5 rounded-xl font-black text-xl shadow-xl hover:shadow-2xl transform hover:scale-[1.02] transition-all duration-300 flex items-center justify-center group">
                                    <i class="fas fa-shopping-cart text-2xl ml-3 group-hover:animate-bounce"></i>
                                    <span>{{ __('Add To Cart') }}</span>
                                    <div class="mr-auto">
                                        <span class="text-white/80 text-lg font-normal">
                                            {{ number_format($book->price, 2) }} × <span id="quantityDisplay">1</span> = 
                                            <span class="font-bold" id="totalPrice">{{ number_format($book->price, 2) }}</span> $
                                        </span>
                                    </div>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Additional Details -->
            <div class="bg-gradient-to-br from-white to-gray-50 rounded-2xl shadow-xl p-8 border border-gray-200">
                <h2 class="text-2xl font-black text-gray-800 mb-8 flex items-center">
                    <i class="fas fa-info-circle text-blue-500 ml-2"></i>
                  {{ __('Detailes')}}
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-gradient-to-r from-blue-50 to-white p-5 rounded-xl border border-blue-200">
                        <div class="flex items-center mb-3">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center ml-2">
                                <i class="fas fa-calendar-alt text-blue-600"></i>
                            </div>
                            <div class="text-gray-600"> {{ __('Publication Year') }}</div>
                        </div>
                        <div class="text-2xl font-bold text-gray-800">{{ $book->publication_year ?: __('Not Specified') }}</div>
                    </div>
                    
                    <div class="bg-gradient-to-r from-green-50 to-white p-5 rounded-xl border border-green-200">
                        <div class="flex items-center mb-3">
                            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center ml-2">
                                <i class="fas fa-file-alt text-green-600"></i>
                            </div>
                            <div class="text-gray-600">عد{{ __('pages') }}</div>
                        </div>
                        <div class="text-2xl font-bold text-gray-800">{{ $book->pages ?: '0' }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Related Books -->
    @if($relatedBooks->count() > 0)
    <div class="mt-16">
        <!-- Section Header -->
        <div class="text-center mb-12">
            <div class="inline-flex items-center bg-gradient-to-r from-purple-100 to-pink-100 px-6 py-3 rounded-full mb-4">
                <i class="fas fa-fire text-purple-600 ml-2"></i>
               <h2 class="text-4xl font-black text-gray-800 mb-4">📚 {{ __('Related Books') }}</h2>
            </div>
           
          
        </div>
        
        <!-- Books Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @foreach($relatedBooks as $relatedBook)
            <div class="group">
                <!-- Book Card -->
                <div class="relative bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-200 hover:border-purple-300 transition-all duration-300 hover:shadow-2xl transform hover:-translate-y-2">
                    <!-- Image Container -->
                    <div class="relative overflow-hidden h-64">
                        <img src="{{ Storage::url($relatedBook->image) }}" 
                             alt="{{ $relatedBook->title }}"
                             onerror="this.onerror=null; this.src='https://placehold.co/400x300/7C3AED/FFFFFF?text=Book+Cover';"
                             class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
                        
                        <!-- Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/40 to-transparent opacity-0 group-hover:opacity-100 transition duration-300">
                            <div class="absolute bottom-4 left-4 right-4">
                                <a href="{{ route('books.show', $relatedBook) }}"
                                   class="block w-full bg-white text-purple-700 hover:bg-purple-50 px-4 py-3 rounded-lg font-bold text-center transition duration-300">
                                    {{ __('Details') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Content -->
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2 line-clamp-1">{{ $relatedBook->title }}</h3>
                        <p class="text-gray-600 mb-4 text-sm line-clamp-2">{{ Str::limit($relatedBook->description, 80) }}</p>
                        
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-2xl font-black text-emerald-600">{{ number_format($relatedBook->price, 2) }} $</div>
                                @if($relatedBook->compare_price)
                                <div class="text-sm text-gray-500 line-through">{{ number_format($relatedBook->compare_price, 2) }} $</div>
                                @endif
                            </div>
                            <a href="{{ route('books.show', $relatedBook) }}"
                               class="bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white px-5 py-2 rounded-lg font-semibold text-sm transition duration-300 hover:shadow-lg">
                                <i class="fas fa-eye ml-1"></i> {{ __('Show') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Social Sharing -->
    <div class="mt-16 text-center">
        <div class="bg-gradient-to-r from-gray-50 to-white rounded-2xl shadow-xl p-8 border border-gray-200">
           
            <div class="flex justify-center space-x-4 space-x-reverse">
                <a href="#" class="w-14 h-14 bg-blue-600 hover:bg-blue-700 text-white rounded-full flex items-center justify-center text-xl transform hover:scale-110 transition duration-300 shadow-lg hover:shadow-xl">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="w-14 h-14 bg-blue-400 hover:bg-blue-500 text-white rounded-full flex items-center justify-center text-xl transform hover:scale-110 transition duration-300 shadow-lg hover:shadow-xl">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="#" class="w-14 h-14 bg-green-500 hover:bg-green-600 text-white rounded-full flex items-center justify-center text-xl transform hover:scale-110 transition duration-300 shadow-lg hover:shadow-xl">
                    <i class="fab fa-whatsapp"></i>
                </a>
                <a href="#" class="w-14 h-14 bg-blue-500 hover:bg-blue-600 text-white rounded-full flex items-center justify-center text-xl transform hover:scale-110 transition duration-300 shadow-lg hover:shadow-xl">
                    <i class="fab fa-telegram"></i>
                </a>
                <a href="#" class="w-14 h-14 bg-red-500 hover:bg-red-600 text-white rounded-full flex items-center justify-center text-xl transform hover:scale-110 transition duration-300 shadow-lg hover:shadow-xl">
                    <i class="fab fa-pinterest"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        function incrementQuantity() {
            const input = document.getElementById('quantity');
            input.value = parseInt(input.value) + 1;
            updateTotalPrice();
        }
        
        function decrementQuantity() {
            const input = document.getElementById('quantity');
            if (input.value > 1) {
                input.value = parseInt(input.value) - 1;
                updateTotalPrice();
            }
        }
        
        function updateTotalPrice() {
            const quantity = document.getElementById('quantity').value;
            const price = {{ $book->price }};
            const total = quantity * price;
            
            document.getElementById('quantityDisplay').textContent = quantity;
            document.getElementById('totalPrice').textContent = total.toFixed(2);
        }
        
        function trackDownload(bookId) {
            // يمكنك إضافة تتبع التحميلات هنا
            fetch(`/api/books/${bookId}/track-download`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            });
        }
        
        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            updateTotalPrice();
        });
    </script>

    <!-- Add these styles -->
    <style>
        @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');
        
        .line-clamp-1 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
        }
        
        .line-clamp-2 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }
        
        .shadow-inner {
            box-shadow: inset 0 2px 4px 0 rgba(0, 0, 0, 0.06);
        }
        
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        
        input[type="number"] {
            -moz-appearance: textfield;
        }
    </style>

</x-front-layout>
