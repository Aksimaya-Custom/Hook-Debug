<?php
/**
 * WHMCS SDK Hook Debug
 * 
 * Helping you to see error log 
 * for hook on inspect elements console.
 * 
 * 
 * I see this WHMCS Engine is using 
 * like-laravel 'Database Query Builder', so i will make 
 * connection using my own logic & understanding from laravel.
 * 
 * @copyright Copyright (c) Kuronekosan 2023
 */

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

use WHMCS\Module\Addon\AddonModule\Admin\AdminDispatcher;
use WHMCS\Module\Addon\AddonModule\Client\ClientDispatcher;
use WHMCS\Database\Capsule;

/**
 * @return array
 */
function hook_debug_config()
{
    return array(
        'name' => 'Hook Debug',
        'description' => 'This module can provide you error log on hook :)',
        'author' => 'Kuronekosan',
        'language' => 'english',
        'version' => '0.1'
    );
}

/**
 * Activate.
 *
 * @return array the result if success or fail
 */
function hook_debug_activate()
{
    try {
        // Check for the table is already created or not, therefore create if not exist.
        if(!Capsule::getSchemaBuilder()->hasTable('addons_hook_debug')) {
            Capsule::schema()->create(
                'addons_hook_debug',
                function ($table) {
                    $table->increments('id');
                    $table->boolean('value');
                }
            );
        }
        /** Update data if exist, if data is empty then create one.
         *  (also thanks laravel for having this nice & elegant query builder. :D)
         *  -------------------------------------- Kuro --------------------------------------
         */
        Capsule::table('addons_hook_debug')->updateOrInsert([
            'id' => 1,
            ],[
            'value' => true
        ]);
        $response = [
            'status' => 'success',
            'desc' => 'Module activated, enjoy.',
        ];
    } catch (\Throwable $th) {
        $response = [
            'status' => 'error',
            'desc' => 'Module activation error. Details: ' . $th->getMessage(),
        ];
    }
    return $response;
}

/**
 * Deactivate.
 *
 * @return array the result if success or fail
 */
function hook_debug_deactivate()
{
    try {
        // Check for the table is already created or not, therefore create if not exist.
        if(!Capsule::getSchemaBuilder()->hasTable('addons_hook_debug')) {
            Capsule::schema()->create(
                'addons_hook_debug',
                function ($table) {
                    $table->increments('id');
                    $table->boolean('value');
                }
            );
        }
        /** Update data if exist, if data is empty then create one.
         *  (also thanks laravel for having this nice & elegant query builder. :D)
         *  -------------------------------------- Kuro --------------------------------------
         */
        Capsule::table('addons_hook_debug')->updateOrInsert([
            'id' => 1,
            ],[
            'value' => false
        ]);
        $response = [
            'status' => 'success',
            'desc' => 'Module deactivated.',
        ];
    } catch (\Throwable $th) {
        $response = [
            'status' => 'error',
            'desc' => 'Module activation error. Details: ' . $th->getMessage(),
        ];
    }
    return $response;
}