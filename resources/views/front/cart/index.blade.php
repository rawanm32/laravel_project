<x-front-layout title="سلة التسوق - Purple Bookstore">
    
    <!-- Header with Gradient Background -->
    <div class="relative bg-gradient-to-r from-purple-900 via-purple-800 to-purple-700 rounded-b-3xl shadow-2xl overflow-hidden">
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-black opacity-20"></div>
            <div class="absolute top-0 left-0 w-64 h-64 bg-white opacity-10 rounded-full -translate-x-32 -translate-y-32"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-white opacity-10 rounded-full translate-x-48 translate-y-48"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-full h-full bg-gradient-to-r from-purple-500/10 to-pink-500/10 blur-3xl"></div>
        </div>
        
        <div class="relative z-10 px-8 py-16">
            <div class="container mx-auto">
                <div class="text-center">
                    <h1 class="text-5xl md:text-6xl font-black text-white mb-6 leading-tight drop-shadow-2xl">
                        <i class="fas fa-shopping-bag ml-3"></i>
                        {{ _('Cart Items') }}
                    </h1>
                 
                    <div class="flex flex-wrap justify-center gap-4">
                        <div class="bg-white/20 backdrop-blur-sm px-6 py-3 rounded-full">
                            <span class="text-white font-bold">{{ $cartItems->count() ?? 0 }} {{ __('Books') }}</span>
                        </div>
                        <div class="bg-white/20 backdrop-blur-sm px-6 py-3 rounded-full">
                            <span class="text-white font-bold">${{ number_format($total, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Cart Section -->
    <section class="py-16 bg-gradient-to-b from-purple-50 to-white">
        <div class="container mx-auto px-4">
            @if($cartItems->isEmpty())
                <!-- Empty Cart State -->
                <div class="max-w-2xl mx-auto text-center">
                    <div class="relative mb-10">
                        <div class="w-48 h-48 mx-auto bg-gradient-to-br from-purple-100 to-pink-100 rounded-full flex items-center justify-center shadow-2xl">
                            <i class="fas fa-shopping-cart text-purple-500 text-7xl"></i>
                        </div>
                        <div class="absolute -bottom-3 left-1/2 transform -translate-x-1/2">
                            <div class="bg-white px-8 py-3 rounded-full shadow-xl border border-purple-200">
                                <span class="text-purple-700 font-bold"> {{ __('No Items') }}</span>
                            </div>
                        </div>
                    </div>
                    
                 
                   
                    
                    <div class="flex flex-col sm:flex-row gap-6 justify-center">
                        <a href="{{ route('home') }}" 
                           class="group bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white px-10 py-4 rounded-xl font-bold text-lg transition-all duration-300 hover:shadow-2xl transform hover:scale-105 inline-flex items-center justify-center">
                            <i class="fas fa-book-open ml-3 group-hover:rotate-12 transition-transform"></i>
                         {{__('Show')}} {{ __('Books') }}
                        </a>
                        <a href="{{ route('cart.index') }}" 
                           class="group bg-white hover:bg-gray-50 text-purple-700 border-2 border-purple-300 hover:border-purple-400 px-10 py-4 rounded-xl font-bold text-lg transition-all duration-300 hover:shadow-xl transform hover:scale-105 inline-flex items-center justify-center">
                            <i class="fas fa-star ml-3 group-hover:animate-pulse"></i>
                        
                        </a>
                    </div>
                </div>
            @else
                <!-- Cart with Items -->
                <div class="flex flex-col lg:flex-row gap-8">
                    <!-- Left Column - Cart Items -->
                    <div class="lg:w-2/3">
                        <!-- Cart Header -->
                        <div class="bg-gradient-to-r from-purple-600 to-purple-700 rounded-2xl shadow-2xl p-6 mb-8">
                            <div class="flex flex-col md:flex-row justify-between items-center">
                                <div class="flex items-center mb-4 md:mb-0">
                                    <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center ml-3">
                                        <i class="fas fa-shopping-cart text-white text-xl"></i>
                                    </div>
                                    <div>
                                        <h2 class="text-2xl font-black text-white"> {{ __('Cart Items') }}</h2>
                             
                                    </div>
                                </div>
                                <div class="flex items-center gap-4">
                                    <span class="text-white font-bold">{{ __('Totally Books') }} : {{ $cartItems->count() }}</span>
                                    <form action="{{ route('cart.clear') }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                onclick="return confirm('هل تريد تفريغ السلة بالكامل؟')"
                                                class="bg-white/20 hover:bg-white/30 backdrop-blur-sm text-white px-5 py-2 rounded-lg font-semibold text-sm transition duration-300 hover:shadow-lg flex items-center">
                                            <i class="fas fa-trash ml-2"></i>
                                             {{ __('Delete All') }}  
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Cart Items Table -->
                        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-purple-200">
                            <!-- Desktop Table -->
                            <div class="hidden md:block">
                                <table class="w-full">
                                    <thead>
                                        <tr class="bg-gradient-to-r from-purple-50 to-purple-100">
                                            <th class="py-5 px-6 text-right text-purple-800 font-bold text-lg border-b border-purple-200">
                                                <i class="fas fa-book ml-2"></i> {{ __('The Book') }}
                                            </th>
                                            <th class="py-5 px-6 text-center text-purple-800 font-bold text-lg border-b border-purple-200">
                                                <i class="fas fa-tag ml-2"></i> {{ __('Price') }}
                                            </th>
                                            <th class="py-5 px-6 text-center text-purple-800 font-bold text-lg border-b border-purple-200">
                                                <i class="fas fa-hashtag ml-2"></i> {{ __('Quantity') }}
                                            </th>
                                            <th class="py-5 px-6 text-center text-purple-800 font-bold text-lg border-b border-purple-200">
                                                <i class="fas fa-calculator ml-2"></i> {{ __('Total') }}
                                            </th>
                                            <th class="py-5 px-6 text-center text-purple-800 font-bold text-lg border-b border-purple-200">
                                                <i class="fas fa-cog ml-2"></i> {{ __('Actions') }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($cartItems as $item)
                                        <tr class="hover:bg-purple-50 transition duration-300 {{ !$loop->last ? 'border-b border-purple-100' : '' }}">
                                            <!-- Product Info -->
                                            <td class="py-6 px-6">
                                                <div class="flex items-center">
                                                    <div class="w-20 h-20 bg-gradient-to-br from-purple-100 to-pink-100 rounded-xl overflow-hidden flex-shrink-0 ml-4 shadow-lg">
                                                        @if($item->book && $item->book->image)
                                                            <img src="{{ asset('storage/' . $item->book->image) }}" 
                                                                 alt="{{ $item->book->name ?? 'كتاب' }}"
                                                                 class="w-full h-full object-cover">
                                                        @else
                                                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-purple-200 to-pink-200">
                                                                <i class="fas fa-book text-purple-500 text-2xl"></i>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="flex-1">
                                                        <h3 class="text-lg font-bold text-gray-800 mb-2">
                                                            <a href="{{ $item->book ? route('books.show', $item->book) : '#' }}" 
                                                               class="hover:text-purple-600 transition duration-300">
                                                                {{ $item->book->title ?? 'كتاب محذوف' }}
                                                            </a>
                                                        </h3>
                                                        @if($item->book && $item->book->author)
                                                            <p class="text-gray-600 text-sm mb-1">
                                                                <i class="fas fa-user-edit ml-2 text-purple-500"></i>
                                                                {{ $item->book->author->name }}
                                                            </p>
                                                        @endif
                                                        @if($item->book && $item->book->category)
                                                            <p class="text-gray-500 text-sm">
                                                                <i class="fas fa-tag ml-2 text-purple-500"></i>
                                                                {{ $item->book->category->name }}
                                                            </p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            
                                            <!-- Price -->
                                            <td class="py-6 px-6 text-center">
                                                <div class="text-2xl font-bold text-purple-600 mb-1">
                                                    ${{ number_format($item->book->price ?? 0, 2) }}
                                                </div>
                                                @if($item->book && $item->book->compare_price)
                                                    <div class="text-sm text-gray-500 line-through">
                                                        ${{ number_format($item->book->compare_price, 2) }}
                                                    </div>
                                                @endif
                                            </td>
                                            
                                            <!-- Quantity -->
                                            <td class="py-6 px-6 text-center">
                                                <form action="{{ route('cart.update', $item->id) }}" method="POST" 
                                                      class="inline-flex items-center bg-gradient-to-r from-purple-50 to-white border-2 border-purple-200 rounded-xl overflow-hidden shadow-inner">
                                                    @csrf
                                                    <button type="button" 
                                                            onclick="this.parentNode.querySelector('input[type=number]').stepDown()"
                                                            class="px-4 py-3 bg-purple-100 hover:bg-purple-200 text-purple-700 font-bold transition duration-300">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                    <input type="number" 
                                                           name="quantity" 
                                                           value="{{ $item->quantity }}" 
                                                           min="1" 
                                                           max="99"
                                                           class="w-16 text-center text-xl font-bold py-3 border-0 bg-white focus:ring-0 focus:outline-none text-purple-700"
                                                           onchange="this.form.submit()">
                                                    <button type="button" 
                                                            onclick="this.parentNode.querySelector('input[type=number]').stepUp()"
                                                            class="px-4 py-3 bg-purple-100 hover:bg-purple-200 text-purple-700 font-bold transition duration-300">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </form>
                                            </td>
                                            
                                            <!-- Total -->
                                            <td class="py-6 px-6 text-center">
                                                <div class="text-2xl font-bold text-emerald-600">
                                                    ${{ number_format($item->quantity * ($item->book->price ?? 0), 2) }}
                                                </div>
                                            </td>
                                            
                                            <!-- Actions -->
                                            <td class="py-6 px-6 text-center">
                                                <form action="{{ route('cart.destroy', $item->id) }}" method="POST" 
                                                      onsubmit="return confirm('هل تريد حذف هذا المنتج من السلة؟')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="bg-gradient-to-r from-red-500 to-pink-600 hover:from-red-600 hover:to-pink-700 text-white px-5 py-3 rounded-xl font-semibold transition duration-300 hover:shadow-lg transform hover:scale-105">
                                                        <i class="fas fa-trash ml-2"></i>
                                                        حذف
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Mobile Cards -->
                            <div class="md:hidden">
                                @foreach($cartItems as $item)
                                <div class="border-b border-purple-100 p-6">
                                    <div class="flex items-start mb-4">
                                        <div class="w-24 h-24 bg-gradient-to-br from-purple-100 to-pink-100 rounded-xl overflow-hidden flex-shrink-0 ml-4 shadow-lg">
                                            @if($item->book && $item->book->image)
                                                <img src="{{ asset('storage/' . $item->book->image) }}" 
                                                     alt="{{ $item->book->name ?? 'كتاب' }}"
                                                     class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-purple-200 to-pink-200">
                                                    <i class="fas fa-book text-purple-500 text-2xl"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex-1">
                                            <h3 class="text-lg font-bold text-gray-800 mb-2">
                                                {{ $item->book->name ?? 'كتاب محذوف' }}
                                            </h3>
                                            <div class="text-2xl font-bold text-purple-600 mb-3">
                                                ${{ number_format($item->book->price ?? 0, 2) }}
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="grid grid-cols-2 gap-4 mb-4">
                                        <div>
                                            <label class="block text-gray-600 text-sm mb-2">{{ __('Quantity') }}:</label>
                                            <form action="{{ route('cart.update', $item->id) }}" method="POST" 
                                                  class="flex items-center bg-gradient-to-r from-purple-50 to-white border-2 border-purple-200 rounded-xl overflow-hidden">
                                                @csrf
                                                <button type="button" 
                                                        onclick="this.parentNode.querySelector('input[type=number]').stepDown()"
                                                        class="px-3 py-2 bg-purple-100 text-purple-700 font-bold">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <input type="number" 
                                                       name="quantity" 
                                                       value="{{ $item->quantity }}" 
                                                       min="1" 
                                                       max="99"
                                                       class="flex-1 text-center font-bold py-2 border-0 bg-white focus:ring-0 focus:outline-none text-purple-700"
                                                       onchange="this.form.submit()">
                                                <button type="button" 
                                                        onclick="this.parentNode.querySelector('input[type=number]').stepUp()"
                                                        class="px-3 py-2 bg-purple-100 text-purple-700 font-bold">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </form>
                                        </div>
                                        <div>
                                            <label class="block text-gray-600 text-sm mb-2">{{ __('Total') }}:</label>
                                            <div class="text-2xl font-bold text-emerald-600">
                                                ${{ number_format($item->quantity * ($item->book->price ?? 0), 2) }}
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="flex gap-3">
                                        <a href="{{ $item->book ? route('books.show', $item->book) : '#' }}" 
                                           class="flex-1 bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white px-4 py-3 rounded-xl font-semibold text-center transition duration-300">
                                            <i class="fas fa-eye ml-2"></i> {{ __('Show') }}
                                        </a>
                                        <form action="{{ route('cart.destroy', $item->id) }}" method="POST" 
                                              class="flex-1"
                                              onsubmit="return confirm('هل تريد حذف هذا المنتج من السلة؟')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="w-full bg-gradient-to-r from-red-500 to-pink-600 hover:from-red-600 hover:to-pink-700 text-white px-4 py-3 rounded-xl font-semibold transition duration-300">
                                                <i class="fas fa-trash ml-2"></i> {{ __('Delete') }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Continue Shopping -->
                        <div class="mt-8">
                            <a href="{{ route('home') }}" 
                               class="group inline-flex items-center bg-white hover:bg-gray-50 text-purple-700 border-2 border-purple-300 hover:border-purple-400 px-8 py-4 rounded-xl font-bold text-lg transition-all duration-300 hover:shadow-xl transform hover:scale-105">
                                <i class="fas fa-arrow-left ml-3 group-hover:-translate-x-1 transition-transform"></i>
                                {{ __('Continue Shopping') }}
                                <i class="fas fa-book-open mr-3 opacity-70"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Right Column - Order Summary -->
                    <div class="lg:w-1/3">
                        <div class="bg-gradient-to-br from-white to-purple-50 rounded-2xl shadow-2xl border border-purple-200 sticky top-8">
                            <!-- Header -->
                            <div class="bg-gradient-to-r from-purple-600 to-purple-700 rounded-t-2xl p-6">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-xl flex items-center justify-center ml-3">
                                        <i class="fas fa-receipt text-white text-xl"></i>
                                    </div>
                                    <div>
                                        <h2 class="text-2xl font-black text-white">{{ __('Order Summary') }}</h2>
                                       
                                    </div>
                                </div>
                            </div>

                            <!-- Summary Content -->
                            <div class="p-6">
                                <!-- Order Items -->
                                <div class="mb-6 max-h-80 overflow-y-auto pr-2">
                                    @foreach($cartItems as $item)
                                    <div class="flex items-center justify-between mb-4 pb-4 border-b border-purple-100 last:border-0">
                                        <div class="flex items-center">
                                            <div class="w-12 h-12 bg-gradient-to-br from-purple-100 to-pink-100 rounded-lg overflow-hidden ml-3">
                                                @if($item->book && $item->book->image)
                                                    <img src="{{ asset('storage/' . $item->book->image) }}" 
                                                         alt="{{ $item->book->name ?? 'كتاب' }}"
                                                         class="w-full h-full object-cover">
                                                @else
                                                    <div class="w-full h-full flex items-center justify-center">
                                                        <i class="fas fa-book text-purple-500"></i>
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                <h4 class="font-bold text-gray-800 text-sm">{{ $item->book->title ?? 'كتاب محذوف' }}</h4>
                                                <p class="text-gray-600 text-xs">
                                                    {{ $item->quantity }} × ${{ number_format($item->book->price ?? 0, 2) }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="text-emerald-600 font-bold">
                                            ${{ number_format($item->quantity * ($item->book->price ?? 0), 2) }}
                                        </div>
                                    </div>
                                    @endforeach
                                </div>

                                <!-- Totals -->
                                <div class="space-y-4 mb-6">
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-700 font-semibold">{{ __('Subtotal') }}:</span>
                                        <span class="text-2xl font-bold text-purple-700">${{ number_format($total, 2) }}</span>
                                    </div>
                                    
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-700 font-semibold">{{ __('Shipping') }}:</span>
                                        <span class="text-xl font-bold text-emerald-600">{{ __('Free') }}</span>
                                    </div>
                                    
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-700 font-semibold">{{ __('Tax') }}:</span>
                                        <span class="text-xl font-bold text-gray-600">$0.00</span>
                                    </div>
                                    
                                    <div class="border-t border-purple-200 pt-4">
                                        <div class="flex justify-between items-center">
                                            <span class="text-xl font-bold text-gray-800">{{ __('Total') }}:</span>
                                            <span class="text-3xl font-black text-purple-800">${{ number_format($total, 2) }}</span>
                                        </div>
                                        
                                    </div>
                                </div>

                                <!-- Checkout Button -->
                                <a href="{{ route('cart.checkout') }}" 
                                   class="group w-full bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 text-white px-8 py-5 rounded-xl font-black text-xl shadow-xl hover:shadow-2xl transform hover:scale-[1.02] transition-all duration-300 flex items-center justify-center">
                                    <i class="fas fa-credit-card text-2xl ml-3 group-hover:animate-pulse"></i>
                                {{__('Done')}}
                                    <i class="fas fa-arrow-left mr-auto text-white/70"></i>
                                </a>

                                <!-- Security Badge -->
                                <div class="mt-6 p-4 bg-gradient-to-r from-emerald-50 to-green-50 rounded-xl border border-emerald-200">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center ml-3">
                                            <i class="fas fa-shield-alt text-emerald-600"></i>
                                        </div>
                                        <div>
                                          
                                            <p class="text-emerald-700 text-xs"> {{ __('Your personal information is protected with the highest security standards') }} </p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Payment Methods -->
                                <div class="mt-6">
                                    <h4 class="text-gray-700 font-bold mb-3">{{ __('Payment Methods') }}:</h4>
                                    <div class="flex justify-center gap-4">
                                        <div class="w-12 h-8 bg-gray-100 rounded flex items-center justify-center">
                                            <i class="fab fa-cc-visa text-blue-600 text-xl"></i>
                                        </div>
                                        <div class="w-12 h-8 bg-gray-100 rounded flex items-center justify-center">
                                            <i class="fab fa-cc-mastercard text-red-600 text-xl"></i>
                                        </div>
                                        <div class="w-12 h-8 bg-gray-100 rounded flex items-center justify-center">
                                            <i class="fab fa-cc-paypal text-blue-500 text-xl"></i>
                                        </div>
                                        <div class="w-12 h-8 bg-gray-100 rounded flex items-center justify-center">
                                            <i class="fas fa-money-bill-wave text-green-600 text-xl"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- JavaScript for Quantity Updates -->
    <script>
        // Auto-submit form when quantity changes
        document.querySelectorAll('input[type="number"]').forEach(input => {
            input.addEventListener('change', function() {
                if (this.value >= 1 && this.value <= 99) {
                    this.form.submit();
                }
            });
        });

        // Prevent form submission on enter in quantity input
        document.querySelectorAll('input[name="quantity"]').forEach(input => {
            input.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                }
            });
        });

        // Add animation to delete buttons
        document.querySelectorAll('form[action*="destroy"] button').forEach(button => {
            button.addEventListener('mouseover', function() {
                this.style.transform = 'scale(1.1)';
            });
            button.addEventListener('mouseout', function() {
                this.style.transform = 'scale(1)';
            });
        });

        // Update totals if needed (for future AJAX updates)
        function updateCartTotals() {
            // يمكن إضافة AJAX هنا لتحديث السلة بدون إعادة تحميل الصفحة
            console.log('Cart updated');
        }
    </script>

    <!-- Custom Styles -->
    <style>
        @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');
        
        /* Custom Scrollbar */
        .max-h-80::-webkit-scrollbar {
            width: 6px;
        }
        
        .max-h-80::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        
        .max-h-80::-webkit-scrollbar-thumb {
            background: linear-gradient(to bottom, #8b5cf6, #7c3aed);
            border-radius: 10px;
        }
        
        /* Remove number input arrows */
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        
        input[type="number"] {
            -moz-appearance: textfield;
        }
        
        /* Smooth transitions */
        * {
            transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        /* Hover effects for table rows */
        tr:hover {
            background: linear-gradient(to right, rgba(139, 92, 246, 0.05), rgba(124, 58, 237, 0.05));
        }
    </style>

</x-front-layout>