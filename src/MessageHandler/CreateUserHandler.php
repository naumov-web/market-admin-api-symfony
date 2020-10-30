<?php

namespace App\MessageHandler;

use App\Message\CreateUser;
use phpDocumentor\Reflection\Types\Self_;
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

    /**
     * Email message template
     * @var string
     */
    public const MESSAGE_TEMPLATE = '
        <h1>Добро пожаловать, {{name}}</h1>
        <p>
            Для вас создан аккаунт на сайте MarketAPI.
        </p>
    ';

    /**
     * @var \Swift_Mailer
     */
    protected $mailer;

    /**
     * Logger instance
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * CreateUserHandler constructor.
     * @param \Swift_Mailer $mailer
     * @param LoggerInterface $logger
     */
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
            ->setBody(str_replace(
                '{{name}}',
                $user->getName(),
                self::MESSAGE_TEMPLATE
                )
            );

        $this->mailer->send($message);

        $this->logger->info('CreateUser. Email sent to ' . $user->getEmail());
    }
}