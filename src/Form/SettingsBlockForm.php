<?php

namespace Drupal\custom_site_settings\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Settings block form
 */
class SettingsBlockForm extends FormBase {
    /**
     * {@inheritdoc}
     */
    public function getFormId() {
        return 'settings_block_form';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state) {
        // Change site name form
        $form['site_name'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Site name'),
            '#description' => $this->t('Change site name'),
            '#default_value' => \Drupal::config('system.site')->get('name'),
        );

        // Submit form
        $form['submit'] = array(
            '#type' => 'submit',
            '#value' => $this->t('Change'),
        );

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function validateForm(array &$form, FormStateInterface $form_state) {
        $text = $form_state->getValue('site_name');
        // Make sure user entered a value
        if (empty($text)) {
            $form_state->setErrorByName('site_name', $this->t('Please input a new site name'));
        }

        /**
         * I also wanted to validate max length and allowed characters
         * but was unable to find limitations or requirements for
         * a Drupal site's site name. 
         */
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
        $value = $form_state->getValue('site_name');

        $config = \Drupal::service('config.factory')->getEditable('system.site');
        $config->set('name', $value);
        $config->save();   
    }
}