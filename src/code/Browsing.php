<?php
/**
 * Browsing module
 *
 * @author Jordi Jolink
 * @date 1-8-2015
 */
class Browsing extends Module
{
    /**
     * @var View
     */
    private $view;

    public function __construct()
    {
        $this->view = new View;
    }

    public function show()
    {
        $this->view->render('browsing');
    }
}
