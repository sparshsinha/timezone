<?php

/**
 * @file
 * Contains \Drupal\timezone\Form\TimeZoneForm.
 */

namespace Drupal\timezone\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Datetime\DrupalDateTime;
use Drupal\Core\Session\AccountInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class TimeZoneForm extends FormBase {

  protected $loaddata;

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'time_zone';
  }

  public function __construct() {
    $this->loaddata = \Drupal::service('timezone.service');
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['country'] = [
      '#type' => 'textfield',
      '#title' => t('Country'),
      '#required' => TRUE,
    ];
    $form['city'] = [
      '#type' => 'textfield',
      '#title' => t('City'),
      '#required' => TRUE,
    ];
    $form['timezone'] = [
      '#type' => 'select',
      '#title' => ('Timezone'),
      '#options' => [
        'options_list' => t('Options in the select list'),
        'America/Chicago' => t('America/Chicago'),
        'America/New_York' => t('America/New_York'),
        'Asia/Tokyo' => t('Asia/Tokyo'),
        'Asia/Dubai' => t('Asia/Dubai'),
        'Asia/Kolkata' => t('Asia/Kolkata'),
        'Europe/Amsterdam' => t('Europe/Amsterdam'),
        'urope/Oslo' => t('Europe/Oslo'),
        'Europe/London' => t('Europe/London'),
      ],
    ];
    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
      '#button_type' => 'primary',
    ];
    return $form;
  }
  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    
    $selected_timezone = $form_state->getValue('timezone');

    $date = new DrupalDateTime();
    $result = $date->setTimezone(new \DateTimeZone($selected_timezone));
    $date_format = $date->format('dS M Y - g:i A');

    \Drupal::messenger()->addMessage($date_format);

  }
}