<?php

// Define some constants
define( "RECIPIENT_NAME2", "YOUR_NAME_HERE" );
define( "RECIPIENT_EMAIL2", "YOUR_EMAIL_HERE" );
define( "EMAIL_SUBJECT", "$subject" );

// Read the form values
$success = false;
$senderName2 = isset( $_POST['senderName2'] ) ? preg_replace( "/[^\.\-\' a-zA-Z0-9]/", "", $_POST['senderName2'] ) : "";
$senderEmail2 = isset( $_POST['senderEmail2'] ) ? preg_replace( "/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['senderEmail2'] ) : "";
$senderPhone2 = isset( $_POST['senderPhone2'] ) ? preg_replace( "/(From:|To:|BCC:|CC:|Subject:|Content-Type:)/", "", $_POST['senderPhone2'] ) : "";
$bookingDate = isset( $_POST['bookingDate'] ) ? preg_replace( "/(From:|To:|BCC:|CC:|Subject:|Content-Type:)/", "", $_POST['bookingDate'] ) : "";
$reservationtime = isset( $_POST['reservationtime'] ) ? preg_replace( "/(From:|To:|BCC:|CC:|Subject:|Content-Type:)/", "", $_POST['reservationtime'] ) : "";
$message2 = isset( $_POST['message2'] ) ? preg_replace( "/(From:|To:|BCC:|CC:|Subject:|Content-Type:)/", "", $_POST['message2'] ) : "";

// If all values exist, send the email
if ( $senderName2 && $senderEmail2 && $message2 ) {
  $recipient2 = RECIPIENT_NAME2 . " <" . RECIPIENT_EMAIL2 . ">";
  $headers2 = "From: " . $senderName2 . " <" . $senderEmail2 . ">";
  $success2 = mail( $recipient2, $senderPhone2 , $bookingDate , $reservationtime , $message2, $headers2 );
}

// Return an appropriate response to the browser
if ( isset($_GET["ajax"]) ) {
  echo $success2 ? "success" : "error";
} else {
?>
<html>
  <head>
    <title>Thanks!</title>
  </head>
  <body>
  <?php if ( $success ) echo "<p>Thanks for sending your message! We'll get back to you shortly.</p>" ?>
  <?php if ( !$success ) echo "<p>There was a problem sending your message. Please try again.</p>" ?>
  <p>Click your browser's Back button to return to the page.</p>
  </body>
</html>
<?php
}
?>