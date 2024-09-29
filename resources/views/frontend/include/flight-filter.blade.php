<div class="col-xl-3 col-lg-4 col-md-12">
    <div class="filter-searchBar bg-white rounded-3">
        <div class="filter-searchBar-head border-bottom">
            <div class="searchBar-headerBody d-flex align-items-start justify-content-between px-3 py-3">
                <div class="searchBar-headerfirst">
                    <h6 class="fw-bold fs-5 m-0">Filters</h6>
                    <p class="text-md text-muted m-0">Showing 180 Flights</p>
                </div>
                <div class="searchBar-headerlast text-end">
                    <a href="#" class="text-md fw-medium text-primary active">Clear All</a>
                </div>
            </div>
        </div>

        <div class="filter-searchBar-body">

            <!-- Departure & Return -->
            <div class="searchBar-single px-3 py-3 border-bottom">
                <div class="searchBar-single-title d-flex mb-3">
                    <h6 class="sidebar-subTitle fs-6 fw-medium m-0">Departure</h6>
                </div>
                <div class="searchBar-single-wrap mb-4">
                    <ul class="row align-items-center justify-content-between p-0 gx-3 gy-2">
                        <li class="col-6">
                            <input type="checkbox" class="btn-check" id="before6am">
                            <label class="btn btn-sm btn-secondary rounded-1 fw-medium px-4 full-width"
                                   for="before6am">Before 6AM</label>
                        </li>
                        <li class="col-6">
                            <input type="checkbox" class="btn-check" id="6am12pm">
                            <label class="btn btn-sm btn-secondary rounded-1 fw-medium px-4 full-width" for="6am12pm">6AM -
                                12PM</label>
                        </li>
                        <li class="col-6">
                            <input type="checkbox" class="btn-check" id="12pm6pm">
                            <label class="btn btn-sm btn-secondary rounded-1 fw-medium px-4 full-width" for="12pm6pm">12PM -
                                6PM</label>
                        </li>
                        <li class="col-6">
                            <input type="checkbox" class="btn-check" id="after6pm">
                            <label class="btn btn-sm btn-secondary rounded-1 fw-medium px-4 full-width" for="after6pm">After
                                6PM</label>
                        </li>
                    </ul>
                </div>

                <div class="searchBar-single-title d-flex mb-3">
                    <h6 class="sidebar-subTitle fs-6 fw-medium m-0">Return</h6>
                </div>
                <div class="searchBar-single-wrap">
                    <ul class="row align-items-center justify-content-between p-0 gx-3 gy-2">
                        <li class="col-6">
                            <input type="checkbox" class="btn-check" id="before6am1">
                            <label class="btn btn-sm btn-secondary rounded-1 fw-medium px-4 full-width"
                                   for="before6am1">Before 6AM</label>
                        </li>
                        <li class="col-6">
                            <input type="checkbox" class="btn-check" id="6am12pm1">
                            <label class="btn btn-sm btn-secondary rounded-1 fw-medium px-4 full-width" for="6am12pm1">6AM -
                                12PM</label>
                        </li>
                        <li class="col-6">
                            <input type="checkbox" class="btn-check" id="12pm6pm1">
                            <label class="btn btn-sm btn-secondary rounded-1 fw-medium px-4 full-width" for="12pm6pm1">12PM
                                - 6PM</label>
                        </li>
                        <li class="col-6">
                            <input type="checkbox" class="btn-check" id="after6pm1">
                            <label class="btn btn-sm btn-secondary rounded-1 fw-medium px-4 full-width"
                                   for="after6pm1">After 6PM</label>
                        </li>
                    </ul>
                </div>

            </div>

            <!-- Onward Stops -->
            <div class="searchBar-single px-3 py-3 border-bottom">
                <div class="searchBar-single-title d-flex mb-3">
                    <h6 class="sidebar-subTitle fs-6 fw-medium m-0">Onward Stops</h6>
                </div>
                <div class="searchBar-single-wrap">
                    <ul class="row align-items-center justify-content-between p-0 gx-3 gy-2">
                        <li class="col-6">
                            <input type="checkbox" class="btn-check" id="direct">
                            <label class="btn btn-sm btn-secondary rounded-1 fw-medium px-4 full-width"
                                   for="direct">Direct</label>
                        </li>
                        <li class="col-6">
                            <input type="checkbox" class="btn-check" id="1stop">
                            <label class="btn btn-sm btn-secondary rounded-1 fw-medium px-4 full-width" for="1stop">1
                                Stop</label>
                        </li>
                        <li class="col-6">
                            <input type="checkbox" class="btn-check" id="2stop">
                            <label class="btn btn-sm btn-secondary rounded-1 fw-medium px-4 full-width" for="2stop">2+
                                Stop</label>
                        </li>
                    </ul>
                </div>

                <div class="searchBar-single-title d-flex mb-3">
                    <h6 class="sidebar-subTitle fs-6 fw-medium m-0">Return Stops</h6>
                </div>
                <div class="searchBar-single-wrap">
                    <ul class="row align-items-center justify-content-between p-0 gx-3 gy-2">
                        <li class="col-6">
                            <input type="checkbox" class="btn-check" id="direct1">
                            <label class="btn btn-sm btn-secondary rounded-1 fw-medium px-4 full-width"
                                   for="direct1">Direct</label>
                        </li>
                        <li class="col-6">
                            <input type="checkbox" class="btn-check" id="1stop1">
                            <label class="btn btn-sm btn-secondary rounded-1 fw-medium px-4 full-width" for="1stop1">1
                                Stop</label>
                        </li>
                        <li class="col-6">
                            <input type="checkbox" class="btn-check" id="2stop1">
                            <label class="btn btn-sm btn-secondary rounded-1 fw-medium px-4 full-width" for="2stop1">2+
                                Stop</label>
                        </li>
                    </ul>
                </div>

            </div>

            <!-- Pricing -->
            <div class="searchBar-single px-3 py-3 border-bottom">
                <div class="searchBar-single-title d-flex mb-3">
                    <h6 class="sidebar-subTitle fs-6 fw-medium m-0">Pricing Range in US$</h6>
                </div>
                <div class="searchBar-single-wrap">
                    <input type="text" class="js-range-slider" name="my_range" value="" data-skin="round"
                           data-type="double" data-min="0" data-max="1000" data-grid="false">
                </div>
            </div>

            <!-- Facilities -->
            <div class="searchBar-single px-3 py-3 border-bottom">
                <div class="searchBar-single-title d-flex mb-3">
                    <h6 class="sidebar-subTitle fs-6 fw-medium m-0">Facilities</h6>
                </div>
                <div class="searchBar-single-wrap">
                    <ul class="row align-items-center justify-content-between p-0 gx-3 gy-2">
                        <li class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="baggage">
                                <label class="form-check-label" for="baggage">Baggage</label>
                            </div>
                        </li>
                        <li class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="inflightmeal">
                                <label class="form-check-label" for="inflightmeal">In-flight Meal</label>
                            </div>
                        </li>
                        <li class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="inflightenter">
                                <label class="form-check-label" for="inflightenter">In-flight Entertainment</label>
                            </div>
                        </li>
                        <li class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="flswifi">
                                <label class="form-check-label" for="flswifi">WiFi</label>
                            </div>
                        </li>
                        <li class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="flusbport">
                                <label class="form-check-label" for="flusbport">Power/USB Port</label>
                            </div>
                        </li>
                    </ul>
                </div>

            </div>

            <!-- Popular Flights -->
            <div class="searchBar-single px-3 py-3 border-bottom">
                <div class="searchBar-single-title d-flex align-items-center justify-content-between mb-3">
                    <h6 class="sidebar-subTitle fs-6 fw-medium m-0">Preferred Airlines</h6>
                    <a href="#" class="text-md fw-medium text-muted active">Reset</a>
                </div>
                <div class="searchBar-single-wrap">
                    <ul class="row align-items-center justify-content-between p-0 gx-3 gy-2">
                        <li class="col-12">
                            <div class="form-check lg">
                                <div class="frm-slicing d-flex align-items-center">
                                    <div class="frm-slicing-first">
                                        <input class="form-check-input" type="checkbox" id="baggage1">
                                        <label class="form-check-label" for="baggage1"></label>
                                    </div>
                                    <div
                                        class="frm-slicing-end d-flex align-items-center justify-content-between full-width ps-1">
                                        <div class="frms-flex d-flex align-items-center">
                                            <div class="frm-slicing-img"><img src="assets/img/air-1.png" class="img-fluid" width="25"
                                                                              alt=""></div>
                                            <div class="frm-slicing-title ps-2"><span class="text-muted-2">Air India</span></div>
                                        </div>
                                        <div class="text-end"><span class="text-md text-muted-2 opacity-75">$390.00</span></div>
                                    </div>
                                </div>

                            </div>
                        </li>
                        <li class="col-12">
                            <div class="form-check lg">
                                <div class="frm-slicing d-flex align-items-center">
                                    <div class="frm-slicing-first">
                                        <input class="form-check-input" type="checkbox" id="baggage2">
                                        <label class="form-check-label" for="baggage2"></label>
                                    </div>
                                    <div
                                        class="frm-slicing-end d-flex align-items-center justify-content-between full-width ps-1">
                                        <div class="frms-flex d-flex align-items-center">
                                            <div class="frm-slicing-img"><img src="assets/img/air-2.png" class="img-fluid" width="25"
                                                                              alt=""></div>
                                            <div class="frm-slicing-title ps-2"><span class="text-muted-2">Jal Airlines</span></div>
                                        </div>
                                        <div class="text-end"><span class="text-md text-muted-2 opacity-75">$310.00</span></div>
                                    </div>
                                </div>

                            </div>
                        </li>
                        <li class="col-12">
                            <div class="form-check lg">
                                <div class="frm-slicing d-flex align-items-center">
                                    <div class="frm-slicing-first">
                                        <input class="form-check-input" type="checkbox" id="baggage3">
                                        <label class="form-check-label" for="baggage3"></label>
                                    </div>
                                    <div
                                        class="frm-slicing-end d-flex align-items-center justify-content-between full-width ps-1">
                                        <div class="frms-flex d-flex align-items-center">
                                            <div class="frm-slicing-img"><img src="assets/img/air-3.png" class="img-fluid" width="25"
                                                                              alt=""></div>
                                            <div class="frm-slicing-title ps-2"><span class="text-muted-2">Indigo</span></div>
                                        </div>
                                        <div class="text-end"><span class="text-md text-muted-2 opacity-75">$390.00</span></div>
                                    </div>
                                </div>

                            </div>
                        </li>
                        <li class="col-12">
                            <div class="form-check lg">
                                <div class="frm-slicing d-flex align-items-center">
                                    <div class="frm-slicing-first">
                                        <input class="form-check-input" type="checkbox" id="baggage4">
                                        <label class="form-check-label" for="baggage4"></label>
                                    </div>
                                    <div
                                        class="frm-slicing-end d-flex align-items-center justify-content-between full-width ps-1">
                                        <div class="frms-flex d-flex align-items-center">
                                            <div class="frm-slicing-img"><img src="assets/img/air-4.png" class="img-fluid" width="25"
                                                                              alt=""></div>
                                            <div class="frm-slicing-title ps-2"><span class="text-muted-2">Air Asia</span></div>
                                        </div>
                                        <div class="text-end"><span class="text-md text-muted-2 opacity-75">$410.00</span></div>
                                    </div>
                                </div>

                            </div>
                        </li>
                        <li class="col-12">
                            <div class="form-check lg">
                                <div class="frm-slicing d-flex align-items-center">
                                    <div class="frm-slicing-first">
                                        <input class="form-check-input" type="checkbox" id="baggage5">
                                        <label class="form-check-label" for="baggage5"></label>
                                    </div>
                                    <div
                                        class="frm-slicing-end d-flex align-items-center justify-content-between full-width ps-1">
                                        <div class="frms-flex d-flex align-items-center">
                                            <div class="frm-slicing-img"><img src="assets/img/air-5.png" class="img-fluid" width="25"
                                                                              alt=""></div>
                                            <div class="frm-slicing-title ps-2"><span class="text-muted-2">Vistara</span></div>
                                        </div>
                                        <div class="text-end"><span class="text-md text-muted-2 opacity-75">$370.00</span></div>
                                    </div>
                                </div>

                            </div>
                        </li>
                    </ul>
                </div>

            </div>

        </div>
    </div>
</div>
