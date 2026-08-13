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
              <li><a href="{{ url('businesslisting/' . $sub['parentCatId']) }}">View All »</a></li>
            </ul>
          </div>
        @endforeach
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
                  <a href="{{ url('startuplisting/'.$sub['industrySlug'].'/'.$sub['subIndustrySlug']) }}">
                    {{ $sub['subindustry'] }}
                  </a>
                </li>
              @endforeach
              <li><a href="{{ url('industry/'.$subIndustries->first()['industrySlug']) }}">View All »</a></li>
            </ul>
          </div>
        @endforeach
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
                  <a href="{{ url('investorlisting/'.$sub['industrySlug'].'/'.$sub['subIndustrySlug']) }}">
                    {{ $sub['subindustry'] }}
                  </a>
                </li>
              @endforeach
              <li><a href="{{ url('industry/'.$subIndustries->first()['industrySlug']) }}">View All »</a></li>
            </ul>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>