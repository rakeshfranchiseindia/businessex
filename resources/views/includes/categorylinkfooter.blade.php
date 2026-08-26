<!-- Footer Tabs -->
<div class="footer-tabs">
  <!-- Nav tabs -->
  <ul class="nav nav-tabs nav-tabs-footer" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#business-tab" role="tab">Business</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#startup-tab" role="tab">Startup</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#investor-tab" role="tab">Investor</a>
    </li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <!-- Business Tab -->
    <div class="tab-pane fade show active footer-categories" id="business-tab" role="tabpanel">
      <div class="row">
        @php
          $groupedIndustries = collect($industrySeller)->groupBy('industry');
        @endphp
        @foreach($groupedIndustries as $industryName => $subIndustries)
          <div class="col-md-3 col-6 footer-category-col">
            <h6>{{ $industryName }}</h6>
            <ul>
              @foreach($subIndustries->take(4) as $sub)
                <li>
                  <a href="{{ url('businesslisting?business_type=all&industry='.$sub['subIndustryid']) }}">
                    {{ $sub['subindustry'] }}
                  </a>
                </li>
              @endforeach
              @php
                // Collect all subIndustry IDs for this parent category
                $ids = $subIndustries->pluck('subIndustryid')->toArray();
                // Build query string like industry[]=24&industry[]=25&industry[]=26
                $query = http_build_query(['business_type' => 'all', 'annual_sale_min'=>0,'annual_sale_max' => 1000000000, 'industry' => $ids]);
              @endphp
              <li><a href="{{ url('businesslisting?'. $query) }}">View All »</a></li>
            </ul>
          </div>
        @endforeach
        @if($groupedIndustries->isEmpty())
          <div class="col-12 text-muted">No opportunity categories are available.</div>
        @endif
      </div>
    </div>

    <!-- Startup Tab -->
    <div class="tab-pane fade footer-categories" id="startup-tab" role="tabpanel">
      <div class="row">
        @php
          $groupedIndustries = collect($industrySeller)->groupBy('industry');
        @endphp
        @foreach($groupedIndustries as $industryName => $subIndustries)
          <div class="col-md-3 col-6 footer-category-col">
            <h6>{{ $industryName }}</h6>
            <ul>
              @foreach($subIndustries->take(4) as $sub)
                <li>
                  <a href="{{ url('startuplisting?business_type=all&industry='.$sub['subIndustryid']) }}">
                    {{ $sub['subindustry'] }}
                  </a>
                </li>
              @endforeach
              @php
                // Collect all subIndustry IDs for this parent category
                $ids = $subIndustries->pluck('subIndustryid')->toArray();
                // Build query string like industry[]=24&industry[]=25&industry[]=26
                $query = http_build_query(['business_type' => 'all', 'min_investment'=>0,'max_investment' => 1000000000, 'industry' => $ids]);
              @endphp

              <li><a href="{{ url('startuplisting?'. $query) }}">View All »</a></li>
            </ul>
          </div>
        @endforeach
        @if($groupedIndustries->isEmpty())
          <div class="col-12 text-muted">No opportunity categories are available.</div>
        @endif
      </div>
    </div>

    <!-- Investor Tab -->
    <div class="tab-pane fade footer-categories" id="investor-tab" role="tabpanel">
      <div class="row">
        @php
          $groupedIndustries = collect($industrySeller)->groupBy('industry');
        @endphp
        @foreach($groupedIndustries as $industryName => $subIndustries)
          <div class="col-md-3 col-6 footer-category-col">
            <h6>{{ $industryName }}</h6>
            <ul>
              @foreach($subIndustries->take(4) as $sub)
                <li>
                  <a href="{{ url('investorlisting?minInvestment=0&maxInvestment=1000000000&industrysub='.$sub['subIndustryid']) }}">
                    {{ $sub['subindustry'] }}
                  </a>
                </li>
              @endforeach
              @php
                // Collect all subIndustry IDs for this parent category
                $ids = $subIndustries->pluck('subIndustryid')->toArray();
                // Build query string like industry[]=24&industry[]=25&industry[]=26
                $query = http_build_query(['minInvestment' => 0, 'maxInvestment' => 1000000, 'industrysub' => $ids]);
              @endphp
              <li><a href="{{ url('investorlisting?' . $query) }}">View All »</a></li>
            </ul>
          </div>
        @endforeach
        @if($groupedIndustries->isEmpty())
          <div class="col-12 text-muted">No opportunity categories are available.</div>
        @endif
      </div>
    </div>
  </div>
</div>