<?php

declare(strict_types = 1);

namespace Telegram\Bot\Service;

use Telegram\Bot\Api\ServiceApiInterface;

/**
 * Class Api
 * @package Telegram\Bot\Service
 */
final class Api implements ServiceApiInterface
{
    /**
     * @var \Telegram\Api
     */
    private $instance;

    /**
     * {@inheritdoc}
     */
    public function get(string $token = null)
    {
        if (!$this->instance) {
            $this->instance = self::create($token);
        }

        return $this->instance;
    }

    /**
     * {@inheritdoc}
     */
    public function create(string $token)
    {
        return \Telegram\ApiFactory::create($token);
    }
}
