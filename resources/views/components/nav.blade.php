<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    @foreach ($items as $item)
        {{-- هنا نستخدم Gate لفحص الصلاحية التي عرفتيها --}}
        {{-- إذا لم تكن هناك صلاحية محددة للعنصر، سيظهر للجميع، وإلا سيخضع للفحص --}}
        @if (!isset($item['ability']) || Gate::allows($item['ability']))
            <li class="nav-item">
                
           
                <a href="{{ route($item['route']) }}" class="nav-link {{ Route::is($item['active']) ? 'active' : '' }}">
                  
                    <p>
                        {{ __($item['title']) }}
                           <i class="material-icons">{{$item['icon']}}</i>
                        @if (isset($item['badge']))
                            <span class="right badge badge-danger">{{ __($item['badge']) }}</span>
                        @endif
                    </p>
                </a>
            </li>
        @endif
    @endforeach
  </ul>
</nav>
