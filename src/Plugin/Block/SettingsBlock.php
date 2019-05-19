<?php

namespace Drupal\custom_site_settings\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Block\BlockPluginInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Provides a Settings Block.
 * 
 * @Block(
 *  id = "settings_block",
 *  admin_label = @Translation("Settings block"),
 *  category = @Translation("Settings Block"),
 * )
 */
class SettingsBlock extends BlockBase implements BlockPluginInterface {

    /**
     * {@inheritdoc}
     */
    public function build() {
        // Return the form Form/SettingsBlockForm.php
        return \Drupal::FormBuilder()->getForm('Drupal\custom_site_settings\Form\SettingsBlockForm');
    }

    /**
     * Access control
     * {@inheritdoc}
     */
    protected function blockAccess(AccountInterface $account) {
        return AccessResult::allowedIfHasPermission($account, 'change site name');
    }

    /**
     * Define block form for block admin screen
     * {@inheritdoc}
     */
    public function blockForm($form, FormStateInterface $form_state) {
        $form = parent::blockForm($form, $form_state);

        $config = $this->getConfiguration();

        return $form;
    }

    /**
     * Submit handler
     * {@inheritdoc}
     */
    public function blockSubmit($form, FormStateInterface $form_state) {
        parent::blockSubmit($form, $form_state);
        $value = $form_state->getValues('site_name');
        $this->configuration['settings_block_name'] = $value['settings_block_name'];
    }
}