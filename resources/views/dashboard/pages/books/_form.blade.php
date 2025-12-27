<div class="card-body"> 

    <div class="row">
        <div class="col-md-6">
            <x-form.input 
                name="title" 
                label="{{__('title')}}" 
                type="text"
                :value="old('title', $book->title ?? '')"
                required
            />
        </div>

   
        <div class="col-md-4">
            <x-form.input 
                name="publication_year" 
                label="{{_('year')}}" 
                type="number"
                :value="old('publication_year', $book->publication_year ?? '')"
            />
        </div>
    </div>

   
    <div class="row">
        <div class="col-md-6">
            <x-form.select
                name="category_id"
                label="{{__('Category')}}"
                :options="$categories" 
                :selected="old('category_id', $book->category_id ?? '')" 
                required
            />
        </div>

  
        <div class="col-md-6">
            <x-form.select
                name="author_id"
                label="{{__('Author')}}"
                :options="$authors" 
                :selected="old('author_id', $book->author_id ?? '')" 
                required
            />
        </div>
    </div>

  
    <div class="row">
        <div class="col-md-12">
            <x-form.input 
                name="description" 
                label="{{__('Description')}}" 
                type="textarea"
                :value="old('description', $book->description ?? '')"
                rows="4"
            />
        </div>
    </div>


    <div class="row">
        <div class="col-md-4">
            <x-form.input 
                name="price" 
                label="{{__('price')}}" 
                type="number"
                step="0.01"
                :value="old('price', $book->price ?? 0.00)"
                required
            />
        </div>
        <div class="col-md-4">
            <x-form.input 
                name="compare_price" 
                label="{{__('copmare_price')}}" 
                type="number"
                step="0.01"
                :value="old('compare_price', $book->compare_price ?? '')"
            />
        </div>
    </div>

    {{-- 7. حقل عدد الصفحات والحالة --}}
    <div class="row">
        <div class="col-md-4">
            <x-form.input 
                name="pages" 
                label="{{__('pages')}}" 
                type="number"
                :value="old('pages', $book->pages ?? '')"
            />
        </div>
        <div class="col-md-4">
            <x-form.select
                name="status"
                label="{{__('Status')}}"
                :options="['available' => 'متاح', 'unavailable' => 'غير متاح']"
                :selected="old('status', $book->status ?? 'available')" 
                required
            />
        </div>
    </div>
    
    <hr class="mt-4 mb-4">
    
 
    <div class="row">
        <div class="col-md-8">i
            <x-form.input 
                name="image" 
                label="{{__('book')}}{{_('image')}}" 
                type="file"
                accept="image/*"
            />
            
            @if(isset($book->image) && $book->image)
                <div class="mt-2">
                    <p class="text-primary"></p>
                    <img src="{{ Storage::url($book->image) }}" alt="{{__('Image')}}" style="width: 150px; height: 180px; object-fit: cover; border-radius: 8px;">
                </div>
            @endif
        </div>
    </div>

    <div class="row mt-3">
    <div class="col-md-8">
        <label for="book_url">{{__('book url')}}</label>
        <input type="url" 
               name="book_url" 
               id="book_url"
               class="form-control"
               placeholder="https://drive.google.com/file/..."
               value="{{ old('book_url', $book->book_url ?? '') }}">

    </div>
</div>

</div>