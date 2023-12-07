<style>
    .email-list {
        background-color: #f8f9fa;
        padding: 15px;
        border-radius: 5px;
        color: black !important;
    }

    .email-item {
        cursor: pointer;
        margin-bottom: 10px;
        transition: background-color 0.3s;
    }

    .email-item:hover {
        background-color: #e9ecef;
    }

    .email-sender {
        width: 150px;
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    .email-details {
        flex-grow: 1;
        text-align: right;
    }

    .email-content {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        margin-top: 20px;
    }
</style>

@extends('admin.layouts.main')

@section('main-content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <!-- Sidebar for Email Folders -->
            <div class="col-md-3">
                <h3>Email Folders</h3>
                <ul class="list-group">
                    @foreach($folders as $folder)
                    <li class="list-group-item">
                        <a href="{{ route('emails', ['folder' => $folder->name]) }}" class="text-dark">
                            {{ $folder->name }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>

            <!-- Main Content Area for Email List -->
            <div class="col-md-9">
                <div class="email-list">
                    <h2>Emails</h2>
                    <ul class="list-group">
                        @forelse($messages as $message)
                        <li class="list-group-item email-item" data-email-id="{{ $message->uid }}">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="email-sender">
                                    <strong>{{ getEmailName($message->from) }}</strong>
                                </div>
                                <div class="email-details">
                                    <span style="float: left; width: {{ strlen($message->subject) > 30 ? '60%' : 'auto' }};">{{ Illuminate\Support\Str::limit($message->subject, $limit = 25, $end = '...') }}</span>
                                    <span style="float: right; width: 40%;">{{ \Carbon\Carbon::parse($message->date)->format('M d, Y') }}</span>
                                    <div style="clear: both;"></div>
                                </div>
                            </div>
                        </li>
                        @empty
                        <li class="list-group-item">No emails found.</li>
                        @endforelse
                    </ul>
                </div>

                <div class="email-content" id="email-content" style="display: none;">
                    <!-- Email content will be loaded here -->
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Your styles remain unchanged */
</style>

@php
function getEmailName($from) {
    $parts = explode('<', $from);
    return isset($parts[1]) ? trim($parts[0], '" ') : $from;
}
@endphp

<script>
    
    console.log('Email detail click event script is running.');

    document.querySelectorAll('.email-item').forEach(function (item) {
        item.addEventListener('click', function () {
            var emailId = item.getAttribute('data-email-id');
            console.log('Email ID clicked:', emailId);

            fetch('/emails/' + emailId, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text();
            })
            .then(data => {
              
                document.getElementById('email-content').innerHTML = data;
                document.querySelector('.email-list').style.display = 'none';
                document.getElementById('email-content').style.display = 'block';
            })
            .catch(error => console.error('Error fetching email content:', error));
        });
    });
</script>

@endsection
