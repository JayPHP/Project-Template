<?php
/**
 * Application Controller
 *
 * @author James Byrne <jamesbwebdev@gmail.com>
 */

namespace Jbyrne\Controllers;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Jbyrne\Interfaces\Template;

class Application
{
    protected $request;
    protected $response;
    protected $template;

    public function __construct(
    	Request $request, 
    	Response $response,
    	Template $template
    ) {
        $this->request = $request;
        $this->response = $response;
        $this->template = $template;
    }

    public function index()
    {
        $html = $this->template->render('homepage');
    }
}
