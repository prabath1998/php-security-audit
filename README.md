PHP Security Audit Package
The PHP Security Audit Package is a simple tool for performing security checks in PHP codebases. It scans for common vulnerabilities like SQL injection and other unsafe coding practices. The goal is to help developers identify security weaknesses and improve the overall security of their applications.

Features
Scans for potential SQL injection vulnerabilities.
Detects unsafe use of raw SQL queries (e.g., mysql_query, mysqli_query, and PDO::query).
Provides color-coded output:
Green for normal or success messages.
Yellow for warnings.
Red for errors.
Requirements
PHP 7.4 or higher
Composer
Installation
Clone this repository:

bash
Copy code
git clone https://github.com/prabath1998/security-audit.git
Navigate to the project directory:

bash
Copy code
cd security-audit
Install the dependencies using Composer:

bash
Copy code
composer install
Usage
Running the Security Audit
You can run the security audit by executing the audit.php script.

bash
Copy code
php audit.php
This will start the audit process, scan your codebase for SQL injection vulnerabilities, and output the results in your terminal.

Example Output
Green messages indicate the audit is starting or has completed successfully.
Yellow messages warn of potential SQL injection vulnerabilities.
Red messages indicate errors during the audit process.
bash
Copy code
Starting security audit...

Warning: Potential SQL Injection vulnerability found in file: src/Database/QueryBuilder.php

Security audit completed successfully!
Customizing the Directories to Scan
By default, the package scans the src/, app/, and controllers/ directories. You can modify the directories to scan by editing the $directories array in the SecurityAudit class.

php
Copy code
$directories = ['src/', 'app/', 'controllers/'];
How It Works
The package scans PHP files in the specified directories and searches for common patterns associated with SQL injection vulnerabilities. It looks for raw SQL queries where variables are concatenated into the query string, or where outdated methods like mysql_query() are used.

Example Pattern Detection
php
Copy code
$query = "SELECT * FROM users WHERE id = " . $userId; // Potential SQL injection
If it detects any such patterns, it will output a yellow warning indicating the file where the potential vulnerability was found.

Code Overview
Key Classes and Methods
SecurityAudit: The main class that handles the scanning process.
checkSQLInjectionVulnerabilities(): Scans PHP files for SQL injection vulnerabilities.
scanFileForSQLInjection(): Parses individual files and detects unsafe SQL query patterns.
runAudit(): The function responsible for starting the audit process, managing errors, and displaying results.
License
This project is open-sourced under the MIT License. See the LICENSE file for more details.

Contribution
Feel free to contribute by submitting issues, creating pull requests, or improving documentation.