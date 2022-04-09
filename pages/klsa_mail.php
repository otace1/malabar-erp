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

include('../classes/maClasse.class.php');

$maClasse = new MaClasse();

if ($maClasse-> nbreDelaiDateKlsa()>0) {
     
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

        //Recipients
        $mail->setFrom('malabar-erp@belej-consulting.com', 'MALABAR-ERP');

        // $mail->addAddress('vijeesh@malabar-group.com');
        // $mail->addAddress('rajeev@malabar-group.com');
        // $mail->addAddress('joshy@malabar-group.com');
        $mail->addAddress('jeremy@belej-consulting.com');
        //$mail->addBCC('bcc@example.com');

        //Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = "TRUCK OVERSTAY MORE THAN 2 DAYS AT KASUMBALESA";

          $message = 'Dear All <br><br>';
          $message .= 'We have <b><font color="red">'.$maClasse-> nbreDelaiDateKlsa().'</font></b> file(s) truck overstay more than 2 days at Kasumbalesa: <br>'; 
          $message .= '<table width="100%" style="  border: 1px solid black; border-radius: 5px; border-collapse:collapse;">
                         <tr style="font-weight: bold; background-color: black; color: white;">
                              <td style="border: 1px solid black;">N.</td>
                              <td style="border: 1px solid black;">MCA REF. FILE</td>
                              <td style="border: 1px solid black;">Client</td>
                              <td style="border: 1px solid black;">Horse</td>
                              <td style="border: 1px solid black;">Trailer 1</td>
                              <td style="border: 1px solid black;">Trailer 2</td>
                              <td style="border: 1px solid black;">Prealerte Date</td>
                              <td style="border: 1px solid black;">Klsa Arrival</td>
                              <td style="border: 1px solid black;">Wiski Arrival</td>
                              <td style="border: 1px solid black;">Wiski Departure</td>
                              <td style="border: 1px solid black;">Dispatch From Klsa</td>
                              <td style="border: 1px solid black;">Delay</td>
                         </tr>
                         '.$maClasse-> afficherDelaiDateKlsa().'
                    </table>';

        $mail->Body    = $message;
        

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

if ($maClasse-> nbreErreurDateKlsa()>0) {
     
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

        //Recipients
        // $mail->setFrom('malabar-erp@belej-consulting.com', 'MALABAR-ERP');
        // $mail->addAddress('vijeesh@malabar-group.com');
        // $mail->addAddress('rajeev@malabar-group.com');
        // $mail->addAddress('joshy@malabar-group.com');
        $mail->addAddress('jeremy@belej-consulting.com');
        //$mail->addBCC('bcc@example.com');

        //Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = "K'LSA DATES ERROR";

          $message = 'Dear All <br><br>';
          $message .= 'We have <b><font color="red">'.$maClasse-> nbreErreurDateKlsa().'</font></b> file(s) of which Kasumbalesa dates have error: <br>'; 
          $message .= '<table width="100%" style="  border: 1px solid black; border-radius: 5px; border-collapse:collapse;">
                         <tr style="font-weight: bold; background-color: black; color: white;">
                              <td style="border: 1px solid black;">N.</td>
                              <td style="border: 1px solid black;">MCA REF. FILE</td>
                              <td style="border: 1px solid black;">Client</td>
                              <td style="border: 1px solid black;">Horse</td>
                              <td style="border: 1px solid black;">Trailer 1</td>
                              <td style="border: 1px solid black;">Trailer 2</td>
                              <td style="border: 1px solid black;">Prealerte Date</td>
                              <td style="border: 1px solid black;">Klsa Arrival</td>
                              <td style="border: 1px solid black;">Wiski Arrival</td>
                              <td style="border: 1px solid black;">Wiski Departure</td>
                              <td style="border: 1px solid black;">Dispatch From Klsa</td>
                              <td style="border: 1px solid black;">Delay</td>
                         </tr>
                         '.$maClasse-> afficherErreurDateKlsa().'
                    </table>';

        $mail->Body    = $message;
        

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

if ($maClasse-> getNombreDossierSansLiquidationApresCotation()>0) {
     
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

        //Recipients
        $mail->setFrom('malabar-erp@belej-consulting.com', 'MALABAR-ERP');
        
        $mail->addAddress('vijeesh@malabar-group.com');
         $mail->addCC('rajeev@malabar-group.com');
         $mail->addCC('joshy@malabar-group.com');
         $mail->addCC('jeremy@belej-consulting.com');
        //$mail->addCC('dngoy@douanexpresscustoms.com');
        //$mail->addBCC('bcc@example.com');

        //Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = "FILES WITHOUT LIQUIDATION BEYOND 2 DAYS";

          $message = 'Dear All <br><br>';
          $message .= 'We have <b><font color="red">'.$maClasse-> getNombreDossierSansLiquidationApresCotation().'</font></b> file(s) without Liquidation of which delay beyond two days: <br>'; 
          $message .= '<table width="100%" style="  border: 1px solid black; border-radius: 5px; border-collapse:collapse;">
                         <tr style="font-weight: bold; background-color: black; color: white;">
                              <td style="border: 1px solid black;">N.</td>
                              <td style="border: 1px solid black;">MCA REF. FILE</td>
                              <td style="border: 1px solid black;">Client</td>
                              <td style="border: 1px solid black;">Prealerte Date</td>
                              <td style="border: 1px solid black;">Prealerte Delay</td>
                              <td style="border: 1px solid black;">Declaration Ref.</td>
                              <td style="border: 1px solid black;">Declaration Date</td>
                              <td style="border: 1px solid black;">Declaration Delay</td>
                         </tr>
                         '.$maClasse-> afficherNotificationMailDossierSansLiquidation().'
                    </table>';

        $mail->Body    = $message;
        

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

if ($maClasse-> getNombreDossierSansQuittanceApresIM4()>0) {
     
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

        //Recipients
        $mail->setFrom('malabar-erp@belej-consulting.com', 'MALABAR-ERP');
        
        $mail->addAddress('vijeesh@malabar-group.com');
         $mail->addCC('rajeev@malabar-group.com');
         $mail->addCC('joshy@malabar-group.com');
         $mail->addCC('jeremy@belej-consulting.com');
        //$mail->addCC('dngoy@douanexpresscustoms.com');
        //$mail->addBCC('bcc@example.com');

        //Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = "FILES WITHOUT QUITTANCE BEYOND 2 DAYS";

          $message = 'Dear All <br><br>';
          $message .= 'We have <b><font color="red">'.$maClasse-> getNombreDossierSansQuittanceApresIM4().'</font></b> file(s) without Liquidation of which delay beyond two days: <br>'; 
          $message .= '<table width="100%" style="  border: 1px solid black; border-radius: 5px; border-collapse:collapse;">
                         <tr style="font-weight: bold; background-color: black; color: white;">
                              <td style="border: 1px solid black;">N.</td>
                              <td style="border: 1px solid black;">MCA REF. FILE</td>
                              <td style="border: 1px solid black;">Client</td>
                              <td style="border: 1px solid black;">Prealerte Date</td>
                              <td style="border: 1px solid black;">Prealerte Delay</td>
                              <td style="border: 1px solid black;">Declaration Ref.</td>
                              <td style="border: 1px solid black;">Declaration Date</td>
                              <td style="border: 1px solid black;">Liq. Ref.</td>
                              <td style="border: 1px solid black;">Liq Date</td>
                              <td style="border: 1px solid black;">Liq. Delay </td>
                         </tr>
                         '.$maClasse-> afficherNotificationMailDossierSansQuittanceApresIM4().'
                    </table>';

        $mail->Body    = $message;
        

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

if ($maClasse-> getNombreDossierSansQuittanceApresIM4()>0) {
     
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

        //Recipients
        $mail->setFrom('malabar-erp@belej-consulting.com', 'MALABAR-ERP');
        
        $mail->addAddress('vijeesh@malabar-group.com');
         $mail->addCC('rajeev@malabar-group.com');
         $mail->addCC('joshy@malabar-group.com');
         $mail->addCC('jeremy@belej-consulting.com');
        //$mail->addCC('dngoy@douanexpresscustoms.com');
        //$mail->addBCC('bcc@example.com');

        //Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = "FILES WITHOUT QUITTANCE BEYOND 2 DAYS";

          $message = 'Dear All <br><br>';
          $message .= 'We have <b><font color="red">'.$maClasse-> getNombreDossierSansQuittanceApresIM4().'</font></b> file(s) without Liquidation of which delay beyond two days: <br>'; 
          $message .= '<table width="100%" style="  border: 1px solid black; border-radius: 5px; border-collapse:collapse;">
                         <tr style="font-weight: bold; background-color: black; color: white;">
                              <td style="border: 1px solid black;">N.</td>
                              <td style="border: 1px solid black;">MCA REF. FILE</td>
                              <td style="border: 1px solid black;">Client</td>
                              <td style="border: 1px solid black;">Prealerte Date</td>
                              <td style="border: 1px solid black;">Prealerte Delay</td>
                              <td style="border: 1px solid black;">Declaration Ref.</td>
                              <td style="border: 1px solid black;">Declaration Date</td>
                              <td style="border: 1px solid black;">Liq. Ref.</td>
                              <td style="border: 1px solid black;">Liq Date</td>
                              <td style="border: 1px solid black;">Liq. Delay </td>
                         </tr>
                         '.$maClasse-> afficherNotificationMailDossierSansQuittanceApresIM4().'
                    </table>';

        $mail->Body    = $message;
        

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

if ($maClasse-> nbreDelaiDateWiski()>0) {
     
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

        //Recipients
        // $mail->setFrom('malabar-erp@belej-consulting.com', 'MALABAR-ERP');
        // // $mail->addAddress('vijeesh@malabar-group.com');
        // // $mail->addAddress('rajeev@malabar-group.com');
        // // $mail->addAddress('joshy@malabar-group.com');
        $mail->addAddress('jeremy@belej-consulting.com');
        //$mail->addBCC('bcc@example.com');

        //Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = "TRUCK OVERSTAY MORE THAN 2 DAYS AT WISKI";

          $message = 'Dear All <br><br>';
          $message .= 'We have <b><font color="red">'.$maClasse-> nbreDelaiDateWiski().'</font></b> file(s) the truck overstay more than 2 days at Wisk: <br>'; 
          $message .= '<table width="100%" style="  border: 1px solid black; border-radius: 5px; border-collapse:collapse;">
                         <tr style="font-weight: bold; background-color: black; color: white;">
                              <td style="border: 1px solid black;">N.</td>
                              <td style="border: 1px solid black;">MCA REF. FILE</td>
                              <td style="border: 1px solid black;">Client</td>
                              <td style="border: 1px solid black;">Horse</td>
                              <td style="border: 1px solid black;">Trailer 1</td>
                              <td style="border: 1px solid black;">Trailer 2</td>
                              <td style="border: 1px solid black;">Prealerte Date</td>
                              <td style="border: 1px solid black;">Klsa Arrival</td>
                              <td style="border: 1px solid black;">Wiski Arrival</td>
                              <td style="border: 1px solid black;">Wiski Departure</td>
                              <td style="border: 1px solid black;">Dispatch From Klsa</td>
                              <td style="border: 1px solid black;">Delay</td>
                         </tr>
                         '.$maClasse-> afficherDelaiDateWiski().'
                    </table>';

        $mail->Body    = $message;
        

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

if ($maClasse-> nbreDelaiStatut('UNDER PREPARATION')>0) {
     
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

        //Recipients
        $mail->setFrom('malabar-erp@belej-consulting.com', 'MALABAR-ERP');

        // $mail->addAddress('vijeesh@malabar-group.com');
        // $mail->addAddress('rajeev@malabar-group.com');
        // $mail->addAddress('joshy@malabar-group.com');
        $mail->addAddress('jeremy@belej-consulting.com');
        //$mail->addBCC('bcc@example.com');

        //Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = "FILES UNDER PREPARATION OVER 15 DAYS";

          $message = 'Dear All <br><br>';
          $message .= 'We have <b><font color="red">'.$maClasse-> nbreDelaiStatut('UNDER PREPARATION').'</font></b> file(s) under preparation over 15 days: <br>'; 
          $message .= '<table width="100%" style="  border: 1px solid black; border-radius: 5px; border-collapse:collapse;">
                         <tr style="font-weight: bold; background-color: black; color: white;">
                              <td style="border: 1px solid black;">N.</td>
                              <td style="border: 1px solid black;">MCA REF. FILE</td>
                              <td style="border: 1px solid black;">Client</td>
                              <td style="border: 1px solid black;">Prealerte Date</td>
                              <td style="border: 1px solid black;">Klsa Arrival</td>
                              <td style="border: 1px solid black;">Wiski Arrival</td>
                              <td style="border: 1px solid black;">Wiski Departure</td>
                              <td style="border: 1px solid black;">Dispatch From Klsa</td>
                              <td style="border: 1px solid black;">Delay</td>
                         </tr>
                         '.$maClasse-> afficherDelaiDateStatut('UNDER PREPARATION').'
                    </table>';

        $mail->Body    = $message;
        

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

if ($maClasse-> nbreDelaiDateClotureSansDeliver()>0) {
     
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

        //Recipients
        $mail->setFrom('malabar-erp@belej-consulting.com', 'MALABAR-ERP');

        // $mail->addAddress('vijeesh@malabar-group.com');
        // $mail->addAddress('rajeev@malabar-group.com');
        // $mail->addAddress('joshy@malabar-group.com');
        $mail->addAddress('jeremy@belej-consulting.com');
        //$mail->addBCC('bcc@example.com');

        //Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = "FILES MISSING DISPATCH DATES/ DELIVERED DATE";

          $message = 'Dear All <br><br>';
          $message .= 'We have <b><font color="red">'.$maClasse-> nbreDelaiDateClotureSansDeliver().'</font></b> file(s) missing dispatch dates/ Delivered date: <br>'; 
          $message .= '<table width="100%" style="  border: 1px solid black; border-radius: 5px; border-collapse:collapse;">
                         <tr style="font-weight: bold; background-color: black; color: white;">
                              <td style="border: 1px solid black;">N.</td>
                              <td style="border: 1px solid black;">MCA REF. FILE</td>
                              <td style="border: 1px solid black;">Client</td>
                              <td style="border: 1px solid black;">Prealerte Date</td>
                              <td style="border: 1px solid black;">Klsa Arrival</td>
                              <td style="border: 1px solid black;">Wiski Arrival</td>
                              <td style="border: 1px solid black;">Wiski Departure</td>
                              <td style="border: 1px solid black;">Dispatch From Klsa</td>
                              <td style="border: 1px solid black;">Delay</td>
                         </tr>
                         '.$maClasse-> afficherClotureSansDeliver().'
                    </table>';

        $mail->Body    = $message;
        

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

if ($maClasse-> nbreArriveKlsa2Jour()>0) {
     
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

        //Recipients
        $mail->setFrom('malabar-erp@belej-consulting.com', 'MALABAR-ERP');

        // $mail->addAddress('vijeesh@malabar-group.com');
        // $mail->addAddress('rajeev@malabar-group.com');
        // $mail->addAddress('joshy@malabar-group.com');
        $mail->addAddress('jeremy@belej-consulting.com');
        //$mail->addBCC('bcc@example.com');

        //Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = "KASUMBALESA TRUCK ARRIVAL";

          $message = 'Dear All <br><br>';
          $message .= 'We have <b><font color="red">'.$maClasse-> nbreArriveKlsa2Jour().'</font></b> Kasumbalesa truck arrival: <br>'; 
          $message .= '<table width="100%" style="  border: 1px solid black; border-radius: 5px; border-collapse:collapse;">
                         <tr style="font-weight: bold; background-color: black; color: white;">
                              <td style="border: 1px solid black;">N.</td>
                              <td style="border: 1px solid black;">MCA REF. FILE</td>
                              <td style="border: 1px solid black;">Client</td>
                              <td style="border: 1px solid black;">Horse</td>
                              <td style="border: 1px solid black;">Trailer 1</td>
                              <td style="border: 1px solid black;">Trailer 2</td>
                              <td style="border: 1px solid black;">Prealerte Date</td>
                              <td style="border: 1px solid black;">Klsa Arrival</td>
                         </tr>
                         '.$maClasse-> afficherArriveKlsa2Jour().'
                    </table>';

        $mail->Body    = $message;
        

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

?>