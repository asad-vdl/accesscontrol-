<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Access Control</title>

```
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>

    body{
        background:#f4f6f9;
        overflow-x:hidden;
    }

    .sidebar{
        width:260px;
        min-height:100vh;
        background:linear-gradient(180deg,#0f172a,#1e293b);
        position:fixed;
        left:0;
        top:0;
        z-index:1000;
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
    }

    .sidebar .nav-link i{
        margin-right:10px;
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

</style>
```

</head>

<body>

<div class="sidebar">

```
<div class="brand">
    <i class="bi bi-shield-lock-fill"></i>
    Smart Access
</div>

<ul class="nav flex-column mt-3">

    <li class="nav-item">
        <a class="nav-link" href="/">
            <i class="bi bi-speedometer2"></i>
            Dashboard
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/users">
            <i class="bi bi-people-fill"></i>
            Users
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/devices">
            <i class="bi bi-cpu-fill"></i>
            Devices
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/credentials">
            <i class="bi bi-credit-card-2-front-fill"></i>
            Credentials
        </a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="/access-logs">
            <i class="bi bi-clock-history"></i>
            Access Logs
        </a>
    </li>

</ul>
```

</div>

<div class="main-content">

```
<div class="topbar d-flex justify-content-between align-items-center">

    <h4 class="mb-0">
        Access Control Management System
    </h4>

    <span class="badge bg-primary fs-6">
        Admin Panel
    </span>

</div>

<div class="content">

    @yield('content')

</div>

<div class="footer">
    Smart Access Control System © 2026
</div>
```

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
