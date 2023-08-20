@extends('frontend.layouts.main')

@section('main-container')
    <!-- HOME -->
    <section id="home" class="slider" data-stellar-background-ratio="0.5">
        <div class="container">
            <div class="row">

                <div class="owl-carousel owl-theme">
                    <div class="item item-third">
                        <div class="caption">
                            <div class="col-md-offset-1 col-md-10">
                                <!-- <h3>Let's make your life happier</h3> -->
                                <h1>Healthy Living</h1>
                                @if (Session('pid'))
                                <a href="{{url('/appoinments-take')}}/{{Session::get('pid')}}" class="section-btn btn btn-default smoothScroll">Book your appoinment
                                    today</a>

                                @else
                                <a href="{{url('appoinments-take')}}" class="section-btn btn btn-default smoothScroll">Book your appoinment
                                    today</a>
                                @endif

                            </div>
                        </div>
                    </div>

                    <div class="item item-second">
                        <div class="caption">
                            <div class="col-md-offset-1 col-md-10">

                                <h1>New Lifestyle</h1>
                                <a href="/about" class="section-btn btn btn-default btn-gray smoothScroll">More About
                                    Us</a>
                            </div>
                        </div>
                    </div>

                    <div class="item item-first">
                        <div class="caption">
                            <div class="col-md-offset-1 col-md-10">

                                <h1>Your Health Benefits</h1>
                                <a href="/contact" class="section-btn btn btn-default btn-blue smoothScroll">Contact us</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- ABOUT -->
    <section id="about">
        <div class="container">
            <div class="row">

                <div class="col-md-6 col-sm-6">
                    <div class="about-info">
                        <h2 class="wow fadeInUp" data-wow-delay="0.6s">Welcome to Shree hari clinic</h2>
                        <div class="wow fadeInUp" data-wow-delay="0.8s">
                            <p>Shree Hari Skin Care and Hair Clinic: Your One-Stop Destination for Radiant Skin and Lustrous
                                Hair.
                                Transform Your Skin and Hair with Shree Hari Skin Care and Hair Clinic's Expert Services</p>
                        </div>
                        <figure class="profile wow fadeInUp" data-wow-delay="1s">
                            <img src="{{ url('frontend/images/profile1.png') }}" class="img-responsive" alt="">
                            <figcaption>
                                <h3>Dr.Binal Desai</h3>
                                <p>B.A.M.S.MD(AM)</p>
                            </figcaption>
                        </figure>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- TEAM -->
    <section id="team" data-stellar-background-ratio="1">
        <div class="container">
            <div class="row">

                <div class="col-md-6 col-sm-6">
                    <div class="about-info">
                        <h2 class="wow fadeInUp" data-wow-delay="0.1s">Our Doctors</h2>
                    </div>
                </div>

                <div class="clearfix"></div>

                <div class="col-md-6 col-sm-6">
                    <div class="team-thumb wow fadeInUp" data-wow-delay="0.2s">
                        <img src="{{ url('frontend/images/profile1.png') }}" class="img-responsive" alt="">

                        <div class="team-info">
                            <h3>Dr.Binal Desai</h3>
                            <p>B.A.M.S.MD(AM)</p>
                            <div class="team-contact-info">
                                <p><i class="fa fa-phone"></i> +91 96645 85431</p>
                                <p><i class="fa fa-envelope-o"></i> <a href="#">binaldesai@gmail.com</a></p>
                            </div>
                            <ul class="social-icon">
                                <li><a href="https://www.facebook.com/shreehariskinnhairclinic/"
                                        class="fa fa-facebook-square"></a></li>
                                <li><a href="https://www.instagram.com/shreehariskin/" class="fa fa-instagram"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-sm-6">
                    <div class="team-thumb wow fadeInUp" data-wow-delay="0.4s">
                        <img src="{{ url('frontend/images/profile2.png') }}" class="img-responsive" alt="">

                        <div class="team-info">
                            <h3>Dr.Ghanshyam Limbasiya</h3>
                            <p>B.H.M.S(CVD)</p>
                            <div class="team-contact-info">
                                <p><i class="fa fa-phone"></i>+91 78620 35674</p>
                                <p><i class="fa fa-envelope-o"></i> <a href="#">Ghanshylimbasiya@gmail.com</a></p>
                            </div>
                            <ul class="social-icon">
                                <li><a href="https://www.facebook.com/ghanshyam.limbasiya.5?mibextid=ZbWKwL"
                                        class="fa fa-facebook-square"></a></li>
                                <li><a href="https://instagram.com/dr_limbasiya?igshid=NTc4MTIwNjQ2YQ=="
                                        class="fa fa-instagram"></a></li>
                            </ul>
                        </div>

                    </div>
                </div>


            </div>
        </div>
    </section>


    <!-- NEWS -->
    <section id="news" data-stellar-background-ratio="2.5">
        <div class="container">
            <div class="row">

                <div class="col-md-12 col-sm-12">
                    <!-- SECTION TITLE -->
                    <div class="section-title wow fadeInUp" data-wow-delay="0.1s">
                        <h2>Our Services</h2>
                    </div>
                </div>

                <div class="col-lg-3 col-md-12 col-sm-12">
                    <!-- NEWS THUMB -->
                    <div class="news-thumb wow fadeInUp" data-wow-delay="0.4s">
                        <a href="#">
                            <img src="{{ url('frontend/images/banner1.png') }}" class="img-responsive" alt="">
                        </a>

                    </div>
                </div>

                <div class="col-lg-3 col-md-12 col-sm-12">
                    <!-- NEWS THUMB -->
                    <div class="news-thumb wow fadeInUp" data-wow-delay="0.4s">
                        <a href="#">
                            <img src="{{ url('frontend/images/banner-3.jpg') }}" class="img-responsive" alt="">
                        </a>

                    </div>
                </div>

                <div class="col-lg-3 col-md-12 col-sm-12">
                    <!-- NEWS THUMB -->
                    <div class="news-thumb wow fadeInUp" data-wow-delay="0.4s">
                        <a href="#">
                            <img src="{{ url('frontend/images/hair-regrowth.jpg') }}" class="img-responsive"
                                alt="">
                        </a>

                    </div>
                </div>

                <div class="col-lg-3 col-md-12 col-sm-12">
                    <!-- NEWS THUMB -->
                    <div class="news-thumb wow fadeInUp" data-wow-delay="0.4s">
                        <a href="#">
                            <img src="{{ url('frontend/images/banner-2.jpg') }}" class="img-responsive" alt="">
                        </a>

                    </div>
                </div>

            </div>
        </div>
    </section>



    <!-- MAKE AN APPOINTMENT -->
    <section id="appointment" data-stellar-background-ratio="3">
        <div class="container">
            <div class="row">

                <div class="col-md-6 col-sm-6">
                    <img src="{{ url('frontend/images/appointment-image.jpg') }}" class="img-responsive" alt="">
                </div>

                <div class="col-md-6 col-sm-6">
                    <!-- CONTACT FORM HERE -->
                    <form id="appointment-form" role="form" method="post" action="#">

                        <!-- SECTION TITLE -->
                        <div class="section-title wow fadeInUp" data-wow-delay="0.4s">
                            <h2>We have world class laser technologies</h2>
                        </div>

                        <div id="faq" role="tablist" aria-multiselectable="true">

                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="questionOne">
                                    <h5 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#faq" href="#answerOne"
                                            aria-expanded="false" aria-controls="answerOne" style="color:peru;">
                                            Fractional CO2 Laser (india)
                                        </a>
                                    </h5>
                                </div>
                                <div id="answerOne" class="panel-collapse collapse in" role="tabpanel"
                                    aria-labelledby="questionOne">
                                    <div class="panel-body">
                                        For Acne Scar & Laser resurfacing
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="questionTwo">
                                    <h5 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#faq" href="#answerTwo"
                                            aria-expanded="false" aria-controls="answerTwo" style="color:deepskyblue;">
                                          Celina MNRF (Korea)
                                        </a>
                                    </h5>
                                </div>
                                <div id="answerTwo" class="panel-collapse collapse" role="tabpanel"
                                    aria-labelledby="questionTwo">
                                    <div class="panel-body">
                                        For open Pores,Skin Whitening,Strech Marks,Dark Circles
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="questionThree">
                                    <h5 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#faq"
                                            href="#answerThree" aria-expanded="true" aria-controls="answerThree" style="color:blueviolet;">
                                            Soprano Ice - Alma Laser(Israel)
                                        </a>
                                    </h5>
                                </div>
                                <div id="answerThree" class="panel-collapse collapse" role="tabpanel"
                                    aria-labelledby="questionThree">
                                    <div class="panel-body">
                                        World's 1st Painless Laser Hair removal
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="questionFour">
                                    <h5 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#faq"
                                            href="#answerFour" aria-expanded="true" aria-controls="answerFour" style="color:brown;">
                                          Intense Pulse Light (India)
                                        </a>
                                    </h5>
                                </div>
                                <div id="answerFour" class="panel-collapse collapse" role="tabpanel"
                                    aria-labelledby="questionFour">
                                    <div class="panel-body">
                                        For Acne , Pigmentation photo Rejunivation & Vascular
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="questionFive">
                                    <h5 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#faq"
                                            href="#answerFive" aria-expanded="true" aria-controls="answerFive" style="color:crimson;">
                                            Helios II Q Switched ND Yag Laser(Korea)
                                        </a>
                                    </h5>
                                </div>
                                <div id="answerFive" class="panel-collapse collapse" role="tabpanel"
                                    aria-labelledby="questionFive">
                                    <div class="panel-body">
                                        For Laser Tonning,Laser Bleaching,Tattoo removal
                                    </div>
                                </div>
                            </div>

                        </div>

                    </form>
                </div>

            </div>
        </div>
    </section>


    <!-- GOOGLE MAP -->
    <section id="google-map">

        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3719.143525228053!2d72.899694675182!3d21.226156480473016!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be0458bb64619ad%3A0x7c60deb730000000!2sSHREE%20HARI%20SKIN%20%26%20HAIR%20CLINIC!5e0!3m2!1sen!2sin!4v1683626172246!5m2!1sen!2sin"
            width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </section>
@endsection
