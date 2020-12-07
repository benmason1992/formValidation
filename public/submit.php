<?php

require 'csrf/token.php';
include 'classes/dbh.php';

//Form information
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];
$token = $_POST['token'];
$newsletter = $_POST['newsletter'];
$dateNow = date('Y-m-d');
$ip = $_SERVER['REMOTE_ADDR'];

//phone number
$phonePattern = "/^(?:0|\+?44)(?:\d\s?){9,10}$/";
$match = preg_match($phonePattern, $phone);

//email
$to = "admin@test.com";
$subject = "Form submission";
$emailMessage = $name . " wrote the following:" . "\n\n" . $message . "\n\n" . "Would I like to sign up to the newsletter? " . $newsletter . "\n\n" . "This message was sent on " . $dateNow . ", from the following IP address " . $ip;
$headers = "From:" . $email;

//message length
$messageLength = strlen($message);

var_dump($emailMessage);
die();

//connection
$connection = new Dbh;
$startConnection = $connection->connect();

if (isset($_POST['submit'])) {

    if (empty($name) || empty($email) || empty($phone) || $messageLength < 25) {
        header('Location: form.php');
        return false;
    }

    if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
        header('Location: form.php');
        return false;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('Location: form.php');
        return false;
    }

    if (!$match) {
        header('Location: form.php');
        return false;
    }

    if (Token::check(!$token)) {
        header('Location: form.php');
        return false;
    }

    mail($to, $subject, $message, $headers);

    $statement = $startConnection->prepare("INSERT into subscribers(name, email, phone, message, signedup, date) values(?, ?, ?, ?, ?, ?)");

    $statement->bind_param("ssssss", $name, $email, $phone, $message, $newsletter, $dateNow);

    $statement->execute();

    $statement->close();

    $startConnection->close();
};
