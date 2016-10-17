<?php

namespace Drupal\dev_mod\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Link;
use Drupal\Core\Url;
use Drupal\Core\Render\Element;

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

    $node = node_load(857);
    echo "node";
    kint($node);

    $image = $this->getResponsiveImage($node);
    echo "image";
    kint($image);
    $rendered_image = render($image);
    echo "rendered image";
    kint($rendered_image);
    echo $rendered_image;

    die;

    return $build;
  }

  private function getResponsiveImage($node) {

    $image_field_name = 'field_image_hero';

    if ($node->hasField($image_field_name) && $node->get($image_field_name) &&
          !$node->get($image_field_name)->isEmpty()) {
        /** @var \Drupal\file\Entiy\File $file */
        $file = $node->get($image_field_name)->entity;

        echo $image_field_name;
        $item = $node->get($image_field_name);
        kint($item);

        echo '$image_field_name ge value';
        $item = $node->get($image_field_name)->getValue();
        kint($item);

        // $item_attributes = $item->_attributes;
        // unset($item->_attributes);

        // The image.factory service will check if our image is valid.
        /** @var \Drupal\Core\Image\Image $image */
        $image = \Drupal::service('image.factory')->get($file->getFileUri());

        $hero_build = [
          '#theme' => 'responsive_image',
          '#width' => NULL,
          '#height' => NULL,
          '#responsive_image_style_id' => 'hero',
          '#uri' => $file->getFileUri(),
          '#attributes' => ['alt' => 'hello'],
        ];

        // Check if image is valid and can be used.
        if ($image->isValid()) {
          $hero_build['#width'] = $image->getWidth();
          $hero_build['#height'] = $image->getHeight();
        }

        $build['image'] = $hero_build;
      }

      return $build;
  }

}
