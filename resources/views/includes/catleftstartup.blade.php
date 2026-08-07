<div class="col-md-3 catsh">
    <div class="catleft">
        <div id="closeftr" class="closebtn">
            <i class="fa fa-times fa-2x" aria-hidden="true"></i>
        </div>

        <div class="mainleftdiv">
            <div class="subhead">Filters</div>

            <!-- Investor Types -->
            <div class="accordion_container">
                <div class="accordion_head">
                    <a href="#">Investor types</a>
                    <span class="plusminus minus"></span>
                </div>
                <div class="accordion_body" style="display: block;">
                    <ul class="sub-menu">
                        @foreach(['All','Sale','Investment','Loan','Mentorship','Incubators','Accelerators'] as $type)
                            <li>
                                <input type="radio" name="sub_genre" value="{{ $type }}" class="sub-gen"> {{ $type }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Investment Size -->
            <div class="accordion_container">
                <div class="accordion_head">
                    <a href="#">Investment Size</a>
                    <span class="plusminus minus"></span>
                </div>
                <div class="accordion_body" style="display: block;">
                    <div class="leftfrmblk">
                        <form>
                            <div class="priblk">
                                <div id="html5"></div>
                                <div class="fbl">
                                    <div class="prlic1"><i class="fas fa-rupee-sign"></i> 5 Lakhs</div>
                                    <div class="prlic2"><i class="fas fa-rupee-sign"></i> 120 Crores</div>
                                </div>
                            </div>

                            <div class="bex-input-range-output">
                                <div class="bex-minmax-imput">
                                    <input type="number" min="100" max="1000" step="1" class="form-control form-control-md form-control-a">
                                </div>
                                <div class="bex-minmax-imput">
                                    <input type="number" min="200" max="1000" step="1" class="form-control form-control-md form-control-a">
                                </div>
                                <div class="bex-minmax-imput">
                                    <input type="button" class="pribtn" value="GO">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Location -->
            <div class="accordion_container">
                <div class="accordion_head">
                    <span class="plusminus minus"></span>
                    <a href="#">Location</a>
                </div>
                <div class="accordion_body" style="display: block;">
                    @foreach([
                        'Haryana' => ['Rohtak','Gurgaon'],
                        'Delhi' => ['New Delhi','South Delhi'],
                        'Madhya Pradesh' => ['Gwalior','Shivpuri']
                    ] as $state => $cities)
                        <div class="accordion_headmain">
                            <input type="checkbox" name="brand[]" value="{{ $state }}" class="brand-filter">
                            <a href="#">{{ $state }}</a>
                            <span class="rightdown"></span>
                        </div>
                        <div class="accordion_bodymain" style="display: {{ $loop->first ? 'block' : 'none' }};">
                            <ul class="sub-menu">
                                @foreach($cities as $city)
                                    <li>
                                        <input type="checkbox" name="sub_sub_category[]" value="{{ $city }}" class="sub-gen"> {{ $city }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach

                    <div class="morcity"><a href="#">25 More</a></div>
                </div>
            </div>

            <!-- Industries -->
            <div class="accordion_container">
                <div class="accordion_head">
                    <a href="#">Industries</a>
                    <span class="plusminus add"></span>
                </div>
                <div class="accordion_body" style="display: none;">
                    <ul class="sub-menu">
                        @foreach(['Investment','Acquisition','Landing'] as $industry)
                            <li>
                                <input type="radio" name="sub_genre" value="{{ $industry }}" class="sub-gen"> {{ $industry }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Annual Sales -->
            <div class="accordion_container">
                <div class="accordion_head">
                    <a href="#">Annual Sales</a>
                    <span class="plusminus minus"></span>
                </div>
                <div class="accordion_body" style="display: block;">
                    <div class="frmright">
                        <select class="form-control">
                            <option value="50 - 100 Crores">50 - 100 Crores</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Establishment Year -->
            <div class="accordion_container">
                <div class="accordion_head">
                    <a href="#">Establishment Year</a>
                    <span class="plusminus minus"></span>
                </div>
                <div class="accordion_body" style="display: block;">
                    <div class="frmright">
                        <select class="form-control">
                            <option value="2001 - 2010">2001 - 2010</option>
                            <option value="2011 - 2020">2011 - 2020</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Entity Type -->
            <div class="accordion_container">
                <div class="accordion_head">
                    <a href="#">Entity Type</a>
                    <span class="plusminus add"></span>
                </div>
                <div class="accordion_body" style="display: none;">More Filters</div>
            </div>

            <!-- Employee Count -->
            <div class="accordion_container">
                <div class="accordion_head">
                    <a href="#">Employee Count</a>
                    <span class="plusminus add"></span>
                </div>
                <div class="accordion_body" style="display: none;">More Filters</div>
            </div>

            <!-- Business Type -->
            <div class="accordion_container">
                <div class="accordion_head">
                    <a href="#">Business Type</a>
                    <span class="plusminus add"></span>
                </div>
                <div class="accordion_body" style="display: none;">More Filters</div>
            </div>
        </div>
    </div>
</div>