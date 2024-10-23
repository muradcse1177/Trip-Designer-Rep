<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/dashboard')}}" class="brand-link">
        @if(@$company_info->logo)
            <div style="background-color: #FFFFFF; border-radius: 10px;" >
                <img src="{{url(@$company_info->logo)}}" width="150" height="40" style="margin-left: 20px; margin-top: 5px; margin-bottom: 5px;">
            </div>
        @else
            <div>
                <h4 style="color: #FFFFFF;">{{@$company_info->company_name}}</h4>
            </div>
        @endif
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-accordion="false">
                <li class="nav-item">
                    <a href="{{url('/main-dashboard')}}" class="nav-link @yield('mainDashboard')">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <?php
                    $r_details  = json_decode(@$role->details);
                ?>
                @if($company_info->role == 2)
                    <li class="nav-item">
                        <a href="{{url('/report-dashboard')}}" class="nav-link @yield('reportDashboard')">
                            <i class="nav-icon fas fa-chart-line"></i>
                            <p>Report Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('/g_invoice')}}" class="nav-link @yield('g_invoice')">
                            <i class="nav-icon fas fa-file-invoice"></i>
                            <p>General Invoice</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('/contacts')}}" class="nav-link @yield('contacts')">
                            <i class="nav-icon fas fa-address-book"></i>
                            <p>Contacts</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{url('/orderReceiver')}}" class="nav-link @yield('orderReceiver')">
                            <i class="nav-icon fas fa-shopping-cart"></i>
                            <p>B2C Order Request</p>
                        </a>
                    </li>
                    <li class="nav-item @yield('ticketMenu')">
                        <a href="#" class="nav-link @yield('airTicket')">
                            <i class="nav-icon fas fa-plane"></i>
                            <p>
                                Air Ticket
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{url('newAirTicket')}}" class="nav-link @yield('newAirTicket')">
                                    <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                    <p>New Air Ticket</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url("reissueAirTicket")}}" class="nav-link @yield('reissueAirTicket')">
                                    <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                    <p>Reissue Ticket</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url("refundAirTicket")}}" class="nav-link @yield('refundAirTicket')">
                                    <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                    <p>Refund Ticket</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url("cancelAirTicket")}}" class="nav-link @yield('cancelAirTicket')">
                                    <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                    <p>Temporary Cancel</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="https://tripdesigner.xyz/" class="nav-link" target="_blank">
                                    <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                    <p>Order Air Ticket</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item @yield('hotelMenu')">
                        <a href="#" class="nav-link @yield('hotel')">
                            <i class="nav-icon fas fa-home"></i>
                            <p>
                                Hotel Booking
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{url('hotelBooking')}}" class="nav-link @yield('hotelBooking')">
                                    <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                    <p>New Hotel Booking</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item @yield('visaMenu')">
                        <a href="#" class="nav-link @yield('visa')">
                            <i class="nav-icon fas fa-passport"></i>
                            <p>
                                Visa Processing
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{url("newVisaProcess")}}" class="nav-link @yield('newVisaProcess')">
                                    <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                    <p>Visa Management</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item @yield('tourMenu')">
                        <a href="#" class="nav-link @yield('tourPackage')">
                            <i class="nav-icon fas fa-umbrella-beach"></i>
                            <p>
                                Tour packages
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{url("newTourPackage")}}" class="nav-link @yield('newTourPackage')">
                                    <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                    <p> Tour Management</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item @yield('umrahMenu')">
                        <a href="#" class="nav-link @yield('umrahPackage')">
                            <i class="nav-icon fas fa-kaaba"></i>
                            <p>
                                Hajj & Umrah
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{url("newUmrahPackage")}}" class="nav-link @yield('newUmrahPackage')">
                                    <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                    <p> Hajj & Umrah</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item @yield('manPowerMenu')">
                        <a href="#" class="nav-link @yield('manPowerPackage')">
                            <i class="nav-icon fas fa-user-friends"></i>
                            <p>
                                Work Permit
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{url("newManPowerPackage")}}" class="nav-link @yield('newManPowerPackage')">
                                    <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                    <p> W.P Management</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item @yield('accountMenu')">
                        <a href="#" class="nav-link @yield('accounts')">
                            <i class="nav-icon fas fa-landmark"></i>
                            <p>
                                Accounts & Finance
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{url('bank-accounts')}}" class="nav-link @yield('bankAccountSuper')">
                                    <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                    <p>Bank Accounts </p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{url('payment-request')}}" class="nav-link @yield('paymentRequest')">
                                    <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                    <p>Payment Request</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{url('accountsHead')}}" class="nav-link @yield('accountsHead')">
                                    <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                    <p>Accounts Head</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{url('officeExpenses')}}" class="nav-link @yield('officeExpenses')">
                                    <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                    <p>Office Expense/Income</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{url('transactions')}}" class="nav-link @yield('transactions')">
                                    <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                    <p>Ledger Account</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{url('bankAccounts')}}" class="nav-link @yield('bankAccounts')">
                                    <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                    <p>Amount in Hand</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item  @yield('hrMenu')">
                        <a href="#" class="nav-link @yield('hr')">
                            <i class="nav-icon fas fa-balance-scale"></i>
                            <p>
                                Human Resource
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{url('designation')}}" class="nav-link  @yield('designation')">
                                    <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                    <p>Designation</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url('employees')}}" class="nav-link  @yield('employees')">
                                    <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                    <p>Employee Management</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url('roles')}}" class="nav-link  @yield('roles')">
                                    <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                    <p>Role Management</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item  @yield('userMenu')">
                        <a href="#" class="nav-link @yield('users')">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Passengers
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{url('users')}}" class="nav-link  @yield('users')">
                                    <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                    <p>Passengers</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item  @yield('agencyMenu')">
                        <a href="#" class="nav-link @yield('agency')">
                            <i class="nav-icon fas fa-city"></i>
                            <p>
                                Agency
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{url('agency')}}" class="nav-link  @yield('agency')">
                                    <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                    <p>Agency Management</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item  @yield('bankDetailsMenu')">
                        <a href="#" class="nav-link @yield('statement')">
                            <i class="nav-icon fas fa-piggy-bank"></i>
                            <p>
                                Bank Statement
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{url('ucbSolvency')}}" class="nav-link  @yield('ucbSolvency')">
                                    <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                    <p>UCB Solvency</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{url('ucbStatement')}}" class="nav-link  @yield('ucbStatement')">
                                    <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                    <p>UCB Statement</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item  @yield('senderMenu')">
                        <a href="#" class="nav-link @yield('sender')">
                            <i class="nav-icon fas fa-sms"></i>
                            <p>
                                Marketing
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{url('smsSender')}}" class="nav-link  @yield('smsSender')">
                                    <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                    <p>SMS Sender</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{url('smsLog')}}" class="nav-link  @yield('smsLog')">
                                    <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                    <p>SMS Log</p>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{url('emailSender')}}" class="nav-link  @yield('emailSender')">
                                    <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                    <p>Email Sender</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item  @yield('settingsMenu')">
                        <a href="#" class="nav-link @yield('settings')">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>
                                Admin Settings
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{url('companyInfo')}}" class="nav-link  @yield('companyInfo')">
                                    <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                    <p>Company Settings</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url('vendors')}}" class="nav-link  @yield('vendors')">
                                    <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                    <p>Vendor Settings</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url('airlines')}}" class="nav-link  @yield('airlines')">
                                    <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                    <p>Airlines Settings</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url('airports')}}" class="nav-link  @yield('airports')">
                                    <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                    <p>Airport Settings</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item  @yield('websiteMenu')">
                        <a href="#" class="nav-link @yield('webSettings')">
                            <i class="nav-icon fas fa-cog"></i>
                            <p>
                                Website Settings
                                <i class="fas fa-angle-left right"></i><br>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{url('b2cCompany')}}" class="nav-link  @yield('b2cCompany')">
                                    <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                    <p>Company Info</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url('domainManage')}}" class="nav-link  @yield('domainManage')">
                                    <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                    <p>Domain Management</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url('tourPackCountry')}}" class="nav-link  @yield('tourPackCountry')">
                                    <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                    <p>Tour Package Country</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url('b2cTourPackage')}}" class="nav-link  @yield('b2cTourPackage')">
                                    <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                    <p>Tour Package</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url('b2cVisaCountry')}}" class="nav-link  @yield('b2cVisaCountry')">
                                    <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                    <p>Visa Country</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url('b2cVisaManagement')}}" class="nav-link  @yield('b2cVisaManagement')">
                                    <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                    <p>Visa Settings</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url('b2cServiceManagement')}}" class="nav-link  @yield('b2cServiceManagement')">
                                    <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                    <p>Services</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url('b2cManpowerCountry')}}" class="nav-link  @yield('b2cManpowerCountry')">
                                    <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                    <p>Manpower Country</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url('b2cManpowerManagement')}}" class="nav-link  @yield('b2cManpowerManagement')">
                                    <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                    <p>Manpower Package</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url('b2cHajjUmrahManagememt')}}" class="nav-link  @yield('b2cHajjUmrahManagememt')">
                                    <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                    <p>Hajj & Umrah Package</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url('blogManagement')}}" class="nav-link  @yield('blogManagement')">
                                    <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                    <p>Blog Management</p>
                                </a>
                            </li>
                        </ul><br>
                    </li>
                @else
                    @if($r_details != null)
                        @foreach($r_details as $detail)
                            @if($detail == $attributes[1]->id)
                                <li class="nav-item">
                                    <a href="{{url('/report-dashboard')}}" class="nav-link @yield('reportDashboard')">
                                        <i class="nav-icon fas fa-chart-line"></i>
                                        <p>Report Dashboard</p>
                                    </a>
                                </li>
                            @endif
                            @if($detail == $attributes[2]->id)
                                <li class="nav-item">
                                    <a href="{{url('/g_invoice')}}" class="nav-link @yield('g_invoice')">
                                        <i class="nav-icon fas fa-file-invoice"></i>
                                        <p>General Invoice</p>
                                    </a>
                                </li>
                            @endif
                            @if($detail == $attributes[3]->id)
                                <li class="nav-item">
                                    <a href="{{url('/contacts')}}" class="nav-link @yield('contacts')">
                                        <i class="nav-icon fas fa-address-book"></i>
                                        <p>Contacts</p>
                                    </a>
                                </li>
                            @endif
                            @if($detail == $attributes[4]->id)
                                <li class="nav-item">
                                    <a href="{{url('/orderReceiver')}}" class="nav-link @yield('orderReceiver')">
                                        <i class="nav-icon fas fa-shopping-cart"></i>
                                        <p>B2C Order Request</p>
                                    </a>
                                </li>
                            @endif
                            @if($detail == $attributes[5]->id)
                                <li class="nav-item @yield('ticketMenu')">
                                    <a href="#" class="nav-link @yield('airTicket')">
                                        <i class="nav-icon fas fa-plane"></i>
                                        <p>
                                            Air Ticket
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{url('newAirTicket')}}" class="nav-link @yield('newAirTicket')">
                                                <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                                <p>New Air Ticket</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{url("reissueAirTicket")}}" class="nav-link @yield('reissueAirTicket')">
                                                <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                                <p>Reissue Ticket</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{url("refundAirTicket")}}" class="nav-link @yield('refundAirTicket')">
                                                <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                                <p>Refund Ticket</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{url("cancelAirTicket")}}" class="nav-link @yield('cancelAirTicket')">
                                                <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                                <p>Temporary Cancel</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="https://tripdesigner.xyz/" class="nav-link" target="_blank">
                                                <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                                <p>Order Air Ticket</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                            @if($detail == $attributes[6]->id)
                                <li class="nav-item @yield('hotelMenu')">
                                    <a href="#" class="nav-link @yield('hotel')">
                                        <i class="nav-icon fas fa-home"></i>
                                        <p>
                                            Hotel Booking
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{url('hotelBooking')}}" class="nav-link @yield('hotelBooking')">
                                                <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                                <p>New Hotel Booking</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                            @if($detail == $attributes[18]->id)
                                <li class="nav-item @yield('visaMenu')">
                                    <a href="#" class="nav-link @yield('visa')">
                                        <i class="nav-icon fas fa-passport"></i>
                                        <p>
                                            Visa Processing
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{url("newVisaProcess")}}" class="nav-link @yield('newVisaProcess')">
                                                <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                                <p>Visa Management</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                            @if($detail == $attributes[7]->id)
                                <li class="nav-item @yield('tourMenu')">
                                    <a href="#" class="nav-link @yield('tourPackage')">
                                        <i class="nav-icon fas fa-umbrella-beach"></i>
                                        <p>
                                            Tour packages
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{url("newTourPackage")}}" class="nav-link @yield('newTourPackage')">
                                                <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                                <p> Tour Management</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                            @if($detail == $attributes[8]->id)
                                <li class="nav-item @yield('umrahMenu')">
                                    <a href="#" class="nav-link @yield('umrahPackage')">
                                        <i class="nav-icon fas fa-kaaba"></i>
                                        <p>
                                            Hajj & Umrah
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{url("newUmrahPackage")}}" class="nav-link @yield('newUmrahPackage')">
                                                <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                                <p> Hajj & Umrah</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                            @if($detail == $attributes[9]->id)

                            @endif
                            @if($detail == $attributes[10]->id)
                                <li class="nav-item @yield('manPowerMenu')">
                                    <a href="#" class="nav-link @yield('manPowerPackage')">
                                        <i class="nav-icon fas fa-user-friends"></i>
                                        <p>
                                            Work Permit
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{url("newManPowerPackage")}}" class="nav-link @yield('newManPowerPackage')">
                                                <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                                <p> W.P Management</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                            @endif
                            @if($detail == $attributes[11]->id)
                                <li class="nav-item @yield('accountMenu')">
                                    <a href="#" class="nav-link @yield('accounts')">
                                        <i class="nav-icon fas fa-landmark"></i>
                                        <p>
                                            Accounts & Finance
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{url('bank-accounts')}}" class="nav-link @yield('bankAccountSuper')">
                                                <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                                <p>Bank Accounts </p>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{url('payment-request')}}" class="nav-link @yield('paymentRequest')">
                                                <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                                <p>Payment Request</p>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{url('accountsHead')}}" class="nav-link @yield('accountsHead')">
                                                <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                                <p>Accounts Head</p>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{url('officeExpenses')}}" class="nav-link @yield('officeExpenses')">
                                                <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                                <p>Office Expense/Income</p>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{url('transactions')}}" class="nav-link @yield('transactions')">
                                                <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                                <p>Ledger Account</p>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{url('bankAccounts')}}" class="nav-link @yield('bankAccounts')">
                                                <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                                <p>Amount in Hand</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                            @if($detail == $attributes[12]->id)
                                <li class="nav-item  @yield('hrMenu')">
                                    <a href="#" class="nav-link @yield('hr')">
                                        <i class="nav-icon fas fa-balance-scale"></i>
                                        <p>
                                            Human Resource
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{url('designation')}}" class="nav-link  @yield('designation')">
                                                <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                                <p>Designation</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{url('employees')}}" class="nav-link  @yield('employees')">
                                                <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                                <p>Employee Management</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                            @if($detail == $attributes[13]->id)
                                <li class="nav-item  @yield('userMenu')">
                                    <a href="#" class="nav-link @yield('users')">
                                        <i class="nav-icon fas fa-user"></i>
                                        <p>
                                            Passengers
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{url('users')}}" class="nav-link  @yield('users')">
                                                <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                                <p>Passengers</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                            @if($detail == $attributes[14]->id)
                                <li class="nav-item  @yield('agencyMenu')">
                                    <a href="#" class="nav-link @yield('agency')">
                                        <i class="nav-icon fas fa-city"></i>
                                        <p>
                                            Agency
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{url('agency')}}" class="nav-link  @yield('agency')">
                                                <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                                <p>Agency Management</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                            @if($detail == $attributes[15]->id)
                                <li class="nav-item  @yield('bankDetailsMenu')">
                                    <a href="#" class="nav-link @yield('statement')">
                                        <i class="nav-icon fas fa-piggy-bank"></i>
                                        <p>
                                            Bank Statement
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{url('ucbSolvency')}}" class="nav-link  @yield('ucbSolvency')">
                                                <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                                <p>UCB Solvency</p>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{url('ucbStatement')}}" class="nav-link  @yield('ucbStatement')">
                                                <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                                <p>UCB Statement</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                            @if($detail == $attributes[16]->id)
                                <li class="nav-item  @yield('senderMenu')">
                                    <a href="#" class="nav-link @yield('sender')">
                                        <i class="nav-icon fas fa-sms"></i>
                                        <p>
                                            Marketing
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{url('smsSender')}}" class="nav-link  @yield('smsSender')">
                                                <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                                <p>SMS Sender</p>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{url('smsLog')}}" class="nav-link  @yield('smsLog')">
                                                <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                                <p>SMS Log</p>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{url('emailSender')}}" class="nav-link  @yield('emailSender')">
                                                <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                                <p>Email Sender</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                            @if($detail == $attributes[17]->id)
                                <li class="nav-item  @yield('settingsMenu')">
                                    <a href="#" class="nav-link @yield('settings')">
                                        <i class="nav-icon fas fa-cogs"></i>
                                        <p>
                                            Admin Settings
                                            <i class="fas fa-angle-left right"></i>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{url('companyInfo')}}" class="nav-link  @yield('companyInfo')">
                                                <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                                <p>Company Settings</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{url('vendors')}}" class="nav-link  @yield('vendors')">
                                                <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                                <p>Vendor Settings</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{url('airlines')}}" class="nav-link  @yield('airlines')">
                                                <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                                <p>Airlines Settings</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{url('airports')}}" class="nav-link  @yield('airports')">
                                                <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                                <p>Airport Settings</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                            @if($detail == $attributes[19]->id)
                                <li class="nav-item  @yield('websiteMenu')">
                                    <a href="#" class="nav-link @yield('webSettings')">
                                        <i class="nav-icon fas fa-cog"></i>
                                        <p>
                                            Website Settings
                                            <i class="fas fa-angle-left right"></i><br>
                                        </p>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="{{url('b2cCompany')}}" class="nav-link  @yield('b2cCompany')">
                                                <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                                <p>Company Info</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{url('domainManage')}}" class="nav-link  @yield('domainManage')">
                                                <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                                <p>Domain Management</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{url('tourPackCountry')}}" class="nav-link  @yield('tourPackCountry')">
                                                <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                                <p>Tour Package Country</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{url('b2cTourPackage')}}" class="nav-link  @yield('b2cTourPackage')">
                                                <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                                <p>Tour Package</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{url('b2cVisaCountry')}}" class="nav-link  @yield('b2cVisaCountry')">
                                                <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                                <p>Visa Country</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{url('b2cVisaManagement')}}" class="nav-link  @yield('b2cVisaManagement')">
                                                <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                                <p>Visa Settings</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{url('b2cServiceManagement')}}" class="nav-link  @yield('b2cServiceManagement')">
                                                <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                                <p>Services</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{url('b2cManpowerCountry')}}" class="nav-link  @yield('b2cManpowerCountry')">
                                                <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                                <p>Manpower Country</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{url('b2cManpowerManagement')}}" class="nav-link  @yield('b2cManpowerManagement')">
                                                <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                                <p>Manpower Package</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{url('b2cHajjUmrahManagememt')}}" class="nav-link  @yield('b2cHajjUmrahManagememt')">
                                                <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                                <p>Hajj & Umrah Package</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{url('blogManagement')}}" class="nav-link  @yield('blogManagement')">
                                                <i class="far fa-arrow-alt-circle-right nav-icon"></i>
                                                <p>Blog Management</p>
                                            </a>
                                        </li>
                                    </ul><br>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endif

            </ul><br>
        </nav>
    </div>
</aside>
