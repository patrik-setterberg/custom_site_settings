<?php

/**
 * @file
 * Contains \Drupal\custom_site_settings\Controller\SettingsController.php.
 */

namespace Drupal\custom_site_settings\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\block\Entity\Block;

use Drupal\Core\Config\FileStorage;

/**
 * Define SettingsController class.
 */
class SettingsController extends ControllerBase {
    /**
     * @return container array.
     */
    public function content() {
        // Get block configuration
        $config_path = drupal_get_path('module', 'custom_site_settings') . '/config/install';
        $source = new FileStorage($config_path);
        $config_storage = \Drupal::service('config.storage');
        $block_config = 'block.block.settings_block';
        $config_storage->write($block_config , $source->read($block_config));        

        // Load block
        $block = \Drupal\block\Entity\Block::load('settings_block');
        $block_content = \Drupal::entityManager()
            ->getViewBuilder('block')
            ->view($block);
 
        // Return block container
        return array(
            '#type' => 'container',
            '#attributes' => array(
                'class' => array("SettingsController"),
            ),
            'element-content' => $block_content,
            '#weight' => 0,
        );
    }
}