<?php
namespace Deployer;
require 'recipe/common.php';
require 'vendor/deployer/recipes/recipe/npm.php';
require 'vendor/deployer/recipes/recipe/rollbar.php';

// Configuration

set('ssh_type', 'native');
set('ssh_multiplexing', true);

set('repository', 'git@github.com:michaeldouglas/confphprs-calculator.git');
set('shared_files', []);
set('shared_dirs', []);
set('writable_dirs', []);

// Servers

server('production', '107.170.63.66')
    ->user('root')
    ->identityFile()
    ->set('deploy_path', '/var/www/html/michael.php')->stage('prod');

set('rollbar', [
    'access_token' => "a5a20d133b60417d91f225bdcbd78bb8",
    'rollbar_username' => 'michaeldouglas010790@gmail.com'
]);

// Run tests
desc('Tests project calculator');

task('local:phpunit', function () {
    runLocally("php bin/phpunit");
});

after('deploy:update_code', 'npm:install');

// Tasks
desc('Deploy your project');
task('deploy', [
    'local:phpunit',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:writable',
    'deploy:vendors',
    'deploy:clear_paths',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
    'success'
]);


after('deploy:failed', 'deploy:unlock');
after('deploy', 'deploy:rollbar');