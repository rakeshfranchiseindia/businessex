<div class="col-md-3">
  <div class="border bg-white p-3 rounded">
    <h5 class="font-weight-bold mb-3">Filters</h5>

    <form method="GET" action="{{ route('mentor.listing') }}">
      <div id="filterAccordion">

        <!-- Mentor Types -->
        <div class="card border-0">
          <div class="card-header bg-white p-0">
            <h6 class="mb-2 font-weight-bold text-secondary">
              <a class="d-flex justify-content-between align-items-center text-dark py-2 px-2"
                 data-toggle="collapse" href="#collapseMentor" aria-expanded="true">
                Mentor Types
                <span class="arrow">&#9662;</span>
              </a>
            </h6>
          </div>
          <div id="collapseMentor" class="collapse show" data-parent="#filterAccordion">
            <div class="card-body py-2 pl-3">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="occupation[]" value="1"
                       {{ in_array(1, $selectedOccupations ?? []) ? 'checked' : '' }}
                       onchange="this.form.submit()">
                <label class="form-check-label">Education Professional</label>
              </div>
              <div class="form-check">
                
                <input class="form-check-input" type="checkbox" name="occupation[]" value="2"
                       {{ in_array(2, $selectedOccupations ?? []) ? 'checked' : '' }}
                       onchange="this.form.submit()">
                <label class="form-check-label">Corporate Professional</label>
              </div>
            </div>
          </div>
        </div>

        <!-- Location -->
        <div class="card border-0">
          <div class="card-header bg-white p-0">
            <h6 class="mb-2 font-weight-bold text-secondary">
              <a class="d-flex justify-content-between align-items-center text-dark py-2 px-2"
                 data-toggle="collapse" href="#collapseLocation" aria-expanded="true">
                Location
                <span class="arrow">&#9662;</span>
              </a>
            </h6>
          </div>
          <div id="collapseLocation" class="collapse show" data-parent="#filterAccordion">
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

      </div>
    </form>
  </div>
</div>

