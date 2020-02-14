<?php

class Kontakt_Admin_Controller extends Admin_Controller {

    public function index() {
        $this->view->activeNavigation = 'kontakt';
        $contacts = $this->model->getContacts();
        $this->view->contacts = $contacts;
        $this->view->render('kontakt/kontakti.php');
    }

    public function obrisiKontakt() {
        $contactId = $_GET['contact_id'];
        $this->model->deleteContact($contactId);
        header('Location: ' . ADMIN_URL . 'kontakt');
    }
    
    public function kontaktStranica(){
        $this->view->activeNavigation = 'kontaktStranica';
        $kontaktPage = $this->model->getKontaktPage();
        $this->view->kontaktPage = $kontaktPage;
        $this->view->render('kontakt/kontakt_stranica.php');
    }
    
    public function azurirajKontaktStranicu() {
        $title = $_POST['title'];
        $description = $_POST['description'];
        
        $this->model->updateContactPage($title, $description);
        
        header('Location: ' . ADMIN_URL . 'kontakt/kontaktStranica?message=azurirana');
    }

    public function odgovori($contactId) {
        $contact = $this->model->getContact($contactId);
        $this->view->contact = $contact;
        $this->view->render('kontakt/odgovorKontakt.php');
    }
    function odgovorKontakt(){
            require LIBS . 'email/PHPMailerAutoload.php';

            $mail = new PHPMailer;

            //$mail->SMTPDebug = 3;                               // Enable verbose debug output

    $mail->Debugoutput = 'html';

            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = SMTP_SERVER;  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = SMTP_USER;                 // SMTP username
            $mail->Password = SMTP_PASSWORD;                           // SMTP password
            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            $mail->From = SMTP_USER;
            $mail->FromName = 'MILOS';
            $mail->addAddress('milossrt@gmail.com');     // Add a recipient
            $mail->addReplyTo(SMTP_USER);
            $mail->isHTML(true);                                  // Set email format to HTML

            $mail->Subject = $_POST['subject'];
            $mail->Body    = $_POST['odgovor'];
            $mail->AltBody = $_POST['odgovor'];

            if(!$mail->send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                echo 'Message has been sent';
            }
            die();
        }
    public function aaa($contactID) {

        require_once LIBS . 'email/swift_required.php';

        $naslov = $_POST['subject'];
        $odgovor = $_POST['odgovor'];
        $email = $_POST['email'];

        $subject = $naslov;
        $from = SMTP_USER;
        $to = $email;
        $body = $odgovor;

        // Create the Transport
        $transport = Swift_SmtpTransport::newInstance()->setHost(SMTP_SERVER);
        $transport->setPort(SMTP_PORT);
        $transport->setUsername(SMTP_USER);
        $transport->setPassword(SMTP_PASSWORD);
        if (SMTP_SSL) {
            $transport->setEncryption('ssl');
        }

        // Create the Mailer using your created Transport
        $mailer = Swift_Mailer::newInstance($transport);

        // Create a message
        $message = Swift_Message::newInstance($subject);
        $message->setFrom($from);
        $message->setTo($to);
        $message->setBody($body);
        $message->setContentType("text/html");
        $message->setPriority(3);
        $message->getHeaders()->addTextHeader('User-Agent', 'Mozilla Thunderbird 1.5.0.8 (Windows/20061025)');

        // Send the message
        if($result = $mailer->send($message)) {
            $this->model->replied($contactID);
            header('Location: ' . ADMIN_URL . 'kontakt?poruka=uspesan_odgovor');
            die();
        }
    }


}

?>