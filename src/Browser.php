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
     * Constructor. Finds out what module to use and sets the settings.
     */
    public function __construct()
    {
        $module = !empty($_GET['module']) ? $_GET['module'] : 'Browsing';
        $moduleFunction = 'module' . ucfirst($module);

        if (!method_exists($this, $moduleFunction)) {
            $moduleFunction = 'Browsing';
        }

        $this->$moduleFunction();
    }

    private function moduleBrowsing()
    {
        $browsing = new Browsing;
        $browsing
            ->show();
    }
}

// Create the script object so that the application starts automatically.
new Browser;
