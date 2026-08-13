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
          <div class="card-header bg-white p-0" id="headingBusiness">
            <h6 class="mb-2 font-weight-bold text-secondary">
              <a class="d-flex justify-content-between align-items-center text-dark py-2 px-2"
                 data-toggle="collapse" href="#collapseBusiness" aria-expanded="true" aria-controls="collapseBusiness">
                Mentor Types
                <span class="arrow">&#9662;</span>
              </a>
            </h6>
          </div>
          <div id="collapseBusiness" class="collapse show" data-parent="#filterAccordion">
            <div class="card-body py-2 pl-4">
              <p><input type="radio" name="business_type" value="all" {{ ($businessType ?? 'all') == 'all' ? 'checked' : '' }} onchange="this.form.submit()"> Education Professional</p>
              <p><input type="radio" name="business_type" value="sale" {{ ($businessType ?? 'all') == 'sale' ? 'checked' : '' }} onchange="this.form.submit()"> Corporate Professional</p>
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