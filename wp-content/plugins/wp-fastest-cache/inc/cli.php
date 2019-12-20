<?php
/**
 * WP-CLI commands for WP Fastest Cache.
 */

if(!defined('ABSPATH')){
    exit;
}

// This is a WP-CLI command, so bail if it's not available.
if(!defined('WP_CLI')){
    return;
}


class wpfcCLI extends \WP_CLI_Command
{
    /**
     * Clears the cache.
     *
     * ## EXAMPLES
     *      wp fastest-cache clear all
     *
     *
     * @subcommand clear
     *
     * @param array $args Args.
     * @param array $args_assoc Associative args.
     *
     * @return void
     */
    public function clear($args, $args_assoc){
        if(isset($args[0]) && $args[0] == "all"){
            if(isset($GLOBALS['wp_fastest_cache'])){
                if(method_exists($GLOBALS['wp_fastest_cache'], 'deleteCache')){

                    WP_CLI::line("Clearing the ALL cache...");
                    $GLOBALS['wp_fastest_cache']->deleteCache();
                    WP_CLI::success("The cache has been cleared!");

                }else{
                    WP_CLI::error("deleteCache() does not exist!");
                }
            }else{
                WP_CLI::error("GLOBALS['wp_fastest_cache'] has not been defined!");
            }
        }else{
            WP_CLI::error("The cache has been cleared!");
        }
    }
}

WP_CLI::add_command( 'fastest-cache', 'wpfcCLI' );

?>