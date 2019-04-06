<section role="main" class="content-body">
    <header class="page-header">
                    <h2>
                        <div>
                            <div class="dmy agileits w3layouts">
                                <script type="text/javascript">
                                    var mydate=new Date()
                                    var year=mydate.getYear()
                                    if(year<1000)
                                    year+=1900
                                    var day=mydate.getDay()
                                    var month=mydate.getMonth()
                                    var daym=mydate.getDate()
                                    if(daym<10)
                                    daym="0"+daym
                                    var dayarray=new Array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu")
                                    var montharray=new Array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember")
                                    document.write(""+dayarray[day]+", "+daym+" "+montharray[month]+"  "+year+"")
                                </script>
                             </div>
                        </div>
                    </h2>
                    <h2 id="clock" class="logo pull-left" style="color: #000; font-family: Arial"></h2>
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
                    
                        <div class="right-wrapper pull-right">
                            <div id="userbox" class="userbox">
                        <a href="#" data-toggle="dropdown">
                            <div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@JSOFT.com">
                                @role('admin')
                               {{ Auth::user()->name }}
                                <span class="role">administrator</span>
                                @endrole
                                @role('karyawan')
                               {{ Auth::user()->name }}
                                <span class="role">karyawan</span>
                                @endrole
                            </div>
            
                            <i class="fa custom-caret"></i>
                        </a>
            
                        <div class="dropdown-menu">
                            <ul class="list-unstyled">
                                <li class="divider"></li>
                                @role('karyawan')
                                <li>
                                    <a href="/karyawan/ubahprofil">
                                       <i class="fa fa-lock"></i> Ubah Profil</a>
                                </li>
                                @endrole
                                <li>
                                    <a role="menuitem" tabindex="-1" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                       <i class="fa fa-power-off"></i> Logout</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"     style="display: none;">
                                            @csrf
                                        </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                        </div>
                    </header>

                    <!-- start: page -->
                    @yield('content')
                    <!-- end: page -->
                </section>