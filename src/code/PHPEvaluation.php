<?php
/**
 * PHP code evaluation module
 *
 * @author Jordi Jolink
 * @date 1-8-2015
 */
class PHPEvaluation extends Module
{
    private $code;

    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    public function show()
    {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        ob_start();
        eval($this->code);
        echo htmlspecialchars(ob_get_clean());
    }
}
