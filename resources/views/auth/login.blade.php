@extends('layouts.login')

@section('title','Masuk')
@section('content')
<style type="text/css">
    body {
    background-color: #379dd0;
}

    .body-sign .panel-sign .panel-body {
    box-shadow: 2px 2px 2px rgba(70, 35, 35, 0.8);
</style>
<section class="body-sign">
            <div class="center-sign">
                <h2 id="clock" class="logo pull-left" style="color: #fff; font-family: Arial"></h2>
                        <script type="text/javascript">
        <!--
        function showTime() {
            var a_p = "";
            var today = new Date();
            var curr_hour = today.getHours();
            var curr_minute = today.getMinutes();
            var curr_second = today.getSeconds();
            if (curr_hour < 12) {
                a_p = "AM";
            } else {
                a_p = "PM";
            }
            if (curr_hour == 0) {
                curr_hour = 12;
            }
            if (curr_hour > 12) {
                curr_hour = curr_hour - 12;
            }
            curr_hour = checkTime(curr_hour);
            curr_minute = checkTime(curr_minute);
            curr_second = checkTime(curr_second);
         document.getElementById('clock').innerHTML=curr_hour + ":" + curr_minute + ":" + curr_second + " " + a_p;
            }
 
        function checkTime(i) {
            if (i < 10) {
                i = "0" + i;
            }
            return i;
        }
        setInterval(showTime, 500);
        //-->
        </script>

                <div class="panel panel-sign">
                    <div class="panel-title-sign mt-xl text-right">
                        <h2 class="title text-uppercase text-bold m-none"><i class="fa fa-user mr-xs"></i> Masuk</h2>
                    </div>
                    <div class="panel-body">
                          <form method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}  
                            <div class="form-group mb-lg">
                                <label>Alamat Email</label>
                                <div class="input-group input-group-icon">
                                    <input id="email" type="email" class="form-control input-lg" name="email" {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" required autofocus>
                                    <span class="input-group-addon">
                                        <span class="icon icon-lg">
                                            <i class="fa fa-user"></i>
                                        </span>
                                    </span>
                                </div>
                                 @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color: red">{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                            </div>

                            <div class="form-group mb-lg">
                                <div class="clearfix">
                                    <label class="pull-left">Kata Sandi</label>
                                    <a href="pages-recover-Kata Sandi.html" class="pull-right">Lupa Kata sandi?</a>
                                </div>
                                <div class="input-group input-group-icon">
                                   
                                    <input id="password" type="password" class="form-control input-lg" name="password" {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password"  required>
                                    <span class="input-group-addon">
                                        <span class="icon icon-lg">
                                            <i class="fa fa-lock"></i>
                                        </span>
                                    </span>
                                </div>
                                  @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong style="color: red">{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                            </div>

                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="checkbox-custom checkbox-default">
                                       
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label for="RememberMe">Ingat Saya</label>
                                    </div>
                                </div>
                                <div class="col-sm-4 text-right">
                                    <button type="submit" class="btn btn-primary hidden-xs">Masuk</button>
                                    
                                </div>
                            </div>

                            <span class="mt-lg mb-lg line-thru text-center text-uppercase">
                                <span>-</span>
                            </span>

                            <div class="mb-xs text-center">
                               
                            </div>

                            <p class="text-center"><i class="fa fa-home"></i> CV PUTRA ADIDARMA</p>
                        </form>
                    </div>
                </div>

                <p class="text-center text-muted mt-md mb-md" style="color: #fff!important">&copy; Copyright 2018.</p>
            </div>
        </section>
@endsection
