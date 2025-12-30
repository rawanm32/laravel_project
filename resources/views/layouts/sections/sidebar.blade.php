<ul class="nav">
  <!-- Dashboard -->
  

  <!-- Books Section -->
 
  <!-- Categories -->
 
  <!-- Authors -->


  <!-- Users -->
  
  <!-- Borrowing -->
 

  <!-- Reports -->
  <x-nav />



  <!-- Divider -->
  <li class="nav-divider"></li>

  <!-- Logout Button -->
  <li class="nav-item logout-item">
    <form action="{{ route('logout') }}" method="POST" class="logout-form">
      @csrf
      <button class="nav-link logout-btn" type="submit">
        <i class="material-icons">exit_to_app</i>
        <p>{{ __('تسجيل الخروج') }}</p>
      </button>
    </form>
  </li>
</ul>
 
<style>
/* Enhanced Sidebar Styling */
.sidebar {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
  overflow: visible !important;
}

.sidebar .logo {
  background: rgba(255, 255, 255, 0.1);
  backdrop-filter: blur(10px);
  padding: 20px;
  text-align: center;
  border-bottom: 1px solid rgba(255, 255, 255, 0.2);
}

.sidebar .logo a {
  color: #fff;
  font-size: 22px;
  font-weight: 700;
  letter-spacing: 1px;
  text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
}

.sidebar .nav {
  margin-top: 20px;
  padding: 0 15px;
}

.sidebar .nav-item {
  margin-bottom: 5px;
  position: relative;
  transition: all 0.3s ease;
}

.sidebar .nav-link {
  display: flex;
  align-items: center;
  padding: 12px 20px;
  color: rgba(255, 255, 255, 0.8);
  border-radius: 12px;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  position: relative;
  overflow: hidden;
  background: transparent;
  text-decoration: none;
}

.sidebar .nav-link::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
  transition: left 0.5s;
}

.sidebar .nav-link:hover::before {
  left: 100%;
}

.sidebar .nav-link:hover {
  background: rgba(255, 255, 255, 0.15);
  color: #fff;
  transform: translateX(8px);
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

.sidebar .nav-item.active .nav-link {
  background: linear-gradient(135deg, rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.1));
  color: #fff;
  box-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
  border-left: 4px solid #ffd700;
}

.sidebar .nav-link i {
  margin-left: 15px;
  font-size: 24px;
  transition: all 0.3s ease;
}

.sidebar .nav-link:hover i {
  transform: scale(1.2) rotate(10deg);
}

.sidebar .nav-link p {
  margin: 0;
  font-size: 14px;
  font-weight: 500;
  letter-spacing: 0.5px;
}

/* Divider */
.nav-divider {
  height: 1px;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
  margin: 20px 0;
}

/* Logout Styling */
.logout-item {
  margin-top: 20px;
}

.logout-form {
  width: 100%;
  margin: 0;
  padding: 0;
}

.logout-btn {
  width: 100%;
  border: none;
  background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
  cursor: pointer;
  text-align: right;
  display: flex;
  align-items: center;
}

.logout-btn:hover {
  background: linear-gradient(135deg, #f5576c 0%, #f093fb 100%);
  transform: translateX(8px) scale(1.02);
}

/* Responsive */
@media (max-width: 991px) {
  .sidebar {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  }
}

/* Scrollbar Styling */
.sidebar-wrapper::-webkit-scrollbar {
  width: 6px;
}

.sidebar-wrapper::-webkit-scrollbar-track {
  background: rgba(255, 255, 255, 0.1);
  border-radius: 10px;
}

.sidebar-wrapper::-webkit-scrollbar-thumb {
  background: rgba(255, 255, 255, 0.3);
  border-radius: 10px;
}

.sidebar-wrapper::-webkit-scrollbar-thumb:hover {
  background: rgba(255, 255, 255, 0.5);
}

/* Animation for items */
@keyframes slideIn {
  from {
    opacity: 0;
    transform: translateX(-20px);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

.sidebar .nav-item {
  animation: slideIn 0.5s ease forwards;
}

.sidebar .nav-item:nth-child(1) { animation-delay: 0.1s; }
.sidebar .nav-item:nth-child(2) { animation-delay: 0.2s; }
.sidebar .nav-item:nth-child(3) { animation-delay: 0.3s; }
.sidebar .nav-item:nth-child(4) { animation-delay: 0.4s; }
.sidebar .nav-item:nth-child(5) { animation-delay: 0.5s; }
.sidebar .nav-item:nth-child(6) { animation-delay: 0.6s; }
.sidebar .nav-item:nth-child(7) { animation-delay: 0.7s; }
.sidebar .nav-item:nth-child(8) { animation-delay: 0.8s; }
</style>