

        <div class="content-wrapper" style="background-color:white; color:black; margin-bottom:4px;">
            <h2>Email Details</h2>
            <strong>From:</strong> {{ $email['from'] }}
            <br>
            <strong>Subject:</strong> {{ $email['subject'] }}
            <br>
            <strong>Date:</strong> {{ $email['date'] }}
            <!-- <br>
                <a href="{{ route('emails.reply', ['id' => $email['id']]) }}" class="btn btn-primary">Reply</a> -->
            <br>
            <!-- <strong>Body:</strong> -->
            {!! $email['body'] !!} {{-- Use {!! !!} to output HTML --}}

            <a href="javascript:void(0);" id="showReplyFormBtn" class="btn btn-primary">Reply</a>
            <div id="replyFormContainer"></div>
            
        </div>
        
        <script>
    console.log('Test script is running.');
</script>
      
<script>
      document.getElementById('showReplyFormBtn').addEventListener('click', function (event) {
    event.preventDefault();
    console.log('Button clicked!'); // Add this line for testing

    fetch('{!! route("emails.reply", ["id" => $email["id"]]) !!}', {
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
        document.getElementById('replyFormContainer').innerHTML = data;
    })
    .catch(error => console.error('Error fetching reply form:', error));
});

</script>
        
