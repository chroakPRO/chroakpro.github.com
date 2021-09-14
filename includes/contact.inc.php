<?php

require '../vendor/autoload.php';

if (isset($_POST['contact-submit']))
{
  
  
  $dotenv = Dotenv\Dotenv::createImmutable('/var/www');

  $name = $_POST['name'];
  $email =  $_POST['email'];
  $message = $_POST['message'];


  if (empty($name) || empty($email) || empty($message)) {
    header("Location: ../index.php?error=emptyfields&uid=".$name."&mail=".$email);
    exit();
  }

  else if (!preg_match("/^[a-zA-Z0-9 ]*$/", $name) && !filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9 ]*$/", $text)) {
    header("Location: ../index.php?error=invalidnamemailtext");
    exit();
  }

  else if (!preg_match("/^[a-zA-Z0-9\s]*$/", $name)) {
    header("Location: ../index.php?error=invalidname&mail=".$email);
    exit();
  }

  else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../index.php?error=invalidmail&uid=".$name);
    exit();
  }

  else if (!preg_match("/^[a-zA-Z0-9\s[\p{P}\p{S}]*$/", $message)) {
    header("Location: ../index.php?error=invalidtext&uid=".$name."&mail=".$email);
    exit();
  }
  else 
  { 
    $email = new \SendGrid\Mail\Mail();
    $email->setFrom("pandaawip@gmail.com", "$name");
    $email->setSubject("Contact Form");
    $email->addTo("christophereek97@gmail.com", "$name");
    $email->addContent("text/plain", "Sent from email = $email");
    $email->addContent(
        "text/plain", "$message"
    );
    $sendgrid = new \SendGrid('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');
    try {
        $response = $sendgrid->send($email);
        print $response->statusCode() . "\n";
        print_r($response->headers());
        print $response->body() . "\n";
    } catch (Exception $e) {
        echo 'Caught exception: '. $e->getMessage() ."\n";
    }
  }
}

