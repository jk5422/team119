<!DOCTYPE html>
<html lang="en">
<head>

     <title>{{$title}}</title>

     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=Edge">
     <meta name="description" content="">
     <meta name="keywords" content="">
     <meta name="author" content="Tooplate">
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

     <link rel="stylesheet" href="{{url('frontend/css/bootstrap.min.css')}}">
     <link rel="stylesheet" href="{{url('frontend/css/font-awesome.min.css')}}">
     <link rel="stylesheet" href="{{url('frontend/css/animate.css')}}">
     <link rel="stylesheet" href="{{url('frontend/css/owl.carousel.css')}}">
     <link rel="stylesheet" href="{{url('frontend/css/owl.theme.default.min.css')}}">
     <link rel="stylesheet" href="{{url('/frontend/css/contact.css')}}">
     <link rel="stylesheet" href="{{url('/frontend/css/about.css')}}">
     <link rel="stylesheet" href="{{url('/frontend/css/dashboard.css')}}">
     <link rel="stylesheet" href="{{url('/frontend/css/profile.css')}}">
     <link rel="stylesheet" href="{{url('/frontend/css/datatable.css')}}">
     <link rel="stylesheet" href="{{url('/frontend/css/allapoinments.css')}}">


     <!-- MAIN CSS -->
     <link rel="stylesheet" href="{{url('frontend/css/tooplate-style.css')}}">


</head>
<body id="top" data-spy="scroll" data-target=".navbar-collapse" data-offset="50">


     <!-- HEADER -->
     <header>
          <div class="container">
               <div class="row">

                    <div class="col-md-4 col-sm-5">
                         <p><b>Welcome to shree hari clinic</b></p>
                    </div>

                    <div class="col-md-8 col-sm-7 text-align-right">
                         <span class="phone-icon"><i class="fa fa-phone"></i>
                         +91 96645 85431</span>
                         <span class="date-icon"><i class="fa fa-calendar-plus-o"></i> 9:00 AM - 08:00 PM (Mon-Sat)</span>
                         <!-- <span class="date-icon"><i class="fa fa-calendar-plus-o"></i> 9:30 AM - 01:00 PM (Sun)</span> -->
                         <span class="email-icon"><i class="fa fa-envelope-o"></i> <a href="mailto:shreehari326@gmail.com">shreehari326@gmail.com</a></span>
                    </div>

               </div>
          </div>
     </header>


     <!-- MENU -->
     <section class="navbar navbar-default navbar-static-top" role="navigation">
          <div class="container">

               <div class="navbar-header">
                    <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                         <span class="icon icon-bar"></span>
                         <span class="icon icon-bar"></span>
                         <span class="icon icon-bar"></span>
                    </button>

                    <!-- lOGO TEXT HERE -->
                    <a href="{{url('/')}}"><img src="{{url('frontend/images/logo_1-removebg-preview.png')}}" alt="SH" height="60px" width="100px"></a>
                    <!-- <a href="index.html" class="navbar-brand"><i class="fa fa-h-square"></i>ealth Center</a> -->
               </div>

               <!-- MENU LINKS -->
               <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                         <li><a href="{{url('/')}}" class="smoothScroll">Home</a></li>
                         <li><a href="{{url('/about')}}" class="smoothScroll">About Us</a></li>
                         <li><a href="{{url('/contact')}}" class="smoothScroll">Contact Us</a></li>


                              <li class="dropdown"><i class="fa fa-user-circle-o" aria-hidden="true" style="margin-top:2rem;"></i>

                                @if(!session('pname'))
                                <a class=" dropdown-toggle"
                                data-toggle="dropdown" style="margin-top:-3.5rem;">
                               SignIn
                               <span class="caret"></span>
                           </a>
                           <ul class="dropdown-menu">
                               <li><a href="{{url('login')}}">Sign In</a></li>
                               <li><a href="{{url('register')}}">Sign Up</a></li>
                           </ul>

                           @else

                           <a class=" dropdown-toggle"
                                     data-toggle="dropdown" style="margin-top:-3.5rem;">
                                    {{session('pname')}}
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="dashboard">Dashboard</a></li>
                                    <li><a href="/logout">logout</a></li>
                                </ul>

                           @endif

                            </li>

                            @if (Session('pid'))
                            <li class="appointment-btn"><a href="{{url('/appoinments-take')}}/{{Session::get('pid')}}">Make an appointment</a></li>

                            @else
                            <li class="appointment-btn"><a href="{{url('/appoinments-take')}}">Make an appointment</a></li>
                            @endif




                    </ul>
               </div>

          </div>
     </section>
