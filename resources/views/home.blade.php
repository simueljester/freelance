@extends('layouts.app')

@section('content')
<div class="card shadow-sm mt-3">
    <div class="card-body">
        <h4 class="text-muted">   <i class="fas fa-tachometer-alt text-primary"></i>  Dashboard </h4>
        <small class="text-muted"> <i> Summary of contents </i>  </small>
    </div>
</div>

@if (Auth::user()->user_instance->role_id == 1)
<div class="row">
    <div class="col-sm-3">
        <div class="card shadow-sm mt-3 fadeInDown">
            <div class="card-header bg-dark"></div>
            <div class="card-body text-center">
                <div> <strong style="font-size:22px;"> {{$group_count}} </strong> </div>
                <div> <i class="fas fa-cubes text-primary"></i>  <strong> <a href="{{route('groups.index')}}"> Class Created  </a> </strong> </div>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="card shadow-sm mt-3 fadeInDown">
            <div class="card-header bg-dark"></div>
            <div class="card-body text-center">
                <div> <strong style="font-size:22px;"> {{$user_count}} </strong> </div>
                <div> <i class="fas fa-users text-primary"></i>  <strong> <a href="{{route('user-management.index')}}"> Users Created  </a> </strong> </div>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="card shadow-sm mt-3 fadeInDown">
            <div class="card-header bg-dark"></div>
            <div class="card-body text-center">
                <div> <strong style="font-size:22px;"> {{$subject_count}} </strong> </div>
                <div> <i class="fas fa-book-reader text-primary"></i>  <strong> <a href="{{route('school-management.subjects.index')}}"> Course Created  </a> </strong> </div>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="card shadow-sm mt-3 fadeInDown">
            <div class="card-header bg-dark"></div>
            <div class="card-body text-center">
                <div> <strong style="font-size:22px; ">  {{$question_count}}  </strong> </div>
                <div> <i class="fas fa-question-circle text-primary"></i> <strong> <a href="{{route('question-bank.index')}}"> Questions Created  </a> </strong> </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-8">
        <div class="card shadow-sm mt-3 fadeIn">
            <div class="card-header bg-dark text-white">
                <i class="fas fa-chart-line"></i> Login Count this week   
                <i class="far fa-calendar-alt float-right" style="cursor:pointer" data-toggle="modal" data-target="#openDateFilter"></i>
            </div>
            <div class="card-body">
                <canvas class="mt-1" id="myChart" height="100"></canvas>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card shadow-sm mt-3">
            <div class="card-header bg-dark text-white">
                <i class="far fa-plus-square"></i> Create Shortcut 
            </div>
            <div class="card-body">
                <a href="{{route('user-management.create')}}" class="btn btn-primary btn-block text-left"> <i class="fas fa-user-plus"></i> Create New User </a>
                <a href="{{route('school-management.subjects.create')}}" class="btn btn-primary btn-block text-left"> <i class="fas fa-book-medical"></i>  Create New Course </a>
                <a href="{{route('school-management.sections.create')}}" class="btn btn-primary btn-block text-left"> <i class="fas fa-plus"></i> Create New Program </a>
                <a href="{{route('groups.create')}}" class="btn btn-primary btn-block text-left"> <i class="fas fa-plus"></i> Create New Class </a>
                <div class="dropdown mt-2 w-100">
                    <button class="btn btn-primary btn-block text-left"> <i class="fas fa-plus"></i>  Create New Question </button>
                    <div class="dropdown-content">
                        <a class="dropdown-item" href="{{route('question-bank.create.mcq',0)}}"> Add Multiple Choice</a>
                        <a class="dropdown-item" href="{{route('question-bank.create.tf',0)}}"> Add True or False</a>
                        <a class="dropdown-item" href="{{route('question-bank.create.sa',0)}}"> Add Identification </a>
                        <a class="dropdown-item" href="{{route('question-bank.create.essay',0)}}"> Add Essay </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<form action="">
    <div class="modal fade" id="openDateFilter" tabindex="-1" role="dialog" >
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"> Filter Date </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                  <span> Select date </span>
                  <input type="date" name="date" id="date" class="form-control" value="{{$date ?? Carbon\Carbon::now()->format('Y-m-d')}}" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary btn-sm"> Filter Dates </button>
            </div>
          </div>
        </div>
      </div>
</form>


@endif



<style>
.fadeInDown {
  -webkit-animation-name: fadeInDown;
  animation-name: fadeInDown;
  -webkit-animation-duration: 1s;
  animation-duration: 1s;
  -webkit-animation-fill-mode: both;
  animation-fill-mode: both;
  }
  @-webkit-keyframes fadeInDown {
  0% {
  opacity: 0;
  -webkit-transform: translate3d(0, -100%, 0);
  transform: translate3d(0, -100%, 0);
  }
  100% {
  opacity: 1;
  -webkit-transform: none;
  transform: none;
  }
  }
  @keyframes fadeInDown {
  0% {
  opacity: 0;
  -webkit-transform: translate3d(0, -100%, 0);
  transform: translate3d(0, -100%, 0);
  }
  100% {
  opacity: 1;
  -webkit-transform: none;
  transform: none;
  }
  } 


  .fadeIn {
  -webkit-animation-name: fadeIn;
  animation-name: fadeIn;
  -webkit-animation-duration: 1s;
  animation-duration: 1s;
  -webkit-animation-fill-mode: both;
  animation-fill-mode: both;
  }
  @-webkit-keyframes fadeIn {
  0% {opacity: 0;}
  100% {opacity: 1;}
  }
  @keyframes fadeIn {
  0% {opacity: 0;}
  100% {opacity: 1;}
  } 

  .dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  padding: 12px 16px;
  z-index: 1;
}

.dropdown:hover .dropdown-content {
  display: block;
}
</style>



@include('layouts.scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.2.0/chart.min.js"></script>
<script>

var login_count = {!! json_encode($login_count) !!};

var dates = []
var count_login = []
login_count.forEach((data) => {
    dates.push(data.date)
    count_login.push(data.count)
});

var ctx = document.getElementById('myChart').getContext('2d');
    var chart_data = {
        type: 'line',
        data: {
            labels: dates,
            datasets: [
                {
                    label: "Login Count",
                    backgroundColor: '#567bd8',
                    data: count_login,
                    borderWidth: 2,
                    borderColor:"#567bd8",   
                }
            ]
        },
        options: { 
            scales: {
                y: {
                    beginAtZero: true,
                    max: 50,     
                }
            },
          
        }
    }
    var myChart = new Chart(ctx, chart_data);
</script>

@endsection
