<?php

namespace App\MessageHandler;

use App\Message\CreateUser;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

/**
 * Class CreateUserHandler
 * @package App\MessageHandler
 */
final class CreateUserHandler implements MessageHandlerInterface
{
    /**
     * Process the message
     *
     * @param CreateUser $message
     * @return void
     */
    public function __invoke(CreateUser $message): void
    {
        
    }
}