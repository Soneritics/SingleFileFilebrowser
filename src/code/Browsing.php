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

    /**
     * @var string
     */
    private $currentPath;

    public function __construct()
    {
        $this->view = new View;
    }

    public function show()
    {
        $error = $this->error();
        if (!empty($error)) {
            $this->view->set('error', $error);
        } else {
            $this->view->set('files', $this->getDirectoryContents());
        }

        $this->view->set('path', $this->currentPath . '/');
        $this->view->render('browsing');
    }

    public function setCurrentPath($path)
    {
        if (substr($path, -1) === DIRECTORY_SEPARATOR) {
            $path = substr($path, 0, -1);
        }

        $this->currentPath = $path;
        $this->view->set('title', 'Browsing: ' . $path);
        return $this;
    }

    private function error()
    {
        if (!is_dir($this->currentPath)) {
            return 'Path does not exist';
        }

        return false;
    }

    private function getDirectoryContents()
    {
        return new DirectoryIterator($this->currentPath);
    }
}
