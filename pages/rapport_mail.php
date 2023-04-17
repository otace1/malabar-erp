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

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'mail11.lwspanel.com';                     //Set the SMTP server to send through
    //$mail->Host       = 'outlook.office365.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'malabar.erp@belej-consulting.com';                     //SMTP username
    $mail->Password   = 'M@l@b@r-3RP';                               //SMTP password
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('malabar-erp@belej-consulting.com', 'MALABAR-ERP');

    $mail->addAddress('vijeesh@malabar-group.com');
    $mail->addBCC('rajeev@malabar-group.com');
    $mail->addBCC('jeremy@belej-consulting.com');
    $mail->addBCC('malabartracking@malabar-group.com');
    $mail->addBCC('malabartracking1@malabar-group.com');
    $mail->addBCC('export-tracking@malabar-group.com');
    $mail->addBCC('import-tracking@malabar-group.com');
    $mail->addBCC('export-tracking-klesa@malabar-group.com');
    $mail->addBCC('ops-kasumbalesa@malabar-group.com');
    $mail->addBCC('john@malabar-group.com');
    $mail->addBCC('deo@malabar-group.com');
    $mail->addBCC('alain@malabar-group.com');
    $mail->addBCC('gaylord@malabar-group.com');
    $mail->addBCC('abdulnoor@malabar-group.com');
    $mail->addBCC('forain@malabar-group.com');
    $mail->addBCC('collinskapila9@gmail.com');
    $mail->addBCC('eric@malabar-group.com');
    $mail->addBCC('mushitutresor@gmail.com');

    $mail->addBCC('alain@malabar-group.com');
    $mail->addBCC('gaylord@malabar-group.com');
    $mail->addBCC('abdulnoor@malabar-group.com');
    $mail->addBCC('forain@malabar-group.com');
    $mail->addBCC('collinskapila9@gmail.com');
    $mail->addBCC('eric@malabar-group.com');
    $mail->addBCC('mushitutresor@gmail.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = "NOTIFICATION";

      $message = 'Dear All <br><br>';
      $message .= 'Please find bellow the notifications: <br>'; 
      $message .= '<table width="100%" style="  border: 1px solid black; border-radius: 5px; border-collapse:collapse;">
                    <tr style="font-weight: bold; background-color: black; color: white;">
                      <td style="border: 1px solid black;">N.</td>
                      <td style="border: 1px solid black;">Notification</td>
                      <td style="border: 1px solid black;">Link</td>
                    </tr>
                    <tr>
                      <td style="border: 1px solid black;">
                        1
                      </td>
                      <td style="border: 1px solid black;">
                        TRUCK OVERSTAY MORE THAN 2 DAYS AT KASUMBALESA
                      </td>
                      <td style="border: 1px solid black; text-align: center;">
                        <a href="https://tracking.malabar-group.com/pages/detail_rapport_mail.php?statut=TRUCK OVERSTAY MORE THAN 2 DAYS AT KASUMBALESA">
                            Click to view details
                        </a>
                      </td>
                    </tr>

                    <tr>
                      <td style="border: 1px solid black;">
                        2
                      </td>
                      <td style="border: 1px solid black;">
                        K\'LSA DATES ERROR
                      </td>
                      <td style="border: 1px solid black; text-align: center;">
                        <a href="https://tracking.malabar-group.com/pages/detail_rapport_mail.php?statut=K\'LSA DATES ERROR">
                            Click to view details
                        </a>
                      </td>
                    </tr>

                    <tr>
                      <td style="border: 1px solid black;">
                        3
                      </td>
                      <td style="border: 1px solid black;">
                        FILES WITHOUT LIQUIDATION BEYOND 2 DAYS
                      </td>
                      <td style="border: 1px solid black; text-align: center;">
                        <a href="https://tracking.malabar-group.com/pages/detail_rapport_mail.php?statut=FILES WITHOUT LIQUIDATION BEYOND 2 DAYS">
                            Click to view details
                        </a>
                      </td>
                    </tr>
                    
                    <tr>
                      <td style="border: 1px solid black;">
                        4
                      </td>
                      <td style="border: 1px solid black;">
                        FILES WITHOUT QUITTANCE BEYOND 2 DAYS
                      </td>
                      <td style="border: 1px solid black; text-align: center;">
                        <a href="https://tracking.malabar-group.com/pages/detail_rapport_mail.php?statut=FILES WITHOUT QUITTANCE BEYOND 2 DAYS">
                            Click to view details
                        </a>
                      </td>
                    </tr>
                    
                    <tr>
                      <td style="border: 1px solid black;">
                        5
                      </td>
                      <td style="border: 1px solid black;">
                        TRUCK OVERSTAY MORE THAN 2 DAYS AT WISKI
                      </td>
                      <td style="border: 1px solid black; text-align: center;">
                        <a href="https://tracking.malabar-group.com/pages/detail_rapport_mail.php?statut=TRUCK OVERSTAY MORE THAN 2 DAYS AT WISKI">
                            Click to view details
                        </a>
                      </td>
                    </tr>
                    
                    <tr>
                      <td style="border: 1px solid black;">
                        6
                      </td>
                      <td style="border: 1px solid black;">
                        FILES UNDER PREPARATION OVER 15 DAYS
                      </td>
                      <td style="border: 1px solid black; text-align: center;">
                        <a href="https://tracking.malabar-group.com/pages/detail_rapport_mail.php?statut=FILES UNDER PREPARATION OVER 15 DAYS">
                            Click to view details
                        </a>
                      </td>
                    </tr>
                    
                    <tr>
                      <td style="border: 1px solid black;">
                        7
                      </td>
                      <td style="border: 1px solid black;">
                        KASUMBALESA TRUCK ARRIVAL
                      </td>
                      <td style="border: 1px solid black; text-align: center;">
                        <a href="https://tracking.malabar-group.com/pages/detail_rapport_mail.php?statut=KASUMBALESA TRUCK ARRIVAL">
                            Click to view details
                        </a>
                      </td>
                    </tr>

                    <tr>
                      <td style="border: 1px solid black;">
                        8
                      </td>
                      <td style="border: 1px solid black;">
                        EXPORT FILES NOTIFICATION
                      </td>
                      <td style="border: 1px solid black; text-align: center;">
                        <a href="https://tracking.malabar-group.com/pages/buildNotificationMailExport.php">
                            Click to view details
                        </a>
                      </td>
                    </tr>
                    
                </table>';

    $mail->Body    = $message;
    

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}


?>