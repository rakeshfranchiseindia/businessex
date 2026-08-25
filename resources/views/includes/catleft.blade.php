<div class="col-md-3">
  <div class="border bg-white p-3 rounded startup-filter-sidebar">
    <h5 class="font-weight-bold mb-3 subhead">Filters</h5>

    @php
      $selectedInvestorTypes = collect(request()->input('investorType', []))->map(fn ($value) => (int) $value)->all();
      $selectedIndustries = collect(request()->input('industrysub', []))->map(fn ($value) => (int) $value)->all();
      $selectedCities = collect(request()->input('city', []))->map(fn ($value) => trim((string) $value))->filter()->values()->all();
      $selectedMinInvestment = request()->input('minInvestment', '');
      $selectedMaxInvestment = request()->input('maxInvestment', '');
      $expandInvestment = request()->hasAny(['minInvestment', 'maxInvestment']);
    @endphp

    <form method="GET" action="{{ route('investor.listing') }}">
      <div id="filterAccordion">
        <div class="card border-0">
          <div class="card-header bg-white p-0 startup-filter-heading">
            <h6 class="mb-0 font-weight-bold text-secondary">
              <a class="d-flex justify-content-between align-items-center text-dark py-2 px-2" data-toggle="collapse" href="#collapseInvestor" aria-expanded="true" aria-controls="collapseInvestor">
                <label class="font-weight-bold text-secondary">INVESTOR TYPES</label>
                <span class="arrow">&#9662;</span>
              </a>
            </h6>
          </div>
          <div id="collapseInvestor" class="collapse show" data-parent="#filterAccordion">
            <div class="card-body py-2 pl-3 startup-filter-body">
              <p><input type="checkbox" name="investorType[]" value="2" {{ in_array(2, $selectedInvestorTypes, true) ? 'checked' : '' }} onchange="this.form.submit()"> Individual Investor</p>
              <p><input type="checkbox" name="investorType[]" value="1" {{ in_array(1, $selectedInvestorTypes, true) ? 'checked' : '' }} onchange="this.form.submit()"> Investment Firm</p>
            </div>
          </div>
        </div>

        <div class="card border-0">
          <div class="card-header bg-white p-0 startup-filter-heading">
            <h6 class="mb-0 font-weight-bold text-secondary">
              <a class="d-flex justify-content-between align-items-center text-dark py-2 px-2" data-toggle="collapse" href="#collapseInvestorSize" aria-expanded="{{ $expandInvestment ? 'true' : 'false' }}" aria-controls="collapseInvestorSize">
                <label class="font-weight-bold text-secondary">INVESTMENT SIZE</label>
                <span class="arrow">&#9662;</span>
              </a>
            </h6>
          </div>
          <div id="collapseInvestorSize" class="collapse {{ $expandInvestment ? 'show' : '' }}" data-parent="#filterAccordion">
            <div class="card-body py-2 pl-4 startup-filter-body">
              <div class="investment-range-container">
                <div class="investment-range">
                  <input type="range" id="investorMinRange" min="0" max="1000000000" step="100000" value="{{ $selectedMinInvestment ?: 0 }}" aria-label="Minimum investment">
                  <input type="range" id="investorMaxRange" min="0" max="1000000000" step="100000" value="{{ $selectedMaxInvestment ?: 1000000000 }}" aria-label="Maximum investment">
                </div>
                <div class="d-flex justify-content-between mt-2">
                  <span id="investorMinLabel">0</span>
                  <span id="investorMaxLabel">100.00 cr</span>
                </div>
                <input type="hidden" name="minInvestment" id="investorMinInput" value="{{ $selectedMinInvestment }}">
                <input type="hidden" name="maxInvestment" id="investorMaxInput" value="{{ $selectedMaxInvestment }}">
              </div>
            </div>
          </div>
        </div>

        <div class="card border-0">
          <div class="card-header bg-white p-0 startup-filter-heading">
            <h6 class="mb-0 font-weight-bold text-secondary">
              <a class="d-flex justify-content-between align-items-center text-dark py-2 px-2" data-toggle="collapse" href="#collapseInvestorLocation" aria-expanded="false" aria-controls="collapseInvestorLocation">
                <label class="font-weight-bold text-secondary">LOCATION</label>
                <span class="arrow">&#9662;</span>
              </a>
            </h6>
          </div>
          <div id="collapseInvestorLocation" class="collapse" data-parent="#filterAccordion">
            <div class="card-body py-2 pl-3 startup-filter-body">
              @php
                $locationGroups = collect($locations ?? [])
                  ->filter(fn ($item) => trim((string) ($item->state ?? $item['state'] ?? '')) !== '')
                  ->groupBy(fn ($item) => trim((string) ($item->state ?? $item['state'] ?? '')))
                  ->sortKeys();
              @endphp

              @foreach($locationGroups as $stateName => $cities)
                @php
                  $stateKey = Str::slug($stateName . '-' . $loop->index);
                  $stateLabel = stateDisplayName($stateName);
                  $cityList = collect($cities)->map(fn ($item) => trim((string) ($item->city ?? $item['city'] ?? '')))->filter()->unique()->values();
                @endphp
                <div class="card border-0 mb-2">
                  <div class="card-header bg-white p-0">
                    <h6 class="mb-0 d-flex justify-content-between align-items-center py-2 px-2">
                      <div class="d-flex align-items-center">
                           <input type="checkbox" class="mr-2 parent-location-filter" data-parent-group="location-{{ $stateKey }}"
                             {{ $cityList->isNotEmpty() && $cityList->every(fn ($cityName) => in_array($cityName, $selectedCities, true)) ? 'checked' : '' }}>
                        {{ $stateLabel }}
                      </div>
                      <a class="text-dark" data-toggle="collapse" href="#collapseInvestorState-{{ $stateKey }}" aria-expanded="false">
                        <span class="arrow">&#9662;</span>
                      </a>
                    </h6>
                  </div>
                  <div id="collapseInvestorState-{{ $stateKey }}" class="collapse" data-parent="#collapseInvestorLocation">
                    <div class="card-body py-2 pl-4">
                      @foreach($cityList as $cityName)
                        <div class="form-check mb-1">
                          <input class="form-check-input child-location-filter" type="checkbox" name="city[]" value="{{ $cityName }}" data-group="location-{{ $stateKey }}" {{ in_array($cityName, $selectedCities, true) ? 'checked' : '' }} onchange="this.form.submit()">
                          <label class="form-check-label">{{ $cityName }}</label>
                        </div>
                      @endforeach
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        </div>

        <div class="card border-0">
          <div class="card-header bg-white p-0 startup-filter-heading">
            <h6 class="mb-0 font-weight-bold text-secondary">
              <a class="d-flex justify-content-between align-items-center text-dark py-2 px-2" data-toggle="collapse" href="#collapseInvestorIndustry" aria-expanded="false" aria-controls="collapseInvestorIndustry">
                <label class="font-weight-bold text-secondary">INDUSTRIES</label>
                <span class="arrow">&#9662;</span>
              </a>
            </h6>
          </div>
          <div id="collapseInvestorIndustry" class="collapse" data-parent="#filterAccordion">
            <div id="investorIndustryAccordion" class="card-body py-2 pl-3 startup-filter-body">
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
                        <input type="checkbox" class="mr-2 parent-industry-filter" data-parent-group="industry-{{ $industryKey }}" {{ $subIndustries->isNotEmpty() && $subIndustries->every(fn ($sub) => in_array($sub['id'], $selectedIndustries, true)) ? 'checked' : '' }}>
                        {{ $industryName }}
                      </div>
                      <a class="text-dark" data-toggle="collapse" href="#collapseInvestorIndustry-{{ $industryKey }}" aria-expanded="false">
                        <span class="arrow">&#9662;</span>
                      </a>
                    </h6>
                  </div>
                  <div id="collapseInvestorIndustry-{{ $industryKey }}" class="collapse" data-parent="#investorIndustryAccordion">
                    <div class="card-body py-2 pl-4">
                      @foreach($subIndustries as $subIndustry)
                        <div class="form-check mb-1">
                          <input type="checkbox" name="industrysub[]" value="{{ $subIndustry['id'] }}" class="form-check-input child-industry-filter" data-group="industry-{{ $industryKey }}" {{ in_array($subIndustry['id'], $selectedIndustries, true) ? 'checked' : '' }} onchange="this.form.submit()">
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
  .startup-filter-sidebar { max-height: calc(100vh - 30px); overflow-y: auto; }
  .startup-filter-heading, .startup-filter-body { border-bottom: 1px solid #dfdfdf; }
  .startup-filter-heading h6, .startup-filter-heading a { min-height: 42px; }
  .investment-range { height: 6px; position: relative; border-radius: 6px; background: #f99549; margin: 18px 10px 0; }
  .investment-range input { appearance: none; background: none; height: 6px; left: 0; margin: 0; outline: none; pointer-events: none; position: absolute; top: 0; width: 100%; }
  .investment-range input::-webkit-slider-thumb { appearance: none; background: #f99549; border: 0; border-radius: 50%; cursor: pointer; height: 22px; pointer-events: auto; width: 22px; }
  .investment-range input::-moz-range-thumb { background: #f99549; border: 0; border-radius: 50%; cursor: pointer; height: 22px; pointer-events: auto; width: 22px; }
  .investment-range-container { padding: 0 0 12px; }
</style>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const minRange = document.getElementById('investorMinRange');
    const maxRange = document.getElementById('investorMaxRange');
    const minInput = document.getElementById('investorMinInput');
    const maxInput = document.getElementById('investorMaxInput');
    const minLabel = document.getElementById('investorMinLabel');
    const maxLabel = document.getElementById('investorMaxLabel');

    function syncInvestmentRange(submit) {
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
      minLabel.textContent = minimum === 0 ? '0' : (minimum / 10000000).toFixed(2) + ' cr';
      maxLabel.textContent = (maximum / 10000000).toFixed(2) + ' cr';
      if (submit) minRange.form.submit();
    }

    if (minRange && maxRange) {
      minRange.addEventListener('change', function () { syncInvestmentRange(true); });
      maxRange.addEventListener('change', function () { syncInvestmentRange(true); });
      syncInvestmentRange(false);
    }

    document.querySelectorAll('.parent-industry-filter, .parent-location-filter').forEach(function (parentCheckbox) {
      parentCheckbox.addEventListener('change', function () {
        const childSelector = this.classList.contains('parent-industry-filter') ? '.child-industry-filter' : '.child-location-filter';
        document.querySelectorAll(childSelector + '[data-group="' + this.dataset.parentGroup + '"]').forEach(function (childCheckbox) {
          childCheckbox.checked = parentCheckbox.checked;
        });
        this.form.submit();
      });
    });
  });
</script>
