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
    private static $instance;

    /**
     * @param string|null $token
     * @return \Telegram\Api|\Telegram\ApiInterface
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */
    public static function get(string $token = null)
    {
        if (!self::$instance) {
            self::$instance = self::create($token);
        }

        return self::$instance;
    }

    /**
     * @param string $token
     * @return \Telegram\ApiInterface
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */
    public static function create(string $token)
    {
        return \Telegram\ApiFactory::create($token);
    }
}
