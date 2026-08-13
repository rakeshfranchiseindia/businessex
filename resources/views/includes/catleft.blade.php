<div class="col-md-3 catsh">
    <div class="catleft">
        <div id="closeftr" class="closebtn">
            <i class="fa fa-times fa-2x" aria-hidden="true"></i>
        </div>

        <div class="mainleftdiv">
            <div class="subhead">Filters</div>

              @php
          $selectedLocations = collect(request()->input('location', []))->map(fn ($value) => (int) $value)->all();
          $selectedIndustries = collect(request()->input('industry', []))->map(fn ($value) => (int) $value)->all();

          $selectedLocationNames = collect($locations ?? [])->filter(function ($item) use ($selectedLocations) {
              $id = (int) ($item->id ?? $item['id'] ?? 0);
              return in_array($id, $selectedLocations, true);
          })->map(function ($item) {
              return trim((string) ($item->city ?? $item['city'] ?? ''));
          })->filter()->values()->all();

          $selectedIndustryNames = collect($industrySeller ?? [])->filter(function ($item) use ($selectedIndustries) {
              $id = (int) ($item['subIndustryid'] ?? 0);
              return in_array($id, $selectedIndustries, true);
          })->map(function ($item) {
              return trim((string) ($item['subindustry'] ?? ''));
          })->filter()->values()->all();
      @endphp

      @if(!empty($selectedLocationNames) || !empty($selectedIndustryNames) || ($businessType ?? 'all') !== 'all')
          <div class="mb-3 p-2 border rounded bg-light">
              <div class="small font-weight-bold mb-1">Selected filters</div>
              <div class="d-flex flex-wrap">
                  @if(($businessType ?? 'all') !== 'all')
                      <span class="badge badge-primary mr-1 mb-1">{{ ucfirst($businessType) }}</span>
                  @endif
                  @foreach(array_merge($selectedLocationNames, $selectedIndustryNames) as $filterName)
                      <span class="badge badge-secondary mr-1 mb-1">{{ $filterName }}</span>
                  @endforeach
              </div>
          </div>
      @endif

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
        <div class="card border-0">
          <div class="card-header bg-white p-0" id="headingLocation">
            <h6 class="mb-0">
              <a class="d-flex justify-content-between align-items-center text-dark py-2 px-2"
                 data-toggle="collapse" href="#collapseLocation" aria-expanded="false" aria-controls="collapseLocation">
                Location
                <span class="arrow">&#9662;</span>
              </a>
            </h6>
          </div>
          <div id="collapseLocation" class="collapse" data-parent="#filterAccordion">
            <div class="card-body py-2 pl-4">
              @php
                  $locationGroups = collect($locations ?? [])->groupBy(function ($item) {
                      return trim((string) ($item->state ?? $item['state'] ?? ''));
                  })->filter(function ($cities, $state) {
                      return trim((string) $state) !== '';
                  })->sortKeys();
              @endphp

              @if($locationGroups->isNotEmpty())
                  <div id="locationAccordion">
                      @foreach($locationGroups as $stateName => $cities)
                          @php
                              $stateKey = \Illuminate\Support\Str::slug($stateName . '-' . $loop->index);
                              $cityList = collect($cities)->map(function ($item) {
                                  $cityName = trim((string) ($item->city ?? $item['city'] ?? ''));
                                  $cityId = (int) ($item->id ?? $item['id'] ?? 0);

                                  return [
                                      'id' => $cityId,
                                      'name' => $cityName,
                                  ];
                              })->filter(function ($city) {
                                  return $city['id'] > 0 && trim((string) $city['name']) !== '';
                              })->unique('id')->values();
                          @endphp

                          <div class="card border-0 mb-2">
                              <div class="card-header bg-white p-0" id="headingLocation-{{ $stateKey }}">
                                  <h6 class="mb-0">
                                      <a class="d-flex justify-content-between align-items-center text-dark py-2 px-2"
                                         data-toggle="collapse" href="#collapseLocation-{{ $stateKey }}" aria-expanded="false" aria-controls="collapseLocation-{{ $stateKey }}">
                                          <div>
                                              <input type="checkbox" class="mr-2 parent-location-filter" data-parent-group="location-{{ $stateKey }}" {{ collect($cityList)->every(function ($city) use ($selectedLocations) { return in_array((int) $city['id'], $selectedLocations, true); }) ? 'checked' : '' }}> {{ $stateName }}
                                          </div>
                                          <span class="arrow">&#9662;</span>
                                      </a>
                                  </h6>
                              </div>

                              <div id="collapseLocation-{{ $stateKey }}" class="collapse" data-parent="#locationAccordion">
                                  <div class="card-body py-2 pl-4">
                                      <ul class="list-unstyled mb-0">
                                          @foreach($cityList as $city)
                                              <li class="mb-1">
                                                  <label class="mb-0">
                                                      <input type="checkbox" name="location[]" value="{{ $city['id'] }}" class="mr-2 child-location-filter" data-group="location-{{ $stateKey }}" {{ in_array((int) $city['id'], $selectedLocations, true) ? 'checked' : '' }} onchange="this.form.submit()"> {{ $city['name'] }}
                                                  </label>
                                              </li>
                                          @endforeach
                                      </ul>
                                  </div>
                              </div>
                          </div>
                      @endforeach
                  </div><!-- /locationAccordion -->
              @endif
            </div>
          </div>
        </div>

        <!-- Industries -->
        <div class="card border-0">
          <div class="card-header bg-white p-0" id="headingIndustry">
            <h6 class="mb-2 font-weight-bold text-secondary">
              <a class="d-flex justify-content-between align-items-center text-dark py-2 px-2"
                 data-toggle="collapse" href="#collapseIndustry" aria-expanded="false" aria-controls="collapseIndustry">
                Industry
                <span class="arrow">&#9662;</span>
              </a>
            </h6>
          </div>
          <div id="collapseIndustry" class="collapse" data-parent="#filterAccordion">
            <div id="industryAccordion" class="card-body py-2 pl-4">
              @php
                  $industryGroups = collect($industrySeller ?? [])
                      ->filter(function ($item) {
                          return trim((string) ($item['industry'] ?? '')) !== '';
                      })
                      ->groupBy('industry')
                      ->sortKeys();
              @endphp

              @if($industryGroups->isNotEmpty())
                  @foreach($industryGroups as $industryName => $industryItems)
                      @php
                          $industryKey = \Illuminate\Support\Str::slug($industryName . '-' . $loop->index);
                          $subIndustries = collect($industryItems)->map(function ($item) {
                              $subIndustryName = trim((string) ($item['subindustry'] ?? ''));
                              $subIndustryId = (int) ($item['subIndustryid'] ?? 0);

                              return [
                                  'id' => $subIndustryId,
                                  'name' => $subIndustryName,
                              ];
                          })->filter(function ($item) {
                              return $item['id'] > 0 && trim((string) $item['name']) !== '';
                          })->unique('id')->values();
                      @endphp

                      <div class="card border-0 mb-2">
                          <div class="card-header bg-white p-0" id="headingIndustry-{{ $industryKey }}">
                              <h6 class="mb-0">
                                  <a class="d-flex justify-content-between align-items-center text-dark py-2 px-2"
                                     data-toggle="collapse" href="#collapseIndustry-{{ $industryKey }}" aria-expanded="false" aria-controls="collapseIndustry-{{ $industryKey }}">
                                      <div>
                                          <input type="checkbox" class="mr-2 parent-industry-filter" data-parent-group="industry-{{ $industryKey }}" {{ collect($subIndustries)->every(function ($industry) use ($selectedIndustries) { return in_array((int) $industry['id'], $selectedIndustries, true); }) ? 'checked' : '' }}> {{ $industryName }}
                                      </div>
                                      <span class="arrow">&#9662;</span>
                                  </a>
                              </h6>
                          </div>

                          <div id="collapseIndustry-{{ $industryKey }}" class="collapse" data-parent="#industryAccordion">
                              <div class="card-body py-2 pl-4">
                                  <ul class="list-unstyled mb-0">
                                      @foreach($subIndustries as $subIndustry)
                                          <li class="mb-1">
                                              <label class="mb-0">
                                                  <input type="checkbox" name="industry[]" value="{{ $subIndustry['id'] }}" class="mr-2 child-industry-filter" data-group="industry-{{ $industryKey }}" {{ in_array((int) $subIndustry['id'], $selectedIndustries, true) ? 'checked' : '' }} onchange="this.form.submit()"> {{ $subIndustry['name'] }}
                                              </label>
                                          </li>
                                      @endforeach
                                  </ul>
                              </div>
                          </div>
                      </div>
                  @endforeach
              @endif
            </div>
          </div>
        </div>
            
        </div>
    </div>
</div>