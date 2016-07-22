<?php
/**
 * Mysql Class
 *
 * @author James Byrne <jamesbwebdev@gmail.com>
 */

namespace Jbyrne\System;

use Jbyrne\Interfaces;
use Symfony\Component\Yaml\Yaml;
use PDO;

class PDOAdapter implements Interfaces\Database
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
