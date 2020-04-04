<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}/img/sidebar-1.jpg">
{{--  data-color="purple | azure | green | orange | danger"  --}}
  <div class="logo">
    <a href="#" class="simple-text logo-normal">
      {{ __('Inventory System') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Dashboard') }}</p>
        </a>
      </li>
      <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'user-management') ? ' active' : '' }}">
        <a class="nav-link " data-toggle="collapse" href="#users-menu" aria-expanded="false">
          <i>{{--  <img style="width:25px" src="{{ asset('material') }}/img/laravel.svg">  --}}</i>
          <p>{{ __('Users') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse" id="users-menu">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('profile.edit') }}">
                <span class="sidebar-mini"> UP </span>
                <span class="sidebar-normal">{{ __('User profile') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('user.index') }}">
                <span class="sidebar-mini"> UM </span>
                <span class="sidebar-normal"> {{ __('User Management') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'movements-reports') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#movements-menu" aria-expanded="true">
          <i>{{--  <img style="width:25px" src="{{ asset('material') }}/img/laravel.svg">  --}}</i>
          <p>{{ __('Movements') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse show" id="movements-menu">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'movements' ? ' active' : '' }}">
              <a class="nav-link" href="{{ url('movements/index') }}">
                <span class="sidebar-mini"> MM </span>
                <span class="sidebar-normal"> {{ __('Movements Management') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'movements-reports' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('movements.reports') }}">
                <span class="sidebar-mini"> MR </span>
                <span class="sidebar-normal"> {{ __('Movements Reports') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
     
      <li class="nav-item{{ $activePage == 'products' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('products.index') }}">
          <i class="material-icons">library_books</i>
            <p>{{ __('Products') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'companies' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('companies.index') }}">
          <i class="material-icons">bubble_chart</i>
          <p>{{ __('Companies') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'supervisors' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('supervisors.index') }}">
          <i class="material-icons">content_paste</i>
            <p>{{ __('Supervisors') }}</p>
        </a>
      </li>

    </ul>
  </div>
</div>