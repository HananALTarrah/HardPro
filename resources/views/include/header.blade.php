<!-- الهيدر هنا سأضمنه في صفحة ال
     layout -->



<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">{{config('app.name')}}</a>

    <!-- لتغيير اسم التطبيق في أعلى اليسار ليصبح من
  "laravel"
إلى 
"My app"
عن طريق 
config ->app.php ->name ->.env
ثم نغير الاسم في ملف الاخير -->

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <!-- عن طريق هذه التنسيقات نضع اسم المستخدم عاليسار 
       me-auto mb-2 mb-lg-0 -->
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        @auth
          <li class="nav-item">
            <a class="nav-link" href="{{route('logout')}}">Logout</a>
          </li>
        @else
          <li class="nav-item">
            <a class="nav-link" href="{{route('login')}}">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('register')}}">Registration</a>
          </li>
        @endauth
        
      </ul>
      <span class="navbar-text">

        @auth
      {{auth()->user()->name}}
        @endauth
        <!-- يتم عرض معلومات عن المستخدم(اسمه مثلا) في أعلى اليمين 
        و ذلك بعد أن يقوم بتسجيل الدخول
       يعني @auth و @endauth -->
      </span>
    </div>
  </div>
</nav>