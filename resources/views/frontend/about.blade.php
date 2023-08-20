@extends('frontend.layouts.main')

@section('main-container')
    <!-- Service Start -->
    <div class="container-fluid" id="facilities" style="margin-top: 3rem; margin-bottom: 2rem;">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">

            </div>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <a class="service-item rounded" href="">
                        <div class="service-icon bg-transparent border rounded p-1">
                            <div class="w-100 h-100 border rounded d-flex align-items-center justify-content-center">
                                <img src="{{ url('/frontend/images/mission.png') }}" alt="#" height="80px"
                                    width="80px">
                            </div>
                        </div>
                        <h5 class="mb-3"> MISSION</h5>
                        <p class="text-body mb-0">To be one of the best skin hair and hair transplant centers using the
                            combination of advanced technology and latest treatments with a focus on patients desired
                            results.</p>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                    <a class="service-item rounded" href="">
                        <div class="service-icon bg-transparent border rounded p-1">
                            <div class="w-100 h-100 border rounded d-flex align-items-center justify-content-center">
                                <img src="{{ url('/frontend/images/vision.png') }}" alt="#" height="80px"
                                    width="80px">
                            </div>
                        </div>
                        <h5 class="mb-3">VISION</h5>
                        <p class="text-body mb-0">To be the number one choice for skin care, hair care and hair transplant
                            dermatology clinic and well-being to help patients feel more confident about their skin, hair
                            and appearance.</p>
                    </a>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <a class="service-item rounded" href="">
                        <div class="service-icon bg-transparent border rounded p-1">
                            <div class="w-100 h-100 border rounded d-flex align-items-center justify-content-center">
                                <img src="{{ url('/frontend/images/values.png') }}" alt="#" height="80px"
                                    width="80px">
                            </div>
                        </div>
                        <h5 class="mb-3">VALUES </h5>
                        <p class="text-body mb-0">Evidence based treatments. To offer patients with suitable treatment
                            plans, safe and secure treatments
                            Educating patients to help them make the right choices. </p>
                    </a>
                </div>



            </div>
        </div>
    </div>
    <!-- Service End -->

    <div class="bg-white py-5">
        <div class="container py-5">
            <div class="row align-items-center mb-5">
                <div class="col-lg-6 order-2 order-lg-1"><i class="fa fa-bar-chart fa-2x mb-3 text-primary"></i>
                    <h2 class="font-weight-light">About Us</h2>
                    <p class="font-italic text-muted mb-4">Everyone desires beautiful skin and healthy hair. we at Shri Hari
                        Clinic understand this aspiration. At Shri Hari Skin Clinic, you can avail wide range of skin and
                        hair care treatment like anti ageing, pimples, pigmentation, laser hair removal, vitiligo (white
                        spots), hair transplant etc.</p>
                </div>
                <div class="col-lg-5 px-5 mx-auto order-1 order-lg-2"><img
                        src="{{ url('frontend/images/news-image2.jpg') }}" alt="" class="img-fluid mb-4 mb-lg-0">
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-5 px-5 mx-auto"><img src="{{ url('frontend/images/team-image1.jpg') }}" alt=""
                        class="img-fluid mb-4 mb-lg-0"></div>
                <div class="col-lg-6"><i class="fa fa-leaf fa-2x mb-3 text-primary"></i>
                    <h2 class="font-weight-light">Why Choose Us</h2>
                    <div class="container-fluid">

                        <div id="faq" role="tablist" aria-multiselectable="true">

                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="questionOne">
                                    <h5 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#faq" href="#answerOne" aria-expanded="false"
                                            aria-controls="answerOne">
                                            WORLD CLASS EQUIPMENT'S
                                        </a>
                                    </h5>
                                </div>
                                <div id="answerOne" class="panel-collapse collapse in" role="tabpanel"
                                    aria-labelledby="questionOne">
                                    <div class="panel-body">
                                        Our treatments utilize world-class equipment & facilities
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="questionTwo">
                                    <h5 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#faq" href="#answerTwo"
                                            aria-expanded="false" aria-controls="answerTwo">
                                            SKILLED EXPERTISE
                                        </a>
                                    </h5>
                                </div>
                                <div id="answerTwo" class="panel-collapse collapse in" role="tabpanel"
                                    aria-labelledby="questionTwo">
                                    <div class="panel-body">
                                        Our experts are highly trained & experienced.
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="questionThree">
                                    <h5 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#faq"
                                            href="#answerThree" aria-expanded="true" aria-controls="answerThree">
                                            BEST-IN-CLASS CARE
                                        </a>
                                    </h5>
                                </div>
                                <div id="answerThree" class="panel-collapse collapse in" role="tabpanel"
                                    aria-labelledby="questionThree">
                                    <div class="panel-body">
                                        Shri Hari Clinic offers the best-in-class patient care solutions.
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="questionFour">
                                    <h5 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#faq"
                                            href="#answerFour" aria-expanded="true" aria-controls="answerFour">
                                            COMPLETE SOLUTIONS
                                        </a>
                                    </h5>
                                </div>
                                <div id="answerFour" class="panel-collapse collapse in" role="tabpanel"
                                    aria-labelledby="questionFour">
                                    <div class="panel-body">
                                        We deliver complete and comprehensive treatments.
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
