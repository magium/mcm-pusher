<?php

namespace Magium\ConfigurationManager\Pusher;

use Magium\Configuration\Config\Repository\ConfigInterface;

class PusherViewHelper
{

    private $repository;

    public function __construct(
        ConfigInterface $repository
    )
    {
        $this->repository = $repository;
    }

    public function getConnectionJavaScript(array $options = [])
    {
        $options['encrypted'] = $this->repository->getValueFlag(PusherFactory::CONFIG_ENCRYPTED);

        return sprintf(
            "new Pusher('%s', %s);",
            htmlspecialchars($this->repository->getValue(PusherFactory::CONFIG_KEY)),
            json_encode($options)
        );

    }


}
