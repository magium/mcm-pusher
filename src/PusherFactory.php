<?php

namespace Magium\ConfigurationManager\Pusher;

use Magium\Configuration\Config\Repository\ConfigInterface;

class PusherFactory
{

    const CONFIG_ID = 'pusher/general/id';
    const CONFIG_KEY = 'pusher/general/key';
    const CONFIG_SECRET = 'pusher/general/secret';
    const CONFIG_SCHEME = 'pusher/options/scheme';
    const CONFIG_HOST = 'pusher/options/host';
    const CONFIG_PORT = 'pusher/options/port';
    const CONFIG_TIMEOUT = 'pusher/options/timeout';
    const CONFIG_ENCRYPTED = 'pusher/options/encrypted';
    const CONFIG_CLUSTER = 'pusher/options/cluster';

    private $repository;

    private static $me;

    public function __construct(
        ConfigInterface $repository
    )
    {
        self::$me = $this;
        $this->repository = $repository;
    }

    public function getRepository()
    {
        return $this->repository;
    }

    public function buildOptions()
    {
        $options = [
            'scheme' => $this->getRepository()->getValue(self::CONFIG_SCHEME),
            'host' => $this->getRepository()->getValue(self::CONFIG_HOST),
            'port' => $this->getRepository()->getValue(self::CONFIG_PORT),
            'timeout' => $this->getRepository()->getValue(self::CONFIG_TIMEOUT),
            'encrypted' => $this->getRepository()->getValueFlag(self::CONFIG_ENCRYPTED),
            'cluster' => $this->getRepository()->getValue(self::CONFIG_CLUSTER)
        ];
        foreach ($options as $key => $value) {
            if ($value === null || $value === '') {
                unset($options[$key]);
            }
        }

        return $options;
    }

    public function factory()
    {
        $options = $this->buildOptions();
        return new \Pusher(
            $this->getRepository()->getValue(self::CONFIG_KEY),
            $this->getRepository()->getValue(self::CONFIG_SECRET),
            $this->getRepository()->getValue(self::CONFIG_ID),
            $options
        );
    }


    public static function staticFactory(ConfigInterface $repository)
    {
        if (!self::$me instanceof self) {
            self::$me = new self($repository);
        }
        return self::$me->factory();
    }

}
