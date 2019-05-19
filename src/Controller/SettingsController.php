<?php

/**
 * @file
 * Contains \Drupal\custom_site_settings\Controller\SettingsController.php.
 */

namespace Drupal\custom_site_settings\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\block\Entity\Block;

/**
 * Define SettingsController class.
 */
class SettingsController extends ControllerBase {
    /**
     * @return container array.
     */
    public function content() {
        $block = \Drupal\block\Entity\Block::load('settings_block');
        $block_content = \Drupal::entityManager()
            ->getViewBuilder('block')
            ->view($block);
 
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