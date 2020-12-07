<?php
session_start();
require_once 'csrf/token.php';
$token = Token::generate();
?>

<!doctype html>
<html>

<head>
    <title>Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>

<body>
    <section>
        <form method="POST" action="submit.php" class="d-flex form-group col-xs-4">

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" required>
            </div>

            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" name="email" id="email" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone number</label>
                <input type="tel" class="form-control" name="phone" id="phone" required>
            </div>

            <div class="form-group">
                <label for="message">Your message</label>
                <textarea type="text" class="form-control" name="message" id="message" minlength="25" required></textarea>
            </div>

            <div class="form-group">
                <label for="signup">Sign up to our newsletter?</label>
                <select name="newsletter">
                    <option value="No">No</option>
                    <option value="Yes">Yes</option>
                </select>
            </div>

            <input type="submit" name="submit" value="Submit" class="btn btn-primary">

            <input type="hidden" name="token" value="<?php echo $token?>">


        </form>
    </section>
</body>
</html>