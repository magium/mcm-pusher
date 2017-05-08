<?php

namespace Magium\ConfigurationManager\Pusher\Tests;

use Magium\Configuration\Config\Repository\ConfigurationRepository;
use Magium\ConfigurationManager\Pusher\PusherFactory;

class PusherFactoryTest extends AbstractTestCase
{

    public function testStaticFactory()
    {
        $repo = $this->getRepository();
        $pusher = PusherFactory::staticFactory($repo);
        $settings = $pusher->getSettings();
        self::assertSettings($settings, $repo);
    }

    public function testOptions()
    {
        // Check config.xml for the values
        $repo = $this->getRepository();
        $factory = new PusherFactory($repo);
        $options = $factory->buildOptions();
        self::assertArrayHasKey('scheme', $options);
        self::assertArrayHasKey('encrypted', $options);
        self::assertArrayHasKey('host', $options);
        self::assertArrayHasKey('port', $options);
        self::assertArrayHasKey('timeout', $options);
        self::assertArrayNotHasKey('cluster', $options); // This value is empty in the config and so should not be passed
        self::assertEquals('https', $options['scheme']);
        self::assertEquals(true, $options['encrypted']);
        self::assertInternalType('boolean', $options['encrypted']);
        self::assertEquals('pusher.host', $options['host']);
        self::assertEquals('8080', $options['port']);
        self::assertEquals('10000', $options['timeout']);
    }

    public function testObjectFactory()
    {
        $repo = $this->getRepository();
        $factory = new PusherFactory($repo);
        $pusher = $factory->factory();
        $settings = $pusher->getSettings();
        self::assertSettings($settings, $repo);
    }

    private static function assertSettings(array $settings, ConfigurationRepository $repo)
    {
        self::assertEquals($repo->getValue(PusherFactory::CONFIG_SCHEME), $settings['scheme']);
        self::assertEquals($repo->getValue(PusherFactory::CONFIG_ID), $settings['app_id']);
        self::assertEquals($repo->getValue(PusherFactory::CONFIG_KEY), $settings['auth_key']);
        self::assertEquals($repo->getValue(PusherFactory::CONFIG_SECRET), $settings['secret']);

    }

}
