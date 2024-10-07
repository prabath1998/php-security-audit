<?php

require_once __DIR__ . '/vendor/autoload.php';

use Prabath\SecurityAudit\SecurityAuditCommand;

define('DEBUG_MODE', true);            // Simulate debug mode (change to false for production)
define('ENCRYPTION_KEY', 'some_key');  // Simulate an encryption key
define('HASH_ALGORITHM', 'bcrypt');    // Simulate the hashing algorithm in use



// Run the security audit command
SecurityAuditCommand::run();
