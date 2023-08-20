<!-- FOOTER -->
<footer data-stellar-background-ratio="5">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-3 col-sm-3">
                <div class="footer-thumb">
                    <img src="{{ url('frontend/images/logo_1-removebg-preview.png') }}" alt="Shree hari" height="200px"
                        width="250px">

                </div>
            </div>

            <div class="col-md-3 col-sm-3">
                <div class="footer-thumb">
                    <div class="opening-hours">
                        <h4 class="wow fadeInUp" data-wow-delay="0.4s">Opening Hours</h4>
                        <p>Monday - Saturday <span>09:30 AM - 08:00 PM</span></p>
                        <p>Sunday <span>09:30 AM - 01:00 PM</span></p>
                    </div>

                    <ul class="social-icon">
                        <li><a href="https://www.facebook.com/shreehariskinnhairclinic/"
                                class="fa fa-facebook-square"></a></li>
                        <li><a href="https://www.instagram.com/shreehariskin/" class="fa fa-instagram"></a></li>
                    </ul>
                </div>
            </div>

            <div class="col-md-3 col-sm-3">
                <div class="footer-thumb">
                    <h4 class="wow fadeInUp" data-wow-delay="0.4s">Contact Info</h4>

                    <div class="contact-info">
                        <p><i class="fa fa-phone"></i> +91 96645 85431</p>
                        <p><i class="fa fa-envelope-o"></i> <a
                                href="mailto:shreehari326@gmail.com">shreehari326@gmail.com</a></p>

                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-3">
                <div class="footer-thumb">
                    <h4 class="wow fadeInUp" data-wow-delay="0.4s">Location</h4>

                    <div class="contact-info">
                        <p><i class="fa fa-map-marker" aria-hidden="true"></i>201-202, Vikas shoppers, Nr. Bhagavannagar
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;chowk, Sarthana Jakatnaka
                            to Vrajchowk
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Road, Surat-395006.</p>
                        <p><i class="fa fa-map-marker" aria-hidden="true"></i>FF 116, Avalon, Opp. Samast Patidar Samaj
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Wadi, Nr. Ankur School, Amba
                            Talavadi, &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Katargam, Surat.</p>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12 col-sm-12 border-top">
                <div class="col-md-4 col-sm-6">
                    <div class="copyright-text">
                        <p>Copyright &copy; 2023 Shree hari clinic

                            {{-- | Design: <a href="#" target="_parent">#</a> --}}
                        </p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="footer-link">
                        <a href="/">Home</a>
                        <a href="/about">About</a>
                        <a href="/contact">Contact Us</a>
                    </div>
                </div>
                <div class="col-md-2 col-sm-2 text-align-center">
                    <div class="angle-up-btn">
                        <a href="#top" class="smoothScroll wow fadeInUp" data-wow-delay="1.2s"><i
                                class="fa fa-angle-up"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- SCRIPTS -->
<script src="{{ url('frontend/js/jquery.js') }}"></script>
<script src="{{ url('frontend/js/bootstrap.min.js') }}"></script>
<script src="{{ url('frontend/js/jquery.sticky.js') }}"></script>
<script src="{{ url('frontend/js/jquery.stellar.min.js') }}"></script>
<script src="{{ url('frontend/js/wow.min.js') }}"></script>
<script src="{{ url('frontend/js/smoothscroll.js') }}"></script>
<script src="{{ url('frontend/js/owl.carousel.min.js') }}"></script>
<script src="{{ url('frontend/js/custom.js') }}"></script>
<script src="{{ url('frontend/js/nicepage.js') }}"></script>
<script src="{{ url('frontend/js/datatable.js') }}"></script>
<script src="{{ url('frontend/js/parsley.js') }}"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
    function upapno(id) {
        $('#uapno').val(id);
    }

    function cancelapp(id)
    {
        $('#upapno').val(id);
    }

    function getclinic(dctr) {

        $.ajax({
            url: '/clinics',
            type: 'post',
            data: 'did=' + dctr + '&_token={{ csrf_token() }}',
            success: function(res) {
                $('#apclnc').html(res);
            }
        });

        $.ajax({
            url: '/services',
            type: 'post',
            data: 'did=' + dctr + '&_token={{ csrf_token() }}',
            success: function(res) {
                $('#apsrvc').html(res);
            }
        });
    }

    $(document).ready(function() {
        $('#example').DataTable();
        $('#login').parsley();
        $('#register').parsley();
        $('#forget').parsley();
        $('#otp').parsley();
        $('#pprofile').parsley();
        $('#changepass').parsley();
        $('#updateapp').parsley();
        $('#apnt').parsley();
        $('#contact_form').parsley();
    });
</script>


<script>
    /*for alert show*/

    $(".alert").fadeTo(2000, 500).fadeOut(3000, function() {
        $(".alert").fadeOut(10000);
    });

    /*for password show*/

    function showpass() {
        var x = document.getElementById("password");
        var y = document.getElementById("cpassword");
        var z = document.getElementById("npassword");

        if (x.type === "password" || y.type === "password" || z.type === "password") {
            x.type = "text";
            y.type = "text";
            z.type = "text";
        } else {
            x.type = "password";
            y.type = "password";
            z.type = "password";
        }
    }

    function newpass() {
        var x = document.getElementById("password");
        var y = document.getElementById("cpassword");

        if (x.type === "password" || y.type === "password") {
            x.type = "text";
            y.type = "text";
        } else {
            x.type = "password";
            y.type = "password";
        }
    }



    function logfrmpass() {
        var x = document.getElementById("password");

        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }

    // for update date-time slot

    function upgetday(day) {
        var pid=$('.pid').val();
        var tdate = new Date();
        var today = new Date().toJSON().slice(0, 10);
        var a = new Date(day).toJSON().slice(0, 10);
        var b = new Date(day)
        if (a >= today) {
            var days = new Array(7);
            days[0] = "Sunday";
            days[1] = "Monday";
            days[2] = "Tuesday";
            days[3] = "Wednesday";
            days[4] = "Thursday";
            days[5] = "Friday";
            days[6] = "Saturday";
            var r = days[b.getDay()];
            if (r == "Sunday") {
                disable();
            } else if (r != "Sunday") {
                enable();
            } else {
                return;
            }

            tdate.setDate(tdate.getDate()+30);
            if(b > tdate)
            {
                alert("You can't book advance appoinment more then 30 days..!!");
                $('input[type=date]').val('');
            }

        } else {
            alert("Please Select date greter than todays date..!!");
            $('input[type=date]').val('');

        }

    }


    // appoinment section

    function getday(day) {
        var pid=$('.pid').val();

        var tdate = new Date();

        var today = new Date().toJSON().slice(0, 10);
        var a = new Date(day).toJSON().slice(0, 10);
        var b = new Date(day)
        if (a >= today) {
            var days = new Array(7);
            days[0] = "Sunday";
            days[1] = "Monday";
            days[2] = "Tuesday";
            days[3] = "Wednesday";
            days[4] = "Thursday";
            days[5] = "Friday";
            days[6] = "Saturday";
            var r = days[b.getDay()];
            if (r == "Sunday") {
                disable();
            } else if (r != "Sunday") {
                enable();
            } else {
                return;
            }


            tdate.setDate(tdate.getDate()+30);


            if(b > tdate)
            {
                alert("You can't book advance appoinment more then 30 days..!!");
                $('input[type=date]').val('');
            }

        } else {
            alert("Please Select date greter than todays date..!!");
            $('input[type=date]').val('');

        }

        $.ajax({
            url: '/checkdate',
            type: 'post',
            data: { pid: pid, date: a, _token: '{{csrf_token()}}' },
            success: function(res) {
                if(res=='true')
                {
                    $('#msg').html('');
                }
                else
                {
                    $('#msg').html('<p style="color:red;">You have booked appoinment for this Same Date..!!</p>');
                    $('input[type=date]').val('');
                }
            }
        });
    }

    function timeslot(){
        var a = $('input[type=date]').val();
        var b=$('.mytime').val();
        if(a=='')
        {
            alert('please Choose Date..!!');
            $('.mytime').val('');
        }
        else
        {
            $.ajax({
            url: '/checkforpasttime',
            type: 'post',
            data: {date: a,time: b, _token: '{{csrf_token()}}' },
            success: function(res) {
                if(res=='true')
                {
                    $.ajax({
                            url: '/checkslot',
                            type: 'post',
                            data: {date: a, _token: '{{csrf_token()}}' },
                            success: function(res) {
                                if(res=='true')
                                {
                                    $('#smsg').html('<p style="color:green;">Slot Is Available..!!</p>');
                                }
                                else
                                {
                                    $('#smsg').html('<p style="color:red;">Slot is Full Choose another slot..!!</p>');
                                    $('.mytime').val('');
                                }
                            }
                        });
                }
                else
                {
                    $('#smsg').html('<p style="color:red;">Time Is Passed..!!</p>');
                    $('.mytime').val('');
                }
            }
        });



      }

    }

    function disable() {
        var a, i, options;
        a = document.getElementById("aptime");
        for (i = 4; i <= a.length - 1; i++) {
            a.options[i].disabled = true;
        }

    }

    function enable() {
        var a, i, options;
        a = document.getElementById("aptime");
        for (i = 4; i <= a.length - 1; i++) {
            a.options[i].disabled = false;
        }

    }

    function submitform(id) {
        var r1 = document.querySelector('input[name="payment"]:checked');
        if (r1 == null) {
            alert("Please Select Payment Method");
        }
        if (r1.value == 'Cash') {
            let c1 = $('.mydate').val();
            let c2 = $('.mytime').val();
            let c3 = $('.mydctr').val();
            let c4 = $('.myclnc').val();
            let c5 = $('.mysrvc').val();
            if (c1 == "" || c2 == "" || c3 == "" || c4 == "" || c5 == null) {
                alert("Please select required field.")
            } else {
                $('#apnt').submit();
            }
        }
        if (r1.value == 'Online') {
            let f1 = $('.mydate').val();
            let f2 = $('.mytime').val();
            let f3 = $('.mydctr').val();
            let f4 = $('.myclnc').val();
            let f5 = $('.mysrvc').val();
            if (f1 == "" || f2 == "" || f3 == "" || f4 == "" || f5 == null) {
                alert("Please select required field.")
            } else {
                $.ajax({
                    url: '/payonline',
                    type: 'post',
                    data: 'pid=' + id + '&_token={{ csrf_token() }}',
                    success: function(res) {
                        if (res) {
                            // alert(res.data['pname']);
                            // window.location.href="/razorpay-payment/"+res;
                            var options = {
                                "key": "rzp_test_mrPbyk4kjYp7jW", // Enter the Key ID generated from the Dashboard
                                "amount": "5000", // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                                "currency": "INR",
                                "name": "ShreeHari Skin & Hair Clinic", //your business name
                                "description": "Thank you for choose us.",
                                "image": "{{ url('/frontend/images/logo_1-removebg-preview.png') }}",
                                //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
                                // "callback_url": "https://eneqd3r9zrjok.x.pipedream.net/",
                                "handler": function(response) {
                                    if (response) {
                                        $('.payid').val(response.razorpay_payment_id);
                                        $('#apnt').submit();
                                    } else {
                                        alert("!!..Payment Failed..!!");
                                    }
                                },
                                "prefill": { //We recommend using the prefill parameter to auto-fill customer's contact information especially their phone number
                                    "name": res.data['pname'], //your customer's name
                                    "email": res.data['pemail'],
                                    "contact": res.data[
                                        'pmobile'] //Provide the customer's phone number for better conversion rates
                                },
                                "notes": {
                                    "address": "Razorpay Corporate Office"
                                },
                                "theme": {
                                    "color": "#3399cc"
                                }
                            };
                            var rzp1 = new Razorpay(options);
                            // document.getElementById('rzp-button1').onclick = function(e) {
                            rzp1.open();
                            // e.preventDefault();
                            // }
                        }
                    }
                });

            }


        }
    }

    function paynow() {
        $('.onlinepay').text('PayNow');
    }

    function paycash() {
        $('.onlinepay').text('Take Appoinment');
    }
</script>


</body>

</html>
