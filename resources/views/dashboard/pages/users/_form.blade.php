<div class="card-body">
    
    <!-- حقل الاسم -->
    <div class="form-group mb-4">
        <x-form.input 
            type="text" 
            name="name" 
            placeholder=" {{__('name')}}" 
            label="الاسم" 
            :value="old('name', $user->name ?? '')"
        />
    </div>
    
    <!-- حقل البريد الإلكتروني -->
    <div class="form-group mb-4">
        <x-form.input 
            type="email" 
            name="email" 
            placeholder=" {{__('email')}}" 
            label="{{"Enter"}}" 
            :value="old('email', $user->email ?? '')"
        />
    </div>
    
  
    <div class="row">
      
        <div class="col-md-6 form-group mb-4">
            <x-form.input 
                type="password" 
                name="password" 
                placeholder=" {{__('password')}}" 
                label=" {{__('password')}}"
            />
        </div>
        
      
        <div class="col-md-6 form-group mb-4">
            <x-form.input 
                type="password" 
                name="password_confirmation" 
                placeholder=" {{__('password_confirmation')}}" 
                label=" {{__('password_confirmation')}}"
            />
        </div>
    </div>

    <!-- زر الإرسال -->
 
    
</div>
