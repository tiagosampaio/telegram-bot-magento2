<?php

declare(strict_types = 1);

namespace Telegram\Bot\Controller\Bot;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

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

    /**
     * @var \Telegram\ObjectType\Entity\UpdateFactory
     */
    private $updateFactory;

    public function __construct(
        Context $context,
        \Telegram\Bot\Api\ServiceApiInterface $api,
        \Telegram\ObjectType\Entity\UpdateFactory $updateFactory,
        \Magento\Framework\Serialize\SerializerInterface $serializer
    ) {
        parent::__construct($context);
        $this->api = $api;
        $this->updateFactory = $updateFactory;
        $this->serializer = $serializer;
    }

    public function execute()
    {
        $json = $this->getRequest()->getContent();
        $data = $this->serializer->unserialize($json);

        $token  = '608782915:AAFym6-ECFA0LfF6HLbZc_MHHM-vKkCCSjE';
        $api = $this->api->get($token);

        /** @var \Telegram\ObjectType\Entity\UpdateInterface $update */
        $update = $this->updateFactory->create(['data' => $data]);

        $chatId    = $update->getMessage()->getChat()->getId();
        $userId    = $update->getMessage()->getFrom()->getId();
        $firstName = $update->getMessage()->getFrom()->getFirstName();
        $lastName  = $update->getMessage()->getFrom()->getLastName();

        $message = __('Hey %1 %2, how are you doing? This is our automatic response to your message.', $firstName, $lastName);

        $api->methods()->sendMessage($chatId, (string) $message);
    }
}
