<?php
namespace Netflex\Context;

class Manager {
  private static $baseContext = NULL;


  private static function ensureContext() {
    if(!self::$baseContext)
      self::$baseContext = self::fromCurrentContext();
  }


  public static function inContext(Context $context, \Closure $scopedExecution) {
    self::ensureContext();
    self::setContext($context);
    $scopedExecution();
    self::setContext(self::$baseContext);
  }

  public static function setContext(Context $context) {
    \NF::$client = $context->client;
    \NF::$cache = $context->cache;
    \NF::$site = $context->site;
  }

  public static function fromCurrentContext() {
    return Context::fromObject(\NF::class);
  }
}
?>