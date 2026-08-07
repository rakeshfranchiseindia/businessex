<div class="col-md-3 catsh">
    <div class="catleft">
        <div id="closeftr" class="closebtn">
            <i class="fa fa-times fa-2x" aria-hidden="true"></i>
        </div>

        <div class="mainleftdiv">
            <div class="subhead">Filters</div>

            <!-- Mentor Types -->
            <div class="accordion_container">
                <div class="accordion_head">
                    <a href="#">Mentor types</a>
                    <span class="plusminus minus"></span>
                </div>
                <div class="accordion_body" style="display: block;">
                    <ul class="sub-menu">
                        @foreach(['All','Educational Professional','Corporate Professional'] as $type)
                            <li>
                                <input type="radio" name="mentor_type" value="{{ $type }}" class="sub-gen"> {{ $type }}
                            </li>
                        @endforeach
                    </ul>
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
                            <input type="checkbox" name="state[]" value="{{ $state }}" class="brand-filter">
                            <a href="#">{{ $state }}</a>
                            <span class="rightdown"></span>
                        </div>
                        <div class="accordion_bodymain" style="display: {{ $loop->first ? 'block' : 'none' }};">
                            <ul class="sub-menu">
                                @foreach($cities as $city)
                                    <li>
                                        <input type="checkbox" name="city[]" value="{{ $city }}" class="sub-gen"> {{ $city }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach

                    <div class="morcity"><a href="#">25 More</a></div>
                </div>
            </div>

            <!-- Extra Filters -->
            @foreach(['Investment Preferences 1','Investment Preferences 2','More Filters'] as $filter)
                <div class="accordion_container">
                    <div class="accordion_head">
                        <a href="#">{{ $filter }}</a>
                        <span class="plusminus add"></span>
                    </div>
                    <div class="accordion_body" style="display: none;">
                        More Filters
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>