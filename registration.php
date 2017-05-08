<?php

$instance = \Magium\Configuration\File\Configuration\ConfigurationFileRepository::getInstance();
$instance->addSecureBase(realpath(__DIR__ . '/settings'));
$instance->registerConfigurationFile(new \Magium\Configuration\File\Configuration\XmlFile(
   realpath(__DIR__ . '/settings/settings.xml')
));
