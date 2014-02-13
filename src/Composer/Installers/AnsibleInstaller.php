<?php
namespace Composer\Installers;

class AnsibleInstaller extends BaseInstaller
{
    protected $locations = array(
        'role' => 'provisioning/roles/{$name}/'
    );
}
