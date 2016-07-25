<?php
/**
 * Application Controller
 *
 * @author James Byrne <jamesbwebdev@gmail.com>
 */

namespace Jay\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Jay\Interfaces\Template;
use Jay\Interfaces\Database;

class Application
{
    protected $request;
    protected $template;

    public function __construct(
    	Request $request,
    	Template $template
    ) {
        $this->request = $request;
        $this->template = $template;
    }

    public function index()
    {
        $html = $this->template->render('homepage');
    }
}
