@props([
    'name',
    'value' => null, // لم يعد ضرورياً ولكن نتركه
    'label',
    'options'=> [],
    'selected' => null
])


<div class="input-group input-group-outline my-3">
    
   
    <label class="form-label" for="{{$name}}">{{$label}} </label> 
    
    <select 
        name="{{$name}}" 
        id="{{$name}}" 
        class="form-control @error($name) is-invalid @enderror" 
        {{ $attributes }} 
    >
       
        <option value="">-- اختر --</option> 
        
        @foreach ($options as $optionValue => $optionText)
            <option value="{{$optionValue}}"
             @if ($optionValue == old($name ,$selected))
              selected
              @endif
               > 
               {{$optionText}}</option>
        @endforeach
    </select>
    
    @error($name)
        {{-- نستخدم class="text-danger" لرسالة الخطأ --}}
        <div class="text-danger mt-1" style="font-size: 0.8em;"> 
            {{$message}}
        </div>
    @enderror

</div>