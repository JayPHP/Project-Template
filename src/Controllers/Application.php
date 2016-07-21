<?php
/**
 * Application Controller
 *
 * @author James Byrne <jamesbwebdev@gmail.com>
 */

namespace Jbyrne\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Jbyrne\Interfaces\Template;
use Jbyrne\Interfaces\Database;

class Application
{
    protected $request;
    protected $template;
    protected $db;

    public function __construct(
        Database $database,
    	Request $request,
    	Template $template
    ) {
        $this->db = $database->PDO;
        $this->request = $request;
        $this->template = $template;
    }

    public function index()
    {
        $html = $this->template->render('homepage');
    }
}
