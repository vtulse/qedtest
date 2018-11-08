<?php

namespace Drupal\qedrest\Services\Http;

use Drupal\Core\Controller\ControllerBase;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Drupal\Component\Serialization\Json;

/**
 * Get a response code from any URL using Guzzle in Drupal 8.
 */
class QedRestServices extends ControllerBase {

  /**
   * {@inheritdoc}
   */
  public function request($endpoint, $method = 'GET', $body = FALSE) {
    try {

      $client = new Client(
        [
          'base_uri'  => "http://www.omdbapi.com/?",
        ]
      );
      $res = $client->request(
        $method, $endpoint, [
          'headers' => [
            'Content-Type' => 'application/json; charset=utf-8',
          ],
          'body' => $body,
        ]
      );
      $data = Json::decode((String) $res->getBody());
      if (empty($data)) {
        return "error";
      }
      return $data;
    }
    catch (RequestException $e) {
      return FALSE;
    }
  }

}
