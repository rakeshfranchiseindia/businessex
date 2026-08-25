@if(config('services.google.maps_api_key'))
    @push('scripts')
        <script>
            window.initBusinessExLocationAutocomplete = function () {
                document.querySelectorAll('[data-google-location]').forEach(function (input) {
                    if (input.dataset.autocompleteReady) {
                        return;
                    }

                    const autocomplete = new google.maps.places.Autocomplete(input, {
                        componentRestrictions: { country: 'in' },
                        fields: ['formatted_address', 'name', 'geometry', 'place_id']
                    });
                    input.dataset.autocompleteReady = 'true';
                    input.addEventListener('input', function () {
                        input.dataset.placeSelected = 'false';
                        const placeIdField = input.dataset.placeIdField
                            ? document.querySelector(input.dataset.placeIdField)
                            : null;
                        if (placeIdField) {
                            placeIdField.value = '';
                        }
                    });
                    autocomplete.addListener('place_changed', function () {
                        const place = autocomplete.getPlace();
                        input.dataset.placeSelected = place && (place.formatted_address || place.name) ? 'true' : 'false';
                        const placeIdField = input.dataset.placeIdField
                            ? document.querySelector(input.dataset.placeIdField)
                            : null;
                        if (placeIdField) {
                            placeIdField.value = place.place_id || '';
                        }
                        if (place && place.formatted_address) {
                            input.value = place.formatted_address;
                        }
                    });
                    input.form.addEventListener('submit', function (event) {
                        if (input.value.trim() && input.dataset.placeSelected !== 'true') {
                            event.preventDefault();
                            input.setCustomValidity('Select a location from the Google suggestions.');
                            input.reportValidity();
                        } else {
                            input.setCustomValidity('');
                        }
                    });
                });
            };
        </script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ urlencode(config('services.google.maps_api_key')) }}&libraries=places&callback=initBusinessExLocationAutocomplete"></script>
    @endpush
@endif
