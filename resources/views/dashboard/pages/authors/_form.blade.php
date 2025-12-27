<div class="card-body"> 


    <div class="row">
        <div class="col-md-8">
            <x-form.input 
                name="name" 
                label="{{__('name')}}" 
                type="text"
                :value="old('name', $author->name ?? '')"
                required
            />
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
         
            <x-form.input 
                name="bio" 
                label="{{__('bio')}}" 
                type="textarea"
                :value="old('bio', $author->bio ?? '')"
                rows="5"
            />
        </div>
    </div>


    <div class="row">
        <div class="col-md-4">
            <x-form.select
                name="status"
                label="{{__('status')}}"
                :options="['active' => 'مفعل', 'inactive' => 'معطل']"
                :selected="old('status', $author->status ?? 'active')" 
            />
        </div>
    </div>

    {{-- 4. حقل الصورة (Image) - معطل مؤقتاً --}}
    {{-- 
    <div class="row">
        <div class="col-md-8">
            <x-form.input 
                name="image" 
                label="صورة المؤلف (اختياري)" 
                type="file"
                accept="image/*"
            />
            @if(isset($author->image) && $author->image)
                <div class="mt-2">
                    <img src="{{ Storage::url($author->image) }}" alt="صورة المؤلف" style="width: 100px; height: 100px; object-fit: cover;">
                </div>
            @endif
        </div>
    </div>
    --}}
</div>