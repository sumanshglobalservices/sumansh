<?php

// =====================================================
// SUMANSH GLOBAL SERVICES - ENQUIRY FORM
// =====================================================

// Email address where enquiries will be received
$to = "sumanshglobalservices@gmail.com";


// Only allow POST requests
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: contact.html");
    exit;
}


// Get form data safely
$name = isset($_POST["name"])
    ? trim($_POST["name"])
    : "";

$email = isset($_POST["email"])
    ? trim($_POST["email"])
    : "";

$phone = isset($_POST["phone"])
    ? trim($_POST["phone"])
    : "";

$company = isset($_POST["company"])
    ? trim($_POST["company"])
    : "";

$message = isset($_POST["message"])
    ? trim($_POST["message"])
    : "";


// Validate required fields
if ($name === "" || $email === "" || $message === "") {

    echo "
    <!doctype html>
    <html>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width,initial-scale=1'>
        <title>Error | Sumansh Global Services</title>

        <style>
            body {
                font-family: Arial, sans-serif;
                background: #f5f7fb;
                display: flex;
                align-items: center;
                justify-content: center;
                min-height: 100vh;
                margin: 0;
            }

            .box {
                background: #fff;
                padding: 40px;
                border-radius: 12px;
                text-align: center;
                max-width: 500px;
                box-shadow: 0 10px 30px rgba(0,0,0,.08);
            }

            h1 {
                color: #dc2626;
            }

            a {
                display: inline-block;
                margin-top: 20px;
                padding: 12px 22px;
                background: #0f172a;
                color: white;
                text-decoration: none;
                border-radius: 6px;
            }
        </style>
    </head>

    <body>

    <div class='box'>

        <h1>Missing Information</h1>

        <p>
            Please fill in all required fields and try again.
        </p>

        <a href='contact.html'>
            Go Back
        </a>

    </div>

    </body>
    </html>
    ";

    exit;
}


// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

    echo "
    <!doctype html>
    <html>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width,initial-scale=1'>
        <title>Invalid Email</title>

        <style>
            body {
                font-family: Arial, sans-serif;
                background: #f5f7fb;
                display: flex;
                align-items: center;
                justify-content: center;
                min-height: 100vh;
                margin: 0;
            }

            .box {
                background: #fff;
                padding: 40px;
                border-radius: 12px;
                text-align: center;
                max-width: 500px;
                box-shadow: 0 10px 30px rgba(0,0,0,.08);
            }

            h1 {
                color: #dc2626;
            }

            a {
                display: inline-block;
                margin-top: 20px;
                padding: 12px 22px;
                background: #0f172a;
                color: white;
                text-decoration: none;
                border-radius: 6px;
            }
        </style>
    </head>

    <body>

    <div class='box'>

        <h1>Invalid Email</h1>

        <p>
            Please enter a valid email address.
        </p>

        <a href='contact.html'>
            Go Back
        </a>

    </div>

    </body>
    </html>
    ";

    exit;
}


// Prevent email header injection
$name = str_replace(["\r", "\n"], " ", $name);
$email = str_replace(["\r", "\n"], " ", $email);
$phone = str_replace(["\r", "\n"], " ", $phone);
$company = str_replace(["\r", "\n"], " ", $company);


// Email subject
$subject = "New Manpower Enquiry - Sumansh Global Services";


// Email body
$emailBody = "

========================================
SUMANSH GLOBAL SERVICES
NEW MANPOWER ENQUIRY
========================================

Name:
$name

Email:
$email

Phone:
$phone

Company:
$company

Manpower Requirement:
$message

========================================
Submitted from:
Sumansh Global Services Website
========================================

";


// Email headers
$headers = "From: Sumansh Global Services <noreply@sumansh.com>\r\n";
$headers .= "Reply-To: " . $email . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";


// Send email
$mailSent = mail(
    $to,
    $subject,
    $emailBody,
    $headers
);


// Success
if ($mailSent) {

    echo "
    <!doctype html>
    <html lang='en'>

    <head>

        <meta charset='utf-8'>

        <meta
            name='viewport'
            content='width=device-width,initial-scale=1'
        >

        <title>Thank You | Sumansh Global Services</title>

        <style>

            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                font-family: Arial, sans-serif;
                background: #f5f7fb;
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 20px;
            }

            .success-box {
                background: #ffffff;
                max-width: 560px;
                width: 100%;
                padding: 45px 35px;
                text-align: center;
                border-radius: 14px;
                box-shadow: 0 10px 35px rgba(0,0,0,.08);
            }

            .check {
                width: 70px;
                height: 70px;
                border-radius: 50%;
                background: #16a34a;
                color: #fff;
                font-size: 40px;
                line-height: 70px;
                margin: 0 auto 20px;
            }

            h1 {
                margin: 0 0 12px;
                color: #172033;
            }

            p {
                color: #65748b;
                line-height: 1.6;
            }

            .back-btn {
                display: inline-block;
                margin-top: 20px;
                padding: 13px 25px;
                background: #172033;
                color: #fff;
                text-decoration: none;
                border-radius: 6px;
            }

            .back-btn:hover {
                opacity: .9;
            }

        </style>

    </head>

    <body>

        <div class='success-box'>

            <div class='check'>
                ✓
            </div>

            <h1>
                Thank You!
            </h1>

            <p>
                Your enquiry has been submitted successfully.
                Our team will contact you shortly.
            </p>

            <a
                href='index.html'
                class='back-btn'
            >
                Back to Home
            </a>

        </div>

    </body>

    </html>
    ";

} else {

    // Error
    echo "
    <!doctype html>
    <html lang='en'>

    <head>

        <meta charset='utf-8'>

        <meta
            name='viewport'
            content='width=device-width,initial-scale=1'
        >

        <title>Unable to Send | Sumansh Global Services</title>

        <style>

            body {
                font-family: Arial, sans-serif;
                background: #f5f7fb;
                display: flex;
                align-items: center;
                justify-content: center;
                min-height: 100vh;
                margin: 0;
                padding: 20px;
            }

            .box {
                background: #fff;
                padding: 40px;
                border-radius: 12px;
                text-align: center;
                max-width: 520px;
                box-shadow: 0 10px 30px rgba(0,0,0,.08);
            }

            h1 {
                color: #dc2626;
            }

            p {
                color: #65748b;
                line-height: 1.6;
            }

            a {
                display: inline-block;
                margin-top: 20px;
                padding: 12px 22px;
                background: #172033;
                color: #fff;
                text-decoration: none;
                border-radius: 6px;
            }

        </style>

    </head>

    <body>

        <div class='box'>

            <h1>
                Unable to Send Enquiry
            </h1>

            <p>
                Sorry, your enquiry could not be sent at this time.
                Please try again later or contact us directly.
            </p>

            <a href='contact.html'>
                Try Again
            </a>

        </div>

    </body>

    </html>
    ";

}

?>