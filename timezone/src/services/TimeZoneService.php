<?php

/**
 * @file
 * Contains \Drupal\timezone\services\TimeZoneService.
 */

namespace Drupal\timezone\services;
use Drupal\Core\Database\Connection;

class TimeZoneService {
  protected $database;
  public function __construct(Connection $database) {
    $this->database = $database;
  }

  public function setData($form_state) {
    $this->database->insert('timezone_tables')
      ->fields(array(
        'country' => $form_state->getValue('timezone'),
      ))
      ->execute();
  }

  public function getData() {
    $query = $this->database->select('timezone_tables', 'tt');
    $query->fields('tt');
    $result = $query->execute()->fetchAll();
    return $result;
  }
}