<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paradise - تسجيل دخول المستخدم</title>
    
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
            background: linear-gradient(135deg, #8A2BE2 0%, #DA70D6 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            color: #333;
        }

        .login-container {
            width: 100%;
            max-width: 420px;
            animation: fadeIn 0.8s ease-out;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px 35px;
            box-shadow: 0 20px 60px rgba(138, 43, 226, 0.25);
            border: 1px solid rgba(255, 255, 255, 0.3);
            position: relative;
            overflow: hidden;
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100%;
            height: 6px;
            background: linear-gradient(90deg, #8A2BE2, #DA70D6);
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
        }

        .logo-icon {
            font-size: 44px;
            background: linear-gradient(135deg, #8A2BE2, #DA70D6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            filter: drop-shadow(0 3px 5px rgba(138, 43, 226, 0.3));
        }

        .logo-text {
            font-size: 28px;
            font-weight: 800;
            background: linear-gradient(135deg, #8A2BE2, #DA70D6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0 2px 4px rgba(138, 43, 226, 0.1);
        }

        .user-role {
            display: inline-block;
            background: linear-gradient(135deg, #8A2BE2, #DA70D6);
            color: white;
            padding: 6px 20px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            margin-top: 10px;
            box-shadow: 0 4px 10px rgba(138, 43, 226, 0.2);
        }

        .login-title {
            font-size: 24px;
            font-weight: 700;
            color: #333;
            margin: 20px 0 30px;
            position: relative;
            padding-bottom: 15px;
        }

        .login-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            right: 0;
            width: 70px;
            height: 3px;
            background: linear-gradient(90deg, #8A2BE2, #DA70D6);
            border-radius: 2px;
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-label {
            display: block;
            margin-bottom: 10px;
            font-weight: 600;
            color: #555;
            font-size: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-label i {
            color: #8A2BE2;
            font-size: 18px;
            width: 24px;
            text-align: center;
        }

        .input-with-icon {
            position: relative;
        }

        .input-with-icon i {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #8A2BE2;
            font-size: 18px;
            transition: color 0.3s;
        }

        .form-input {
            width: 100%;
            padding: 16px 55px 16px 20px;
            border: 2px solid #e6e6e6;
            border-radius: 12px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: #f9f9f9;
            color: #333;
            font-family: 'Tajawal', sans-serif;
        }

        .form-input:focus {
            outline: none;
            border-color: #8A2BE2;
            background: white;
            box-shadow: 0 0 0 4px rgba(138, 43, 226, 0.15);
        }

        .form-input::placeholder {
            color: #999;
            font-family: 'Tajawal', sans-serif;
        }

        .error-message {
            color: #ff4757;
            font-size: 14px;
            margin-top: 8px;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 12px;
            background: rgba(255, 71, 87, 0.08);
            border-radius: 8px;
            border-right: 3px solid #ff4757;
        }

        .error-message i {
            font-size: 16px;
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 25px 0 30px;
            padding: 15px 0;
            border-top: 1px solid #eee;
            border-bottom: 1px solid #eee;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #555;
            cursor: pointer;
            font-size: 15px;
            user-select: none;
        }

        .remember-checkbox {
            width: 20px;
            height: 20px;
            accent-color: #8A2BE2;
            cursor: pointer;
            border-radius: 4px;
        }

        .forgot-password {
            color: #8A2BE2;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
            font-size: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .forgot-password:hover {
            color: #DA70D6;
            text-decoration: underline;
            transform: translateX(-3px);
        }

        .submit-btn {
            width: 100%;
            padding: 17px;
            background: linear-gradient(135deg, #8A2BE2, #DA70D6);
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
            gap: 15px;
            margin-top: 10px;
            font-family: 'Tajawal', sans-serif;
            letter-spacing: 0.5px;
            box-shadow: 0 6px 20px rgba(138, 43, 226, 0.3);
        }

        .submit-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 25px rgba(138, 43, 226, 0.4);
        }

        .submit-btn:active {
            transform: translateY(-1px);
        }

        .register-link {
            text-align: center;
            margin-top: 30px;
            padding-top: 25px;
            border-top: 1px solid #eee;
            color: #666;
            font-size: 15px;
        }

        .register-link a {
            color: #8A2BE2;
            text-decoration: none;
            font-weight: 600;
            margin-right: 8px;
            transition: color 0.3s;
        }

        .register-link a:hover {
            color: #DA70D6;
            text-decoration: underline;
        }

        .alert {
            padding: 16px 20px;
            border-radius: 12px;
            margin-bottom: 25px;
            font-size: 15px;
            display: flex;
            align-items: center;
            gap: 15px;
            line-height: 1.5;
        }

        .alert-success {
            background: rgba(46, 204, 113, 0.1);
            color: #27ae60;
            border: 1px solid rgba(46, 204, 113, 0.3);
            border-right: 4px solid #27ae60;
        }

        .alert-error {
            background: rgba(255, 71, 87, 0.1);
            color: #ff4757;
            border: 1px solid rgba(255, 71, 87, 0.3);
            border-right: 4px solid #ff4757;
        }

        .session-status {
            background: rgba(52, 152, 219, 0.1);
            color: #2980b9;
            border: 1px solid rgba(52, 152, 219, 0.3);
            border-right: 4px solid #2980b9;
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
            .login-card {
                padding: 30px 25px;
            }
            
            .logo-text {
                font-size: 24px;
            }
            
            .login-title {
                font-size: 22px;
            }
            
            .remember-forgot {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            
            .form-input {
                padding: 14px 50px 14px 15px;
            }
        }

        .arabic-text {
            font-family: 'Tajawal', sans-serif;
        }

        .credits {
            text-align: center;
            margin-top: 25px;
            color: rgba(255, 255, 255, 0.85);
            font-size: 14px;
            text-shadow: 0 1px 2px rgba(0,0,0,0.1);
        }

        .credits span {
            color: #FFD700;
            font-weight: 700;
            text-shadow: 0 1px 3px rgba(0,0,0,0.2);
        }

        .credits i {
            color: #ff6b6b;
            animation: heartbeat 1.5s infinite;
        }

        @keyframes heartbeat {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        .password-toggle {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            cursor: pointer;
            transition: color 0.3s;
        }

        .password-toggle:hover {
            color: #8A2BE2;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Session Status -->
        @if(session('status'))
        <div class="alert session-status">
            <i class="fas fa-info-circle"></i>
            <div>{{ session('status') }}</div>
        </div>
        @endif

        <div class="login-card">
            <!-- Header -->
            <div class="header">
                <div class="logo">
                    <i class="fas fa-book-reader logo-icon"></i>
                    <div class="logo-text">Paradise Books</div>
                </div>
                <div class="user-role">
                    <i class="fas fa-user-circle"></i>
                    تسجيل دخول المستخدم
                </div>
                <h2 class="login-title">
                    <i class="fas fa-sign-in-alt"></i>
                    مرحباً بعودتك!
                </h2>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="form-group">
                    <label class="form-label" for="email">
                        <i class="fas fa-envelope"></i>
                        البريد الإلكتروني
                    </label>
                    <div class="input-with-icon">
                        <i class="fas fa-user"></i>
                        <input id="email" 
                               class="form-input" 
                               type="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               required 
                               autofocus 
                               autocomplete="email"
                               placeholder="أدخل بريدك الإلكتروني">
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
                               autocomplete="current-password"
                               placeholder="أدخل كلمة المرور">
                        <span class="password-toggle" onclick="togglePassword()">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                    @error('password')
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="remember-forgot">
                    <label class="remember-me">
                        <input id="remember_me" 
                               type="checkbox" 
                               class="remember-checkbox" 
                               name="remember">
                        تذكرني على هذا الجهاز
                    </label>
                    
                    @if (Route::has('password.request'))
                    <a class="forgot-password" href="{{ route('password.request') }}">
                        <i class="fas fa-key"></i>
                        نسيت كلمة المرور؟
                    </a>
                    @endif
                </div>

                <!-- Submit Button -->
                <button type="submit" class="submit-btn">
                    <i class="fas fa-sign-in-alt"></i>
                    تسجيل الدخول إلى حسابي
                </button>
            </form>

            <!-- Register Link -->
            <div class="register-link">
                <span>ليس لديك حساب؟</span>
                <a href="{{ route('register') }}">
                    <i class="fas fa-user-plus"></i>
                    إنشاء حساب جديد
                </a>
            </div>
        </div>

        <!-- Credits -->
        <div class="credits">
            <p>
                <i class="fas fa-heart"></i>
                © {{ date('Y') }} Paradise Books 
                | تم التطوير بواسطة 
                <span>روان وبتول | Rawaan & Batool</span>
            </p>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        // Toggle password visibility
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.querySelector('.password-toggle i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        // Add focus effect to inputs
        document.querySelectorAll('.form-input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.querySelector('i').style.color = '#DA70D6';
                this.style.boxShadow = '0 0 0 4px rgba(218, 112, 214, 0.15)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.querySelector('i').style.color = '#8A2BE2';
                this.style.boxShadow = 'none';
            });
        });

        // Form submission loading
        document.querySelector('form').addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('.submit-btn');
            if (submitBtn) {
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> جاري التحقق...';
                submitBtn.disabled = true;
                submitBtn.style.opacity = '0.8';
            }
        });

        // Add animation to form elements
        document.addEventListener('DOMContentLoaded', function() {
            const formGroups = document.querySelectorAll('.form-group');
            formGroups.forEach((group, index) => {
                group.style.animationDelay = `${index * 0.1}s`;
                group.style.animation = 'fadeIn 0.5s ease-out forwards';
                group.style.opacity = '0';
            });
        });
    </script>
</body>
</html>