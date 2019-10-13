<html>
<head>
    <title>INPUT HTML</title>   
</head>
<body>
    <?php if (empty($_REQUEST['Submit'])){ ?>
    
    <h3>FORM SISWA</h3>
    <form action="<?php $_SERVER['PHP_SELF'] ?>">
        <label>Email</label>
        <input type="text" name="email"/><br/>
        <label>Subject</label>
        <input type="text" name="subject"/><br/>
        <label>Message</label><br/>
        <textarea rows="8" cols="50" name="message"></textarea><br/>
        <input type="submit" name="Submit" value="Send">
        <input type="reset" name="Reset" value="Reset">
    </form>   

    <?php 
    } else { 
        if ($_REQUEST["email"] == "" && $_REQUEST["subject"] == "" || $_REQUEST["message"] == ""){ 
            print "<h3>Lengkapi isi email.</h3>
            <a href='latihan04-email.php'>Kembali</a>";
        } else {
            /*
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= 'From: <hendroprwk@live.com>' . "\r\n";
            
            mail($_REQUEST["email"],
                $_REQUEST["subject"], 
                $_REQUEST["message"],
                $headers);
            */
            $mail = new PHPMailer(true);

            // Send mail using Gmail
            if($send_using_gmail){
                $mail->IsSMTP(); // telling the class to use SMTP
                $mail->SMTPAuth = true; // enable SMTP authentication
                $mail->SMTPSecure = "ssl"; // sets the prefix to the servier
                $mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server
                $mail->Port = 465; // set the SMTP port for the GMAIL server
                $mail->Username = "hendroprwk08@gmail.com"; // GMAIL username
                $mail->Password = "suparji08"; // GMAIL password
            }

            // Typical mail data
            $mail->AddAddress($email, $name);
            $mail->SetFrom($email_from, $name_from);
            $mail->Subject = $_REQUEST["subject"];
            $mail->Body = $_REQUEST["message"];

            try{
                $mail->Send();
                echo "Success!";
            } catch(Exception $e){
                // Something went bad
                echo "Fail :(";
            }
            
            print "<a href='latihan04-email.php'>Email terkirim</a>";
        }
    }?>
</body>
</html>