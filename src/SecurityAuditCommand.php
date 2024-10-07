<?php

namespace Prabath\SecurityAudit;

class SecurityAuditCommand
{
    /**
     * Execute the security audit.
     */
    public static function run()
    {
        echo "Running PHP Security Audit...\n";

        $audit = new SecurityAudit();
        $audit->run();

        echo "Audit finished.\n";
    }
}
