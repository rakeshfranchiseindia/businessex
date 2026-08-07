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
                        <li><input type="radio" value="6" name="sub_genre" class="sub-gen"> All</li>
                        <li><input type="radio" value="7" name="sub_genre" class="sub-gen"> Individual</li>
                        <li><input type="radio" value="8" name="sub_genre" class="sub-gen"> Investment Firm</li>
                    </ul>
                </div>
            </div>

            <!-- Investment Preferences -->
            <div class="accordion_container">
                <div class="accordion_head">
                    <a href="#">Investment Preferences</a>
                    <span class="plusminus add"></span>
                </div>
                <div class="accordion_body" style="display: none;">
                    <ul class="sub-menu">
                        <li><input type="radio" value="6" name="sub_genre" class="sub-gen"> Investment</li>
                        <li><input type="radio" value="7" name="sub_genre" class="sub-gen"> Acquisition</li>
                        <li><input type="radio" value="8" name="sub_genre" class="sub-gen"> Lending</li>
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
                            <div class="form-group">
                                <input type="range" class="form-control-range" id="investment-min"
                                       min="2500000" max="2000000000" value="50" step="5">
                                <div class="bex-range-here">
                                    <span class="fl">₹ 25 Lakhs</span>
                                    <span class="fr">₹ 200 Crores</span>
                                </div>
                            </div>
                            <div class="bex-input-range-output">
                                <div class="bex-minmax-imput">
                                    <input type="text" class="form-control form-control-md form-control-a" value="2500000">
                                </div>
                                <div class="bex-minmax-imput">
                                    <input type="text" class="form-control form-control-md form-control-a" value="200000000">
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
                    <a href="#">Location</a>
                    <span class="plusminus minus"></span>
                </div>
                <div class="accordion_body" style="display: block;">

                    <!-- Haryana -->
                    <div class="accordion_headmain">
                        <input type="checkbox" value="2" name="brand[]" class="brand-filter">
                        <a href="#">Haryana</a>
                        <span class="rightdown downval"></span>
                    </div>
                    <div class="accordion_bodymain" style="display: block;">
                        <ul class="sub-menu">
                            <li><input type="checkbox" value="626" name="sub_sub_category" class="sub-gen"> Rohtak</li>
                            <li><input type="checkbox" value="444" name="sub_sub_category" class="sub-gen"> Gurgaon</li>
                        </ul>
                    </div>

                    <!-- Delhi -->
                    <div class="accordion_headmain">
                        <input type="checkbox" value="2" name="brand[]" class="brand-filter">
                        <a href="#">Delhi</a>
                        <span class="rightdown rightval"></span>
                    </div>
                    <div class="accordion_bodymain" style="display: none;">
                        <ul class="sub-menu">
                            <li><input type="checkbox" value="626" name="sub_sub_category" class="sub-gen"> New Delhi</li>
                            <li><input type="checkbox" value="444" name="sub_sub_category" class="sub-gen"> South Delhi</li>
                        </ul>
                    </div>

                    <!-- Madhya Pradesh -->
                    <div class="accordion_headmain">
                        <input type="checkbox" value="2" name="brand[]" class="brand-filter">
                        <a href="#">Madhya Pradesh</a>
                        <span class="rightdown rightval"></span>
                    </div>
                    <div class="accordion_bodymain" style="display: none;">
                        <ul class="sub-menu">
                            <li><input type="checkbox" value="626" name="sub_sub_category" class="sub-gen"> Gwalior</li>
                            <li><input type="checkbox" value="444" name="sub_sub_category" class="sub-gen"> Shivpuri</li>
                        </ul>
                    </div>

                    <div class="morcity"><a href="#">25 More</a></div>
                </div>
            </div>

            <!-- Extra Filters -->
            <div class="accordion_container">
                <div class="accordion_head">
                    <a href="#">Investment Preferences 1</a>
                    <span class="plusminus add"></span>
                </div>
                <div class="accordion_body" style="display: none;">More Filters</div>
            </div>

            <div class="accordion_container">
                <div class="accordion_head">
                    <a href="#">Investment Preferences 2</a>
                    <span class="plusminus add"></span>
                </div>
                <div class="accordion_body" style="display: none;">More Filters</div>
            </div>

            <div class="accordion_container">
                <div class="accordion_head">
                    <a href="#">More Filters</a>
                    <span class="plusminus add"></span>
                </div>
                <div class="accordion_body" style="display: none;">More Filters</div>
            </div>
        </div>
    </div>
</div>