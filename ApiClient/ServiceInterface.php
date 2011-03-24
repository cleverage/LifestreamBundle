<?php

namespace CleverAge\Bundle\LifestreamBundle\ApiClient;

interface ServiceInterface
{
  /**
   * Return 
   *
   * @return array
   */
  public function get();


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
  public function getProfileURL();
}