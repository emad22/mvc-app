<?php

namespace PHPMVC\Controllers;

class AccessDeniedController extends AbstractController
{
    public function defaultAction()
    {
        $this->lang->load('template.common');
        $this->_renderView();
    }
}
