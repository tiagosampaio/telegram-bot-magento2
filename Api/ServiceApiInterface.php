<?php

declare(strict_types = 1);

namespace Telegram\Bot\Api;

/**
 * Class ServiceApiInterface
 * @package Telegram\Bot\Api
 */
interface ServiceApiInterface
{
    /**
     * @param string|null $token
     * @return \Telegram\Api
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */
    public function get(string $token = null);

    /**
     * @param string $token
     * @return \Telegram\Api
     * @throws \DI\DependencyException
     * @throws \DI\NotFoundException
     */
    public function create(string $token);
}
