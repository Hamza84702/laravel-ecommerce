

<form action="{{ route('emails.sendReply', ['id' => $originalEmail->uid]) }}" method="post">
    @csrf
    <!-- Add fields for reply message, subject, etc. -->
    <label for="replyMessage">Reply:</label>
    <textarea name="replyMessage" id="replyMessage" rows="4" cols="50"></textarea>

    <button type="submit">Send Reply</button>
</form>
