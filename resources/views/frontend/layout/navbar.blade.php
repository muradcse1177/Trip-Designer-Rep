<?php
if(@$c_info->agent_id) {
    ?>
<div id="main-wrapper">

    <!-- ============================================================== -->
    <!-- Top header  -->
    <!-- ============================================================== -->
    <!-- Start Navigation -->

    <div class="header header-transparent theme" style="background: white;">
        <div class="container">
            <nav id="navigation" class="navigation navigation-landscape">
                <div class="nav-header">
                    <a class="nav-brand static-show" href="{{url('/')}}"><img src="{{@$domain.'/'.@$c_info->logo}}" class="logo" alt=""></a>
                    <a class="nav-brand mob-show" href="{{url('/')}}"><img src="{{@$domain.'/'.@$c_info->logo}}" class="logo" alt=""></a>
                    <div class="nav-toggle"></div>
                    <div class="mobile_nav">
                        <ul>
                            @if(Session::get('customer'))
                            @else
                                <li>
                                    <a href="{{url('all-login')}}" class="bg-light-primary text-primary rounded"><i class="fa-regular fa-circle-user fs-6"></i></a>
                                </li>
                            @endif
                        </ul>

                    </div>
                </div>
                <div class="nav-menus-wrapper" style="transition-property: none;">
                    <ul class="nav-menu">
                        <li><a href="{{url('/')}}">Home<span class="submenu-indicator"></span></a></li>
                        <li><a href="{{url('/visa')}}">Visa<span class="submenu-indicator"></span></a>
                            <ul class="nav-dropdown nav-submenu">
                                <?php
                                    $rows2 = DB::table('b2c_visa_country')->where('agent_id',@$c_info->agent_id)->get();
                                    foreach ($rows2 as  $row){
                                ?>
                                <li>
                                    <a href="{{url('search-visa?country='.$row->name)}}">{{$row->name}}</a>
                                </li>
                                <?php
                                    }
                                ?>
                            </ul>
                        </li>
                        <li>
                            <a href="{{url('tour-package')}}">Tour Package<span class="submenu-indicator"></span></a>
                            <ul class="nav-dropdown nav-submenu">
                                <?php
                                    $today =  date('Y-m-d', strtotime('+3 days'));
                                    $date = date('Y-m-d', strtotime('+8 days'));
                                    $rows2 = DB::table('b2c_tour_package_country')->where('agent_id',@$c_info->agent_id)->get();
                                    foreach ($rows2 as  $row){
                                        ?>
                                    <li>
                                        <a href="{{url('search-tour-package?country='.$row->name.'&checkinout='.$today.'+to+'.$date)}}">{{$row->name}}</a>
                                    </li>
                                        <?php
                                    }
                                ?>
                            </ul>
                        </li>
                        <li>
                            <a href="{{url('work-permit')}}">Work Permit</a>
                            <ul class="nav-dropdown nav-submenu">
                                <?php
                                $rows2 = DB::table('b2c_manpower_country')->where('agent_id',@$c_info->agent_id)->get();
                                foreach ($rows2 as  $row){
                                ?>
                                <li>
                                    <a href="{{url('search-manpower?country='.$row->name)}}">{{$row->name}}</a>
                                </li>
                                <?php
                                }
                                ?>
                            </ul>
                        </li>
                        <li><a href="{{url('about-us')}}">Hajj & Umrah </a></li>
                        <li><a href="{{url('about-us')}}">Education</a></li>
                        <li>
                            <a href="{{url('services')}}">Services</a>
                            <ul class="nav-dropdown nav-submenu">
                                    <?php
                                    $rows2 = DB::table('b2c_service')->where('agent_id',@$c_info->agent_id)->get();
                                foreach ($rows2 as  $row){
                                    ?>
                                <li>
                                    <a href="{{url('service?name='.$row->name)}}">{{$row->name}}</a>
                                </li>
                                    <?php
                                }
                                    ?>
                            </ul>
                        </li>
                        <li><a href="{{url('about-us')}}">About</a></li>
                        <li><a href="{{url('contact-us')}}">Contact</a></li>
                    </ul>
                    <ul class="nav-menu nav-menu-social align-to-right">
                        @if(Session::get('customer'))
                            <li>
                                    <?php
                                        $user_id = Session::get('user_id');
                                        $row = DB::table('users')->where('id',$user_id)->first();
                                        if($row->logo){
                                            $photo = $row->logo;
                                        }
                                        else{
                                            $photo = 'public/profile.png';
                                        }

                                    ?>
                                <div class="btn-group account-drop">
                                    <button type="button" class="btn btn-order-by-filt" data-bs-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        <img src="{{url($photo)}}" class="img-fluid" alt="">
                                    </button>
                                    <div class="dropdown-menu pull-right animated flipInX">
                                        <div class="drp_menu_headr">
                                            <h4>{{@$row->company_name}}</h4>
                                            <div class="drp_menu_headr-right">
                                                <a href="{{url('logout')}}" class="btn btn-md fw-medium btn-whites text-dark">Logout</a>
                                            </div>
                                        </div>
                                        <ul>
                                            <li><a href="{{url('customer-profile')}}"><i class="fa-regular fa-id-card me-2"></i>My Profile</a></li>
                                            <li><a href="my-booking.html"><i class="fa-solid fa-ticket me-2"></i>My Booking</a></li>
                                            <li><a href="travelers.html"><i class="fa-solid fa-user-group me-2"></i>My Travelers</a></li>
                                            <li><a href="payment-detail.html"><i class="fa-solid fa-wallet me-2"></i>Payment Details</a></li>
                                            <li><a href="my-wishlists.html"><i class="fa-solid fa-shield-heart me-2"></i>My Wishlist</a></li>
                                            <li><a href="login.html"><i class="fa-solid fa-power-off me-2"></i>Sign Out</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                        @else
                            <li class="list-buttons light">
                                <a href="{{url('all-login')}}"><i class="fa-regular fa-circle-user fs-6 me-2"></i>Sign In / Register</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <!-- End Navigation -->
    <div class="clearfix"></div>
    <!-- ============================================================== -->
    <!-- Top header  -->
    <!-- ============================================================== -->
        <?php } ?>
