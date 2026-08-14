@extends('account_dashboard.accountDashboardApp')

@section('title', 'My Interaction')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        @include('partials.sidebar')

        <div class="col-lg-9">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5>BX Inbox</h5>
                    <span id="unreadCount" class="badge bg-danger"></span>
                </div>
                <div class="card-body">
                    <ul id="messageList" class="list-group"></ul>
                    <div class="text-center mt-3">
                        <button id="loadMore" class="btn btn-primary">Load More</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    #messageList li {
        cursor: pointer; 
        transition: background-color 0.2s ease;
    }
    #messageList li:hover {
        background-color: #f0f8ff;  
    }
    #messageList li.clicked {
        background-color: #d1ffd1; 
    }
</style>
@endsection

@push('styles')
<style>
    /* Cursor pointer like <a> tag */
    #messageList li {
        cursor: pointer;
        transition: background-color 0.2s ease;
    }
    /* Hover par halka blue background */
    #messageList li:hover {
        background-color: #f0f8ff;
    }
    /* Click hone par greenish highlight */
    #messageList li.clicked {
        background-color: #d1ffd1;
    }
</style>
@endpush

@push('scripts')
<script>
$(document).ready(function(){

    // Fetch messages from backend
    function fetchMessages(){
        $.ajax({
            url: "{{ route('myinteraction.fetch') }}",
            type: "POST",
            data: {_token: "{{ csrf_token() }}"},
            success: function(res){
                $('#unreadCount').text(res.unReadNotificationcount);
                $('#messageList').empty();

                $.each(res.messages, function(index, msg){
                    let readClass = msg.readstatus == 1 ? 'fw-bold' : '';
                    $('#messageList').append(
                        `<li class="list-group-item ${readClass}" 
                             data-request-id="${msg.request_id}">
                            <img src="${msg.profilepic}" width="40" class="rounded-circle me-2">
                            <strong>${msg.name}</strong> (${msg.location})<br>
                            ${msg.msg}<br>
                            <small>${msg.timestamp}</small>
                        </li>`
                    );
                });
            },
            error: function(err){
                console.error("Fetch error:", err);
            }
        });
    }

    // Initial load
    fetchMessages();

    // Click event to mark message as read + visual feedback
    $('#messageList').on('click', 'li', function(){
        let requestId = $(this).data('request-id');
        console.log("Clicked request_id:", requestId);

        if(!requestId) return;

        // Visual feedback: highlight clicked message
        $('#messageList li').removeClass('clicked');
        $(this).addClass('clicked');

        $.ajax({
            url: "{{ route('myinteraction.update') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                contactedContacts: [requestId]
            },
            success: function(res){
                if(res.message === 200){
                    // Remove bold class to show as read
                    $(this).removeClass('fw-bold');
                    // Refresh unread count
                    fetchMessages();
                }
            }.bind(this),
            error: function(err){
                console.error("Update error:", err);
            }
        });
    });

    // Load more button (demo: re-fetch same set)
    $('#loadMore').click(function(){
        fetchMessages();
    });
});
</script>
@endpush
