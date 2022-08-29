<?php

/**
 * @file
 * Contains \Drupal\timezone\Plugin\Block\TimeZoneBlock.
 */

namespace Drupal\timezone\Plugin\Block;

use Drupal\Core\Form\FormInterface;
use Drupal\Core\Block\BlockBase;

/**
 * Provides a block to get the timezone.
 * 
 * @Block(
 *  id = "timezone_block",
 *  admin_label = @Translation("TimeZone Block")
 * )
 */

class TimeZoneBlock extends BlockBase {
  /**
   * {@inheritdoc}
   */
  public function build() {
    $data = \Drupal::service('timezone.service')->getData();
    return [
      '#theme' => 'timezone_template',
      '#data' => $data,
    ];
  }
}