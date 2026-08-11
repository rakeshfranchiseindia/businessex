<div class="col-md-3 catsh">
  <div class="catleft">
    <div id="closeftr" class="closebtn">
      <i class="fa fa-times fa-2x" aria-hidden="true"></i>
    </div>

    <div class="mainleftdiv">
      <div class="subhead font-weight-bold mb-3">Filters</div>

      <div id="filterAccordion">

        <!-- Business Looking For -->
        <div class="card border-0">
          <div class="card-header bg-white p-0" id="headingBusiness">
            <h6 class="mb-2 font-weight-bold text-secondary">
              <a class="d-flex justify-content-between align-items-center text-dark py-2 px-2"
                 data-toggle="collapse" href="#collapseBusiness" aria-expanded="true" aria-controls="collapseBusiness">
                Business Looking For
                <span class="arrow">&#9662;</span>
              </a>
            </h6>
          </div>
          <div id="collapseBusiness" class="collapse show" data-parent="#filterAccordion">
            <div class="card-body py-2 pl-4">
              <p><input type="radio" name="businessType"> All</p>
              <p><input type="radio" name="businessType"> Sale</p>
              <p><input type="radio" name="businessType"> Investor</p>
              <p><input type="radio" name="businessType"> Loan</p>
            </div>
          </div>
        </div>

        <!-- Annual Sales -->
        <div class="card border-0">
          <div class="card-header bg-white p-0" id="headingSales">
            <h6 class="mb-0">
              <a class="d-flex justify-content-between align-items-center text-dark py-2 px-2"
                 data-toggle="collapse" href="#collapseSales" aria-expanded="false" aria-controls="collapseSales">
                Annual Sales
                <span class="arrow">&#9662;</span>
              </a>
            </h6>
          </div>
          <div id="collapseSales" class="collapse" data-parent="#filterAccordion">
            <div class="card-body py-2 pl-4">
              <label class="font-weight-bold text-secondary">ANNUAL SALES</label>
              <div id="salesSlider"></div>
              <div class="d-flex justify-content-between mt-2">
                <span id="salesMin">0</span>
                <span id="salesMax">100.00 cr</span>
              </div>
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
                                  return trim((string) ($item->city ?? $item['city'] ?? ''));
                              })->filter()->unique()->values();
                          @endphp

                          <div class="card border-0 mb-2">
                              <div class="card-header bg-white p-0" id="headingLocation-{{ $stateKey }}">
                                  <h6 class="mb-0">
                                      <a class="d-flex justify-content-between align-items-center text-dark py-2 px-2"
                                         data-toggle="collapse" href="#collapseLocation-{{ $stateKey }}" aria-expanded="false" aria-controls="collapseLocation-{{ $stateKey }}">
                                          <div>
                                              <input type="checkbox" class="mr-2"> {{ $stateName }}
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
                                                      <input type="checkbox" class="mr-2"> {{ $city }}
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
                              return trim((string) ($item['subindustry'] ?? ''));
                          })->filter()->unique()->values();
                      @endphp

                      <div class="card border-0 mb-2">
                          <div class="card-header bg-white p-0" id="headingIndustry-{{ $industryKey }}">
                              <h6 class="mb-0">
                                  <a class="d-flex justify-content-between align-items-center text-dark py-2 px-2"
                                     data-toggle="collapse" href="#collapseIndustry-{{ $industryKey }}" aria-expanded="false" aria-controls="collapseIndustry-{{ $industryKey }}">
                                      <div>
                                          <input type="checkbox" class="mr-2"> {{ $industryName }}
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
                                                  <input type="checkbox" class="mr-2"> {{ $subIndustry }}
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

      </div><!-- /filterAccordion -->
    </div>
  </div>
</div>