<?php

namespace Cleverage\LifestreamBundle\Service;

interface ServiceInterface 
{
  /**
   * Returns a list of recents items from related service
   *
   * @return array
   */
  public function getRecents();
  
  /**
   * Returns profile's url (ex: http://lastfm.com/user/palleas)
   *
   * @return String
   */
  public function getProfileURL();
}