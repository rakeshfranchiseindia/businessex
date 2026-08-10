@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="card shadow-sm p-4">
        <h4 class="mb-4 text-center">MANAGE PREFERENCE INFORMATION</h4>
        <form id="preferenceForm">
            @csrf
            <div class="mb-3">
                <label for="sector_preference" class="form-label fw-bold">Sector Preference *</label>
                <select id="sector_preference" name="sector_preference[]" multiple class="form-control">
                    <option value="Beauty equipments">Beauty equipments</option>
                    <option value="Business research">Business research</option>
                    <option value="Entertainment services">Entertainment services</option>
                    <option value="Technology">Technology</option>
                    <option value="Healthcare">Healthcare</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="location_preference" class="form-label fw-bold">Location Preference *</label>
                <input type="text" id="location_preference" name="location_preference" class="form-control" placeholder="Enter location">
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-success px-5 py-2">SUBMIT</button>
            </div>
        </form>
    </div>
</div>

<!-- jQuery & Select2 -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(document).ready(function() {
  $('#sector_preference').select2({
        tags: true,
        placeholder: "Select or type sectors",
        width: '100%'
    });
    $('#preferenceForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: "{{ route('preferences.save') }}",
            type: "POST",
            data: $(this).serialize(),
            success: function(response) {
                alert(response.message);
            },
            error: function(xhr) {
                alert('Error: ' + xhr.responseText);
            }
        });
    });
});

</script>
@endsection
