<?php
/**
 * Mysql Class
 *
 * @author James Byrne <jamesbwebdev@gmail.com>
 */

namespace Jay\System\Database;

use Jay\System\Adapter;
use PDO;

class PDOAdapter implements Adapter
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
