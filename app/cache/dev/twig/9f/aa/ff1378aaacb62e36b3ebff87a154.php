<?php

/* IHQSNuitBlancheBundle:Main:index.html.twig */
class __TwigTemplate_9faaff1378aaacb62e36b3ebff87a154 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("IHQSNuitBlancheBundle::layout_home.html.twig");

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'content' => array($this, 'block_content'),
            'right' => array($this, 'block_right'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "IHQSNuitBlancheBundle::layout_home.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_title($context, array $blocks = array())
    {
    }

    // line 6
    public function block_content($context, array $blocks = array())
    {
        echo "   
    <div class=\"block block-3\">
        ";
        // line 8
        $this->env->loadTemplate("IHQSNuitBlancheBundle:News:_teasers.html.twig")->display(array_merge($context, array("news" => $this->getContext($context, "news"), "title" => "Nuit Blanche News")));
        // line 9
        echo "    </div>
    <div class=\"block block-3 block-last\">
        ";
        // line 11
        $this->env->loadTemplate("IHQSNuitBlancheBundle:News:_teasers.html.twig")->display(array_merge($context, array("news" => $this->getContext($context, "newsCommunity"), "title" => "Community News")));
        // line 12
        echo "    </div>
    <div class=\"spacer\"></div>

    <div class=\"block block-4\">
        ";
        // line 16
        echo $this->env->getExtension('actions')->renderAction("IHQSNuitBlancheBundle:War:_next", array(), array());
        // line 17
        echo "    </div>
    <div class=\"block block-1 block-last\">
        
        <div class=\"promote promote-tournaments\">
            <a href=\"#\">";
        // line 21
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Tournaments"), "html", null, true);
        echo "</a>
        </div>
    </div>
    <div class=\"spacer\"></div>

    <div class=\"block block-4\">
        <a href=\"http://www.intkeys.com\" target=\"_blank\"><img src=\"http://www.clan-nuitblanche.org/intkeys-banner-520x100.jpg\" /></a>
    </div>
    <div class=\"block block-1 block-last\">
        <div class=\"promote promote-replays\">
            <a href=\"";
        // line 31
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("replay_list"), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Replays"), "html", null, true);
        echo "</a>
        </div>
    </div>
    <div class=\"spacer\"></div>

    <div class=\"block block-2\">
        ";
        // line 37
        echo $this->env->getExtension('actions')->renderAction("IHQSNuitBlancheBundle:Player:_connected", array(), array());
        // line 38
        echo "    </div>
    <div class=\"block block-2-mid\">
        ";
        // line 40
        echo $this->env->getExtension('actions')->renderAction("IHQSNuitBlancheBundle:Ts3:_channels", array(), array());
        // line 41
        echo "    </div>
    <div class=\"block block-2\">
        ";
        // line 43
        echo $this->env->getExtension('actions')->renderAction("IHQSForumBundle:Topic:_latest", array(), array());
        // line 44
        echo "    </div>
    <div class=\"block block-2-mid block-last\">
        ";
        // line 46
        echo $this->env->getExtension('actions')->renderAction("IHQSNuitBlancheBundle:Replay:_latest", array(), array());
        // line 47
        echo "    </div>
    <div class=\"spacer\"></div>

";
    }

    // line 52
    public function block_right($context, array $blocks = array())
    {
        // line 53
        echo "    ";
        echo $this->env->getExtension('actions')->renderAction("IHQSNuitBlancheBundle:Team:_sections", array(), array());
        // line 54
        echo "    ";
        echo $this->env->getExtension('actions')->renderAction("IHQSNuitBlancheBundle:War:_latest", array(), array());
        // line 55
        echo "    ";
        $this->env->loadTemplate("IHQSNuitBlancheBundle:Main:_partners.html.twig")->display($context);
    }

    public function getTemplateName()
    {
        return "IHQSNuitBlancheBundle:Main:index.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  123 => 55,  120 => 54,  117 => 53,  114 => 52,  107 => 47,  105 => 46,  101 => 44,  99 => 43,  95 => 41,  93 => 40,  89 => 38,  87 => 37,  76 => 31,  63 => 21,  57 => 17,  55 => 16,  49 => 12,  47 => 11,  43 => 9,  41 => 8,  35 => 6,  30 => 3,);
    }
}
