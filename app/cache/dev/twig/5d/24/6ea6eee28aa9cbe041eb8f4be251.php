<?php

/* IHQSNuitBlancheBundle::layout_home.html.twig */
class __TwigTemplate_5d246ea6eee28aa9cbe041eb8f4be251 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("IHQSNuitBlancheBundle::layout_base.html.twig");

        $this->blocks = array(
            'main' => array($this, 'block_main'),
            'content' => array($this, 'block_content'),
            'right' => array($this, 'block_right'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "IHQSNuitBlancheBundle::layout_base.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 4
    public function block_main($context, array $blocks = array())
    {
        // line 5
        echo "
    <div id=\"main\">
        ";
        // line 7
        if ($this->getAttribute($this->getAttribute($this->getContext($context, "app"), "session"), "flash", array(0 => "notice"), "method")) {
            // line 8
            echo "            <div class=\"flash-message\">
                <em>Notice</em>: ";
            // line 9
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "app"), "session"), "flash", array(0 => "notice"), "method"), "html", null, true);
            echo "
            </div>
        ";
        }
        // line 12
        echo "
        ";
        // line 13
        $this->displayBlock('content', $context, $blocks);
        // line 15
        echo "    </div>

    <div id=\"right\">
        ";
        // line 18
        $this->env->loadTemplate("IHQSNuitBlancheBundle:Secured:_action.html.twig")->display($context);
        // line 19
        echo "        ";
        $this->displayBlock('right', $context, $blocks);
        // line 21
        echo "    </div>

";
    }

    // line 13
    public function block_content($context, array $blocks = array())
    {
        // line 14
        echo "        ";
    }

    // line 19
    public function block_right($context, array $blocks = array())
    {
        // line 20
        echo "        ";
    }

    public function getTemplateName()
    {
        return "IHQSNuitBlancheBundle::layout_home.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  79 => 20,  72 => 14,  69 => 13,  60 => 19,  58 => 18,  53 => 15,  51 => 13,  48 => 12,  42 => 9,  39 => 8,  37 => 7,  33 => 5,  123 => 55,  120 => 54,  117 => 53,  114 => 52,  107 => 47,  105 => 46,  101 => 44,  99 => 43,  95 => 41,  93 => 40,  89 => 38,  87 => 37,  76 => 19,  63 => 21,  57 => 17,  55 => 16,  49 => 12,  47 => 11,  43 => 9,  41 => 8,  35 => 6,  30 => 4,);
    }
}
