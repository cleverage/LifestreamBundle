<?php

namespace Application\LifestreamBundle;

interface ServiceInterface {
  
  public function getRecents();
  
  public function getProfileURL();
}