<?php
/**
 * WHMCS SDK Hook Debug
 * 
 * Helping you to see error log 
 * for hook on inspect elements console.
 * 
 * 
 * This is the handler for custom hook_debug.
 * I use global variable to get parameters from parent
 * function to child function, not a best practice but it's work.
 * 
 * @copyright Copyright (c) Kuronekosan 2023
 */

if (!defined("WHMCS"))
	die("This file cannot be accessed directly");

use WHMCS\Database\Capsule;

function PrintErrorToJs($name, $type="Client", $det="")
{
	// Check if module is active.
    if(Capsule::getSchemaBuilder()->hasTable('addons_hook_debug')) {
        $checkValue = Capsule::table('addons_hook_debug')->where('id', 1)->first();
        if ($checkValue->value == 1) {
			// Start Here.
			global $filename;
			global $details;
			$filename = $name;
			$details = htmlspecialchars($det);
			if ($type == "Admin") {
				add_hook('AdminAreaHeadOutput', 1, function ($vars)
				{
					global $details;
					global $filename;
					return <<<HTML
					<script type="text/javascript">
						console.error( "Error Import Hooks on file => " + "$filename" + ", details: " + "$details" );
					</script>
				HTML;
				});
			} else {
				add_hook('ClientAreaHeadOutput', 1, function ($vars)
				{
					global $details;
					global $filename;
					return <<<HTML
					<script type="text/javascript">
						console.error( "Error Import Hooks on file => " + "$filename" + ", details: " + "$details" );
					</script>
				HTML;
				});
			}
			// End Here.
        }
    }
}


