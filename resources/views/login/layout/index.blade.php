<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Tali Kuat Bina Marga | @yield('title')</title>

        {{-- link css icon --}}
        <link rel="shortcut icon" href="{{ asset('assets/images/talikuat.png') }}" type="image/x-icon">

        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!--===============================================================================================-->
        <!--===============================================================================================-->
        <link
            rel="stylesheet"
            type="text/css"
            href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }} "
        />
        <!--===============================================================================================-->
        <link
            rel="stylesheet"
            type="text/css"
            href="{{
                asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css')
            }}"
        />
        <!--===============================================================================================-->
        <link
            rel="stylesheet"
            type="text/css"
            href="{{ asset('vendor/animate/animate.css') }}"
        />
        <!--===============================================================================================-->
        <link
            rel="stylesheet"
            type="text/css"
            href="{{ asset('vendor/css-hamburgers/hamburgers.min.css') }}"
        />
        <!--===============================================================================================-->
        <link
            rel="stylesheet"
            type="text/css"
            href="{{ asset('vendor/select2/select2.min.css') }}"
        />
        <!--===============================================================================================-->
        <link
            rel="stylesheet"
            type="text/css"
            href="{{ asset('css/util.css') }}"
        />
        <link
            rel="stylesheet"
            type="text/css"
            href="{{ asset('css/main.css') }}"
        />
        <!--===============================================================================================-->
    </head>

    <body>
        <div class="limiter">
            <div class="container-login100">
                <div class="wrap-login100">
                    <div class="login100-pic js-tilt" data-tilte>
                        <img
                            src="{{ asset('assets/images/talikuat.png') }}"
                            alt="IMG"
                        />
                    </div>

                    @yield('content')
                </div>
            </div>
        </div>

        <!--===============================================================================================-->
        <script src="{{ asset('vendor/jquery/jquery-3.2.1.min.js') }}"></script>
        <!--===============================================================================================-->
        <script src="{{ asset('vendor/bootstrap/js/popper.js') }}"></script>
        <script src="{{
                asset('vendor/bootstrap/js/bootstrap.min.js')
            }}"></script>
        <!--===============================================================================================-->
        <script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
        <!--===============================================================================================-->
        <script src="{{ asset('vendor/tilt/tilt.jquery.min.js') }}"></script>
        <script>
            $(".js-tilt").tilt({
                scale: 1.1,
            });
        </script>
        <!--===============================================================================================-->
        <script src="{{ asset('assets/js/main.js') }}"></script>
    </body>
</html>
