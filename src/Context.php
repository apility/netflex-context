<?php
namespace Netflex\Context;

use GuzzleHttp\Client;
use Netflex\Site\Cache;
use Netflex\Site\Site;

class Context {

  /**
   * Guzzle Client
   */
  private $client;

  /**
   * Cache instance
   */
  private $cache;

  /**
   * Site variable
   */
  private $site;

  /**
   * Site name
   */
  private $sitename;

  private function __construct(array $data) {
    $this->client = $data['client'] ?? null;
    $this->cache = $data['cache'] ?? null;
    $this->site = $data['site'] ?? null;
    $this->sitename = $data['sitename'] ?? null;
  }

  public static function fromObject($obj) {
    return new Context([
      'client' => $obj::$client,
      'cache' => $obj::$cache,
      'site' => $obj::$site
    ]);
  }

  public static function fromApiKeys($apiPublic, $apiSecret, $siteName = NULL) {
    if($siteName === NULL) {
      $siteName = md5($apiPublic);
    }

    return new Context([
      'client' => new Client([
        'base_uri' => 'https://api.netflexapp.com/v1/',
        'auth' => [$apiPublic, $apiSecret]
      ]),
      'cache' => new Cache($siteName, 'files'),
      'site' => new Site(),
      'sitename' => $siteName
    ]);
  }
}