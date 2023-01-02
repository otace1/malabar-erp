<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

// include('../../classes/maClasse.class.php');

// $maClasse = new MaClasse();

// if ($maClasse-> nbreDelaiDateKlsa()>0) {
     
    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'mail11.lwspanel.com';                     //Set the SMTP server to send through
        //$mail->Host       = 'outlook.office365.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'malabar-erp@belej-consulting.com';                     //SMTP username
        $mail->Password   = 'M@l@b@r-3RP';                               //SMTP password
        $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        $mail->Priority = 1;
        //MS Outlook custom header
        //May set to "Urgent" or "Highest" rather than "High"
        $mail->AddCustomHeader("X-MSMail-Priority: High");
        //Not sure if Priority will also set the Importance header:
        $mail->AddCustomHeader("Importance: High");

        //Recipients
        $mail->setFrom('malabar-erp@belej-consulting.com', 'MALABAR-ERP');

        $mail->addAddress('jeremy@belej-consulting.com');

        for ($i=1; $i <= $_POST['nbre_adresse'] ; $i++) { 
            if (isset($_POST['check_'.$i])) {
                // echo $_POST['adr_mail_'.$i];
                $mail->addAddress($_POST['adr_mail_'.$i]);
            }
        }

        //$mail->addBCC('bcc@example.com');

        //Attachments
        $mail->addAttachment('../facture_dossier/'.$_POST['ref_fact'].'.pdf');         //Add attachments
        $mail->addAttachment('../facture_dossier/'.$_POST['ref_fact'].'.xls');         //Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Signature
        // $mail->addEmbeddedImage('../../images/belej.png', 'logo_belej');
        // $mail->addEmbeddedImage('../../images/kcc.png', 'logo_kcc');
        //Signature

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'INVOICE '.$_POST['ref_fact'];

        $message = 'Dear All, <br><br>';
        $message .= 'Please find attached the documents for the Invoice<br>';
        $mail->Body    = $message;
        

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
// }


?>