<x-front-layout>
    <section id="books" class="padding-medium bg-gradient-to-b from-gray-50 to-white">
        <div class="container mx-auto px-4" data-aos="fade-up" dir="rtl">
            
            <!-- Header Section with Glow Effect -->
            <div class="text-center mb-16 relative">
                <!-- Decorative Elements -->
                <div class="absolute top-0 left-1/2 transform -translate-x-1/2 -translate-y-8">
                    <div class="w-32 h-32 bg-purple-500/10 rounded-full blur-3xl"></div>
                </div>
                
                <!-- Main Title -->
                <div class="relative z-10">
                    <h3 class="text-5xl md:text-6xl font-black text-gray-800 tracking-tight mb-6">
                         <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600"> {{__('Our Books List !')}}</span>
                    </h3>
                   
                    <!-- Animated Underline -->
                    <div class="relative inline-block">
                        <div class="h-2 w-24 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full mx-auto mb-2"></div>
                        <div class="h-2 w-16 bg-gradient-to-r from-purple-400 to-pink-400 rounded-full mx-auto animate-pulse"></div>
                    </div>
                    
                    <!-- Subtitle -->
                  
                </div>
            </div>

            <!-- Books Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @foreach ($books as $book)
                <div class="group">
                    <!-- Book Card Container -->
                    <div class="relative bg-white rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-500 border border-gray-200 hover:border-purple-300 transform hover:-translate-y-2">
                        
                        <!-- Image Container with Overlay -->
                        <div class="relative overflow-hidden h-80">
                            <!-- Main Image -->
                            <img src="{{ Storage::url($book->image) }}" 
                                 alt="Book Cover" 
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            
                            <!-- Gradient Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                <!-- Quick Actions -->
                                <div class="absolute bottom-4 left-4 right-4">
                                    <div class="flex gap-2">
                                        <a href="{{ route('books.show', $book) }}" 
                                           class="flex-1 bg-white text-purple-700 hover:bg-purple-50 px-4 py-3 rounded-lg font-bold text-center transition duration-300 transform hover:scale-105">
                                            <i class="fas fa-eye ml-2"></i> {{__('Show')}}
                                        </a>
                                        @if($book->book_url)
                                        <a href="{{ $book->book_url }}" 
                                           target="_blank"
                                           class="flex-1 bg-gradient-to-r from-emerald-500 to-green-600 text-white hover:from-emerald-600 hover:to-green-700 px-4 py-3 rounded-lg font-bold text-center transition duration-300 transform hover:scale-105">
                                            <i class="fas fa-download ml-2"></i> {{__('download')}}
                                        </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Status Badge -->
                           
                            
                            <!-- Hover Description Panel -->
                            <div class="absolute inset-0 bg-gradient-to-br from-purple-900/95 via-purple-800/90 to-pink-900/95 p-6 rounded-2xl opacity-0 group-hover:opacity-100 transition-all duration-500 backdrop-blur-sm overflow-y-auto">
                                <h4 class="text-2xl font-bold text-white mb-6 pb-3 border-b border-purple-500 text-center">
                                    {{ $book->title }}
                                </h4>
                                
                                <div class="space-y-4">
                                    <!-- Description -->
                                    <div class="flex items-start">
                                        <div class="w-10 h-10 bg-purple-700/50 rounded-lg flex items-center justify-center ml-3 flex-shrink-0">
                                            <i class="fas fa-align-left text-purple-300"></i>
                                        </div>
                                        <div>
                                            <div class="text-purple-300 font-semibold mb-1">{{__('Description')}}</div>
                                            <p class="text-white/90 text-sm leading-relaxed line-clamp-4">
                                                {{ $book->description }}
                                            </p>
                                        </div>
                                    </div>
                                    
                                    <!-- Details Grid -->
                                    <div class="grid grid-cols-2 gap-4 mt-6">
                                        <div class="bg-purple-800/40 rounded-xl p-3 text-center">
                                            <div class="text-purple-300 text-sm mb-1">{{_('pages')}}</div>
                                            <div class="text-white font-bold text-xl">{{ $book->pages ?: '0' }}</div>
                                        </div>
                                        <div class="bg-pink-800/40 rounded-xl p-3 text-center">
                                            <div class="text-pink-300 text-sm mb-1">{{__('Author')}}</div>
                                            <div class="text-white font-bold text-lg truncate">{{ $book->author->name }}</div>
                                        </div>
                                        <div class="bg-indigo-800/40 rounded-xl p-3 text-center">
                                            <div class="text-indigo-300 text-sm mb-1">{{__('Category')}}</div>
                                            <div class="text-white font-bold text-lg">{{ $book->category->name }}</div>
                                        </div>
                                        <div class="bg-emerald-800/40 rounded-xl p-3 text-center">
                                            <div class="text-emerald-300 text-sm mb-1">{{_('year')}}</div>
                                            <div class="text-white font-bold text-xl">{{ $book->publication_year ?: ' - ' }}</div>
                                        </div>
                                    </div>
                                    
                                    <!-- Quick View Button -->
                                   
                                </div>
                            </div>
                        </div>
                        
                        <!-- Content Below Image -->
                        <div class="p-6">
                            <!-- Title -->
                            <h4 class="text-xl font-bold text-gray-800 mb-3 line-clamp-1 group-hover:text-purple-700 transition-colors duration-300">
                                <a href="{{ route('books.show', $book) }}" class="hover:underline">
                                    {{ $book->title }}
                                </a>
                            </h4>
                            
                            <!-- Author & Category -->
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center text-gray-600">
                                    <i class="fas fa-user-edit text-purple-500 ml-2"></i>
                                    <span class="text-sm font-medium">{{ Str::limit($book->author->name, 15) }}</span>
                                </div>
                                <div class="flex items-center text-gray-600">
                                    <i class="fas fa-tag text-pink-500 ml-2"></i>
                                    <span class="text-sm font-medium">{{ Str::limit($book->category->name, 12) }}</span>
                                </div>
                            </div>
                            
                            <!-- Pricing -->
                            <div class="mb-6">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="text-2xl font-black text-emerald-600">
                                            {{ number_format($book->price, 2) }} <span class="text-lg">$</span>
                                        </div>
                                        @if($book->compare_price && $book->compare_price > $book->price)
                                        <div class="text-sm text-gray-500 line-through mt-1">
                                            {{ number_format($book->compare_price, 2) }} $
                                        </div>
                                        @endif
                                    </div>
                                    
                                    <!-- Discount Badge -->
                                    @if($book->compare_price && $book->compare_price > $book->price)
                                    <div class="bg-gradient-to-r from-red-500 to-pink-600 text-white px-3 py-1 rounded-full text-xs font-bold">
                                         {{ number_format((($book->compare_price - $book->price) / $book->compare_price) * 100, 0) }}%
                                    </div>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="grid grid-cols-2 gap-3">
                                <a href="{{ route('books.show', $book) }}" 
                                   class="bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white px-4 py-3 rounded-lg font-semibold text-center transition duration-300 transform hover:scale-105 shadow-md hover:shadow-lg flex items-center justify-center">
                                    <i class="fas fa-eye ml-2"></i>
                                    <span>{{__('Show')}}</span>
                                </a>
                                
                             
                            </div>
                            
                            <!-- Download Quick Link -->
                            @if($book->book_url)
                            <div class="mt-4 pt-4 border-t border-gray-200">
                                <a href="{{ $book->book_url }}" 
                                   target="_blank"
                                   class="flex items-center justify-center text-emerald-600 hover:text-emerald-700 font-semibold text-sm transition duration-300">
                                    <i class="fas fa-download ml-2"></i>
                                    <span>{{__('download')}}</span>
                                    <i class="fas fa-external-link-alt text-xs mr-auto opacity-70"></i>
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Pagination Section -->
            @if($books->hasPages())
            <div class="mt-16 pt-8 border-t border-gray-200">
                <div class="flex justify-center">
                    <div class="flex items-center space-x-2 space-x-reverse">
                        <!-- Previous Button -->
                        @if($books->onFirstPage())
                        <span class="px-4 py-2 bg-gray-200 text-gray-500 rounded-lg cursor-not-allowed">
                            <i class="fas fa-arrow-right ml-2"></i> السابق
                        </span>
                        @else
                        <a href="{{ $books->previousPageUrl() }}" 
                           class="px-4 py-2 bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white rounded-lg font-semibold transition duration-300 transform hover:scale-105 shadow-md hover:shadow-lg">
                            <i class="fas fa-arrow-right ml-2"></i> السابق
                        </a>
                        @endif
                        
                        <!-- Page Numbers -->
                        <div class="flex items-center space-x-2 space-x-reverse">
                            @foreach(range(1, $books->lastPage()) as $page)
                                @if($page == $books->currentPage())
                                <span class="w-10 h-10 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-full flex items-center justify-center font-bold shadow-lg">
                                    {{ $page }}
                                </span>
                                @else
                                <a href="{{ $books->url($page) }}" 
                                   class="w-10 h-10 bg-gray-100 hover:bg-purple-100 text-gray-700 hover:text-purple-700 rounded-full flex items-center justify-center font-semibold transition duration-300 hover:shadow-md">
                                    {{ $page }}
                                </a>
                                @endif
                            @endforeach
                        </div>
                        
                        <!-- Next Button -->
                        @if($books->hasMorePages())
                        <a href="{{ $books->nextPageUrl() }}" 
                           class="px-4 py-2 bg-gradient-to-r from-pink-500 to-rose-600 hover:from-pink-600 hover:to-rose-700 text-white rounded-lg font-semibold transition duration-300 transform hover:scale-105 shadow-md hover:shadow-lg">
                            التالي <i class="fas fa-arrow-left mr-2"></i>
                        </a>
                        @else
                        <span class="px-4 py-2 bg-gray-200 text-gray-500 rounded-lg cursor-not-allowed">
                            التالي <i class="fas fa-arrow-left mr-2"></i>
                        </span>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            
            <!-- Empty State -->
            @if($books->isEmpty())
            <div class="text-center py-20">
                <div class="mb-8">
                    <div class="inline-flex items-center justify-center w-32 h-32 bg-gradient-to-r from-purple-100 to-pink-100 rounded-full mb-6">
                        <i class="fas fa-book-open text-5xl text-purple-500"></i>
                    </div>
                </div>
                <h4 class="text-2xl font-bold text-gray-700 mb-4"> {{__('No Items')}}</h4>
             
                <a href="{{ route('home') }}" 
                   class="inline-flex items-center bg-gradient-to-r from-purple-500 to-purple-600 hover:from-purple-600 hover:to-purple-700 text-white px-8 py-3 rounded-xl font-bold text-lg transition duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                    <i class="fas fa-home ml-2"></i>
                  {{__('home')}}
                </a>
            </div>
            @endif
        </div>
    </section>

    <!-- Styles -->
    <style>
        @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');
        
        .line-clamp-1 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
        }
        
        .line-clamp-4 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;
        }
        
        .blur-3xl {
            filter: blur(64px);
        }
        
        .backdrop-blur-sm {
            backdrop-filter: blur(8px);
        }
        
        .transition-all {
            transition-property: all;
        }
        
        .duration-700 {
            transition-duration: 700ms;
        }
        
        .animate-pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        
        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
        }
        
        .truncate {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    </style>

    <!-- AOS Animation Script -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100
        });
    </script>
</x-front-layout>
