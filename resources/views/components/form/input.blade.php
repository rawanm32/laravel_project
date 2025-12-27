@props(
    [
    'name',
    'placeholder' => '',
    'value' => '',   
    'label' => '',
    'type' => 'text' 
    ]
)


<div class="input-group input-group-outline my-3"> 

    @if($label)
   
        <label class="form-label" for="{{ $name }}">{{ $label }}</label> 
    @endif

    <input 
        type="{{ $type }}" 
        name="{{ $name }}" 
        id="{{ $name }}" 
  
        class="form-control @error ($name) is-invalid @enderror" 
       
        placeholder="{{ $placeholder }}" 
        value="{{ old($name, $value) }}"
        {{ $attributes }} >
    
    @error($name)

    <div class="text-danger mt-1" style="font-size: 0.8em;"> {{ $message }}
    </div>
    @enderror

</div>