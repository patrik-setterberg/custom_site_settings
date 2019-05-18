<?php

/**
 * @file
 * Contains \Drupal\custom_site_settings\Controller\SettingsController.php.
 */

namespace Drupal\custom_site_settings\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Define SettingsController class.
 */
class SettingsController extends ControllerBase {
    
    /**
     * Display markup
     * @return markup array.
     */
    public function content() {
        return [
            '#type' => 'markup',
            '#markup' => $this->t('CONTROL PANEL'),
        ];
    }
}