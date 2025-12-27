@extends('layouts.dashboard')

@section('title', 'تعديل كتاب ')

@section('content')
<div class="content book-edit-page">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="modern-card">
                    <!-- Card Header -->
                    <div class="modern-card-header edit-header">
                        <div class="header-content">
                            <div class="header-icon-box">
                                <i class="material-icons">edit</i>
                            </div>
                            <div class="header-info">
                                <h4 class="card-title">تعديل كتاب</h4>
                                <p class="card-category">أدخل بيانات الكتاب الجديدة</p>
                            </div>
                        </div>
                        <div class="edit-badge">
                            <i class="material-icons">auto_stories</i>
                            <span>تحرير</span>
                        </div>
                    </div>
                    
                    <div class="modern-card-body">
                        {{-- عرض رسائل أخطاء التحقق --}}
                        @if ($errors->any())
                            <div class="modern-alert modern-alert-warning">
                                <div class="alert-icon-wrapper">
                                    <i class="material-icons">warning</i>
                                </div>
                                <div class="alert-content">
                                    <h5 class="alert-heading">تنبيه: يوجد أخطاء في النموذج</h5>
                                    <ul class="alert-list">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                       
                        {{-- النموذج الرئيسي للتعديل --}}
                        <form method="POST" action="{{ route('dashboard.authors.update', $author->id) }}" enctype="multipart/form-data">
                            @csrf 
                            @method('PUT')
                            
                            {{-- تضمين النموذج المشترك --}}
                            @include('dashboard.pages.authors._form', ['author' => $author])
                            
                            <div class="form-footer">
                                <button type="submit" class="btn-update-modern">
                                    <i class="material-icons">check_circle</i>
                                    <span>حفظ التعديلات</span>
                                    <div class="btn-ripple"></div>
                                </button>
                                
                                <a href="{{ route('dashboard.authors.index') }}" class="btn-back-modern">
                                    <i class="material-icons">arrow_back</i>
                                    <span>إلغاء</span>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* ============================================
   BOOK EDIT PAGE STYLES
   ============================================ */

.book-edit-page {
    padding: 30px 0;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    min-height: 100vh;
}

.modern-card {
    background: white;
    border-radius: 22px;
    box-shadow: 0 12px 35px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    animation: cardZoomIn 0.5s ease-out;
}

@keyframes cardZoomIn {
    from {
        opacity: 0;
        transform: scale(0.95);
    }
    to {
        opacity: 1;
        transform: scale(1);
    }
}

.edit-header {
    background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
    padding: 35px 40px;
    position: relative;
    overflow: hidden;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.edit-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='0.08' fill-rule='evenodd'%3E%3Cpath d='M0 40L40 0H20L0 20M40 40V20L20 40'/%3E%3C/g%3E%3C/svg%3E");
    opacity: 0.4;
}

.header-content {
    display: flex;
    align-items: center;
    gap: 20px;
    position: relative;
    z-index: 1;
}

.header-icon-box {
    width: 70px;
    height: 70px;
    background: rgba(255, 255, 255, 0.25);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(10px);
    animation: iconSpin 3s ease-in-out infinite;
}

@keyframes iconSpin {
    0%, 100% {
        transform: rotate(0deg);
    }
    50% {
        transform: rotate(8deg);
    }
}

.header-icon-box i {
    font-size: 38px;
    color: white;
}

.header-info .card-title {
    font-size: 26px;
    font-weight: 800;
    color: white;
    margin: 0 0 6px 0;
    text-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
}

.header-info .card-category {
    font-size: 14px;
    color: rgba(255, 255, 255, 0.95);
    margin: 0;
}

.edit-badge {
    display: flex;
    align-items: center;
    gap: 8px;
    background: rgba(255, 255, 255, 0.25);
    padding: 12px 22px;
    border-radius: 14px;
    backdrop-filter: blur(10px);
    color: white;
    font-weight: 600;
    font-size: 15px;
    position: relative;
    z-index: 1;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.edit-badge i {
    font-size: 22px;
}

.modern-card-body {
    padding: 40px;
}

/* Modern Alert Warning */
.modern-alert {
    border-radius: 16px;
    padding: 22px;
    margin-bottom: 28px;
    display: flex;
    gap: 18px;
    animation: alertShake 0.5s ease-out;
}

@keyframes alertShake {
    0%, 100% { transform: translateX(0); }
    25% { transform: translateX(-8px); }
    75% { transform: translateX(8px); }
}

.modern-alert-warning {
    background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
    border: 2px solid #fbbf24;
}

.modern-alert-warning .alert-icon-wrapper {
    background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
}

.alert-icon-wrapper {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    box-shadow: 0 4px 12px rgba(251, 191, 36, 0.3);
}

.alert-icon-wrapper i {
    font-size: 26px;
    color: white;
}

.alert-content {
    flex: 1;
}

.alert-heading {
    font-size: 15px;
    font-weight: 700;
    color: #92400e;
    margin: 0 0 10px 0;
}

.alert-list {
    margin: 0;
    padding: 0 0 0 20px;
    color: #78350f;
}

.alert-list li {
    margin-bottom: 4px;
    font-size: 13px;
}

/* Form Footer */
.form-footer {
    display: flex;
    gap: 12px;
    justify-content: flex-end;
    margin-top: 35px;
    padding-top: 28px;
    border-top: 2px solid #f3f4f6;
}

.btn-update-modern,
.btn-back-modern {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 14px 30px;
    border-radius: 14px;
    font-weight: 600;
    font-size: 15px;
    transition: all 0.3s ease;
    cursor: pointer;
    text-decoration: none;
    position: relative;
    overflow: hidden;
}

.btn-update-modern {
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    color: white;
    border: none;
    box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
}

.btn-update-modern:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 28px rgba(59, 130, 246, 0.5);
}

.btn-ripple {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) scale(0);
    background: radial-gradient(circle, rgba(255, 255, 255, 0.5), transparent);
    opacity: 0;
}

.btn-update-modern:active .btn-ripple {
    animation: rippleEffect 0.6s ease-out;
}

@keyframes rippleEffect {
    to {
        transform: translate(-50%, -50%) scale(2);
        opacity: 0;
    }
}

.btn-back-modern {
    background: white;
    color: #6b7280;
    border: 2px solid #e5e7eb;
}

.btn-back-modern:hover {
    background: #f9fafb;
    color: #374151;
    border-color: #d1d5db;
    transform: translateX(-4px);
}

.btn-update-modern i,
.btn-back-modern i {
    font-size: 20px;
}

/* Responsive */
@media (max-width: 768px) {
    .edit-header {
        padding: 28px 22px;
        flex-direction: column;
        gap: 15px;
        text-align: center;
    }
    
    .header-content {
        flex-direction: column;
    }
    
    .edit-badge {
        width: 100%;
        justify-content: center;
    }
    
    .modern-card-body {
        padding: 28px 22px;
    }
    
    .form-footer {
        flex-direction: column-reverse;
    }
    
    .btn-update-modern,
    .btn-back-modern {
        width: 100%;
        justify-content: center;
    }
}
</style>

@endsection