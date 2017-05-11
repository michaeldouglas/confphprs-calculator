<?php
namespace Deployer;
require 'recipe/common.php';
require 'vendor/deployer/recipes/recipe/npm.php';
require 'vendor/deployer/recipes/recipe/rollbar.php';
require 'vendor/deployer/recipes/recipe/slack.php';

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

set('default_stage', 'prod');

// Notices Rollbar
set('rollbar', [
    'access_token' => "a5a20d133b60417d91f225bdcbd78bb8"
]);

// Slack
set('slack', [
    'token' => 'xoxp-176584622293-177310698935-176421134851-a912ffc4ba5cad5449706fe391111fab',
    'team'  => 'confphprs',
    'app'   => 'confphprs',
]);

// Run tests
desc('Tests project calculator');
task('local:phpunit', function () {
    runLocally("php bin/phpunit");
});

// Run PHING
desc('PHING Task');
task('phing', function () {
    run("cd /var/www/html/michael.php/current && phing");
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
after('deploy', 'phing');