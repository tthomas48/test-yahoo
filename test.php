#!/usr/bin/env php
<?php

require_once "vendor/autoload.php";

use utils\net\SMTP\Client; // SMTP client
use utils\net\SMTP\Client\Authentication\Login; // authentication mechanism
use utils\net\SMTP\Client\Connection\SSLConnection; // the connection
use utils\net\SMTP\Message; // the message

$client = new Client(new SSLConnection("smtp.mail.yahoo.com", 465));
$client->authenticate(new Login("xxxxx@yahoo.com", "yahoopassword"));

$uniqid = uniqid();
$message = new Message();
$message->from("xxxxx@yahoo.com") // sender
        ->to("yahoo-test@scriptworks.org") // receiver
        ->subject("Yahoo Test") // message subject
        ->body("This is a test of sending email to apollohosting from yahoo $uniqid."); // message content


$msg = $client->send($message) ? "Message sent" : "Error";
file_put_contents("/tmp/message.log", "$uniqid:$msg\n", FILE_APPEND);

