<div class="sidebar" id="sidebar">
    <nav class="sidebar__content">
        <div class="sidebar__user-block">
            <a class="sidebar__logo" href="{{ url('/') }}">
                <span class="sidebar__logo-icon logo-icon"></span>
                <span class="sidebar__logo-name">EleCRM</span>
            </a>
            @foreach($menu['userBlock'] as $userMenuItem)
                <a href="{{ route($userMenuItem['route']) }}"
                   class="sidebar__link @if($userMenuItem['active']) sidebar__link_active @endif">
                    <i class="sidebar__icon bx {{ $userMenuItem['boxIconClass'] }}"></i>
                    <span class="nav_name">{{ $userMenuItem['title'] }}</span>
                </a>
            @endforeach
        </div>
        <div class="sidebar__admin-block">
            @can('viewAny', App\Models\User::class)
                @foreach($menu['adminBlock'] as $adminMenuItem)
                    <a href="{{ route($adminMenuItem['route']) }}"
                       class="sidebar__link @if($adminMenuItem['active']) sidebar__link_active @endif">
                        <i class="sidebar__icon bx {{ $adminMenuItem['boxIconClass'] }}"></i>
                        <span class="nav_name">{{ $adminMenuItem['title'] }}</span>
                    </a>
                @endforeach
            @endcan
        </div>
    </nav>
</div>
