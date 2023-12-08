

        <div class="content-wrapper" style="background-color:white; color:black !important; margin-bottom:4px;">
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

            <a href="{{route('emails.reply', $email['id'])}}"  class="btn btn-primary">Reply</a>
            <!-- <div id="replyFormContainer"></div>
            
        </div> -->
        
        <script>
    console.log('Test script is running.');
</script>
      
<script>
   document.getElementById('showReplyFormBtn').addEventListener('click', function (event) {
    event.preventDefault();
    
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
        var replyFormContainer = document.getElementById('replyFormContainer');
        replyFormContainer.innerHTML = data;
        replyFormContainer.style.display = 'block'; // Ensure it's visible
    })
    .catch(error => console.error('Error fetching reply form:', error));
});

</script>

        
