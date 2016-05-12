<html>
    <head>
        <title>Thanks For Contacting Me</title>
    </head>
    <body>
        <?php
            $to = 'nward3@nd.edu';
            $from = $_POST['email'];
            $name = $_POST['name'];
            $subject = $_POST['subject'];
            $body = $_POST['body'];
        
            # make a list of error messages
            $messages = array();

            # only allow reasonable email addresses
            if (!preg_match("/^[\w\+\-.~]+\@[\-\w\.\!]+$/", $from)) {
                $messages[] = "That is not a valid email address.";
            }
        
            # eliminate additional space to prevent spam
            $subject = preg_replace('/\s+/', ' ', $subject);
            # ensure the subject isn't blank afterwards!
            if (preg_match('/^\s*$/', $subject)) {
                $messages[] = "Please specify a subject for your message";
            }

            # ensure the message has a body
            if (preg_match('/^\s*$/', $body)) {
                $messages[] = "Your message was blank. Did you mean to say " .
                "something?"; 
            }

            # errors so tell the user and don't send the email
            if (count($messages)) {
                foreach ($messages as $message) {
                    echo("<p>$message</p>\n");
                }
                
                echo("<p>Please correct the problems and then click send again.</p>\n");
            }
            # no errors so send the email
            else {
                mail($to,
                    $subject,
                    $body,
                    "From: $name <$from>\r\n" .
                    "Reply-To: $name <$from>\r\n"); 
                echo("<p>Your message has been sent. Thanks!</p>\n");
          }
        ?>
    </body>
</html>