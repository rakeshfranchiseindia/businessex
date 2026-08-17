@extends('account_dashboard.accountDashboardApp')

@section('title', 'My Interaction')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        @include('account_dashboard.dashboardSidebar')

        <div class="col-lg-9">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5>BX Inbox</h5>
                    <span id="unreadCount" class="badge bg-danger" style="display:none;"></span>
                </div>
                <div class="card-body">
                    <ul id="messageList" class="list-group"></ul>
                    <div id="emptyState" class="text-center text-muted py-4" style="display:none;">
                        <i class="far fa-comment-dots" style="font-size: 28px; display:block; margin-bottom: 8px;"></i>
                        No messages yet.
                    </div>
                    <div id="loadMoreWrap" class="text-center mt-3" style="display:none;">
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
    .avatar-fallback {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: linear-gradient(135deg, #2563eb, #7c3aed);
        color: #fff;
        font-weight: 700;
        vertical-align: middle;
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
                if (res.unReadNotificationcount > 0) {
                    $('#unreadCount').text(res.unReadNotificationcount).show();
                } else {
                    $('#unreadCount').hide();
                }

                $('#messageList').empty();

                $.each(res.messages, function(index, msg){
                    let readClass = msg.readstatus == 1 ? 'fw-bold' : '';
                    let initial = (msg.name || 'U').trim().charAt(0).toUpperCase();
                    let avatarHtml = msg.profilepic
                        ? `<img src="${msg.profilepic}" width="40" height="40" class="rounded-circle me-2" style="object-fit:cover;" onerror="this.outerHTML='<div class=\\'avatar-fallback me-2\\'>${initial}</div>'">`
                        : `<div class="avatar-fallback me-2">${initial}</div>`;
                    $('#messageList').append(
                        `<li class="list-group-item ${readClass}"
                             data-request-id="${msg.request_id}">
                            ${avatarHtml}
                            <strong>${msg.name}</strong> (${msg.location})<br>
                            ${msg.msg}<br>
                            <small>${msg.timestamp}</small>
                        </li>`
                    );
                });

                if (res.messages.length === 0) {
                    $('#emptyState').show();
                    $('#loadMoreWrap').hide();
                } else {
                    $('#emptyState').hide();
                    $('#loadMoreWrap').show();
                }
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
