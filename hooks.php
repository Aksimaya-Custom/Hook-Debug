<?php
/**
 * WHMCS SDK Hook Debug
 * 
 * Helping you to see error log 
 * for hook on inspect elements console.
 * 
 * 
 * This is the example you should 
 * apply to hook for using this addons.
 * 
 * @copyright Copyright (c) Kuronekosan 2023
 */
if (!defined("WHMCS"))
	die("This file cannot be accessed directly");

try {
    add_hook('AdminAreaHeadOutput', 1, function() {
        return <<<HTML
		<script type="text/javascript">
		console.log("Hook Debug Called Successfully.");
		</script>
	HTML;
    });
} catch (\Throwable $th) {
    // if you're inside folder 'includes/hooks', then use => include(ROOTDIR."modules/addons/hook_debug/00000_when_hook_errors.php");
    include_once('00000_when_hook_errors.php'); 
    /**
     * 1. First Parameters is for current hook name
     * 2. Second Parameters is for Type, you can declare 
     *    it as 'Admin' or 'Client', the default is 'Client'
     * 3. Third Parameters is for debugging, you can fill it empty or not assign it, default is ""
     */ 
    PrintErrorToJs(__FILE__, 'Admin', $th->getMessage());
}
