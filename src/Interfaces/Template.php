<?php
/**
 * Template Interface
 *
 * @author James Byrne <jamesbwebdev@gmail.com>
 */

namespace Jbyrne\Interfaces;

interface Template
{
    public function render($template, $data = [], $layout = 'default');
}