<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paradise Dashboard - إنشاء حساب</title>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Tajawal', sans-serif;
        }

        body {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            color: #333;
        }

        .register-container {
            width: 100%;
            max-width: 480px;
            animation: fadeIn 0.8s ease-out;
        }

        .register-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px 35px;
            box-shadow: 0 20px 60px rgba(106, 17, 203, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            overflow: hidden;
        }

        .register-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, #6a11cb, #2575fc);
        }

        .header {
            text-align: center;
            margin-bottom: 35px;
        }

        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            margin-bottom: 15px;
            color: #6a11cb;
        }

        .logo i {
            font-size: 42px;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .logo-text {
            font-size: 28px;
            font-weight: 800;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .welcome-text {
            font-size: 16px;
            color: #666;
            margin-bottom: 5px;
        }

        .register-title {
            font-size: 24px;
            font-weight: 700;
            color: #333;
            margin-bottom: 30px;
            position: relative;
            padding-bottom: 15px;
        }

        .register-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            right: 0;
            width: 80px;
            height: 3px;
            background: linear-gradient(90deg, #6a11cb, #2575fc);
            border-radius: 2px;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #555;
            font-size: 15px;
        }

        .form-label i {
            margin-left: 8px;
            color: #6a11cb;
        }

        .input-with-icon {
            position: relative;
        }

        .input-with-icon i {
            position: absolute;
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #6a11cb;
            font-size: 18px;
        }

        .form-input {
            width: 100%;
            padding: 15px 50px 15px 20px;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: #f8f9fa;
            color: #333;
        }

        .form-input:focus {
            outline: none;
            border-color: #6a11cb;
            background: white;
            box-shadow: 0 0 0 3px rgba(106, 17, 203, 0.1);
        }

        .form-input::placeholder {
            color: #aaa;
        }

        .error-message {
            color: #ff4757;
            font-size: 14px;
            margin-top: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .password-strength {
            margin-top: 8px;
            font-size: 14px;
            color: #666;
        }

        .strength-meter {
            height: 4px;
            background: #eee;
            border-radius: 2px;
            margin-top: 5px;
            overflow: hidden;
        }

        .strength-fill {
            height: 100%;
            width: 0%;
            transition: width 0.3s, background 0.3s;
        }

        .register-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 30px;
        }

        .login-link {
            color: #6a11cb;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
            font-size: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .login-link:hover {
            color: #2575fc;
            text-decoration: underline;
        }

        .submit-btn {
            padding: 16px 35px;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 17px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            min-width: 150px;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(106, 17, 203, 0.3);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        .terms-checkbox {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 20px 0;
            color: #555;
            font-size: 15px;
        }

        .terms-checkbox input {
            width: 18px;
            height: 18px;
            accent-color: #6a11cb;
            cursor: pointer;
        }

        .terms-link {
            color: #6a11cb;
            text-decoration: none;
            font-weight: 500;
        }

        .terms-link:hover {
            text-decoration: underline;
        }

        .footer-links {
            text-align: center;
            margin-top: 30px;
            padding-top: 25px;
            border-top: 1px solid #eee;
            color: #777;
            font-size: 14px;
        }

        .footer-links a {
            color: #6a11cb;
            text-decoration: none;
            font-weight: 500;
        }

        .footer-links a:hover {
            text-decoration: underline;
        }

        .alert {
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 25px;
            font-size: 15px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .alert-success {
            background: rgba(46, 204, 113, 0.1);
            color: #27ae60;
            border: 1px solid rgba(46, 204, 113, 0.3);
        }

        .alert-error {
            background: rgba(255, 71, 87, 0.1);
            color: #ff4757;
            border: 1px solid rgba(255, 71, 87, 0.3);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 480px) {
            .register-card {
                padding: 30px 25px;
            }
            
            .logo-text {
                font-size: 24px;
            }
            
            .register-title {
                font-size: 22px;
            }
            
            .register-actions {
                flex-direction: column;
                gap: 20px;
                align-items: stretch;
            }
            
            .submit-btn {
                width: 100%;
            }
        }

        .arabic-text {
            font-family: 'Tajawal', sans-serif;
        }

        .credits {
            text-align: center;
            margin-top: 25px;
            color: rgba(255, 255, 255, 0.8);
            font-size: 14px;
        }

        .credits span {
            color: #ffd166;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <!-- Error Messages -->
        @if($errors->any())
        <div class="alert alert-error">
            <i class="fas fa-exclamation-triangle"></i>
            <div>
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        </div>
        @endif

        <div class="register-card">
            <!-- Header -->
            <div class="header">
                <div class="logo">
                    <i class="fas fa-book-open"></i>
                    <div class="logo-text">Paradise Dashboard</div>
                </div>
                <p class="welcome-text">انضم إلى مجتمعنا الرقمي</p>
                <h2 class="register-title">
                    <i class="fas fa-user-plus"></i>
                    إنشاء حساب جديد
                </h2>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="form-group">
                    <label class="form-label" for="name">
                        <i class="fas fa-user"></i>
                        الاسم الكامل
                    </label>
                    <div class="input-with-icon">
                        <i class="fas fa-id-card"></i>
                        <input id="name" 
                               class="form-input" 
                               type="text" 
                               name="name" 
                               value="{{ old('name') }}" 
                               required 
                               autofocus 
                               autocomplete="name"
                               placeholder="أدخل اسمك الكامل">
                    </div>
                    @error('name')
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Email Address -->
                <div class="form-group">
                    <label class="form-label" for="email">
                        <i class="fas fa-envelope"></i>
                        البريد الإلكتروني
                    </label>
                    <div class="input-with-icon">
                        <i class="fas fa-at"></i>
                        <input id="email" 
                               class="form-input" 
                               type="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               required 
                               autocomplete="email"
                               placeholder="example@domain.com">
                    </div>
                    @error('email')
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label class="form-label" for="password">
                        <i class="fas fa-lock"></i>
                        كلمة المرور
                    </label>
                    <div class="input-with-icon">
                        <i class="fas fa-key"></i>
                        <input id="password" 
                               class="form-input"
                               type="password"
                               name="password"
                               required 
                               autocomplete="new-password"
                               placeholder="كلمة المرور (8 أحرف على الأقل)"
                               onkeyup="checkPasswordStrength(this.value)">
                    </div>
                    <div class="password-strength">
                        <span id="strength-text">قوة كلمة المرور</span>
                        <div class="strength-meter">
                            <div class="strength-fill" id="strength-meter"></div>
                        </div>
                    </div>
                    @error('password')
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <label class="form-label" for="password_confirmation">
                        <i class="fas fa-lock"></i>
                        تأكيد كلمة المرور
                    </label>
                    <div class="input-with-icon">
                        <i class="fas fa-key"></i>
                        <input id="password_confirmation" 
                               class="form-input"
                               type="password"
                               name="password_confirmation" 
                               required 
                               autocomplete="new-password"
                               placeholder="أعد إدخال كلمة المرور">
                    </div>
                    @error('password_confirmation')
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Terms Agreement -->
                <div class="terms-checkbox">
                    <input type="checkbox" id="terms" name="terms" required>
                    <label for="terms">
                        أوافق على 
                        <a href="#" class="terms-link">الشروط والأحكام</a>
                        و
                        <a href="#" class="terms-link">سياسة الخصوصية</a>
                    </label>
                </div>

                <!-- Actions -->
                <div class="register-actions">
                    <a class="login-link" href="{{ route('login') }}">
                        <i class="fas fa-sign-in-alt"></i>
                        لديك حساب؟ سجل الدخول
                    </a>

                    <button type="submit" class="submit-btn">
                        <i class="fas fa-user-plus"></i>
                        إنشاء الحساب
                    </button>
                </div>
            </form>

            <!-- Footer Links -->
            <div class="footer-links">
                <p class="arabic-text">
                    © {{ date('Y') }} Paradise Dashboard 
                    | تم التطوير بواسطة 
                    <span style="color: #6a11cb; font-weight: 600;">
                        روان وبتول
                    </span>
                </p>
            </div>
        </div>

        <!-- Credits -->
        <div class="credits">
            <p>
                <i class="fas fa-heart" style="color: #ff6b6b;"></i>
                Paradise Dashboard v1.0 | Rawaan & Batool
            </p>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        // Password strength checker
        function checkPasswordStrength(password) {
            const meter = document.getElementById('strength-meter');
            const text = document.getElementById('strength-text');
            let strength = 0;
            
            if (password.length >= 8) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[a-z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++;
            
            let width = (strength / 5) * 100;
            meter.style.width = width + '%';
            
            if (strength <= 1) {
                meter.style.background = '#ff4757';
                text.textContent = 'ضعيفة';
                text.style.color = '#ff4757';
            } else if (strength <= 3) {
                meter.style.background = '#ffa502';
                text.textContent = 'متوسطة';
                text.style.color = '#ffa502';
            } else {
                meter.style.background = '#2ed573';
                text.textContent = 'قوية';
                text.style.color = '#2ed573';
            }
        }

        // Add focus effect to inputs
        document.querySelectorAll('.form-input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.querySelector('i').style.color = '#2575fc';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.querySelector('i').style.color = '#6a11cb';
            });
        });

        // Form submission loading
        document.querySelector('form').addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('.submit-btn');
            if (submitBtn) {
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> جاري إنشاء الحساب...';
                submitBtn.disabled = true;
            }
        });

        // Check password confirmation
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('password_confirmation');
        
        confirmPassword.addEventListener('input', function() {
            if (password.value !== this.value) {
                this.style.borderColor = '#ff4757';
            } else {
                this.style.borderColor = '#2ed573';
            }
        });
    </script>
</body>
</html>