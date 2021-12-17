<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/gif/png" href="{{ asset('system_info/').'/'.App\SystemInformation::whereActive(1)->first()->logo }}">
    <title> {{ App\SystemInformation::whereActive(1)->first()->title }} </title>
    @include('layouts.styles') 

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background: #081127">

            <div class="text-center m-3">
                <img  src="{{ asset('system_info/').'/'.App\SystemInformation::whereActive(1)->first()->logo }}"  style="width:100px">
                {{-- <br>
                <strong class="text-white"> {{ App\SystemInformation::whereActive(1)->first()->title }} </strong> --}}
            </div>
     

            <!-- Heading -->

            
{{--       
            <div class="text-center mt-2">
                <h6><span class="badge badge-primary p-1"> {{Auth::user()->user_instance->role->role}} </span></h6>
            </div> --}}

         
            <li class="nav-item ">
                <a class="nav-link " href="{{route('home')}}">
                    
                    @if(request()->is(['home', 'home/*']))
                        <i class="fas fa-tachometer-alt" style="color:#567bd8"></i>
                        <span class="text-white"> <strong> Dashboard </strong> </span>
                    @else
                        <i class="fas fa-tachometer-alt text-white"></i>
                        <span> Dashboard </span>
                    @endif 
                </a>
            </li>

            @if (Auth::user()->user_instance->role_id == 1)
                <li class="nav-item">
                    <a class="nav-link " href="{{route('school-management.academic-year.index')}}">
                    
                        @if(request()->is(['school-management', 'school-management/*']))
                        
                            <i class="fas fa-university" style="color:#567bd8"></i>
                            <span class="text-white"> <strong> School Management </strong> </span>
                        @else
                            <i class="fas fa-university text-white"></i>
                            <span> School Management  </span>
                        @endif 
                    </a>
                </li>
            @endif

           

            @if (Auth::user()->user_instance->role_id == 1 || Auth::user()->user_instance->role_id == 2)
            <li class="nav-item">
                <a class="nav-link" href="{{route('question-bank.index')}}">
                
                    @if(request()->is(['question-bank', 'question-bank/*']))
                        <i class="fas fa-globe" style="color:#567bd8"></i>
                        <span class="text-white"> <strong> Question Bank </strong>  </span>
                    @else
                        <i class="fas fa-globe text-white"></i>
                        <span>Question Bank</span>
                    @endif
                </a>
            </li>
            @endif

            @if (Auth::user()->user_instance->role_id == 1 || Auth::user()->user_instance->role_id == 2)
            <li class="nav-item">
                <a class="nav-link" href="{{route('groups.index')}}">
                    
                 
                    @if(request()->is(['groups', 'groups/*']))
                        <i class="fas fa-cubes" style="color:#567bd8"></i>
                        <span class="text-white"> <strong> Class </strong>  </span>
                    @else
                        <i class="fas fa-cubes text-white"></i>
                        <span>Class</span>
                    @endif
                </a>
            </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{route('groups.user-group.user-group')}}">
                        @if(request()->is(['groups', 'groups/*']))
                            <i class="fas fa-cubes" style="color:#567bd8"></i>
                            <span class="text-white"> <strong> My Class </strong>  </span>
                        @else
                            <i class="fas fa-cubes text-white"></i>
                            <span> My Class</span>
                        @endif
                    </a>
                </li>
            @endif

            {{-- @if (Auth::user()->user_instance->role_id == 1 || Auth::user()->user_instance->role_id == 2)
            <li class="nav-item">
                <a class="nav-link" href="{{route('examination.index')}}">
                    <i class="fas fa-paste text-white"></i>
                    @if(request()->is(['examination', 'examination/*']))
                        <span class="text-warning"> <strong> Examination </strong> </span>
                    @else
                        <span>Examination</span>
                    @endif
                </a>
            </li>
            @endif --}}

            @if (Auth::user()->user_instance->role_id == 1)
                <li class="nav-item" >
                    <a class="nav-link" href="{{route('user-management.index')}}">
                        @if(request()->is(['user-management', 'user-management/*']))
                            <i class="fas fa-users" style="color:#567bd8"></i>
                            <span class="text-white"> <strong> User Management </strong> </span>
                        @else
                            <i class="fas fa-users text-white"></i>
                            <span> User Management </span>
                        @endif
                    </a>
                </li>
            @endif

            @if (Auth::user()->user_instance->role_id == 1)
            <li class="nav-item" >
                <a class="nav-link" href="{{route('administrator.index')}}">
                    @if(request()->is(['administrator', 'administrator/*']))
                        <i class="fas fa-user-cog" style="color:#567bd8" ></i>
                        <span class="text-white"> <strong> Administrator </strong> </span>
                    @else
                        <i class="fas fa-user-cog text-white"></i>
                        <span> Administrator </span>
                    @endif
                </a>
            </li>
            @endif
          

         
            {{-- <li class="nav-item">
                <a class="nav-link"  href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li> --}}


        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <div class="p-3" style="background: #e0e0e0">
                <strong> <i class="fab fa-font-awesome-flag"></i> &nbsp {{App\AcademicYear::whereActive(1)->first()->name}} </strong>
                <div class="dropdown float-right mr-3">
                    <span> <i class="fas fa-user"></i> {{Auth::user()->name}} </span>
                    <div class="dropdown-content">
                        <a class="nav-link"  href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div id="content" class="p-3">
                
                <div class="row">
                    <div class="col-sm-4">
                        <div class="card shadow-sm p-1">
                            <div class="card-body border">
                                <strong> <i class="fas fa-user-circle fa-2x"></i> &nbsp {{Auth::user()->name}}  </strong> -  <span class="badge badge-primary p-1"> {{Auth::user()->user_instance->role->role}} </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card shadow-sm p-1">
                            <div class="card-body border">
                                <strong> <i class="fab fa-font-awesome-flag fa-2x"></i> &nbsp {{App\AcademicYear::whereActive(1)->first()->name}} </strong>
                            </div>
                        </div>
                    </div>
                </div>
      
        
               

                @if(session()->has('success'))
                    <div class="alert alert-success mt-3" role="alert">
                        <i class="fas fa-check-circle"></i> {{ session()->get('success') }}
                    </div>
                @endif

                @if(session()->has('error'))
                    <div class="alert alert-danger mt-3" role="alert">
                        <i class="fas fa-times-circle"></i> {{ session()->get('error') }}
                    </div>
                @endif

                @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <i class="fas fa-exclamation"></i> <strong> There are error(s) in your request  </strong> 
                    <br>  <br>  
                    @foreach ($errors->all() as $error)
                        <div> <i class="fas fa-caret-right"></i> {{$error}}  </div>
                    @endforeach
                </div>
               
                @endif
              
                @yield('content')
            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

  
 

 
    @include('layouts.scripts') 
 


</body>

</html>