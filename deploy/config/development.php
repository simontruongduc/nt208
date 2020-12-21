<?php

namespace Deployer;

host('3.135.64.186')
    ->set('http_user', 'apache')
    ->stage('development')
    ->user('ec2-user')
    ->port(22)
    ->identityFile('deploy/keys/key.pem')
    ->forwardAgent(true)
    ->multiplexing(true)
    ->set('branch', 'feature/product_list')
    ->set('deploy_path', '/var/www/html/khopkmobile');