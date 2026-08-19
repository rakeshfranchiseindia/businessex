<div class="col-md-3 catsh business-filter-column">
    <div class="catleft business-filter-sidebar">
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

      <form method="GET" action="{{ route('business.listing') }}">
      <div id="filterAccordion">

        <!-- Business Looking For -->
        <div class="card border-0">
          <div class="card-header bg-white p-0 business-filter-heading" id="headingBusiness">
            <h6 class="mb-2 font-weight-bold text-secondary">
              <a class="d-flex justify-content-between align-items-center text-dark py-2 px-2"
                 data-toggle="collapse" href="#collapseBusiness" aria-expanded="true" aria-controls="collapseBusiness">
                <label class="font-weight-bold text-secondary">BUSINESS LOOKING FOR</label>
                <span class="arrow">&#9662;</span>
              </a>
            </h6>
          </div>
          <div id="collapseBusiness" class="collapse show" data-parent="#filterAccordion">
            <div class="card-body py-2 pl-4 business-filter-body">
              <p><input type="radio" name="business_type" value="all" {{ ($businessType ?? 'all') == 'all' ? 'checked' : '' }} onchange="this.form.submit()"> All</p>
              <p><input type="radio" name="business_type" value="sale" {{ ($businessType ?? 'all') == 'sale' ? 'checked' : '' }} onchange="this.form.submit()"> Sale</p>
              <p><input type="radio" name="business_type" value="investor" {{ ($businessType ?? 'all') == 'investor' ? 'checked' : '' }} onchange="this.form.submit()"> Investor</p>
              <p><input type="radio" name="business_type" value="loan" {{ ($businessType ?? 'all') == 'loan' ? 'checked' : '' }} onchange="this.form.submit()"> Loan</p>
            </div>
          </div>
        </div>

        <!-- Annual Sales -->
        <div class="card border-0">
          <div class="card-header bg-white p-0 business-filter-heading" id="headingSales">
            <h6 class="mb-0">
              <a class="d-flex justify-content-between align-items-center text-dark py-2 px-2"
                 data-toggle="collapse" href="#collapseSales" aria-expanded="false" aria-controls="collapseSales">
                <label class="font-weight-bold text-secondary">ANNUAL SALES</label>
                <span class="arrow">&#9662;</span>
              </a>
            </h6>
          </div>
          <div id="collapseSales" class="collapse" data-parent="#filterAccordion">
                        <div class="container mt-4 px-0">
                            <div class="business-range">
                                <input type="range" id="businessAnnualMinRange" min="0" max="1000000000" step="100000" value="{{ request('annual_sale_min', 0) ?: 0 }}" aria-label="Minimum annual sales">
                                <input type="range" id="businessAnnualMaxRange" min="0" max="1000000000" step="100000" value="{{ request('annual_sale_max', 1000000000) ?: 1000000000 }}" aria-label="Maximum annual sales">
                            </div>
                            <div class="d-flex justify-content-between mt-2">
                                <span id="businessAnnualMinLabel">0</span>
                                <span id="businessAnnualMaxLabel">100.00 cr</span>
                            </div>
                            <input type="hidden" name="annual_sale_min" id="businessAnnualMinInput" value="{{ request('annual_sale_min', '') }}">
                            <input type="hidden" name="annual_sale_max" id="businessAnnualMaxInput" value="{{ request('annual_sale_max', '') }}">
                        </div>
          </div>
        </div>

        <!-- Location -->
        <div class="card border-0">
          <div class="card-header bg-white p-0 business-filter-heading" id="headingLocation">
            <h6 class="mb-0">
              <a class="d-flex justify-content-between align-items-center text-dark py-2 px-2"
                 data-toggle="collapse" href="#collapseLocation" aria-expanded="false" aria-controls="collapseLocation">
                <label class="font-weight-bold text-secondary">LOCATION</label>
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
          <div class="card-header bg-white p-0 business-filter-heading" id="headingIndustry">
            <h6 class="mb-2 font-weight-bold text-secondary">
              <a class="d-flex justify-content-between align-items-center text-dark py-2 px-2"
                 data-toggle="collapse" href="#collapseIndustry" aria-expanded="false" aria-controls="collapseIndustry">
                <label class="font-weight-bold text-secondary">INDUSTRIES</label>
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

      </div><!-- /filterAccordion -->
      </form>
    </div>
  </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        function syncParentCheckbox(parentSelector, childSelector) {
            document.querySelectorAll(parentSelector).forEach(function (parentCheckbox) {
                parentCheckbox.addEventListener('change', function () {
                    const parentGroup = this.dataset.parentGroup;
                    document.querySelectorAll(childSelector + '[data-group="' + parentGroup + '"]').forEach(function (childCheckbox) {
                        childCheckbox.checked = this.checked;
                        if (this.checked) {
                            childCheckbox.setAttribute('checked', 'checked');
                        } else {
                            childCheckbox.removeAttribute('checked');
                        }
                    }, this);
                    this.form.submit();
                });
            });
        }

        function syncChildParentState(parentSelector, childSelector) {
            document.querySelectorAll(childSelector).forEach(function (childCheckbox) {
                childCheckbox.addEventListener('change', function () {
                    const group = this.dataset.group;
                    const parentCheckbox = document.querySelector(parentSelector + '[data-parent-group="' + group + '"]');
                    if (!parentCheckbox) return;

                    const siblings = document.querySelectorAll(childSelector + '[data-group="' + group + '"]');
                    const allChecked = Array.from(siblings).every(function (checkbox) {
                        return checkbox.checked;
                    });

                    parentCheckbox.checked = allChecked;
                    parentCheckbox.form && parentCheckbox.form.submit();
                });
            });
        }

        syncParentCheckbox('.parent-location-filter', '.child-location-filter');
        syncChildParentState('.parent-location-filter', '.child-location-filter');
        syncParentCheckbox('.parent-industry-filter', '.child-industry-filter');
        syncChildParentState('.parent-industry-filter', '.child-industry-filter');
    });
</script>

<style>
    .business-filter-sidebar {
        background: #fff;
        max-height: calc(100vh - 30px);
        overflow-y: auto;
        box-shadow: none;
    }

    .business-filter-heading {
        border: 0;
        padding: 0;
    }

    .business-filter-body {
        border: 0;
    }

    .business-filter-sidebar .card {
        background: transparent;
    }

    .business-filter-sidebar .card-header,
    .business-filter-sidebar .card-body {
        background: #fff !important;
    }

    .business-filter-sidebar .parent-location-filter,
    .business-filter-sidebar .parent-industry-filter {
        margin-right: 10px;
    }

    .business-range {
        background: #f99549;
        border-radius: 6px;
        height: 6px;
        margin: 18px 10px 0;
        position: relative;
    }

    .business-range input {
        appearance: none;
        background: none;
        height: 6px;
        left: 0;
        margin: 0;
        outline: none;
        pointer-events: none;
        position: absolute;
        top: 0;
        width: 100%;
    }

    .business-range input::-webkit-slider-thumb {
        appearance: none;
        background: #f99549;
        border: 0;
        border-radius: 50%;
        cursor: pointer;
        height: 22px;
        pointer-events: auto;
        width: 22px;
    }

    .business-range input::-moz-range-thumb {
        background: #f99549;
        border: 0;
        border-radius: 50%;
        cursor: pointer;
        height: 22px;
        pointer-events: auto;
        width: 22px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const minRange = document.getElementById('businessAnnualMinRange');
        const maxRange = document.getElementById('businessAnnualMaxRange');
        const minInput = document.getElementById('businessAnnualMinInput');
        const maxInput = document.getElementById('businessAnnualMaxInput');
        const minLabel = document.getElementById('businessAnnualMinLabel');
        const maxLabel = document.getElementById('businessAnnualMaxLabel');

        function formatCrores(value) {
            return Number(value) === 0 ? '0' : (Number(value) / 10000000).toFixed(2) + ' cr';
        }

        function syncAnnualSales(submit) {
            if (!minRange || !maxRange) return;
            let minimum = Number(minRange.value);
            let maximum = Number(maxRange.value);
            if (minimum > maximum) {
                [minimum, maximum] = [maximum, minimum];
                minRange.value = minimum;
                maxRange.value = maximum;
            }
            minInput.value = minimum;
            maxInput.value = maximum;
            minLabel.textContent = formatCrores(minimum);
            maxLabel.textContent = formatCrores(maximum);
            if (submit) minRange.form.submit();
        }

        if (minRange && maxRange) {
            minRange.addEventListener('change', function () { syncAnnualSales(true); });
            maxRange.addEventListener('change', function () { syncAnnualSales(true); });
            syncAnnualSales(false);
        }

        document.querySelectorAll('.business-filter-sidebar .parent-location-filter, .business-filter-sidebar .parent-industry-filter').forEach(function (parentCheckbox) {
            parentCheckbox.addEventListener('click', function (event) {
                event.stopPropagation();
            });
        });

        document.querySelectorAll('.business-filter-sidebar .business-filter-heading a[data-toggle="collapse"]').forEach(function (toggle) {
            toggle.addEventListener('click', function () {
                const target = document.querySelector(this.getAttribute('href'));
                if (!target || window.jQuery) return;
                const isOpen = target.classList.toggle('show');
                this.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            });
        });
    });
</script>