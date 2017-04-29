<?php
namespace Deployer;
require 'recipe/common.php';

// Configuration

set('ssh_type', 'native');
set('ssh_multiplexing', true);

set('repository', 'git@github.com:michaeldouglas/confphprs-calculator.git');
set('shared_files', []);
set('shared_dirs', []);
set('writable_dirs', []);
add('rsync', [
    'exclude' => [
        '.git',
        'deploy.php',
        'node_modules',
    ],
]);

// Servers

server('production', '107.170.63.66')
    ->user('root')
    ->identityFile()
    ->set('deploy_path', '/var/www/html/michael.php');



// Run tests
desc('Tests project calculator');

task('local:phpunit', function () {
    runLocally("php bin/phpunit");
});

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

task('test', function () {
    writeln('Hello world');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');