<?php namespace Ishannz\LaravelEvernote\Facades;
 
use Illuminate\Support\Facades\Facade;

/**
 * @see \Ishannz\LaravelEvernote
 */
class Evernote extends Facade {
 
  /**
   * Get the registered name of the component.
   *
   * @return string
   */
  protected static function getFacadeAccessor() { return 'evernote'; }
 
}
