@extends ('layouts.dashboard')

@section('title', 'تعديل بيانات البروفايل')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            {{-- 1. بطاقة تعديل البيانات الأساسية (اسم وبريد إلكتروني) --}}
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">تعديل معلومات الحساب الأساسية</h4>
                        <p class="card-category">الاسم والبريد الإلكتروني (بيانات جدول Users)</p>
                    </div>
                    
                    <div class="card-body">
                        {{-- عرض رسائل النجاح أو الأخطاء --}}
                        <x-alert />
                        <x-alert type="danger" :errors="$errors" />

                        {{-- الفورم يشير إلى راوت 'dashboard.profile.update' --}}
                      @include('dashboard.pages.profile._form')
                    </div>
                </div>
            </div>

            {{-- 2. بطاقة معلومات المستخدم الجانبية (اختياري) --}}
            <div class="col-md-4">
                <div class="card card-profile">
                    <div class="card-avatar">
                        {{-- 💡 يمكنك وضع صورة البروفايل هنا --}}
                        <img class="img" src="https://placehold.co/128x128/0000FF/FFFFFF?text=R" alt="Profile Image">
                    </div>
                    <div class="card-body">
                        <h6 class="card-category text-gray">المستخدم الحالي</h6>
                        <h4 class="card-title">{{ $user->name }}</h4>
                        <p class="card-description">
                            هذه بيانات الحساب التي يمكن لزملائك رؤيتها. تأكد من تحديثها بانتظام.
                        </p>
                        <p class="text-muted small">
                            ID: {{ $user->id }}
                        </p>
                    </div>
                </div>
            </div>
            {{-- نهاية العمود الجانبي --}}

        </div>
    </div>
</div>
@endsection