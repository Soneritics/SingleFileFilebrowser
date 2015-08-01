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
            $moduleFunction = 'moduleBrowsing';
        }

        $this->$moduleFunction();
    }

    private function moduleBrowsing()
    {
        $currentPath = isset($_GET['currentPath']) ?
            $_GET['currentPath'] :
            __DIR__;

        $browsing = new Browsing;
        $browsing
            ->setCurrentPath($currentPath)
            ->show();
    }

    private function moduleShellCommand()
    {
        $command = $_POST['command'];

        $shellCommand = new ShellCommand;
        $shellCommand
            ->setCommand($command)
            ->show();
    }

    private function modulePHPEvaluation()
    {
        $code = $_POST['code'];

        $phpEvaluation = new PHPEvaluation;
        $phpEvaluation
            ->setCode($code)
            ->show();
    }
}

// Create the script object so that the application starts automatically.
new Browser;
