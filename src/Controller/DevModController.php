<?php

namespace Drupal\dev_mod\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Link;
use Drupal\Core\Url;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

/**
 * Controller routines for page example routes.
 */
class DevModController extends ControllerBase {

  /**
   * Constructs a page for debug content.
   *
   * Our router maps this method to the path 'examples/page-example'.
   */
  public function description() {

    // Assemble the markup.
    $build = array(
      '#markup' => $this->t('<p>Dev Mod</p>'),
    );

    return $build;
  }

}
