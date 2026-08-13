{{-- File: resources/views/includes/catleftstartup.blade.php --}}
{{-- Sidebar filter for the Startup Listing page --}}
{{-- FIXES applied vs. original:
     1. Form action now points to route('startup.listing') instead of route('business.listing')
     2. Radio button values aligned with controller filter map
     3. checked conditions fixed for each radio
     4. Labels now match the actual filter purpose
     5. Added min/max investment hidden fields (populated by slider JS)
--}}

<div class="col-md-3 catsh">
  <div class="catleft">
    <div id="closeftr" class="closebtn">
      <i class="fa fa-times fa-2x" aria-hidden="true"></i>
    </div>

    <div class="mainleftdiv">
      <div class="subhead font-weight-bold mb-3">Filters</div>

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
              $id = (int) ($item->subIndustryid ?? 0);
              return in_array($id, $selectedIndustries, true);
          })->map(function ($item) {
              return trim((string) ($item->subindustry ?? ''));
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

      {{-- FIX: form action changed from business.listing to startup.listing --}}
      <form method="GET" action="{{ route('startup.listing') }}" id="startupFilterForm">
      <div id="filterAccordion">

        {{-- =============================================
             Startups Looking For  (Business Type Filter)
             ============================================= --}}
        <div class="card border-0">
          <div class="card-header bg-white p-0" id="headingBusiness">
            <h6 class="mb-2 font-weight-bold text-secondary">
              <a class="d-flex justify-content-between align-items-center text-dark py-2 px-2"
                 data-toggle="collapse" href="#collapseBusiness" aria-expanded="true" aria-controls="collapseBusiness">
                Startups Looking for
                <span class="arrow">&#9662;</span>
              </a>
            </h6>
          </div>
          <div id="collapseBusiness" class="collapse show" data-parent="#filterAccordion">
            <div class="card-body py-2 pl-4">
              {{-- FIX: values and checked conditions corrected --}}
              <p><input type="radio" name="business_type" value="all"        {{ ($businessType ?? 'all') === 'all'        ? 'checked' : '' }} onchange="this.form.submit()"> All</p>
              <p><input type="radio" name="business_type" value="investor"    {{ ($businessType ?? 'all') === 'investor'    ? 'checked' : '' }} onchange="this.form.submit()"> Investor</p>
              <p><input type="radio" name="business_type" value="buyer"       {{ ($businessType ?? 'all') === 'buyer'       ? 'checked' : '' }} onchange="this.form.submit()"> Buyer</p>
              <p><input type="radio" name="business_type" value="loan"        {{ ($businessType ?? 'all') === 'loan'        ? 'checked' : '' }} onchange="this.form.submit()"> Lender</p>
              <p><input type="radio" name="business_type" value="mentorship" {{ ($businessType ?? 'all') === 'mentorship' ? 'checked' : '' }} onchange="this.form.submit()"> Mentorship</p>
              <p><input type="radio" name="business_type" value="incubators" {{ ($businessType ?? 'all') === 'incubators' ? 'checked' : '' }} onchange="this.form.submit()"> Incubators / Accelerators</p>
            </div>
          </div>
        </div>

        {{-- =============================================
             Investment Size  (Range Slider)
             ============================================= --}}
        <div class="card border-0">
          <div class="card-header bg-white p-0" id="headingSales">
            <h6 class="mb-0">
              <a class="d-flex justify-content-between align-items-center text-dark py-2 px-2"
                 data-toggle="collapse" href="#collapseSales" aria-expanded="false" aria-controls="collapseSales">
                Investment Size
                <span class="arrow">&#9662;</span>
              </a>
            </h6>
          </div>
          <div id="collapseSales" class="collapse" data-parent="#filterAccordion">
            <div class="card-body py-2 pl-4">
              <div class="container mt-4">
                <label class="font-weight-bold text-secondary">INVESTMENT AMOUNT</label>
                <div id="investmentRange"></div>
                <div class="d-flex justify-content-between mt-2">
                  <span id="investmentMinLabel">0</span>
                  <span id="investmentMaxLabel">100 Cr</span>
                </div>
                {{-- Hidden fields populated by the slider JS --}}
                <input type="hidden" name="min_investment" id="minInvestmentInput" value="{{ request('min_investment', '') }}">
                <input type="hidden" name="max_investment" id="maxInvestmentInput" value="{{ request('max_investment', '') }}">
              </div>
            </div>
          </div>
        </div>

        {{-- =============================================
             Location
             ============================================= --}}
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
                                      'id'   => $cityId,
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
              @else
                  <p class="text-muted small">No locations available.</p>
              @endif
            </div>
          </div>
        </div>

        {{-- =============================================
             Industry
             ============================================= --}}
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
                          $industryName = trim((string) ($item->industry ?? ''));
                          return $industryName !== '';
                      })
                      ->groupBy(function ($item) {
                          return trim((string) ($item->industry ?? ''));
                      })
                      ->sortKeys();
              @endphp

              @if($industryGroups->isNotEmpty())
                  @foreach($industryGroups as $industryName => $industryItems)
                      @php
                          $industryKey = \Illuminate\Support\Str::slug($industryName . '-' . $loop->index);
                          $subIndustries = collect($industryItems)->map(function ($item) {
                              $subIndustryName = trim((string) ($item->subindustry ?? ''));
                              $subIndustryId = (int) ($item->subIndustryid ?? 0);

                              return [
                                  'id'   => $subIndustryId,
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
              @else
                  <p class="text-muted small">No industries available.</p>
              @endif
            </div>
          </div>
        </div>

      </div><!-- /filterAccordion -->
      </form>
    </div>
  </div>
</div>

{{-- ==================================================================
     JavaScript – Parent/Child checkbox sync + Investment range slider
     ================================================================== --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    // ----------------------------------
    // 1. Parent ↔ Child checkbox sync
    // ----------------------------------
    function syncParentCheckbox(parentSelector, childSelector) {
        document.querySelectorAll(parentSelector).forEach(function (parentCheckbox) {
            parentCheckbox.addEventListener('change', function () {
                var parentGroup = this.dataset.parentGroup;
                document.querySelectorAll(childSelector + '[data-group="' + parentGroup + '"]').forEach(function (childCheckbox) {
                    childCheckbox.checked = parentCheckbox.checked;
                    if (parentCheckbox.checked) {
                        childCheckbox.setAttribute('checked', 'checked');
                    } else {
                        childCheckbox.removeAttribute('checked');
                    }
                });
                parentCheckbox.form.submit();
            });
        });
    }

    function syncChildParentState(parentSelector, childSelector) {
        document.querySelectorAll(childSelector).forEach(function (childCheckbox) {
            childCheckbox.addEventListener('change', function () {
                var group = this.dataset.group;
                var parentCheckbox = document.querySelector(parentSelector + '[data-parent-group="' + group + '"]');
                if (!parentCheckbox) return;

                var siblings = document.querySelectorAll(childSelector + '[data-group="' + group + '"]');
                var allChecked = Array.from(siblings).every(function (cb) { return cb.checked; });
                parentCheckbox.checked = allChecked;

                parentCheckbox.form && parentCheckbox.form.submit();
            });
        });
    }

    syncParentCheckbox('.parent-location-filter', '.child-location-filter');
    syncChildParentState('.parent-location-filter', '.child-location-filter');
    syncParentCheckbox('.parent-industry-filter', '.child-industry-filter');
    syncChildParentState('.parent-industry-filter', '.child-industry-filter');

    // ----------------------------------
    // 2. Investment Range Slider
    //    (Uses noUiSlider if loaded, otherwise a plain HTML5 range)
    // ----------------------------------
    var minInput = document.getElementById('minInvestmentInput');
    var maxInput = document.getElementById('maxInvestmentInput');
    var minLabel = document.getElementById('investmentMinLabel');
    var maxLabel = document.getElementById('investmentMaxLabel');

    // If noUiSlider is available on the page, use it
    if (typeof noUiSlider !== 'undefined') {
        var slider = document.getElementById('investmentRange');
        if (slider) {
            noUiSlider.create(slider, {
                start: [
                    parseFloat(minInput.value) || 0,
                    parseFloat(maxInput.value) || 100000000
                ],
                connect: true,
                step: 100000,
                range: {
                    'min': 0,
                    'max': 100000000  // 100 Crore (10,00,00,000)
                },
                format: {
                    to: function (value) { return Math.round(value); },
                    from: function (value) { return Number(value); }
                }
            });

            function formatCr(value) {
                if (value >= 10000000) return (value / 10000000).toFixed(value % 10000000 === 0 ? 0 : 2) + ' Cr';
                if (value >= 100000) return (value / 100000).toFixed(value % 100000 === 0 ? 0 : 2) + ' L';
                return value.toLocaleString('en-IN');
            }

            slider.noUiSlider.on('update', function (values) {
                minLabel.textContent = formatCr(values[0]);
                maxLabel.textContent = formatCr(values[1]);
            });

            slider.noUiSlider.on('change', function (values) {
                minInput.value = values[0];
                maxInput.value = values[1];
                document.getElementById('startupFilterForm').submit();
            });
        }
    } else {
        // Fallback: two plain range inputs
        var container = document.getElementById('investmentRange');
        if (container) {
            container.innerHTML = '<div class="form-group">' +
                '<label>Min</label>' +
                '<input type="range" class="form-control-range" id="minRange" min="0" max="100000000" step="100000" value="' + (parseFloat(minInput.value) || 0) + '">' +
                '</div>' +
                '<div class="form-group mt-2">' +
                '<label>Max</label>' +
                '<input type="range" class="form-control-range" id="maxRange" min="0" max="100000000" step="100000" value="' + (parseFloat(maxInput.value) || 100000000) + '">' +
                '</div>';

            document.getElementById('minRange').addEventListener('change', function () {
                minInput.value = this.value;
                minLabel.textContent = Number(this.value).toLocaleString('en-IN');
                document.getElementById('startupFilterForm').submit();
            });
            document.getElementById('maxRange').addEventListener('change', function () {
                maxInput.value = this.value;
                maxLabel.textContent = Number(this.value).toLocaleString('en-IN');
                document.getElementById('startupFilterForm').submit();
            });
        }
    }
});
</script>
