<div class="col-md-3 catsh">
  <div class="catleft">
    <div id="closeftr" class="closebtn">
      <i class="fa fa-times fa-2x" aria-hidden="true"></i>
    </div>

    <div class="mainleftdiv">
      <div class="subhead font-weight-bold mb-3">Filters</div>

      <div id="filterAccordion">

        <!-- Business Looking For -->
        <div class="card border-0">
          <div class="card-header bg-white p-0" id="headingBusiness">
            <h6 class="mb-2 font-weight-bold text-secondary">
              <a class="d-flex justify-content-between align-items-center text-dark py-2 px-2"
                 data-toggle="collapse" href="#collapseBusiness" aria-expanded="true" aria-controls="collapseBusiness">
                Business Looking For
                <span class="arrow">&#9662;</span>
              </a>
            </h6>
          </div>
          <div id="collapseBusiness" class="collapse show" data-parent="#filterAccordion">
            <div class="card-body py-2 pl-4">
              <p><input type="radio" name="businessType"> All</p>
              <p><input type="radio" name="businessType"> Sale</p>
              <p><input type="radio" name="businessType"> Investor</p>
              <p><input type="radio" name="businessType"> Loan</p>
            </div>
          </div>
        </div>

        <!-- Annual Sales -->
        <div class="card border-0">
          <div class="card-header bg-white p-0" id="headingSales">
            <h6 class="mb-0">
              <a class="d-flex justify-content-between align-items-center text-dark py-2 px-2"
                 data-toggle="collapse" href="#collapseSales" aria-expanded="false" aria-controls="collapseSales">
                Annual Sales
                <span class="arrow">&#9662;</span>
              </a>
            </h6>
          </div>
          <div id="collapseSales" class="collapse" data-parent="#filterAccordion">
            <div class="card-body py-2 pl-4">
              <label class="font-weight-bold text-secondary">ANNUAL SALES</label>
              <div id="salesSlider"></div>
              <div class="d-flex justify-content-between mt-2">
                <span id="salesMin">0</span>
                <span id="salesMax">100.00 cr</span>
              </div>
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
              <!-- Haryana -->
              <div id="locationAccordion">
                <div class="card border-0">
                  <div class="card-header bg-white p-0" id="headingHaryana">
                    <h6 class="mb-0">
                      <a class="d-flex justify-content-between align-items-center text-dark py-2 px-2"
                         data-toggle="collapse" href="#collapseHaryana" aria-expanded="false" aria-controls="collapseHaryana">
                        <div>
                          <input type="checkbox" class="mr-2"> Haryana
                        </div>
                        <span class="arrow">&#9662;</span>
                      </a>
                    </h6>
                  </div>
                  <div id="collapseHaryana" class="collapse" data-parent="#locationAccordion">
                    <div class="card-body py-2 pl-4">
                      <ul class="list-unstyled mb-0">
                        <li><input type="checkbox" class="mr-2"> Rohtak</li>
                        <li><input type="checkbox" class="mr-2"> Gurgaon</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div><!-- /locationAccordion -->
            </div>
          </div>
        </div>

        <!-- Industries -->
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

              <!-- Automobile -->
              <div class="card border-0">
                <div class="card-header bg-white p-0" id="headingAuto">
                  <h6 class="mb-0">
                    <a class="d-flex justify-content-between align-items-center text-dark py-2 px-2"
                       data-toggle="collapse" href="#collapseAuto" aria-expanded="false" aria-controls="collapseAuto">
                      <div>
                        <input type="checkbox" class="mr-2"> Automobile
                      </div>
                      <span class="arrow">&#9662;</span>
                    </a>
                  </h6>
                </div>
                <div id="collapseAuto" class="collapse" data-parent="#industryAccordion">
                  <div class="card-body py-2 pl-4">
                    <ul class="list-unstyled mb-0">
                      <li><input type="checkbox" class="mr-2"> Automobile Accessories</li>
                      <li><input type="checkbox" class="mr-2"> Automobile Electric Vehicles</li>
                      <li><input type="checkbox" class="mr-2"> Automobile Insurance</li>
                      <li><input type="checkbox" class="mr-2"> Automobile Maintenance</li>
                      <li><input type="checkbox" class="mr-2"> Automobile Manufacturing</li>
                      <li><input type="checkbox" class="mr-2"> Automobile Reselling</li>
                      <li><input type="checkbox" class="mr-2"> Automobile Showrooms</li>
                      <li><input type="checkbox" class="mr-2"> Automobile Parts</li>
                      <li><input type="checkbox" class="mr-2"> Automobile Wash</li>
                      <li><input type="checkbox" class="mr-2"> Car Wash For Sale</li>
                      <li><input type="checkbox" class="mr-2"> Car Workshop For Sale</li>
                      <li><input type="checkbox" class="mr-2"> Car Service Center For Sale</li>
                    </ul>
                  </div>
                </div>
              </div>

              <!-- Add more industry categories here following the same pattern -->

            </div>
          </div>
        </div>

      </div><!-- /filterAccordion -->
    </div>
  </div>
</div>