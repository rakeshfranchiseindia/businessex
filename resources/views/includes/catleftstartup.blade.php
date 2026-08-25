<div class="col-md-3">
  <div class="border bg-white p-3 rounded startup-filter-sidebar">
    <h5 class="font-weight-bold mb-3 subhead">Filters</h5>

    @php
      $selectedBusinessType = request()->input('business_type', 'all');
      $selectedIndustries = collect(request()->input('industry', []))->map(fn ($value) => (int) $value)->all();
      $selectedMinInvestment = request()->input('min_investment', '');
      $selectedMaxInvestment = request()->input('max_investment', '');
      $expandInvestment = request()->hasAny(['min_investment', 'max_investment']);
    @endphp

    <form method="GET" action="{{ route('startup.listing') }}">
      <div id="filterAccordion">

        <div class="card border-0">
          <div class="card-header bg-white p-0 startup-filter-heading">
            <h6 class="mb-0 font-weight-bold text-secondary">
              <a class="d-flex justify-content-between align-items-center text-dark py-2 px-2"
                 data-toggle="collapse" href="#collapseMentor" aria-expanded="true">
                <label class="font-weight-bold text-secondary">STARTUPS LOOKING FOR</label>
                <span class="arrow">&#9662;</span>
              </a>
            </h6>
          </div>
          <div id="collapseMentor" class="collapse show" data-parent="#filterAccordion">
            <div class="card-body py-2 pl-3 startup-filter-body">
              <p><input type="radio" name="business_type" value="all"        {{ $selectedBusinessType === 'all'        ? 'checked' : '' }} onchange="this.form.submit()"> All</p>
              <p><input type="radio" name="business_type" value="investor"    {{ $selectedBusinessType === 'investor'    ? 'checked' : '' }} onchange="this.form.submit()"> Investor</p>
              <p><input type="radio" name="business_type" value="buyer"       {{ $selectedBusinessType === 'buyer'       ? 'checked' : '' }} onchange="this.form.submit()"> Buyer</p>
              <p><input type="radio" name="business_type" value="loan"        {{ $selectedBusinessType === 'loan'        ? 'checked' : '' }} onchange="this.form.submit()"> Lender</p>
              <p><input type="radio" name="business_type" value="mentorship" {{ $selectedBusinessType === 'mentorship' ? 'checked' : '' }} onchange="this.form.submit()"> Mentorship</p>
              <p><input type="radio" name="business_type" value="incubators" {{ $selectedBusinessType === 'incubators' ? 'checked' : '' }} onchange="this.form.submit()"> Incubators / Accelerators</p>
            </div>
          </div>
        </div>


        <div class="card border-0">
          <div class="card-header bg-white p-0 startup-filter-heading" id="headingSales">
            <h6 class="mb-0">
              <a class="d-flex justify-content-between align-items-center text-dark py-2 px-2"
                 data-toggle="collapse" href="#collapseSales" aria-expanded="{{ $expandInvestment ? 'true' : 'false' }}" aria-controls="collapseSales">
                <label class="font-weight-bold text-secondary">INVESTMENT SIZE</label>
                <span class="arrow">&#9662;</span>
              </a>
            </h6>
          </div>
          <div id="collapseSales" class="collapse {{ $expandInvestment ? 'show' : '' }}" data-parent="#filterAccordion">
            <div class="card-body py-2 pl-4 startup-filter-body">
              <div class="investment-range-container">
                <div id="investmentRange" class="investment-range">
                  <input type="range" id="investmentMinRange" min="0" max="1000000000" step="100000" value="{{ $selectedMinInvestment ?: 0 }}" aria-label="Minimum investment">
                  <input type="range" id="investmentMaxRange" min="0" max="1000000000" step="100000" value="{{ $selectedMaxInvestment ?: 1000000000 }}" aria-label="Maximum investment">
                </div>
                <div class="d-flex justify-content-between mt-2">
                  <span id="investmentMinLabel">0</span>
                  <span id="investmentMaxLabel">100.00 cr</span>
                </div>
                {{-- Hidden fields populated by the slider JS --}}
                <input type="hidden" name="min_investment" id="minInvestmentInput" value="{{ $selectedMinInvestment }}">
                <input type="hidden" name="max_investment" id="maxInvestmentInput" value="{{ $selectedMaxInvestment }}">
              </div>
            </div>
          </div>
        </div>
        <!-- Location -->
        <div class="card border-0">
          <div class="card-header bg-white p-0 startup-filter-heading">
            <h6 class="mb-0 font-weight-bold text-secondary">
              <a class="d-flex justify-content-between align-items-center text-dark py-2 px-2"
                 data-toggle="collapse" href="#collapseLocation" aria-expanded="true">
                <label class="font-weight-bold text-secondary">LOCATION</label>
                <span class="arrow">&#9662;</span>
              </a>
            </h6>
          </div>
          <div id="collapseLocation" class="collapse show" data-parent="#filterAccordion">
            <div class="card-body py-2 pl-3 startup-filter-body">
              @php
                  $locationGroups = collect($locations ?? [])->groupBy(fn($item) => $item->state ?? $item['state'] ?? '');
              @endphp

              @foreach($locationGroups as $stateName => $cities)
                @php
                    $stateKey = Str::slug($stateName . '-' . $loop->index);
                  $stateLabel = stateDisplayName($stateName);
                    $cityList = collect($cities)->map(fn($item) => [
                        'id' => (int) ($item->id ?? $item['id'] ?? 0),
                        'name' => trim((string) ($item->city ?? $item['city'] ?? ''))
                    ])->filter(fn($city) => $city['id'] > 0 && $city['name'] !== '');
                @endphp

                <div class="card border-0 mb-2">
                <div class="card-header bg-white p-0">
                    <h6 class="mb-0 d-flex justify-content-between align-items-center py-2 px-2">
                    <div class="d-flex align-items-center">
                        <input type="checkbox" class="mr-2 parent-location-filter"
                            data-parent-group="location-{{ $stateKey }}"
                            {{ $cityList->every(fn($city) => in_array($city['id'], $selectedLocations ?? [])) ? 'checked' : '' }}>
                        {{ $stateLabel }}
                    </div>
                    <!-- Arrow is the only collapse trigger -->
                    <a class="text-dark" data-toggle="collapse" href="#collapseState-{{ $stateKey }}" aria-expanded="false">
                        <span class="arrow">&#9662;</span>
                    </a>
                    </h6>
                </div>

                  <div id="collapseState-{{ $stateKey }}" class="collapse" data-parent="#collapseLocation">
                    <div class="card-body py-2 pl-4">
                      @foreach($cityList as $city)
                        <div class="form-check mb-1">
                          <input class="form-check-input child-location-filter" type="checkbox"
                                 name="location[]" value="{{ $city['id'] }}"
                                 data-group="location-{{ $stateKey }}"
                                 {{ in_array($city['id'], $selectedLocations ?? []) ? 'checked' : '' }}
                                 onchange="this.form.submit()">
                          <label class="form-check-label">{{ $city['name'] }}</label>
                        </div>
                      @endforeach
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>

        <!--- INDUSTRY SECTION --->
        <div class="card border-0">
          <div class="card-header bg-white p-0 startup-filter-heading">
            <h6 class="mb-0 font-weight-bold text-secondary">
              <a class="d-flex justify-content-between align-items-center text-dark py-2 px-2"
                 data-toggle="collapse" href="#collapseIndustry" aria-expanded="false" aria-controls="collapseIndustry">
                <label class="font-weight-bold text-secondary">INDUSTRIES</label>
                <span class="arrow">&#9662;</span>
              </a>
            </h6>
          </div>
          <div id="collapseIndustry" class="collapse" data-parent="#filterAccordion">
            <div id="industryAccordion" class="card-body py-2 pl-3 startup-filter-body">
              @php
                  $industryGroups = collect($industrySeller ?? [])
                      ->filter(fn ($item) => trim((string) ($item['industry'] ?? '')) !== '')
                      ->groupBy('industry')
                      ->sortKeys();
              @endphp

              @foreach($industryGroups as $industryName => $industryItems)
                @php
                    $industryKey = Str::slug($industryName . '-' . $loop->index);
                    $subIndustries = collect($industryItems)->map(fn ($item) => [
                        'id' => (int) ($item['subIndustryid'] ?? 0),
                        'name' => trim((string) ($item['subindustry'] ?? '')),
                    ])->filter(fn ($item) => $item['id'] > 0 && $item['name'] !== '')->unique('id')->values();
                @endphp

                <div class="card border-0 mb-2">
                  <div class="card-header bg-white p-0">
                    <h6 class="mb-0 d-flex justify-content-between align-items-center py-2 px-2">
                      <div class="d-flex align-items-center">
                        <input type="checkbox" class="mr-2 parent-industry-filter"
                               data-parent-group="industry-{{ $industryKey }}"
                               {{ $subIndustries->isNotEmpty() && $subIndustries->every(fn ($sub) => in_array($sub['id'], $selectedIndustries, true)) ? 'checked' : '' }}>
                        {{ $industryName }}
                      </div>
                      <a class="text-dark" data-toggle="collapse" href="#collapseIndustry-{{ $industryKey }}" aria-expanded="false">
                        <span class="arrow">&#9662;</span>
                      </a>
                    </h6>
                  </div>
                  <div id="collapseIndustry-{{ $industryKey }}" class="collapse" data-parent="#industryAccordion">
                    <div class="card-body py-2 pl-4">
                      @foreach($subIndustries as $subIndustry)
                        <div class="form-check mb-1">
                          <input type="checkbox" name="industry[]" value="{{ $subIndustry['id'] }}"
                                 class="form-check-input child-industry-filter"
                                 data-group="industry-{{ $industryKey }}"
                                 {{ in_array($subIndustry['id'], $selectedIndustries, true) ? 'checked' : '' }}
                                 onchange="this.form.submit()">
                          <label class="form-check-label">{{ $subIndustry['name'] }}</label>
                        </div>
                      @endforeach
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>

      </div>
    </form>
  </div>
</div>

<style>
  .startup-filter-sidebar {
    max-height: calc(100vh - 30px);
    overflow-y: auto;
  }

  .startup-filter-heading,
  .startup-filter-body {
    border-bottom: 1px solid #dfdfdf;
  }

  .startup-filter-heading h6,
  .startup-filter-heading a {
    min-height: 42px;
  }

  #investmentRange {
    margin: 18px 10px 0;
  }

  .investment-range {
    height: 6px;
    position: relative;
    border-radius: 6px;
    background: #f99549;
  }

  .investment-range input {
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

  .investment-range input::-webkit-slider-thumb {
    appearance: none;
    background: #f99549;
    border: 0;
    border-radius: 50%;
    cursor: pointer;
    height: 22px;
    pointer-events: auto;
    width: 22px;
  }

  .investment-range input::-moz-range-thumb {
    background: #f99549;
    border: 0;
    border-radius: 50%;
    cursor: pointer;
    height: 22px;
    pointer-events: auto;
    width: 22px;
  }

  .investment-range-container {
    padding: 0 0 12px;
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const minRange = document.getElementById('investmentMinRange');
    const maxRange = document.getElementById('investmentMaxRange');
    const minInput = document.getElementById('minInvestmentInput');
    const maxInput = document.getElementById('maxInvestmentInput');
    const minLabel = document.getElementById('investmentMinLabel');
    const maxLabel = document.getElementById('investmentMaxLabel');

    if (!minRange || !maxRange) return;

    function formatInvestment(value) {
      if (Number(value) === 0) return '0';
      return (Number(value) / 10000000).toFixed(2) + ' cr';
    }

    function syncInvestmentRange(submit) {
      let minimum = Number(minRange.value);
      let maximum = Number(maxRange.value);

      if (minimum > maximum) {
        [minimum, maximum] = [maximum, minimum];
        minRange.value = minimum;
        maxRange.value = maximum;
      }

      minInput.value = minimum;
      maxInput.value = maximum;
      minLabel.textContent = formatInvestment(minimum);
      maxLabel.textContent = formatInvestment(maximum);

      if (submit) minRange.form.submit();
    }

    minRange.addEventListener('change', function () { syncInvestmentRange(true); });
    maxRange.addEventListener('change', function () { syncInvestmentRange(true); });
    syncInvestmentRange(false);

    document.querySelectorAll('.parent-industry-filter').forEach(function (parentCheckbox) {
      parentCheckbox.addEventListener('change', function () {
        const group = this.dataset.parentGroup;
        const childCheckboxes = document.querySelectorAll(
          '.child-industry-filter[data-group="' + group + '"]'
        );

        childCheckboxes.forEach(function (childCheckbox) {
          childCheckbox.checked = parentCheckbox.checked;
        });

        this.form.submit();
      });
    });
  });
</script>