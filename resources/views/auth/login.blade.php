<!DOCTYPE html>
<html lang="en" itemscope itemtype="http://schema.org/WebPage">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> Login Page </title>

    <meta name="title" Content="RealVest - Home">
    <meta name="description" content="Introducing RealVest - Real Estate Investment System, the cutting-edge solution for navigating the complexities of real estate investment with unparalleled ease and efficiency. RealVest offers a robust platform developed on advanced technology, designed to meet the needs of both novice investors and seasoned professionals in the real estate industry.">
    
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">

<!-- Icon Libraries via CDN -->
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <link rel="apple-touch-icon" href="{{ asset('frontend/assets/images/logo.png') }}">
 
    <meta property="og:image:type" content="image/png">
        <meta property="og:image:width" content="1180">
    <meta property="og:image:height" content="600"> 
    <meta name="twitter:card" content="summary_large_image">

    <link href="{{ asset('frontend/assets/css/bootstrap.min.css?get=5') }}" rel="stylesheet"> 
   <link href="{{ asset('frontend/assets/css/slick.css') }}" rel="stylesheet">  
    <link href="{{ asset('frontend/assets/css/main.css?get=5') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/custom.css?get=5') }}" rel="stylesheet">

    
   
</head>

<body>
    <div class="preloader">
        <div class="loader-p"></div>
    </div>

    <div class="body-overlay"></div>

    <div class="sidebar-overlay"></div>

    
        <section class="account">
        <div class="account-inner py-60 bg-pattern3">
            <div class="container ">
                <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-6 col-xxl-5">
           
           
  <form method="POST" action="{{ route('login') }}" class="account-form verify-gcaptcha">
    @csrf 
                
    
    <div class="account-form__header text-center">
                    <a class="mb-5" href=" "> <img src="{{ asset('frontend/assets/images/logo.png') }}"></a>
                    <h5 class="account-form__title mb-3">Account Login</h5>
 
                </div>
<div class="account-form__body">
    <div class="form-group">
        <label for="usernameOrEmail" class="form--label required">Email</label>
        <input class="form--control" type="email" name="email" id="email">
    </div>
    <div class="form-group">
        <label for="your-password" class="form--label required">Password</label>
        <div class="position-relative">
            <input class="form--control" type="password" name="password" id="password">
        </div>
    </div>
    
    <div class="flex-between">
            
        <a href="{{ route('password.request') }}"
            class="account-form__forgot-pass">Forgot Password?</a>
    </div>
</div>
                <div class="account-form__footer">
                    <button type="submit" id="recaptcha" class="w-100 btn btn--base">Login</button>
                    <p class="account-form__subtitle mt-3">
                        Don't have an account?
                        <a href="{{ route('register') }}">Register</a>
                    </p>
                </div>
            </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

        
   <script src="{{ asset('frontend/assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap.bundle.min.js') }}"></script>

        <script src="{{ asset('frontend/assets/js/slick.min.js') }}"></script>

    
    <script src="{{ asset('frontend/assets/js/main.js?get=5') }}"></script>

    <link href="{{ asset('frontend/assets/js/iziToast.min.css') }}" rel="stylesheet">
<link href="{{ asset('frontend/assets/js/iziToast_custom.css') }}" rel="stylesheet">
<script src="{{ asset('frontend/assets/js/iziToast.min.js') }}"></script> 
 

<script>
    "use strict";
    const colors = {
        success: '#28c76f',
        error: '#eb2222',
        warning: '#ff9f43',
        info: '#1e9ff2',
    }

    const icons = {
        success: 'fas fa-check-circle',
        error: 'fas fa-times-circle',
        warning: 'fas fa-exclamation-triangle',
        info: 'fas fa-exclamation-circle',
    }

    const notifications = [];
    const errors = [];


    const triggerToaster = (status, message) => {
        iziToast[status]({
            title: status.charAt(0).toUpperCase() + status.slice(1),
            message: message,
            position: "topRight",
            backgroundColor: '#fff',
            icon: icons[status],
            iconColor: colors[status],
            progressBarColor: colors[status],
            titleSize: '1rem',
            messageSize: '1rem',
            titleColor: '#474747',
            messageColor: '#a2a2a2',
            transitionIn: 'obunceInLeft'
        });
    }

    if (notifications.length) {
        notifications.forEach(element => {
            triggerToaster(element[0], element[1]);
        });
    }

    if (errors.length) {
        errors.forEach(error => {
            triggerToaster('error', error);
        });
    }

    function notify(status, message) {
        if (typeof message == 'string') {
            triggerToaster(status, message);
        } else {
            $.each(message, (i, val) => triggerToaster(status, val));
        }
    }
</script>

            <script src="///realvest/assets/global/js/firebase/firebase-8.3.2.js"></script>

<script>
    "use strict";

    var permission = null;
    var authenticated = '';
    var pushNotify = 1;
    var firebaseConfig = null;

    function pushNotifyAction() {
        permission = Notification.permission;

        if (!('Notification' in window)) {
            notify('info', 'Push notifications not available in your browser. Try Chromium.')
        } else if (permission === 'denied' || permission == 'default') { //Notice for users dashboard
            $('.notice').append(`
                <div class="row notification-alert">
                    <div class="col-lg-12">
                        <div class="card custom--card mb-4">
                            <div class="card-header justify-content-between d-flex flex-wrap notice_notify">
                                <h5 class="alert-heading">Please Allow / Reset Browser Notification <i class='las la-bell text--danger'></i></h5>
                            </div>
                            <div class="card-body">
                                <p class="mb-0 small">If you want to get push notification then you have to allow notification from your browser</p>
                            </div>
                        </div>
                    </div>
                </div>
            `);
        }
    }

    //If enable push notification from admin panel
    if (pushNotify == 1) {
        pushNotifyAction();
    }

    //When users allow browser notification
    if (permission != 'denied' && firebaseConfig) {

        //Firebase
        firebase.initializeApp(firebaseConfig);
        const messaging = firebase.messaging();

        navigator.serviceWorker.register("///realvest/assets/global/js/firebase/firebase-messaging-sw.js")

            .then((registration) => {
                messaging.useServiceWorker(registration);

                function initFirebaseMessagingRegistration() {
                    messaging
                        .requestPermission()
                        .then(function() {
                            return messaging.getToken()
                        })
                        .then(function(token) {
                            $.ajax({
                                url: '///realvest/user/add-device-token',
                                type: 'POST',
                                data: {
                                    token: token,
                                    '_token': "PEASqKgrAKN6rF181e43U0uM8W45aBENiwb3ALoy"
                                },
                                success: function(response) {},
                                error: function(err) {},
                            });
                        }).catch(function(error) {});
                }

                messaging.onMessage(function(payload) {
                    const title = payload.notification.title;
                    const options = {
                        body: payload.notification.body,
                        icon: payload.data.icon,
                        image: payload.notification.image,
                        click_action: payload.data.click_action,
                        vibrate: [200, 100, 200]
                    };
                    new Notification(title, options);
                });

                //For authenticated users
                if (authenticated) {
                    initFirebaseMessagingRegistration();
                }

            });

    }
</script>
    
        <script>
        (function($){
            "use strict"
            $('.verify-gcaptcha').on('submit',function(){
                var response = grecaptcha.getResponse();
                if (response.length == 0) {
                    document.getElementById('g-recaptcha-error').innerHTML = '<span class="text--danger">Captcha field is required.</span>';
                    return false;
                }
                return true;
            });

            window.verifyCaptcha = () => {
                document.getElementById('g-recaptcha-error').innerHTML = '';
            }
        })(jQuery);
    </script>

    <script>
        (function($) {
            "use strict";

            $(".langSel").on("click", function() {
                var value = $(this).data('value');
                window.location.href = "///realvest/change/" + value;
            });

            $('.policy').on('click', function() {
                $.get('///realvest/cookie/accept', function(response) {
                    $('.cookies-card').addClass('d-none');
                });
            });
            setTimeout(function() {
                $('.cookies-card').removeClass('hide')
            }, 2000);

            var inputElements = $('[type=text],select,textarea');
            $.each(inputElements, function(index, element) {
                element = $(element);
                element.closest('.form-group').find('label').attr('for', element.attr('name'));
                element.attr('id', element.attr('name'))
            });

            $.each($('input:not([type=checkbox]):not([type=hidden]), select, textarea'), function (i, element) {
                var elementType = $(element);
                if (elementType.attr('type') != 'checkbox') {
                    if (element.hasAttribute('required')) {
                        $(element).closest('.form-group').find('label').addClass('required');
                    }
                }
            });

            Array.from(document.querySelectorAll('table')).forEach(table => {
                let heading = table.querySelectorAll('thead tr th');
                Array.from(table.querySelectorAll('tbody tr')).forEach((row) => {
                    Array.from(row.querySelectorAll('td')).forEach((colum, i) => {
                        colum.setAttribute('data-label', heading[i].innerText)
                    });
                });
            });

            let disableSubmission = false;
            $('.disableSubmission').on('submit', function(e) {
                if (disableSubmission) {
                    e.preventDefault()
                } else {
                    disableSubmission = true;
                }
            });
        })(jQuery);
    </script>
    
    <script>
  var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
  (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/5fe0b9b2a8a254155ab5421d/1eq2tap1m';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
  })();
</script>

<script>
if (window.top != window.self) {
    document.body.innerHTML += '<div style="position:fixed;top:0;width:100%;z-index:9999999;background:#f8d7da;color:#721c24;text-align:center; padding: 20px;"><p style="font-size:20px; font-weight: bold;">You are using this website under an external iframe!!</p><p style="font-size:16px; margin-top: 20px;">for a better experience, please browse directly instead of an external iframe.</p><a href="'+window.self.location+'" target="_blank" style=" margin-top:20px; color: #fff;background-color: #dc3545; padding: 5px 10px; border-radius: 5px; text-decoration: none;">Browse Directly</a></div>';
}
</script>


<script>
    adroll_adv_id = "YXRNNTO7ZBAMFBH67UUE5M";
    adroll_pix_id = "MMQQDWGN25EXPHGRPA3NLR";
    adroll_version = "2.0";
    (function(w, d, e, o, a) {
        w.__adroll_loaded = true;
        w.adroll  = w.adroll  || [];
        w.adroll.f = [ 'setProperties', 'identify', 'track' ];
        var roundtripUrl = "https://s.adroll.com/j/" + adroll_adv_id
                + "/roundtrip.js";
        for (a = 0; a < w.adroll.f.length; a++) {
            w.adroll[w.adroll.f[a]] = w.adroll[w.adroll.f[a]] || (function(n) {
                return function() {
                    w.adroll.push([ n, arguments ])
                }
            })(w.adroll.f[a])
        }
        e = d.createElement('script');
        o = d.getElementsByTagName('script')[0];
        e.async  = 1;
        e.src  = roundtripUrl;
        o.parentNode.insertBefore(e, o);
    })(window, document);
    adroll.track("pageView");
</script>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-1ME4K0RD7K"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-1ME4K0RD7K');
</script>

</body>

</html>
