<?php

namespace App\Notification;

use App\Entity\Contact;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class ContactNotification
{

    /**
     * @var MailerInterface
     */
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }
    public function notify(Contact $contact)
    {
        /* $email = (new Email())
            ->from('abdelfattah59@gmail.com')
            ->to('you@example.com')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html('<p>See Twig integration for better HTML integration!</p>');
            $this->mailer->send($email); */

        $tmp = (new TemplatedEmail())
            ->from('abdelfattah59@gmail.com')
            ->to('abdelfattah59@gmail.com')
            ->subject('Contact du a propos du bien ' . $contact->getProperty()->getSlug())
            ->htmlTemplate('emails/contact.html.twig')
            ->context([
                'contact' => $contact
            ]);

        $this->mailer->send($tmp);
    }
}
