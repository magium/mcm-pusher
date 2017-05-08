# Pusher Factory for the Magium Configuration Manager

If you application uses the [Magium Configuration Manager](https://github.com/magium/configuration-manager) you can use this module to retrieve a configured Pusher instance, both on the frontend and the backend.

## Installation

```
composer require magium/mcm-pusher-factory
```

Follow the instructions at the Magium Configuration Manager GitHub link to get configured, or run the `bin/magium-configuration` CLI.

## Backend Integration

```
$factory = new \Magium\Configuration\MagiumConfigurationFactory();
$config = $factory->getManager()->getConfiguration();

$pusher = Magium\ConfigurationManager\Pusher\PusherFactory::staticFactory($config);

// or

$factory = new Magium\ConfigurationManager\Pusher\PusherFactory($config);
$pusher = $factory->factory();

```

or configure your dependency manager to make `Magium\ConfigurationManager\Pusher\PusherFactory` the factory for the `Pusher` instance.

## Frontend Integration

If you want to use the frontend integration you can use the generic view handler provided here.

```
<?php

$factory = new \Magium\Configuration\MagiumConfigurationFactory();
$config = $factory->getManager()->getConfiguration();
$helper = new Magium\ConfigurationManager\Pusher($config);

?>
<html>
    <head>
    <script type="text/javascript">
        var pusher = <?php echo $helper->getConnectionJavaScript(); ?>
    </script>
    </head>
</html>

```
