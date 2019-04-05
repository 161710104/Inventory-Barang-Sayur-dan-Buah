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