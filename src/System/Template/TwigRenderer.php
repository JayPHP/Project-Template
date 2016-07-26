<?php
/**
 * TwigRenderer
 *
 * @author James Byrne <jamesbwebdev@gmail.com>
 */

namespace Jay\System\Template;

use Jay\System\Template;
use Twig_Environment;
use Symfony\Component\HttpFoundation\Response;

class TwigRenderer implements Template
{
    private $template;

    public function __construct(Twig_Environment $template, Response $response)
    {
        $this->template = $template;
        $this->response = $response;
    }

    public function render($template, $data = [], $layout = 'default')
    {
    	if (isset($data['app_layout_name'])) {
    		exit;
    	}

    	$data['app_layout_name'] = "$layout.html";

    	$this->response->setContent(
    		$this->template->render("$template.html", $data)
    	);
    }
}