<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>{{$title}}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{url('backend/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{url('backend/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css')}}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{url('backend/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{url('backend/css/style.css')}}" rel="stylesheet">
    <link href="{{url('backend/css/datatable.css')}}" rel="stylesheet">


    <script src="{{url('backend/js/jquery341.js')}}"></script>
    <script src="{{url('backend/js/parsley.js')}}"></script>

</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="/doctor" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-primary"><i class="fa fa-hashtag me-2"></i>SHREEHARI</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="{{url('backend/img/logo_1.png')}}" alt="D" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">{{session('dname')}}</h6>
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="{{url('doctor/dashboard')}}" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                    {{-- <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Doctors</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{url('doctor/adddoctor')}}" class="dropdown-item">Add New Doctor</a>
                            <a href="{{url('doctor/alldoctor')}}" class="dropdown-item">All Doctors</a>
                        </div>
                    </div> --}}
                    <a href="{{url('doctor/alldoctor')}}" class="nav-item nav-link"><i class='fas fa-users me-2'></i>Doctors</a>

                    <a href="{{url('doctor/allclinics')}}" class="nav-item nav-link"><i class='fas fa-clinic-medical me-2'></i>Clinics</a>
                    <a href="{{url('doctor/allmedicines')}}" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Medicines</a>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fas fa-notes-medical me-2"></i>Appoinments</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="{{url('doctor/pendappoinments')}}" class="nav-link dropdown-item"><i class="fas fa-book-reader me-2"></i>Pending Appoinments</a>
                            <a href="{{url('doctor/allappoinments')}}" class=" nav-link dropdown-item"><i class="fas fa-calendar-check me-2"></i>Visited/Cancellation</a>
                        </div>
                    </div>

                    <a href="{{url('doctor/allservices')}}" class="nav-item nav-link"><i class="far fa-file-alt me-2"></i>Services</a>

                    <a href="{{url('doctor/allpatients')}}" class="nav-item nav-link"><i class="fas fa-users me-2"></i>Patients</a>

                    <a href="{{url('doctor/allpayments')}}" class="nav-item nav-link"><i class='fas fa-rupee-sign me-2'></i>Payments</a>


                    <a href="{{url('doctor/contactus')}}" class="nav-item nav-link"><i class='fas fa-phone-alt me-2'></i>Contact Us</a>

                    <a href="{{url('doctor/Allreports')}}" class="nav-item nav-link"><i class="fas fa-print me-2"></i>Reports</a>

                    <a href="{{url('doctor/dlogout')}}" class="nav-item nav-link"><i class="fas fa-power-off me-2"></i>Logout</a>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content ">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="/doctor" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                </a>
                <a href="" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>

                {{-- <form class="d-none d-md-flex ms-4">
                    <input class="form-control border-0 " type="search" placeholder="Search">

                </form> --}}
                <div class="navbar-nav align-items-center ms-auto">
                    {{-- <div class="nav-item dropdown"> --}}
                        {{-- <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-envelope me-lg-2"></i>
                                <span class="translate-middle badge rounded-pill bg-danger">
                                  99+
                                </span>
                            <span class="d-none d-lg-inline-flex">Message</span>
                        </a> --}}
                        {{-- <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all message</a>
                        </div> --}}
                    {{-- </div> --}}
                    {{-- <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-bell me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Notification</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Profile updated</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">New user added</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Password changed</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">See all notifications</a>
                        </div>
                    </div> --}}
                    <div class="nav-item ">
                        <a href="/doctor/dlogout" class="nav-link">
                            <i class="fas fa-power-off me-2" style="color: blue;"></i>
                            Logout
                        </a>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->
