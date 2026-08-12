<!-- Footer Tabs -->
<div class="footer-tabs">
  <ul class="nav nav-tabs-footer" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" data-tab="business-tab" href="#">Business</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-tab="startup-tab" href="#">Startup</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-tab="investor-tab" href="#">Investor</a>
    </li>
  </ul>

  <!-- Business Tab -->
  <div class="footer-categories tab-pane-footer" id="business-tab" style="display: block;">
    <div class="row">
      @php
        // Group subindustries by industry
        $groupedIndustries = collect($industrySeller)->groupBy('industry');
      @endphp

      @foreach($groupedIndustries as $industryName => $subIndustries)
        <div class="col-md-3 col-6 footer-category-col">
          <h6>{{ $industryName }}</h6>
          <ul>
            @foreach($subIndustries->take(4) as $sub)
              <li>
                <a href="{{ url('industry/'.$sub['industrySlug'].'/'.$sub['subIndustrySlug']) }}">
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

  <!-- Startup Tab -->
  <div class="footer-categories tab-pane-footer" id="startup-tab" style="display: none;">
    <div class="row">
      @php
        // Group subindustries by industry
        $groupedIndustries = collect($industrySeller)->groupBy('industry');
      @endphp

      @foreach($groupedIndustries as $industryName => $subIndustries)
        <div class="col-md-3 col-6 footer-category-col">
          <h6>{{ $industryName }}</h6>
          <ul>
            @foreach($subIndustries->take(4) as $sub)
              <li>
                <a href="{{ url('industry/'.$sub['industrySlug'].'/'.$sub['subIndustrySlug']) }}">
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
  <div class="footer-categories tab-pane-footer" id="investor-tab" style="display: none;">
    <div class="row">
      @php
        // Group subindustries by industry
        $groupedIndustries = collect($industrySeller)->groupBy('industry');
      @endphp

      @foreach($groupedIndustries as $industryName => $subIndustries)
        <div class="col-md-3 col-6 footer-category-col">
          <h6>{{ $industryName }}</h6>
          <ul>
            @foreach($subIndustries->take(4) as $sub)
              <li>
                <a href="{{ url('industry/'.$sub['industrySlug'].'/'.$sub['subIndustrySlug']) }}">
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
