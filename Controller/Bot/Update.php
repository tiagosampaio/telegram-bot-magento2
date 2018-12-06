<?php

declare(strict_types = 1);

namespace Telegram\Bot\Controller\Bot;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;

/**
 * Class Update
 * @package Telegram\Bot\Controller\Telegram\Bot
 */
class Update extends Action
{
    /**
     * @var \Telegram\Bot\Api\ServiceApiInterface
     */
    private $api;

    /**
     * @var \Magento\Framework\Serialize\SerializerInterface
     */
    private $serializer;

    public function __construct(
        Context $context,
        \Telegram\Bot\Api\ServiceApiInterface $api,
        \Magento\Framework\Serialize\SerializerInterface $serializer
    ) {
        parent::__construct($context);
        $this->api = $api;
        $this->serializer = $serializer;
    }

    public function execute()
    {
        $json = $this->getRequest()->getContent();
        $data = $this->serializer->unserialize($json);

        $chatId    = $data['message']['chat']['id'];
        $userId    = $data['message']['from']['id'];
        $firstName = $data['message']['from']['first_name'];
        $lastName  = $data['message']['from']['last_name'];

        $message = __('Hey %1 %2, how are you doing? This is our automatic response to your message.', $firstName, $lastName);

        $token  = '608782915:AAFym6-ECFA0LfF6HLbZc_MHHM-vKkCCSjE';

        $api = $this->api->get($token);
        $api->methods()->sendMessage($chatId, (string) $message);
    }
}
