<div class="card">
    <div class="bex-card-main">
        <div class="bex-form-section-main">
            <h5>REGISTER FOR FREE</h5>
        </div>
    </div>
    <div>
        <div class="bex-form-section">
            <form method="POST" action="{{ route('register.custom') }}">
                @csrf
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><img src="{{ asset('assets/img/doc-file.png') }}" /></span>
                    </div>
                    <select id="profile" name="profile" class="form-control">
                        <option selected>Select a profile</option>
                        <option>Startup</option>
                        <option>Investor</option>
                        <option>Mentor</option>
                        <option>Incubator</option>
                    </select>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><img src="{{ asset('assets/img/person.png') }}" /></span>
                    </div>
                    <input type="text" name="name" class="form-control" placeholder="Enter Your Name" required>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><img src="{{ asset('assets/img/telephone.png') }}" /></span>
                    </div>
                    <input type="tel" name="phone" class="form-control" placeholder="Enter Your Mobile No." required>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><img src="{{ asset('assets/img/mail.png') }}" /></span>
                    </div>
                    <input type="email" name="email" class="form-control" placeholder="Enter Your Email ID" required>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><img src="{{ asset('assets/img/company.png') }}" /></span>
                    </div>
                    <input type="text" name="company" class="form-control" placeholder="Enter Company Name">
                </div>

                <div class="bex-form-top-btn">
                    <button type="submit" class="btn btn-outline-secondary btn-outline-secondary-main">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>