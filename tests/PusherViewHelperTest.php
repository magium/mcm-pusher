<?php

namespace Magium\ConfigurationManager\Pusher\Tests;

use Magium\Configuration\Config\Repository\ConfigurationRepository;
use Magium\ConfigurationManager\Pusher\PusherFactory;
use Magium\ConfigurationManager\Pusher\PusherViewHelper;

class PusherViewHelperTest extends AbstractTestCase
{

    public function testJavaScriptObjectCreation()
    {
        $helper = new PusherViewHelper($this->getRepository());
        $string = $helper->getConnectionJavaScript();
        self::assertContains('Pusher', $string);
        self::assertContains($this->getRepository()->getValue(PusherFactory::CONFIG_KEY), $string);
        self::assertContains('"encrypted":true', $string);
    }

    public function testJavaScriptOptions()
    {
        $helper = new PusherViewHelper($this->getRepository());
        $string = $helper->getConnectionJavaScript(['somestring' => 'somevalue']);
        self::assertContains('"somestring":"somevalue"', $string);
    }

}
