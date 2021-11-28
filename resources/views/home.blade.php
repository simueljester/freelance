@extends('layouts.app')

@section('content')
<div class="card shadow-sm mt-3">
    <div class="card-body">
        <h4 class="text-muted">   <i class="fas fa-tachometer-alt text-info"></i>  Dashboard </h4>
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
                <div>  <i class="fas fa-cubes text-info fa-2x"></i>  </div>
                <div> <small> Groups created </small> </div>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="card shadow-sm mt-3 fadeInDown">
            <div class="card-header bg-dark"></div>
            <div class="card-body text-center">
                <div> <strong style="font-size:22px;"> {{$user_count}} </strong> </div>
                <div>  <i class="fas fa-users text-info fa-2x"></i>  </div>
                <div> <small> Users created </small> </div>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="card shadow-sm mt-3 fadeInDown">
            <div class="card-header bg-dark"></div>
            <div class="card-body text-center">
                <div> <strong style="font-size:22px;"> {{$subject_count}} </strong> </div>
                <div> <i class="fas fa-book-reader text-info fa-2x"></i>  </div>
                <div> <small> Subjects created </small> </div>
            </div>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="card shadow-sm mt-3 fadeInDown">
            <div class="card-header bg-dark"></div>
            <div class="card-body text-center">
                <div> <strong style="font-size:22px; ">  {{$question_count}}  </strong> </div>
                <div>  <i class="fas fa-question-circle text-info fa-2x"></i> </div>
                <div> <small> Questions created </small> </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-sm-8">
        <div class="card shadow-sm mt-3 fadeIn">
            <div class="card-header bg-dark text-white">
                <i class="fas fa-chart-line"></i> Login Count this week  
            </div>
            <div class="card-body">
                <canvas class="mt-3" id="myChart" height="100"></canvas>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card shadow-sm mt-3">
            <div class="card-header bg-dark text-white">
                <i class="far fa-plus-square"></i> Create Shortcut 
            </div>
            <div class="card-body">
                <a href="{{route('user-management.create')}}" class="btn btn-info btn-block text-left"> <i class="fas fa-user-plus"></i> Create New User </a>
                <a href="{{route('subjects.create')}}" class="btn btn-info btn-block text-left"> <i class="fas fa-book-medical"></i>  Create New Subject </a>
                <a href="{{route('groups.create')}}" class="btn btn-info btn-block text-left"> <i class="fas fa-plus"></i> Create New Group </a>
                <a href="{{route('question-bank.create.mcq')}}" class="btn btn-info btn-block text-left"> <i class="fas fa-plus"></i>  Create New Question (MCQ) </a>
            </div>
        </div>
    </div>
</div>


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
</style>



@include('layouts.scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.2.0/chart.min.js"></script>
<script>

var login_count = {!! json_encode($login_count) !!};
console.log(login_count);
var dates = []
var count_login = []
login_count.forEach((data) => {
    dates.push(data.date)
    count_login.push(data.count)
});

console.log(dates);
var ctx = document.getElementById('myChart').getContext('2d');
    var chart_data = {
        type: 'line',
        data: {
            labels: dates,
            datasets: [
                {
                    label: "Login Count",
                    backgroundColor: 'rgba(58, 225, 225 , 0.3)',
                    data: count_login,
                    borderWidth: 2,
                    borderColor:"rgba(58, 225, 225)",   
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
