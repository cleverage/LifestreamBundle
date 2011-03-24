<?php

namespace CleverAge\Bundle\LifestreamBundle\ApiClient;

abstract class BaseService
{
  /**
   * Return 
   *
   * @return array
   */
  abstract public function get();


  /**
   * Use goute 
   * @return string
   */
  private function fetch($url)
  {
    // todo
  }

  /**
   * Returns profile's url (ex: http://lastfm.com/user/palleas)
   *
   * @return String
   */
  abstract public function getProfileURL();
}