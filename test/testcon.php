SEND SMS with PHP:
<?php
# Example PHP code to send an SMS to the recipient '447000000001', with sender set to 'James' and message 'Hello'.

print "Initialising library...\n";
require_once("SendSMS.php");
# Set global username and password for use by the library
$sms_username = "user01";
$sms_password = "pass01";
print "Library initialised.\n";

# Send a message to 447000000001 with sender 'James' and message 'Hello'
# SourceTON (type of number) will be set automatically by the library.
$destination = "447000000001";
$source = "James";
$message = "Hello";
print "Sending message...\n";
$responses = send_sms($destination, $source, $message) or die ("Error: " . $errstr . "\n");
print "Message sent.\n";

# Print the response to the screen
print "Responses from the server:\n";
foreach ($responses as $response) {
echo "\t$response\n";
}
?>