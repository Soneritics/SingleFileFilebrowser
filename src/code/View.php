<?php
/**
 * View class. Takes care of rendering the correct template and passing the
 * registered view variables to the template.
 *
 * @author Jordi Jolink
 * @date 31-7-2015
 */
class View
{
    /**
     * @var array
     */
    private $variables = array();

    /**
     * Assign a parameter for use in the view.
     * @param string $variable Name of the parameter.
     * @param mixed $value Value of the parameter.
     * @return $this
     */
    public function set($variable, $value)
    {
        $this->variables[$variable] = $value;
        return $this;
    }

    /**
     * Render the view based on a template.
     * @param string $view Template name.
     * @param bool $layout Show the layout or only the template
     */
    public function render($view, $layout = true)
    {
        $template = new Template;
        $templateFile = $template->getTemplateFilename($view);

        if (!empty($this->variables)) {
            foreach ($this->variables as $key => $value) {
                $$key = $value;
            }
        }

        ob_start();
        include $templateFile;
        $content = ob_get_clean();

        if ($layout === true) {
            include $template->getTemplateFilename('layout');
        } else {
            echo $content;
        }
    }

    /**
     * Return an HTML safe string.
     * @param string $html
     * @return string
     */
    private function encode($html)
    {
        return htmlspecialchars($html);
    }
}