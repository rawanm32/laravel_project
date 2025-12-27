@extends('layouts.dashboard')

@section('title', 'إضافة كتاب جديد')

@section('content')
<div class="content book-create-page">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="modern-card">
                    <!-- Card Header -->
                    <div class="modern-card-header">
                        <div class="header-content">
                            <div class="header-icon-box">
                                <i class="material-icons">add_circle</i>
                            </div>
                            <div class="header-info">
                                <h4 class="card-title">{{__('Add')}} {{__('Book')}}</h4>
                       
                            </div>
                        </div>
                        <div class="header-decoration">
                            <div class="deco-dot"></div>
                            <div class="deco-dot"></div>
                            <div class="deco-dot"></div>
                        </div>
                    </div>
                    
                    <div class="modern-card-body">
                        {{-- عرض رسائل أخطاء التحقق --}}
                        @if ($errors->any())
                            <div class="modern-alert modern-alert-danger">
                                <div class="alert-icon-wrapper">
                                    <i class="material-icons">error_outline</i>
                                </div>
                                <div class="alert-content">
                               
                                    <ul class="alert-list">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                        
                        {{-- النموذج الرئيسي للإضافة --}}
                        <form method="POST" action="{{ route('admins.store') }}" enctype="multipart/form-data">
                            @csrf 
                            
                            {{-- تضمين النموذج المشترك --}}
                            @include('dashboard.pages.admins._form', [
                                'admin' => $admin, 
                              
                            ])
                            
                            <div class="form-footer">
                                <button type="submit" class="btn-submit-modern">
                                    <i class="material-icons">save</i>
                                    <span>{{__('Save')}}</span>
                                    <div class="btn-wave"></div>
                                </button>
                                
                                <a href="{{ route('admins.index') }}" class="btn-cancel-modern">
                                    <i class="material-icons">close</i>
                                    <span>{{__('Cancel')}}</span>
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
   BOOK CREATE PAGE STYLES
   ============================================ */

.book-create-page {
    padding: 30px 0;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    min-height: 100vh;
}

.modern-card {
    background: white;
    border-radius: 22px;
    box-shadow: 0 12px 35px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    animation: cardAppear 0.5s ease-out;
}

@keyframes cardAppear {
    from {
        opacity: 0;
        transform: translateY(25px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.modern-card-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 35px 40px;
    position: relative;
    overflow: hidden;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.modern-card-header::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.08) 1px, transparent 1px);
    background-size: 25px 25px;
    animation: bgMove 25s linear infinite;
}

@keyframes bgMove {
    0% { transform: translate(0, 0); }
    100% { transform: translate(25px, 25px); }
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
    background: rgba(255, 255, 255, 0.2);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    backdrop-filter: blur(10px);
    animation: iconBounce 2.5s ease-in-out infinite;
}

@keyframes iconBounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-8px); }
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

.header-decoration {
    display: flex;
    gap: 8px;
    position: relative;
    z-index: 1;
}

.deco-dot {
    width: 10px;
    height: 10px;
    background: rgba(255, 255, 255, 0.4);
    border-radius: 50%;
    animation: dotPulse 1.8s ease-in-out infinite;
}

.deco-dot:nth-child(2) {
    animation-delay: 0.3s;
}

.deco-dot:nth-child(3) {
    animation-delay: 0.6s;
}

@keyframes dotPulse {
    0%, 100% {
        transform: scale(1);
        opacity: 0.6;
    }
    50% {
        transform: scale(1.4);
        opacity: 1;
    }
}

.modern-card-body {
    padding: 40px;
}

/* Modern Alert */
.modern-alert {
    border-radius: 16px;
    padding: 22px;
    margin-bottom: 28px;
    display: flex;
    gap: 18px;
    animation: alertSlideIn 0.4s ease-out;
}

@keyframes alertSlideIn {
    from {
        opacity: 0;
        transform: translateX(-20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.modern-alert-danger {
    background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
    border: 2px solid #f87171;
}

.alert-icon-wrapper {
    width: 48px;
    height: 48px;
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
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
    color: #991b1b;
    margin: 0 0 10px 0;
}

.alert-list {
    margin: 0;
    padding: 0 0 0 20px;
    color: #7f1d1d;
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

.btn-submit-modern,
.btn-cancel-modern {
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

.btn-submit-modern {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
    border: none;
    box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
}

.btn-submit-modern:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 28px rgba(16, 185, 129, 0.5);
}

.btn-wave {
    position: absolute;
    inset: 0;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.4) 0%, transparent 60%);
    transform: scale(0);
    opacity: 0;
}

.btn-submit-modern:active .btn-wave {
    animation: waveEffect 0.6s ease-out;
}

@keyframes waveEffect {
    to {
        transform: scale(2.5);
        opacity: 0;
    }
}

.btn-cancel-modern {
    background: #f3f4f6;
    color: #6b7280;
    border: 2px solid #e5e7eb;
}

.btn-cancel-modern:hover {
    background: #e5e7eb;
    color: #374151;
    border-color: #d1d5db;
}

.btn-submit-modern i,
.btn-cancel-modern i {
    font-size: 20px;
}

/* Responsive */
@media (max-width: 768px) {
    .modern-card-header {
        padding: 28px 22px;
        flex-direction: column;
        gap: 15px;
        text-align: center;
    }
    
    .header-content {
        flex-direction: column;
    }
    
    .modern-card-body {
        padding: 28px 22px;
    }
    
    .form-footer {
        flex-direction: column-reverse;
    }
    
    .btn-submit-modern,
    .btn-cancel-modern {
        width: 100%;
        justify-content: center;
    }
}
</style>

@endsection