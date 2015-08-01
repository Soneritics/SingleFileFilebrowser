<?php
/**
 * Shell Command module
 *
 * @author Jordi Jolink
 * @date 1-8-2015
 */
class ShellCommand extends Module
{
    private $command;

    public function setCommand($command)
    {
        $this->command = $command;
        return $this;
    }

    public function show()
    {
        echo htmlspecialchars(shell_exec($this->command));
    }
}
