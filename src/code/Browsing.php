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

    private $currentPath;

    public function __construct()
    {
        $this->view = new View;
    }

    public function show()
    {
        $this->view->render('browsing');
    }

    public function setCurrentPath($path)
    {
        $this->currentPath = $path;
        $this->view->set('title', 'Browsing: ' . $path);
        return $this;
    }
}
