
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>

    {{ $setting->company_name ?? 'Smart Access Control' }}

</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>

        body{
            background:#f4f6f9;
            overflow-x:hidden;
        }

       .sidebar{
    width:260px;
    height:100vh;
    background:linear-gradient(180deg,#0f172a,#1e293b);
    position:fixed;
    left:0;
    top:0;
    display:flex;
    flex-direction:column;
    z-index:1000;
    overflow-y:auto;
    overflow-x:hidden;
}
        .brand{
            color:#fff;
            font-size:22px;
            font-weight:700;
            padding:20px;
            border-bottom:1px solid rgba(255,255,255,.1);
        }

        .sidebar .nav-link{
            color:#cbd5e1;
            padding:12px 20px;
            margin:4px 10px;
            border-radius:10px;
            transition:.3s;
        }

        .sidebar .nav-link:hover{
            background:#2563eb;
            color:#fff;
            transform:translateX(4px);
        }

        .sidebar .nav-link i{
            margin-right:10px;
        }

        .logout-area{
            margin-top:auto;
            padding:20px;
            border-top:1px solid rgba(255,255,255,.1);
        }

        .logout-btn{
            background:#16a34a;
            border:none;
            color:#fff;
            border-radius:10px;
            padding:10px;
            font-weight:600;
            transition:.3s;
        }

        .logout-btn:hover{
            background:#15803d;
            color:#fff;
        }

        .main-content{
            margin-left:260px;
        }

        .topbar{
            background:#fff;
            padding:15px 25px;
            box-shadow:0 2px 10px rgba(0,0,0,.08);
        }

        .content{
            padding:25px;
        }

        .card{
            border:none;
            border-radius:15px;
            box-shadow:0 3px 12px rgba(0,0,0,.08);
        }

        .footer{
            text-align:center;
            padding:15px;
            color:#6c757d;
        }

        .sidebar .nav-link.active{

    background:#2563eb;

    color:#fff;

    transform:translateX(4px);

    box-shadow:0 5px 15px rgba(37,99,235,.3);

}
.brand h5{
    color:#6c757d;
    font-size:20px;
    font-weight:700;
}
    </style>

</head>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<body>

<div class="sidebar">

   <div class="brand text-center py-3">

   @if($setting && $setting->company_logo)

    <img src="{{ asset('storage/'.$setting->company_logo) }}"
         class="rounded-circle brand-logo-border shadow-sm mb-2"
         style="width:70px;height:70px;object-fit:cover;">

@else

    <div class="rounded-circle bg-white d-inline-flex align-items-center justify-content-center shadow-sm mb-2 brand-logo-border"
         style="width:70px;height:70px;">

        <i class="bi bi-shield-lock-fill text-primary"
           style="font-size:32px;"></i>

    </div>

@endif
    <h5 class="fw-bold mb-0">

    {{ $setting->company_name ?? 'Smart Access Control' }}

</h5>

</div>

    <ul class="nav flex-column mt-3">

        <li class="nav-item">
            <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">
                <i class="bi bi-speedometer2"></i>
                Dashboard
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->is('users*') ? 'active' : '' }}" href="/users">
                <i class="bi bi-people-fill"></i>
                Users
            </a>
        </li>

        <li class="nav-item">
           <a class="nav-link {{ request()->is('devices*') ? 'active' : '' }}" href="/devices">
                <i class="bi bi-cpu-fill"></i>
                Devices
            </a>
        </li>

        <li class="nav-item">
    <a class="nav-link {{ request()->is('gates*') ? 'active' : '' }}" href="/gates">
        <i class="bi bi-door-open-fill"></i>
        Gates
    </a>
</li>

        <li class="nav-item">
            <a class="nav-link {{ request()->is('credentials*') ? 'active' : '' }}" href="/credentials">
                <i class="bi bi-credit-card-2-front-fill"></i>
                Credentials
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->is('access-logs*') ? 'active' : '' }}" href="/access-logs">
                <i class="bi bi-clock-history"></i>
                Access Logs
            </a>
        </li>

        <li class="nav-item">

    <a href="{{ route('reports.index') }}"
       class="nav-link {{ request()->routeIs('reports.*') ? 'active' : '' }}">

        <i class="bi bi-bar-chart-line me-2"></i>

        Reports

    </a>

</li>

<li class="nav-item">

    <a href="{{ route('settings.index') }}"
       class="nav-link {{ request()->routeIs('settings.*') ? 'active' : '' }}">

        <i class="bi bi-gear-fill me-2"></i>

        Settings

    </a>

</li>

    </ul>

    <div class="logout-area">

        <form action="{{ route('logout') }}" method="POST">

            @csrf

            <button type="submit" class="btn logout-btn w-100">

                <i class="bi bi-box-arrow-right"></i>

                Logout

            </button>

        </form>

    </div>

</div>

<div class="main-content">

    <div class="topbar d-flex justify-content-between align-items-center">

        <h4 class="mb-0">
            Smart Access Control
        </h4>

        <a href="{{ route('access.terminal') }}" class="btn">

    🚪 Access Terminal

</a>

      <a href="{{ route('profile.edit') }}"
   class="btn btn-light d-flex align-items-center gap-2 border shadow-sm">

    @if(auth()->user()->photo)

        <img
            src="{{ asset('storage/' . auth()->user()->photo) }}"
            alt="Profile"
            width="38"
            height="38"
            class="rounded-circle"
            style="object-fit: cover;">

    @else

        <img
            src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=0D6EFD&color=fff"
            alt="Profile"
            width="38"
            height="38"
            class="rounded-circle">

    @endif

    <div class="text-start">

        <div class="fw-bold text-dark">

            {{ auth()->user()->name }}

        </div>

        <small class="text-muted">

            {{ ucfirst(auth()->user()->role) }}

        </small>

    </div>

</a>

    </div>

    <div class="content">

        @yield('content')

    </div>

    <div class="footer">

        {{ $setting->company_name ?? 'Smart Access Control' }} System © {{ date('Y') }}

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

