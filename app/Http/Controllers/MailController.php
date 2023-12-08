<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
// use Webklex\LaravelIMAP\Facades\Client;
use Illuminate\Support\Facades\View;
use Webklex\IMAP\Facades\Client;
use Webklex\PHPIMAP\Message;
use Webklex\PHPIMAP\Support\MessageCollection;

class MailController extends Controller
{
    public function index()
    {
        // Connect to the IMAP server
        $client = Client::account('default');
        $client->connect();
        
        // Get the INBOX folder
        $inbox = $client->getFolder('INBOX');

        // Get all messages in the INBOX folder
        $messages = $inbox->query()->all()->limit(20)->setFetchOrder("desc")->get();

        // Sort the messages by date in descending order
        $messages = $messages->sortByDesc('date');

        $folders = $client->getFolders();
        
        // Disconnect from the IMAP server
        $client->disconnect();

        // Pass emails to the view
        return view('admin.emails.index', ['messages' => $messages, 'folders' => $folders]);
    }

    
//SHow the email details

   public function show($id)
{

    // Assuming $id is the UID of the email
    $client = Client::account('default');
    $client->connect();
    // Fetch the email using the $id
    $folder = $client->getFolder('INBOX');

    try {
        $email = $folder->query()->getMessage($id);

        // Log or dump the $email for debugging
        \Log::info("Email: " . json_encode($email));

        if (!$email) {
            // Log or dump an error message for debugging
            \Log::error("Email not found for ID: $id");

            // Handle the case where the email with the given ID is not found
            abort(404);
        }

        // You might need to adjust the attributes based on your actual email model
        $emailData = [
            'id'=> $email->uid,
            'from' => $email->from,
            'subject' => $email->subject,
            'date' => $email->date,
            'body' => $email->getHTMLBody(), // Adjust based on how your email body is stored
        ];

        // Return the email content, typically a Blade view
        return view('admin.emails.email-detail', ['email' => $emailData]);

    } catch (\Exception $e) {
        // Log the exception for debugging
        \Log::error("Exception: " . $e->getMessage());

        // Handle the exception as needed
        abort(500, "Error fetching email: " . $e->getMessage());
    }
}

//reply to the mail
public function showReplyForm($id)
{
    
    $client = Client::account('default');
    $client->connect();
    $folder = $client->getFolder('INBOX');
    
    try {
        $originalEmail = $folder->query()->getMessage($id);
        
        if (!$originalEmail) {
            abort(404);
        }

        return view('admin.emails.reply', ['originalEmail' => $originalEmail]);
    } catch (\Exception $e) {
        abort(500, "Error fetching original email: " . $e->getMessage());
    } finally {
        $client->disconnect();
    }
}

// MailController.php

public function sendReply(Request $request, $id)
{
    // Validate the request, add any validation rules you need
    $request->validate([
        'replyMessage' => 'required|string',
    ]);

    // Fetch the original email
    $client = Client::account('default');
    $client->connect();
    $folder = $client->getFolder('INBOX');

    try {
        $originalEmail = $folder->query()->getMessage($id);

        if (!$originalEmail) {
            abort(404);
        }

        // Compose and send the reply
        $replyMessage = $request->input('replyMessage');

        // Create a new message using Swift Mailer
        $newMessage = new \Swift_Message();
        $newMessage->setSubject('Re: ' . $originalEmail->getSubject());
        $newMessage->setTo($originalEmail->getFrom());
        $newMessage->setBody($replyMessage);

        // Send the new message
        $mailer = new \Swift_Mailer(\Swift_SmtpTransport::newInstance());
        $mailer->send($newMessage);

        // Optionally, you can redirect back with a success message
        return redirect()->back()->with('success', 'Reply sent successfully');
    } catch (\Exception $e) {
        // Log the exception for debugging
        \Log::error("Exception: " . $e->getMessage());

        // Handle the exception as needed
        abort(500, "Error sending reply: " . $e->getMessage());
    } finally {
        $client->disconnect();
    }

}
}