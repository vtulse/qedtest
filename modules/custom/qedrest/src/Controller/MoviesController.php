<?php

namespace Drupal\qedrest\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\qedrest\Services\Http\QedRestServices;

/**
 * Get a response code from any URL using Guzzle in Drupal 8.
 */
class MoviesController extends ControllerBase {

  /**
   * Drupal\qedrest\Services\Http\QedRestServices.
   *
   * @var Drupal\qedrest\Services\Http\QedRestServices
   */
   protected $restapiservice;

  /**
   * {@inheritdoc}
   */
    public function __construct(QedRestServices $restapi) {
        $this->restapiservice = $restapi;
    }

  }

  /**
   * {@inheritdoc}
   */
    public static function create(ContainerInterface $container) {
        return new static(
            $container->get('qedrest')
        );
    }

  /**
   * {@inheritdoc}
   */
  public function getData() {
    try {

      $title = filter_input(INPUT_GET, 'title');
      return $this->restapiservice->request("t=" . $title);
    }
    catch (Exception $e) {
      return FALSE;
    }
  }

}
