/* BusinessEx shared UI behavior. Vendor libraries are loaded before this file. */
(function (window, document) {
    'use strict';

    /* User profile sidebar */
    function setSidebar(open) {
        var sidebar = document.getElementById('userSidebar');
        var overlay = document.getElementById('sidebarOverlay');
        if (!sidebar || !overlay) return;

        sidebar.classList.toggle('is-open', open);
        overlay.classList.toggle('is-visible', open);
        document.body.classList.toggle('sidebar-open', open);
        sidebar.setAttribute('aria-hidden', open ? 'false' : 'true');
    }

    window.openSidebar = function () { setSidebar(true); };
    window.closeSidebar = function () { setSidebar(false); };

    /* Shared location and industry checkbox behavior */
    function initializeFilterCheckboxes() {
        document.querySelectorAll('.parent-location-filter, .parent-industry-filter').forEach(function (parent) {
            parent.addEventListener('change', function () {
                var selector = this.classList.contains('parent-location-filter')
                    ? '.child-location-filter'
                    : '.child-industry-filter';
                var group = this.dataset.parentGroup;
                document.querySelectorAll(selector + '[data-group="' + group + '"]').forEach(function (child) {
                    child.checked = parent.checked;
                });
                if (this.form) this.form.submit();
            });
        });

        document.querySelectorAll('.child-location-filter, .child-industry-filter').forEach(function (child) {
            child.addEventListener('change', function () {
                var selector = this.classList.contains('child-location-filter')
                    ? '.child-location-filter'
                    : '.child-industry-filter';
                var parentSelector = this.classList.contains('child-location-filter')
                    ? '.parent-location-filter'
                    : '.parent-industry-filter';
                var parent = document.querySelector(parentSelector + '[data-parent-group="' + this.dataset.group + '"]');
                if (!parent) return;

                var children = document.querySelectorAll(selector + '[data-group="' + this.dataset.group + '"]');
                parent.checked = Array.prototype.some.call(children, function (item) { return item.checked; });
                if (parent.form) parent.form.submit();
            });
        });
    }

    /* Shared dual range input synchronization */
    function initializeRange(minId, maxId, minInputId, maxInputId, minLabelId, maxLabelId) {
        var minRange = document.getElementById(minId);
        var maxRange = document.getElementById(maxId);
        var minInput = document.getElementById(minInputId);
        var maxInput = document.getElementById(maxInputId);
        var minLabel = document.getElementById(minLabelId);
        var maxLabel = document.getElementById(maxLabelId);
        if (!minRange || !maxRange) return;

        function format(value) {
            return Number(value) === 0 ? '0' : (Number(value) / 10000000).toFixed(2) + ' cr';
        }
        function sync(submit) {
            var minimum = Number(minRange.value);
            var maximum = Number(maxRange.value);
            if (minimum > maximum) {
                var swap = minimum;
                minimum = maximum;
                maximum = swap;
                minRange.value = minimum;
                maxRange.value = maximum;
            }
            if (minInput) minInput.value = minimum;
            if (maxInput) maxInput.value = maximum;
            if (minLabel) minLabel.textContent = format(minimum);
            if (maxLabel) maxLabel.textContent = format(maximum);
            if (submit && minRange.form) minRange.form.submit();
        }

        minRange.addEventListener('change', function () { sync(true); });
        maxRange.addEventListener('change', function () { sync(true); });
        sync(false);
    }

    /* Newsletter AJAX submission and inline validation */
    function initializeNewsletter() {
        var form = document.getElementById('newsletterForm');
        if (!form) return;

        form.addEventListener('submit', function (event) {
            event.preventDefault();
            form.querySelectorAll('.newsletter-error').forEach(function (item) { item.remove(); });
            document.querySelectorAll('.newsletter-alert').forEach(function (item) { item.remove(); });

            var csrf = document.querySelector('meta[name="csrf-token"]');
            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrf ? csrf.content : '',
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: new FormData(form)
            }).then(function (response) {
                return response.json().then(function (data) { return { status: response.status, data: data }; });
            }).then(function (result) {
                if (result.status === 422 && result.data.errors) {
                    Object.keys(result.data.errors).forEach(function (key) {
                        var input = form.querySelector('[name="' + key + '"]');
                        if (!input) return;
                        var error = document.createElement('small');
                        error.className = 'text-danger d-block newsletter-error';
                        error.textContent = result.data.errors[key][0];
                        input.insertAdjacentElement('afterend', error);
                    });
                    return;
                }
                var alert = document.createElement('div');
                alert.className = 'alert ' + (result.data.success ? 'alert-success' : 'alert-danger') + ' newsletter-alert mt-3';
                alert.textContent = result.data.success || result.data.error || 'Something went wrong. Please try again.';
                form.insertAdjacentElement('beforebegin', alert);
                if (result.data.success) form.reset();
            }).catch(function () {
                var alert = document.createElement('div');
                alert.className = 'alert alert-danger newsletter-alert mt-3';
                alert.textContent = 'Something went wrong. Please try again.';
                form.insertAdjacentElement('beforebegin', alert);
            });
        });
    }

    /* Open the registration tab automatically on profile forms for guests. */
    function initializeProfileGate() {
        var profilePaths = [
            '/registration/create-startup-profile',
            '/registration/create-business-profile',
            '/registration/create-investor-profile',
            '/registration/create-mentor-profile'
        ];
        var currentPath = window.location.pathname.replace(/\/$/, '');
        if (profilePaths.indexOf(currentPath) === -1 || window.BX_IS_LOGGED_IN || !window.jQuery) return;
        jQuery('#login').modal('show');
        jQuery('#register-tab').tab('show');
    }

    /* Shared page initialization */
    document.addEventListener('DOMContentLoaded', function () {
        var overlay = document.getElementById('sidebarOverlay');
        if (overlay) overlay.addEventListener('click', function () { setSidebar(false); });
        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') setSidebar(false);
        });

        initializeFilterCheckboxes();
        initializeRange('investmentMinRange', 'investmentMaxRange', 'minInvestmentInput', 'maxInvestmentInput', 'investmentMinLabel', 'investmentMaxLabel');
        initializeRange('investorMinRange', 'investorMaxRange', 'investorMinInput', 'investorMaxInput', 'investorMinLabel', 'investorMaxLabel');
        initializeRange('businessAnnualMinRange', 'businessAnnualMaxRange', 'businessAnnualMinInput', 'businessAnnualMaxInput', 'businessAnnualMinLabel', 'businessAnnualMaxLabel');
        initializeProfileGate();

        if (window.jQuery && jQuery.fn.owlCarousel) {
            var clients = jQuery('#clientssay');
            if (clients.length) {
                clients.owlCarousel({
                    loop: true,
                    margin: 10,
                    nav: true,
                    dots: true,
                    autoplay: true,
                    autoplayTimeout: 3000,
                    responsive: { 0: { items: 1 }, 600: { items: 2 }, 1000: { items: 3 } }
                });
            }
        }
    });
}(window, document));
