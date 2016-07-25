<?php
/**
 * Mysql Class
 *
 * @author James Byrne <jamesbwebdev@gmail.com>
 */

namespace Jay\System;

use Jay\Interfaces;
use PDO;

class PDOAdapter implements Interfaces\Adapter
{
    public $PDO;

    public function __construct(PDO $PDO) 
    {
        $this->PDO = $PDO;
    }

    public function __destruct()
    {
        $this->PDO = null;
    }
}
