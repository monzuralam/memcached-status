<?php
/**
 * Plugin Name:       Memcached Status
 * Plugin URI:        https://profiles.wordpress.org/monzuralam
 * Description:       Easily check memcached status in WordPress.
 * Version:           0.0.1
 * Author:            Monzur Alam
 * Author URI:        https://profiles.wordpress.org/monzuralam
 * Text Domain:       memcachedstatus
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * GitHub Plugin URI: https://github.com/monzuralam/memcached-status
 */

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

if(!class_exists('MemcachedStatus')){
    class MemcachedStatus{
        public function __construct(){
            add_action('admin_menu', array($this,'memcachedstatus_menu'));
        }
    
        public function memcachedstatus_menu(){
            add_options_page('Memcached Status','Memcached Status','administrator','memcached-status', array($this, 'memcachedstatus_admin_callback'));
        }
    
        public function memcachedstatus_admin_callback(){
            ?>
            <div class="wrap">
                <h2>Memcached Status</h2>
                <?php 
                    try{
                        $memcachedstatus = new Memcached();
                        $memcachedstatus->addServer('localhost', 11211);
                        _e('Memcached extension enable.','memcachedstatus');
                        echo "<br>";
                        echo "<pre>";
                        // print_r($memcachedstatus->getStats());
                    }catch(\Error $ex){
                        _e('Memcached not installed.','memcachedstatus');
                    }
                ?>
            </div>
            <?php
        }
    }
    new MemcachedStatus();
}
