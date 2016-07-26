<?php
/**
 * Template Interface
 *
 * @author James Byrne <jamesbwebdev@gmail.com>
 */

namespace Jay\System;

interface Template
{
    public function render($template, $data = [], $layout = 'default');
}