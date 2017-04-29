<?php

// installs global error and exception handlers
Rollbar::init(array('access_token' => 'a5a20d133b60417d91f225bdcbd78bb8'));

// Message at level 'info'
Rollbar::report_message('testing 123', 'info');

// Catch an exception and send it to Rollbar
try {
    throw new Exception('test exception');
} catch (Exception $e) {
    Rollbar::report_exception($e);
}

// Will also be reported by the exception handler
throw new Exception('test 2');