<?php
namespace Cleverage\LifestreamBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Tests\TestCase;
use Cleverage\LifestreamBundle\Service\LastFmAPI;

require __DIR__.'/../../../autoload.php';

/**
 * 
 */
class LastFmTest extends TestCase
{
    const SAMPLE_KEY = 'ohaidizizmykey';
    
    const SAMPLE_SECRET = 'ohaidizizmysecret';
    
    public function testProfileUrlWithSampleUsername() 
    {
        $handler = new LastFmAPI(self::SAMPLE_KEY, self::SAMPLE_SECRET, 'palleas', null);
        $this->assertEquals('http://www.lastfm.fr/user/palleas', $handler->getProfileUrl());
    }
}