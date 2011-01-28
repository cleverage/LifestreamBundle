<?php
namespace Application\LifestreamBundle;

/**
 * LastFmAPI
 *
 * @package Application\LifestreamBundle
 * @author Romain "palleas" Pouclet <me@palleas.com>
 */
class LastFmAPI {
    
    /**
     * API Key
     *
     * @var string
     */
    protected $key;
    
    /**
     * API Secret
     *
     * @var string
     */
    protected $secret;
    
    /**
     * LastFM account username
     *
     * @var string
     */
    protected $username;
    
    /**
     * LastFM account password
     *
     * @var string
     */
    protected $password;
    
    public function __construct($key, $secret, $username, $password) {
        $this->key = $key;
        $this->secret = $secret;
        $this->username = $username;
        $this->password = $password;
    }
}
