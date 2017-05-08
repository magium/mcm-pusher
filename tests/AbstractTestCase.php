<?php

namespace Magium\ConfigurationManager\Pusher\Tests;

use Magium\Configuration\Config\Repository\ConfigurationRepository;
use PHPUnit\Framework\TestCase;

abstract class AbstractTestCase extends TestCase
{

    protected function getRepository()
    {
        return new ConfigurationRepository(file_get_contents('config.xml'));
    }
}
