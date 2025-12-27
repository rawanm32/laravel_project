<form action="{{ route('dashboard.profile.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    {{-- استخدام متود PUT لإجراء عملية التحديث --}}
    @method('PUT') 

    <div class="card-body">
        
        {{-- بيانات جدول Users --}}
       
           

        <hr class="mt-4 mb-4">
       
        
        {{-- بيانات جدول Profiles: الاسم الأول والاسم الأخير --}}
        <div class="row">
            <div class="col-md-6">
                <x-form.input 
                    name="first_name" 
                    label="{{__('')}}" 
                    type="text"
                    :value="old('first_name', $user->profile->first_name ?? '')"
                    required
                />
            </div>
            <div class="col-md-6">
                <x-form.input 
                    name="last_name" 
                    label="{{__('last name')}}" 
                    type="text"
                    :value="old('last_name', $user->profile->last_name ?? '')"
                    required
                />
            </div>
        </div>

        {{-- بيانات جدول Profiles: تاريخ الميلاد ورقم الهاتف --}}
        <div class="row">
            <div class="col-md-6">
                <x-form.input 
                    name="birthdate" 
                    label="{{__('birth')}}" 
                    type="date"
                    :value="old('birthdate', $user->profile->birthdate ?? '')"
                />
            </div>
            <div class="col-md-6">
                <x-form.input 
                    name="phone" 
                    label="{{__('Phone')}}" 
                    type="tel"
                    :value="old('phone', $user->profile->phone ?? '')"
                />
            </div>
        </div>
        
        {{-- بيانات جدول Profiles: الجنس والصورة الشخصية --}}
        <div class="row">
            <div class="col-md-6">
                {{-- نفترض أن لديك Component Select --}}
                <x-form.select
                    name="gender" 
                    label="{{__('gender')}}" 
                    :options="['male' => 'ذكر', 'female' => 'أنثى']"
                    :selected="old('gender', $user->profile->gender ?? '')"
                />
            </div>
            <div class="col-md-6">
                 {{-- 💡 حقل الصورة: إذا كنت تستخدمينه، يجب إضافة enctype="multipart/form-data" للفورم --}}
               
            </div>
        </div>
        
        {{-- بيانات جدول Profiles: العنوان --}}
        <div class="row">
            <div class="col-md-12">
                {{-- نستخدم textarea للعناوين الطويلة --}}
                <div class="form-group">
                    <label class="bmd-label-floating">{{__('Address')}}</label>
                    <textarea name="Address" class="form-control" rows="3">{{ old('address', $user->profile->address ?? '') }}</textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
             
                <div class="form-group">
                    <label class="bmd-label-floating">{{__('bio')}}</label>
                    <textarea name="bio" class="form-control" rows="3">{{ old('address', $user->profile->bio ?? '') }}</textarea>
                </div>
            </div>
        </div>
        
    </div> <!-- نهاية card-body -->

    <button type="submit" class="btn btn-primary pull-right">{{__('Update')}}</button>
    <div class="clearfix"></div>
</form>