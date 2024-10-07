<?php

namespace Prabath\SecurityAudit;

class SecurityAudit
{
    /**
     * Run all security checks.
     */
    public function run()
    {
        $this->checkDebugMode();
        $this->checkEncryptionKey();
        $this->checkHashingAlgorithm();
        $this->checkSQLInjectionVulnerabilities();

        echo "\033[32mSecurity audit completed successfully!\033[0m\n";
    }

    /**
     * Check if debug mode is enabled.
     */
    protected function checkDebugMode()
    {
        if (defined('DEBUG_MODE') && DEBUG_MODE) {
            echo "Warning: Debug mode is ON. It should be turned OFF in production.\n";
        } else {
            echo "Debug mode is OFF. Good practice!\n";
        }
    }

    /**
     * Check if encryption key is set.
     */
    protected function checkEncryptionKey()
    {
        if (!defined('ENCRYPTION_KEY') || empty(ENCRYPTION_KEY)) {
            echo "\033[31mError: Encryption key is not set. Please configure a secure encryption key.\033[31m\n";
        } else {
            echo "Encryption key is set.\n";
        }
    }

    /**
     * Check if the application uses strong hashing algorithms.
     */
    protected function checkHashingAlgorithm()
    {
        if (!defined('HASH_ALGORITHM') || HASH_ALGORITHM !== 'bcrypt') {
            echo "Warning: The default hashing algorithm is not bcrypt. Ensure you are using a strong hashing algorithm.\n";
        } else {
            echo "Default hashing algorithm is bcrypt.\n";
        }
    }

    /**
     * Simulate SQL injection check (for demonstration purposes).
     * This could be expanded to scan the application for unsafe query usage.
     */
    protected function checkSQLInjectionVulnerabilities()
    {
        echo "\033[32mStarting SQL injection vulnerability scan...\033[0m\n"; // Green message
        
        $directories = ['src/', 'app/', 'controllers/'];
       
        foreach ($directories as $directory) {
            $files = $this->getPHPFiles($directory);

            foreach ($files as $file) {
                $this->scanFileForSQLInjection($file);
            }
        }

        echo "\033[32mSQL injection vulnerability scan completed.\033[0m\n"; // Green message
    }

    /**
     * Get all PHP files in a directory.
     */
    private function getPHPFiles($directory)
    {
        try {
            $files = [];
            $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($directory));
            foreach ($iterator as $file) {
                if (pathinfo($file, PATHINFO_EXTENSION) === 'php') {
                    $files[] = $file;
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
        }

        return $files;
    }

    /**
     * Scan a single file for potential SQL injection patterns.
     */
    private function scanFileForSQLInjection($file)
    {
        try {
            $code = file_get_contents($file);

        // Pattern to match potential unsafe SQL queries
        $patterns = [
            '/\$[\w]+ ?\.\= ?[\'\"]SELECT .* FROM/i',       // Detect SQL query concatenation with variables
            '/mysql_query\(.+\)/i',                         // Detect old mysql_query usage (deprecated)
            '/mysqli_query\(.+\)/i',                        // Detect mysqli_query usage without prepared statements
            '/pg_query\(.+\)/i',                            // Detect PostgreSQL queries without prepared statements
            '/PDO::query\(.+\)/i',                          // Detect direct usage of PDO::query
            '/PDOStatement::execute\(.+\)/i',               // Detect PDO execute statements with concatenation
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $code)) {                
                echo "\033[33mWarning: Potential SQL Injection vulnerability found in file: $file\033[0m\n";
            }
        }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
