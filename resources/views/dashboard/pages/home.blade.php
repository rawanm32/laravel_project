@extends('layouts.dashboard')

@section('title')
{{__('dashboard')}}
@endsection

@section('content')
<div class="content magical-dashboard">
  <div class="container-fluid">
    
    <!-- Welcome Section -->
    <div class="row mb-4">
      <div class="col-12">
        <div class="welcome-card">
          <div class="welcome-content">
            <div class="welcome-text">
              <h1 class="welcome-title"> {{_('welcome')}}! {{ Auth::user()->name ?? 'المدير' }} 👋</h1>
           
            </div>
            <div class="welcome-date">
              <div class="date-info">
                <i class="material-icons">event</i>
                <span>{{ now()->translatedFormat('l, d F Y') }}</span>
              </div>
              <div class="time-info" id="currentTime">
                <i class="material-icons">access_time</i>
                <span>--:--:--</span>
              </div>
            </div>
          </div>
          <div class="welcome-decoration">
            <div class="floating-book">📚</div>
            <div class="floating-star">⭐</div>
            <div class="floating-lamp">💡</div>
          </div>
        </div>
      </div>
    </div>

    <!-- Statistics Cards Row -->
    <div class="row stats-row">
      <!-- Total Users -->
      <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
        <div class="stat-card stat-card-purple">
          <div class="stat-icon">
            <div class="icon-wrapper purple-gradient">
              <i class="material-icons">people</i>
            </div>
            <div class="stat-badge">+12%</div>
          </div>
          <div class="stat-info">
            <p class="stat-label"> {{__('Total')}} {{__('Users')}}</p>
            <h3 class="stat-value" data-value="{{ $stats['total_user'] }}">0</h3>
            <div class="stat-trend">
         
       
            </div>
          </div>
          <div class="card-shine"></div>
        </div>
      </div>

      <!-- Total Categories -->
      <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
        <div class="stat-card stat-card-blue">
          <div class="stat-icon">
            <div class="icon-wrapper blue-gradient">
              <i class="material-icons">category</i>
            </div>
            <div class="stat-badge">+8%</div>
          </div>
          <div class="stat-info">
            <p class="stat-label"> {{__('Total')}} {{__('categories')}}</p>
            <h3 class="stat-value" data-value="{{ $stats['total_categories'] }}">0</h3>
            <div class="stat-trend">
          
            </div>
          </div>
          <div class="card-shine"></div>
        </div>
      </div>

      <!-- Total Books -->
      <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
        <div class="stat-card stat-card-orange">
          <div class="stat-icon">
            <div class="icon-wrapper orange-gradient">
              <i class="material-icons">menu_book</i>
            </div>
            <div class="stat-badge">+24%</div>
          </div>
          <div class="stat-info">
            <p class="stat-label">{{__('Total')}} {{__('Books')}}</p>
            <h3 class="stat-value" data-value="{{ $stats['total_books'] }}">0</h3>
            <div class="stat-trend">
           
             
            </div>
          </div>
          <div class="card-shine"></div>
        </div>
      </div>

      <!-- Total Authors -->
      <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
        <div class="stat-card stat-card-green">
          <div class="stat-icon">
            <div class="icon-wrapper green-gradient">
              <i class="material-icons">person_outline</i>
            </div>
            <div class="stat-badge">+5%</div>
          </div>
          <div class="stat-info">
            <p class="stat-label">{{__('Active')}} {{__('Authors')}}</p>
            <h3 class="stat-value" data-value="{{ $stats['total_authors'] }}">0</h3>
            <div class="stat-trend">
            
            </div>
          </div>
          <div class="card-shine"></div>
        </div>
      </div>
    </div>

    <!-- Charts and Details Row -->
    <div class="row">
      <!-- Available Books Chart -->
      <div class="col-md-4 mb-4">
        <div class="chart-card">
          <div class="chart-header">
            <div class="chart-icon green-gradient">
              <i class="material-icons">book</i>
            </div>
            <div class="chart-title-section">
              <h4 class="chart-title">{{__('Books')}}</h4>
           
            </div>
          </div>
          <div class="chart-body">
            <div class="chart-visual" id="booksChart">
              <div class="circular-progress">
                <svg class="progress-ring" width="200" height="200">
                  <circle class="progress-ring-circle-bg" cx="100" cy="100" r="80"></circle>
                  <circle class="progress-ring-circle" cx="100" cy="100" r="80"></circle>
                </svg>
                <div class="progress-text">
                  <span class="progress-value">{{ $stats['available_books'] }}</span>
                  <span class="progress-label">كتاب</span>
                </div>
              </div>
            </div>
            <div class="chart-footer">
              <div class="chart-detail">
                {{-- <span class="detail-label">متاح</span>
                <span class="detail-value green">{{ $stats['available_books'] }}</span>
              </div>
              <div class="chart-detail">
                <span class="detail-label">مستعار</span>
                <span class="detail-value orange">{{ $stats['total_books'] - $stats['available_books'] }}</span> --}}
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Active Categories Chart -->
      <div class="col-md-4 mb-4">
        <div class="chart-card">
          <div class="chart-header">
            <div class="chart-icon blue-gradient">
              <i class="material-icons">dashboard</i>
            </div>
            <div class="chart-title-section">
            
              <p class="chart-subtitle"> {{__('Active')}}{{__('categories')}}</p>
            </div>
          </div>
          <div class="chart-body">
            <div class="chart-visual" id="categoriesChart">
            
              <div class="chart-number">
                <span class="big-number">{{ $stats['active_categories'] }}</span>
                <span class="number-label">{{__('Active')}} {{_('Category')}}</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Authors Info -->
      <div class="col-md-4 mb-4">
        <div class="chart-card">
          <div class="chart-header">
            <div class="chart-icon purple-gradient">
              <i class="material-icons">people_outline</i>
            </div>
            <div class="chart-title-section">
              <h4 class="chart-title">{{__('Authors')}}</h4>
            
            </div>
          </div>
          <div class="chart-body">
            <div class="authors-grid">
              <div class="author-stat">
                <div class="author-icon">
                  <i class="material-icons">star</i>
                </div>
                <div class="author-info">
                  <span class="author-number">{{ $stats['total_authors'] }}</span>
                  <span class="author-label">{{__('Total')}}{{__('Authors')}}</span>
                </div>
              </div>
              <div class="author-stat">
                <div class="author-icon">
                  <i class="material-icons">verified</i>
                </div>
                <div class="author-info">
                  <span class="author-number">{{ floor($stats['total_authors'] * 0.8) }}</span>
                  <span class="author-label">{{__('Author')}}</span>
                </div>
              </div>
              <div class="author-stat">
                <div class="author-icon">
                  <i class="material-icons">library_books</i>
                </div>
                <div class="author-info">
                  <span class="author-number">{{ floor($stats['total_books'] / max($stats['total_authors'], 1)) }}</span>
                  <span class="author-label">{{__('Total')}} {{__('Books')}} </span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Quick Actions Row -->
    <div class="row">
      <div class="col-12">
        <div class="quick-actions-card">
          <div class="actions-header">
            <h4 class="actions-title">
              <i class="material-icons">flash_on</i>
             {{__('Actions')}}
            </h4>
          </div>
          <div class="actions-grid">
            <a href="{{ route('dashboard.books.create') }}" class="action-item">
              <div class="action-icon blue-gradient">
                <i class="material-icons">add</i>
              </div>
              <span class="action-label">{{__('Add')}} {{__('book')}}</span>
            </a>
            <a href="{{ route('dashboard.categories.create') }}" class="action-item">
              <div class="action-icon purple-gradient">
                <i class="material-icons">create_new_folder</i>
              </div>
              <span class="action-label"> {{__('Add')}} {{__('Category')}}</span>
            </a>
            <a href="{{ route('dashboard.users.index') }}" class="action-item">
              <div class="action-icon green-gradient">
                <i class="material-icons">group_add</i>
              </div>
              <span class="action-label">{{__('Add')}} {{__('Admins')}}</span>
            </a>
            
           
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<style>
/* ============================================
   MAGICAL DASHBOARD STYLES
   ============================================ */

.magical-dashboard {
  padding: 30px 0;
  min-height: 100vh;
  background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
  position: relative;
}

/* Welcome Card */
.welcome-card {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  border-radius: 25px;
  padding: 40px;
  color: white;
  box-shadow: 0 15px 40px rgba(102, 126, 234, 0.3);
  position: relative;
  overflow: hidden;
}

.welcome-card::before {
  content: '';
  position: absolute;
  top: -50%;
  right: -50%;
  width: 200%;
  height: 200%;
  background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 1px, transparent 1px);
  background-size: 50px 50px;
  animation: movePattern 20s linear infinite;
}

@keyframes movePattern {
  0% { transform: translate(0, 0); }
  100% { transform: translate(50px, 50px); }
}

.welcome-content {
  display: flex;
  justify-content: space-between;
  align-items: center;
  position: relative;
  z-index: 1;
  flex-wrap: wrap;
  gap: 20px;
}

.welcome-title {
  font-size: 32px;
  font-weight: 800;
  margin-bottom: 10px;
  text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
}

.welcome-subtitle {
  font-size: 16px;
  opacity: 0.9;
  margin: 0;
}

.welcome-date {
  display: flex;
  gap: 20px;
  flex-wrap: wrap;
}

.date-info, .time-info {
  display: flex;
  align-items: center;
  gap: 8px;
  background: rgba(255, 255, 255, 0.15);
  padding: 10px 20px;
  border-radius: 15px;
  backdrop-filter: blur(10px);
}

.date-info i, .time-info i {
  font-size: 20px;
}

.welcome-decoration {
  position: absolute;
  top: 20px;
  left: 20px;
  z-index: 0;
}

.floating-book, .floating-star, .floating-lamp {
  position: absolute;
  font-size: 40px;
  opacity: 0.2;
  animation: float 3s ease-in-out infinite;
}

.floating-book {
  top: 20px;
  left: 20px;
}

.floating-star {
  top: 60px;
  left: 80px;
  animation-delay: 1s;
}

.floating-lamp {
  top: 10px;
  left: 140px;
  animation-delay: 2s;
}

@keyframes float {
  0%, 100% { transform: translateY(0px); }
  50% { transform: translateY(-15px); }
}

/* Statistics Cards */
.stats-row {
  margin-bottom: 30px;
}

.stat-card {
  background: white;
  border-radius: 20px;
  padding: 25px;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
  transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  position: relative;
  overflow: hidden;
  border: 1px solid rgba(0, 0, 0, 0.05);
  height: 100%;
}

.stat-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
}

.card-shine {
  position: absolute;
  top: -50%;
  left: -50%;
  width: 200%;
  height: 200%;
  background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
  transform: rotate(45deg);
  transition: all 0.6s;
  opacity: 0;
}

.stat-card:hover .card-shine {
  left: 100%;
  opacity: 1;
}

.stat-icon {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  margin-bottom: 20px;
}

.icon-wrapper {
  width: 70px;
  height: 70px;
  border-radius: 18px;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
}

.icon-wrapper i {
  font-size: 36px;
  color: white;
}

.purple-gradient {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.blue-gradient {
  background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
}

.orange-gradient {
  background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
}

.green-gradient {
  background: linear-gradient(135deg, #30cfd0 0%, #330867 100%);
}

.red-gradient {
  background: linear-gradient(135deg, #ff6b6b 0%, #ee5a6f 100%);
}

.gray-gradient {
  background: linear-gradient(135deg, #636363 0%, #a2ab58 100%);
}

.stat-badge {
  background: rgba(34, 197, 94, 0.1);
  color: #22c55e;
  padding: 5px 12px;
  border-radius: 20px;
  font-size: 12px;
  font-weight: 700;
}

.stat-label {
  font-size: 14px;
  color: #6b7280;
  margin-bottom: 10px;
  font-weight: 500;
}

.stat-value {
  font-size: 36px;
  font-weight: 800;
  color: #1f2937;
  margin-bottom: 10px;
}

.stat-trend {
  display: flex;
  align-items: center;
  gap: 5px;
  color: #22c55e;
  font-size: 13px;
}

.stat-trend i {
  font-size: 18px;
}

/* Chart Cards */
.chart-card {
  background: white;
  border-radius: 20px;
  padding: 25px;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
  height: 100%;
  transition: all 0.3s ease;
}

.chart-card:hover {
  box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
}

.chart-header {
  display: flex;
  gap: 15px;
  align-items: center;
  margin-bottom: 25px;
  padding-bottom: 20px;
  border-bottom: 2px solid #f3f4f6;
}

.chart-icon {
  width: 50px;
  height: 50px;
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.chart-icon i {
  font-size: 28px;
  color: white;
}

.chart-title {
  font-size: 18px;
  font-weight: 700;
  color: #1f2937;
  margin: 0;
}

.chart-subtitle {
  font-size: 13px;
  color: #6b7280;
  margin: 5px 0 0;
}

/* Circular Progress */
.circular-progress {
  position: relative;
  width: 200px;
  height: 200px;
  margin: 20px auto;
}

.progress-ring-circle-bg {
  stroke: #f3f4f6;
  fill: none;
  stroke-width: 12;
}

.progress-ring-circle {
  stroke: url(#gradient);
  fill: none;
  stroke-width: 12;
  stroke-linecap: round;
  transform: rotate(-90deg);
  transform-origin: center;
  stroke-dasharray: 502.4;
  stroke-dashoffset: 125.6;
  animation: progressAnimation 2s ease-out forwards;
}

@keyframes progressAnimation {
  from { stroke-dashoffset: 502.4; }
  to { stroke-dashoffset: 125.6; }
}

.progress-text {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
}

.progress-value {
  display: block;
  font-size: 42px;
  font-weight: 800;
  color: #1f2937;
}

.progress-label {
  display: block;
  font-size: 14px;
  color: #6b7280;
  margin-top: 5px;
}

/* Bar Chart */
.bar-chart {
  display: flex;
  justify-content: space-around;
  align-items: flex-end;
  height: 150px;
  gap: 10px;
  margin: 20px 0;
}

.bar-item {
  flex: 1;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: flex-end;
}

.bar-fill {
  width: 100%;
  background: linear-gradient(180deg, #4facfe 0%, #00f2fe 100%);
  border-radius: 10px 10px 0 0;
  position: relative;
  animation: barGrow 1.5s ease-out;
  box-shadow: 0 -5px 15px rgba(79, 172, 254, 0.3);
}

.bar-fill::after {
  content: attr(data-label);
  position: absolute;
  bottom: -25px;
  left: 50%;
  transform: translateX(-50%);
  font-size: 11px;
  color: #6b7280;
  white-space: nowrap;
}

@keyframes barGrow {
  from { height: 0; }
}

.chart-number {
  text-align: center;
  margin-top: 20px;
}

.big-number {
  display: block;
  font-size: 48px;
  font-weight: 800;
  background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
}

.number-label {
  display: block;
  font-size: 14px;
  color: #6b7280;
  margin-top: 5px;
}

/* Authors Grid */
.authors-grid {
  display: flex;
  flex-direction: column;
  gap: 20px;
  padding: 20px 0;
}

.author-stat {
  display: flex;
  align-items: center;
  gap: 15px;
  padding: 15px;
  background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
  border-radius: 15px;
  transition: all 0.3s ease;
}

.author-stat:hover {
  transform: translateX(-5px);
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.author-icon {
  width: 50px;
  height: 50px;
  border-radius: 12px;
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
}

.author-icon i {
  font-size: 26px;
}

.author-number {
  display: block;
  font-size: 24px;
  font-weight: 800;
  color: #1f2937;
}

.author-label {
  display: block;
  font-size: 13px;
  color: #6b7280;
}

/* Quick Actions */
.quick-actions-card {
  background: white;
  border-radius: 20px;
  padding: 30px;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
  margin-top: 20px;
}

.actions-header {
  margin-bottom: 25px;
}

.actions-title {
  font-size: 20px;
  font-weight: 700;
  color: #1f2937;
  display: flex;
  align-items: center;
  gap: 10px;
}

.actions-title i {
  color: #fbbf24;
}

.actions-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
  gap: 20px;
}

.action-item {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 12px;
  padding: 25px 15px;
  background: linear-gradient(135deg, #f9fafb 0%, #ffffff 100%);
  border-radius: 15px;
  text-decoration: none;
  transition: all 0.3s ease;
  border: 2px solid #f3f4f6;
  position: relative;
  overflow: hidden;
}

.action-item::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
  transition: left 0.5s;
}

.action-item:hover::before {
  left: 100%;
}

.action-item:hover {
  transform: translateY(-5px) scale(1.05);
  box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
  border-color: transparent;
}

.action-icon {
  width: 60px;
  height: 60px;
  border-radius: 15px;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
}

.action-icon i {
  font-size: 30px;
  color: white;
}

.action-label {
  font-size: 14px;
  font-weight: 600;
  color: #374151;
  text-align: center;
}

.chart-footer {
  display: flex;
  justify-content: space-around;
  padding-top: 20px;
  border-top: 2px solid #f3f4f6;
  margin-top: 20px;
}

.chart-detail {
  text-align: center;
}

.detail-label {
  display: block;
  font-size: 12px;
  color: #6b7280;
  margin-bottom: 5px;
}

.detail-value {
  display: block;
  font-size: 20px;
  font-weight: 700;
}

.detail-value.green {
  color: #22c55e;
}

.detail-value.orange {
  color: #f59e0b;
}

/* Responsive */
@media (max-width: 768px) {
  .welcome-title {
    font-size: 24px;
  }
  
  .stat-value {
    font-size: 28px;
  }
  
  .actions-grid {
    grid-template-columns: repeat(2, 1fr);
  }
}

/* Counter Animation */
@keyframes countUp {
  from { opacity: 0; transform: translateY(20px); }
  to { opacity: 1; transform: translateY(0); }
}

.stat-value {
  animation: countUp 0.6s ease-out;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
  // Counter Animation
  const counters = document.querySelectorAll('.stat-value');
  counters.forEach(counter => {
    const target = parseInt(counter.getAttribute('data-value'));
    const duration = 2000;
    const step = target / (duration / 16);
    let current = 0;
    
    const updateCounter = () => {
      current += step;
      if (current < target) {
        counter.textContent = Math.floor(current);
        requestAnimationFrame(updateCounter);
      } else {
        counter.textContent = target;
      }
    };
    
    updateCounter();
  });
  
  // Real-time Clock
  function updateTime() {
    const now = new Date();
    const timeString = now.toLocaleTimeString('ar-SA', { 
      hour: '2-digit', 
      minute: '2-digit', 
      second: '2-digit' 
    });
    const timeElement = document.querySelector('#currentTime span');
    if (timeElement) {
      timeElement.textContent = timeString;
    }
  }
  
  updateTime();
  setInterval(updateTime, 1000);
  
  // Add SVG Gradient for circular progress
  const svg = document.querySelector('.progress-ring');
  if (svg) {
    const defs = document.createElementNS('http://www.w3.org/2000/svg', 'defs');
    const gradient = document.createElementNS('http://www.w3.org/2000/svg', 'linearGradient');
    gradient.setAttribute('id', 'gradient');
    gradient.setAttribute('x1', '0%');
    gradient.setAttribute('y1', '0%');
    gradient.setAttribute('x2', '100%');
    gradient.setAttribute('y2', '100%');
    
    const stop1 = document.createElementNS('http://www.w3.org/2000/svg', 'stop');
    stop1.setAttribute('offset', '0%');
    stop1.setAttribute('style', 'stop-color:#30cfd0;stop-opacity:1');
    
    const stop2 = document.createElementNS('http://www.w3.org/2000/svg', 'stop');
    stop2.setAttribute('offset', '100%');
    stop2.setAttribute('style', 'stop-color:#330867;stop-opacity:1');
    
    gradient.appendChild(stop1);
    gradient.appendChild(stop2);
    defs.appendChild(gradient);
    svg.insertBefore(defs, svg.firstChild);
  }
});
</script>

@endsection
