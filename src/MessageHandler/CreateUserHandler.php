<?php

namespace App\MessageHandler;

use App\Message\CreateUser;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

/**
 * Class CreateUserHandler
 * @package App\MessageHandler
 */
final class CreateUserHandler implements MessageHandlerInterface
{

    /**
     * Subject of message
     * @var string
     */
    public const SUBJECT = 'Регистрация нового пользователя';

    protected $mailer;

    protected $logger;

    public function __construct(\Swift_Mailer $mailer, LoggerInterface $logger)
    {
        $this->mailer = $mailer;
        $this->logger = $logger;
    }

    /**
     * Process the message
     *
     * @param CreateUser $event_message
     * @return void
     */
    public function __invoke(CreateUser $event_message): void
    {
        $user = $event_message->getUser();

        $message = new \Swift_Message();
        $message->setSubject(self::SUBJECT)
            ->setTo($user->getEmail())
            ->setBody('test123');

        $this->mailer->send($message);

        $this->logger->info('CreateUser. Email sent to ' . $user->getEmail());
    }
}