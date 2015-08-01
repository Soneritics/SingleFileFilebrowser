<?php
/**
 * Browser class.
 *
 * @author Jordi Jolink
 * @date 1-8-2015
 */
class Browser
{
    /**
     * @var View
     */
    private $view;

    /**
     * The constructor of this example class starts the single file application.
     */
    public function __construct()
    {
        $this->view = new View;

        $page = !empty($_GET['page']) ? $_GET['page'] : '1';
        $this->view->set('page', $page);

        $this->view->render('index');
    }
}

// Create the script object so that the application starts automatically.
new Browser;
