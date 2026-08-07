@extends('layouts.app')

@section('content')
<h2 class="fgts">Faqs</h2>

<div class="fabqback">
    <div class="faqs_head">
        <a href="#">What is a Business profile?</a>
        <span class="faqcirplusminus minus"></span>
    </div>
    <div class="faqs_body" style="display: block;">
        A business profile is the one in which a business/company is looking for various Business requirements such as Investment, Acquisition, Loan, Mentorship and Incubation support.
    </div>

    <div class="faqs_head">
        <a href="#">What is the difference between a Business profile and a Start-up profile?</a>
        <span class="faqcirplusminus add"></span>
    </div>
    <div class="faqs_body" style="display: none;">
        In BusinessEx, we have created a separate option for a Start-up profile so that Start-ups can be identified separately from established businesses.
    </div>

    <div class="faqs_head">
        <a href="#">Who can create Start-up profile?</a>
        <span class="faqcirplusminus minus"></span>
    </div>
    <div class="faqs_body" style="display: none;">
        A Start-up profile can be created by any person from the particular Start-up. Ideally, the person creating the profile should be the Founder, Co-Founder, or part of the top management.
    </div>

    <div class="faqs_head">
        <a href="#">What is a Business profile?</a>
        <span class="faqcirplusminus add"></span>
    </div>
    <div class="faqs_body" style="display: none;">
        A business profile is the one in which a business/company is looking for various Business requirements such as Investment, Acquisition, Loan, Mentorship and Incubation support.
    </div>

    <div class="faqs_head">
        <a href="#">Why should I reveal my start-up details?</a>
        <span class="faqcirplusminus add"></span>
    </div>
    <div class="faqs_body" style="display: none;">
        It is important to reveal start-up details so that when you connect with an investor, they can view the necessary information about your Start-up.
    </div>

    <div class="faqs_head">
        <a href="#">What can I enter in the Facilities section?</a>
        <span class="faqcirplusminus add"></span>
    </div>
    <div class="faqs_body" style="display: none;">
        The facilities section can contain information regarding any warehouse, office space, or similar resources of your business.
    </div>

    <div class="faqs_head">
        <a href="#">What should I do if the industry/sector of my business is not available in the listing?</a>
        <span class="faqcirplusminus add"></span>
    </div>
    <div class="faqs_body" style="display: none;">
        If you feel that your industry/sector is missing, please write to <a href="mailto:support@businessex.com">support@businessex.com</a>. We’ll ensure it is added within 5 working days of your request.
    </div>
</div>
@endsection