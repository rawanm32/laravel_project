<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top library-header">
  <div class="container-fluid">
    <!-- Brand/Title -->
    <div class="navbar-wrapper">
      <div class="navbar-brand-container">
        <i class="material-icons brand-icon">local_library</i>
        <a class="navbar-brand" href="javascript:;">
          <span class="brand-text">{{ __('مكتبتي الرقمية') }}</span>
          <small class="brand-subtitle">{{ __('نظام إدارة متكامل') }}</small>
        </a>
      </div>
    </div>

    <!-- Language Selector -->
 <div class="p-3" style="max-width: 200px;">
    <select class="form-select form-select-sm" onchange="window.location.href=this.value">
        @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            <option value="{{ LaravelLocalization::getLocalizedURL($localeCode) }}" 
                    @selected($localeCode == App::currentLocale())>
                {{ $properties['native'] }}
            </option>
        @endforeach
    </select>
</div>

    <!-- Mobile Toggle -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" 
            aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Right Side Menu -->
    <div class="collapse navbar-collapse justify-content-end">
      
      <!-- Search Bar -->
      <form class="navbar-form search-form">
        <div class="input-group search-group">
          <input type="text" class="form-control search-input" placeholder="{{ __('ابحث عن كتاب، مؤلف...') }}">
          <button type="submit" class="btn search-btn">
            <i class="material-icons">search</i>
          </button>
        </div>
      </form>

      <!-- Navigation Icons -->
      <ul class="navbar-nav">
        
        <!-- Quick Stats -->
        <li class="nav-item dropdown stats-dropdown">
          <a class="nav-link" href="javascript:;" data-toggle="dropdown">
            <i class="material-icons">dashboard</i>
            <span class="notification-badge">{{ $stats['total_books'] ?? 0 }}</span>
            <p class="d-lg-none d-md-block">{{ __('الإحصائيات') }}</p>
          </a>
          <div class="dropdown-menu dropdown-menu-right stats-menu">
            <div class="dropdown-header">{{ __('إحصائيات سريعة') }}</div>
            <a class="dropdown-item" href="#">
              <i class="material-icons">menu_book</i>
              {{ __('كتب متاحة') }}: {{ $stats['available_books'] ?? 0 }}
            </a>
            <a class="dropdown-item" href="#">
              <i class="material-icons">people</i>
              {{ __('مستخدمين نشطين') }}: {{ $stats['total_user'] ?? 0 }}
            </a>
            <a class="dropdown-item" href="#">
              <i class="material-icons">swap_horiz</i>
              {{ __('استعارات اليوم') }}: {{ $stats['today_borrowing'] ?? 0 }}
            </a>
          </div>
        </li>

        <!-- Notifications -->
        <li class="nav-item dropdown notifications-dropdown">
          <a class="nav-link" href="javascript:;" data-toggle="dropdown">
            <i class="material-icons">notifications</i>
            <span class="notification-badge pulse">5</span>
            <p class="d-lg-none d-md-block">{{ __('التنبيهات') }}</p>
          </a>
          <div class="dropdown-menu dropdown-menu-right notifications-menu">
            <div class="dropdown-header">{{ __('الإشعارات الأخيرة') }}</div>
            <a class="dropdown-item notification-item unread" href="#">
              <div class="notification-icon book-return">
                <i class="material-icons">book</i>
              </div>
              <div class="notification-content">
                <strong>{{ __('إرجاع كتاب') }}</strong>
                <p>{{ __('تم إرجاع كتاب "البرمجة المتقدمة"') }}</p>
                <span class="time">{{ __('منذ 5 دقائق') }}</span>
              </div>
            </a>
            <a class="dropdown-item notification-item" href="#">
              <div class="notification-icon new-user">
                <i class="material-icons">person_add</i>
              </div>
              <div class="notification-content">
                <strong>{{ __('مستخدم جديد') }}</strong>
                <p>{{ __('انضم أحمد محمد إلى المكتبة') }}</p>
                <span class="time">{{ __('منذ ساعة') }}</span>
              </div>
            </a>
            <a class="dropdown-item notification-item" href="#">
              <div class="notification-icon overdue">
                <i class="material-icons">warning</i>
              </div>
              <div class="notification-content">
                <strong>{{ __('تأخير إرجاع') }}</strong>
                <p>{{ __('3 كتب متأخرة عن موعد الإرجاع') }}</p>
                <span class="time">{{ __('منذ 3 ساعات') }}</span>
              </div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item text-center view-all" href="#">
              {{ __('عرض جميع الإشعارات') }}
            </a>
          </div>
        </li>

        <!-- User Profile -->
        <li class="nav-item dropdown profile-dropdown">
          <a class="nav-link" href="javascript:;" data-toggle="dropdown">
            <div class="profile-avatar">
              <img src="{{ Auth::user()->avatar ?? asset('assets/img/default-avatar.png') }}" alt="Profile">
              <span class="status-indicator online"></span>
            </div>
            <span class="profile-name d-none d-lg-inline">{{ Auth::user()->name ?? 'المستخدم' }}</span>
            <p class="d-lg-none d-md-block">{{ __('الحساب') }}</p>
          </a>
          <div class="dropdown-menu dropdown-menu-right profile-menu">
            <div class="dropdown-header profile-info">
              <img src="{{ Auth::user()->avatar ?? asset('assets/img/default-avatar.png') }}" alt="Profile">
              <div>
                <strong>{{ Auth::user()->name ?? 'المستخدم' }}</strong>
                <span>{{ Auth::user()->email ?? 'user@example.com' }}</span>
              </div>
            </div>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">
              <i class="material-icons">person</i>
              {{ __('الملف الشخصي') }}
            </a>
            <a class="dropdown-item" href="#">
              <i class="material-icons">settings</i>
              {{ __('الإعدادات') }}
            </a>
            <a class="dropdown-item" href="#">
              <i class="material-icons">help</i>
              {{ __('المساعدة') }}
            </a>
            <div class="dropdown-divider"></div>
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button class="dropdown-item logout-item" type="submit">
                <i class="material-icons">exit_to_app</i>
                {{ __('تسجيل الخروج') }}
              </button>
            </form>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>

<style>
/* Enhanced Header Styling */
.library-header {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15) !important;
  backdrop-filter: blur(10px);
  padding: 10px 0 !important;
}

/* Brand Section */
.navbar-brand-container {
  display: flex;
  align-items: center;
  gap: 12px;
}

.brand-icon {
  font-size: 32px;
  color: #ffd700;
  animation: float 3s ease-in-out infinite;
}

@keyframes float {
  0%, 100% { transform: translateY(0px); }
  50% { transform: translateY(-5px); }
}

.navbar-brand {
  display: flex;
  flex-direction: column;
  color: #fff !important;
  text-decoration: none;
  padding: 0;
}

.brand-text {
  font-size: 20px;
  font-weight: 700;
  letter-spacing: 0.5px;
  text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
}

.brand-subtitle {
  font-size: 11px;
  color: rgba(255, 255, 255, 0.8);
  font-weight: 400;
}

/* Language Selector */
.language-selector {
  margin: 0 15px;
}

.language-select {
  background: rgba(255, 255, 255, 0.15);
  border: 1px solid rgba(255, 255, 255, 0.3);
  color: #fff;
  padding: 8px 15px;
  border-radius: 8px;
  font-size: 13px;
  cursor: pointer;
  transition: all 0.3s ease;
  backdrop-filter: blur(10px);
}

.language-select:hover {
  background: rgba(255, 255, 255, 0.25);
  border-color: rgba(255, 255, 255, 0.5);
}

.language-select option {
  background: #667eea;
  color: #fff;
}

/* Search Bar */
.search-form {
  margin: 0 20px;
}

.search-group {
  background: rgba(255, 255, 255, 0.15);
  border-radius: 25px;
  overflow: hidden;
  border: 1px solid rgba(255, 255, 255, 0.3);
  transition: all 0.3s ease;
  backdrop-filter: blur(10px);
}

.search-group:focus-within {
  background: rgba(255, 255, 255, 0.25);
  border-color: rgba(255, 255, 255, 0.5);
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

.search-input {
  background: transparent !important;
  border: none !important;
  color: #fff !important;
  padding: 10px 20px !important;
  font-size: 14px;
}

.search-input::placeholder {
  color: rgba(255, 255, 255, 0.7);
}

.search-btn {
  background: transparent;
  border: none;
  color: #fff;
  padding: 5px 15px;
  transition: all 0.3s ease;
}

.search-btn:hover {
  background: rgba(255, 255, 255, 0.2);
  transform: scale(1.1);
}

/* Navigation Items */
.navbar-nav .nav-item {
  margin: 0 5px;
}

.navbar-nav .nav-link {
  color: rgba(255, 255, 255, 0.9) !important;
  padding: 10px 15px;
  border-radius: 10px;
  transition: all 0.3s ease;
  position: relative;
  display: flex;
  align-items: center;
  gap: 8px;
}

.navbar-nav .nav-link:hover {
  background: rgba(255, 255, 255, 0.15);
  transform: translateY(-2px);
}

.navbar-nav .nav-link i {
  font-size: 24px;
}

/* Notification Badge */
.notification-badge {
  position: absolute;
  top: 8px;
  right: 8px;
  background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
  color: #fff;
  border-radius: 10px;
  padding: 2px 6px;
  font-size: 10px;
  font-weight: 700;
  min-width: 18px;
  text-align: center;
  box-shadow: 0 2px 8px rgba(245, 87, 108, 0.5);
}

.notification-badge.pulse {
  animation: pulse 2s infinite;
}

@keyframes pulse {
  0%, 100% {
    transform: scale(1);
    box-shadow: 0 2px 8px rgba(245, 87, 108, 0.5);
  }
  50% {
    transform: scale(1.1);
    box-shadow: 0 2px 15px rgba(245, 87, 108, 0.8);
  }
}

/* Dropdown Menus */
.dropdown-menu {
  background: #fff;
  border: none;
  border-radius: 15px;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
  margin-top: 10px;
  padding: 0;
  min-width: 300px;
  animation: dropdownSlide 0.3s ease;
}

@keyframes dropdownSlide {
  from {
    opacity: 0;
    transform: translateY(-10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.dropdown-header {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  color: #fff;
  padding: 15px 20px;
  font-weight: 700;
  font-size: 14px;
  border-radius: 15px 15px 0 0;
}

.dropdown-item {
  padding: 12px 20px;
  color: #333;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  gap: 12px;
}

.dropdown-item:hover {
  background: linear-gradient(90deg, rgba(102, 126, 234, 0.1), transparent);
  color: #667eea;
  transform: translateX(-5px);
}

.dropdown-item i {
  color: #667eea;
  font-size: 20px;
}

/* Stats Dropdown */
.stats-menu .dropdown-item {
  font-size: 13px;
}

/* Notifications Dropdown */
.notifications-menu {
  min-width: 350px;
  max-height: 450px;
  overflow-y: auto;
}

.notification-item {
  display: flex;
  gap: 15px;
  padding: 15px 20px !important;
  border-bottom: 1px solid #f0f0f0;
  align-items: flex-start;
}

.notification-item.unread {
  background: rgba(102, 126, 234, 0.05);
}

.notification-item:hover {
  background: rgba(102, 126, 234, 0.1);
  transform: translateX(0);
}

.notification-icon {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}

.notification-icon.book-return {
  background: linear-gradient(135deg, #667eea, #764ba2);
}

.notification-icon.new-user {
  background: linear-gradient(135deg, #f093fb, #f5576c);
}

.notification-icon.overdue {
  background: linear-gradient(135deg, #ffa726, #ff6f00);
}

.notification-icon i {
  color: #fff;
  font-size: 20px;
}

.notification-content {
  flex: 1;
}

.notification-content strong {
  display: block;
  color: #333;
  font-size: 14px;
  margin-bottom: 4px;
}

.notification-content p {
  margin: 0;
  color: #666;
  font-size: 13px;
  line-height: 1.4;
}

.notification-content .time {
  display: block;
  color: #999;
  font-size: 11px;
  margin-top: 4px;
}

.view-all {
  color: #667eea !important;
  font-weight: 600;
  justify-content: center;
  padding: 15px !important;
}

/* Profile Dropdown */
.profile-avatar {
  position: relative;
  display: inline-block;
}

.profile-avatar img {
  width: 38px;
  height: 38px;
  border-radius: 50%;
  border: 2px solid rgba(255, 255, 255, 0.5);
  object-fit: cover;
}

.status-indicator {
  position: absolute;
  bottom: 0;
  right: 0;
  width: 10px;
  height: 10px;
  border-radius: 50%;
  border: 2px solid #667eea;
}

.status-indicator.online {
  background: #4caf50;
}

.profile-name {
  color: #fff;
  font-size: 14px;
  font-weight: 500;
  margin-right: 8px;
}

.profile-info {
  display: flex;
  gap: 15px;
  align-items: center;
  padding: 20px !important;
}

.profile-info img {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  border: 3px solid #fff;
}

.profile-info strong {
  display: block;
  color: #fff;
  font-size: 15px;
  margin-bottom: 3px;
}

.profile-info span {
  display: block;
  color: rgba(255, 255, 255, 0.9);
  font-size: 12px;
}

.logout-item {
  color: #f5576c !important;
  font-weight: 600;
  border: none;
  background: transparent;
  width: 100%;
  text-align: right;
}

.logout-item:hover {
  background: rgba(245, 87, 108, 0.1) !important;
  color: #f5576c !important;
}

/* Mobile Toggle */
.navbar-toggler {
  border: none;
  padding: 8px;
  background: rgba(255, 255, 255, 0.15);
  border-radius: 8px;
}

.navbar-toggler-icon {
  width: 25px;
  height: 2px;
  background: #fff;
  display: block;
  margin: 5px 0;
  transition: all 0.3s ease;
}

/* Responsive */
@media (max-width: 991px) {
  .search-form {
    margin: 15px 0;
  }
  
  .language-selector {
    margin: 15px 0;
  }
  
  .navbar-nav {
    padding: 15px 0;
  }
  
  .dropdown-menu {
    position: static !important;
    transform: none !important;
    width: 100%;
    margin-top: 10px;
  }
}

/* Scrollbar for notifications */
.notifications-menu::-webkit-scrollbar {
  width: 6px;
}

.notifications-menu::-webkit-scrollbar-track {
  background: #f1f1f1;
  border-radius: 10px;
}

.notifications-menu::-webkit-scrollbar-thumb {
  background: #667eea;
  border-radius: 10px;
}

.notifications-menu::-webkit-scrollbar-thumb:hover {
  background: #764ba2;
}
</style>
