<div class="col-md-3">
  <div class="border bg-white p-3 rounded">
    <h5 class="font-weight-bold mb-3">Filters</h5>

    <form method="GET" action="{{ route('investor.listing') }}">
      <div id="filterAccordion">
        @php
        $selectedIndustries = collect(request()->input('industry', []))->map(fn ($value) => (int) $value)->all(); 
        @endphp
        <!-- Investor Types -->
        <div class="card border-0">
          <div class="card-header bg-white p-0 accordion_head">
            <h6 class="mb-2 font-weight-bold text-secondary">
              <a class="d-flex justify-content-between align-items-center text-dark py-2 px-2"
                 data-toggle="collapse" href="#collapseInvestor" aria-expanded="true">
                INVESTOR TYPES
                <span class="arrow">&#9662;</span>
              </a>
            </h6>
          </div>
          <div id="collapseInvestor" class="collapse show" data-parent="#filterAccordion">
            <div class="card-body py-2 pl-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="occupation[]" value="1"
                       {{ in_array(1, $selectedOccupations ?? []) ? 'checked' : '' }}
                       onchange="this.form.submit()">
                <label class="form-check-label">Individual Investor</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="occupation[]" value="2"
                       {{ in_array(2, $selectedOccupations ?? []) ? 'checked' : '' }}
                       onchange="this.form.submit()">
                <label class="form-check-label">Investment Firm</label>
              </div>
            </div>
          </div>
        </div>

        <!-- Investment Size -->
        <div class="card border-0">
          <div class="card-header bg-white p-0 accordion_head">
            <h6 class="mb-2 font-weight-bold text-secondary">
              <a class="d-flex justify-content-between align-items-center text-dark py-2 px-2"
                 data-toggle="collapse" href="#collapseSize" aria-expanded="false">
                INVESTMENT SIZE
                <span class="arrow">&#9662;</span>
              </a>
            </h6>
          </div>
          <div id="collapseSize" class="collapse" data-parent="#filterAccordion">
            <div class="card-body py-2 pl-3">
              <div class="form-group">
                <input type="range" class="form-control-range" id="investment-min"
                       min="2500000" max="2000000000" value="2500000" step="500000">
                <div class="bex-range-here">
                  <span class="fl">₹ 25 Lakhs</span>
                  <span class="fr">₹ 200 Crores</span>
                </div>
              </div>
              
            </div>
          </div>
        </div>

        <!-- Location -->
        <div class="card border-0">
          <div class="card-header bg-white p-0 accordion_head">
            <h6 class="mb-2 font-weight-bold text-secondary">
              <a class="d-flex justify-content-between align-items-center text-dark py-2 px-2"
                 data-toggle="collapse" href="#collapseLocation" aria-expanded="false">
                LOCATION
                <span class="arrow">&#9662;</span>
              </a>
            </h6>
          </div>
          <div id="collapseLocation" class="collapse" data-parent="#filterAccordion">
            <div class="card-body py-2 pl-3">
              @php
                  $locationGroups = collect($locations ?? [])->groupBy(fn($item) => $item->state ?? $item['state'] ?? '');
              @endphp

              @foreach($locationGroups as $stateName => $cities)
                @php
                    $stateKey = Str::slug($stateName . '-' . $loop->index);
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
                        {{ $stateName }}
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

        <!-- Industries -->
            <div class="card border-0">
            <div class="card-header bg-white p-0 accordion_head">
                <h6 class="mb-2 font-weight-bold text-secondary">
                <a class="d-flex justify-content-between align-items-center text-dark py-2 px-2"
                    data-toggle="collapse" href="#collapseIndustry" aria-expanded="false">
                    INDUSTRIES
                    <span class="arrow">&#9662;</span>
                </a>
                </h6>
            </div>
            <div id="collapseIndustry" class="collapse" data-parent="#filterAccordion">
                <div id="industryAccordion" class="card-body py-2 pl-4">
                @php
                    $industryGroups = collect($industrySeller ?? [])
                        ->filter(fn($item) => trim((string) ($item['industry'] ?? '')) !== '')
                        ->groupBy('industry')
                        ->sortKeys();
                @endphp

                @foreach($industryGroups as $industryName => $industryItems)
                    @php
                        $industryKey = Str::slug($industryName . '-' . $loop->index);
                        $subIndustries = collect($industryItems)->map(function ($item) {
                            return [
                                'id' => (int) ($item['subIndustryid'] ?? 0),
                                'name' => trim((string) ($item['subindustry'] ?? ''))
                            ];
                        })->filter(fn($item) => $item['id'] > 0 && $item['name'] !== '')
                        ->unique('id')->values();
                    @endphp

                    <div class="card border-0 mb-2">
                    <div class="card-header bg-white p-0">
                        <h6 class="mb-0 d-flex justify-content-between align-items-center py-2 px-2">
                        <div class="d-flex align-items-center">
                            <input type="checkbox" class="mr-2 parent-industry-filter"
                                data-parent-group="industry-{{ $industryKey }}"
                                {{ $subIndustries->every(fn($sub) => in_array($sub['id'], $selectedIndustries ?? [])) ? 'checked' : '' }}>
                            {{ $industryName }}
                        </div>
                        <!-- Arrow is the only collapse trigger -->
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
                                    {{ in_array($subIndustry['id'], $selectedIndustries ?? []) ? 'checked' : '' }}
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