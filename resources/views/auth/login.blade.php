<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paradise Dashboard - تسجيل الدخول</title>
    
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

        .login-container {
            width: 100%;
            max-width: 420px;
            animation: fadeIn 0.8s ease-out;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px 35px;
            box-shadow: 0 20px 60px rgba(106, 17, 203, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            overflow: hidden;
        }

        .login-card::before {
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

        .login-title {
            font-size: 24px;
            font-weight: 700;
            color: #333;
            margin-bottom: 30px;
            position: relative;
            padding-bottom: 15px;
        }

        .login-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            right: 0;
            width: 60px;
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

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #555;
            cursor: pointer;
        }

        .remember-checkbox {
            width: 18px;
            height: 18px;
            accent-color: #6a11cb;
            cursor: pointer;
        }

        .forgot-password {
            color: #6a11cb;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
            font-size: 15px;
        }

        .forgot-password:hover {
            color: #2575fc;
            text-decoration: underline;
        }

        .submit-btn {
            width: 100%;
            padding: 16px;
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
            margin-top: 10px;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(106, 17, 203, 0.3);
        }

        .submit-btn:active {
            transform: translateY(0);
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

        .session-status {
            background: rgba(52, 152, 219, 0.1);
            color: #2980b9;
            border: 1px solid rgba(52, 152, 219, 0.3);
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
    <div class="login-container">
        <!-- Session Status -->
        @if(session('status'))
        <div class="alert session-status">
            <i class="fas fa-info-circle"></i>
            {{ session('status') }}
        </div>
        @endif

        <div class="login-card">
            <!-- Header -->
            <div class="header">
                <div class="logo">
                    <i class="fas fa-book-open"></i>
                    <div class="logo-text">Paradise Dashboard</div>
                </div>
                <p class="welcome-text">مرحباً بك في لوحة التحكم</p>
                <h2 class="login-title">
                    <i class="fas fa-sign-in-alt"></i>
                    تسجيل الدخول
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
                        <i class="fas fa-user-circle"></i>
                        <input id="email" 
                               class="form-input" 
                               type="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               required 
                               autofocus 
                               autocomplete="username"
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
                        تذكرني
                    </label>
                    
                    @if (Route::has('password.request'))
                    <a class="forgot-password" href="{{ route('password.request') }}">
                        <i class="fas fa-question-circle"></i>
                        نسيت كلمة المرور؟
                    </a>
                    @endif
                </div>

                <!-- Submit Button -->
                <button type="submit" class="submit-btn">
                    <i class="fas fa-sign-in-alt"></i>
                    تسجيل الدخول
                </button>
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

    <!-- JavaScript for animations -->
    <script>
        // Add focus effect to inputs
        document.querySelectorAll('.form-input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.querySelector('i').style.color = '#2575fc';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.querySelector('i').style.color = '#6a11cb';
            });
        });

        // Add loading effect to submit button
        document.querySelector('form').addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('.submit-btn');
            if (submitBtn) {
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> جاري التحقق...';
                submitBtn.disabled = true;
            }
        });
    </script>
</body>
</html>