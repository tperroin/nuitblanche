<?php

/* IHQSNuitBlancheBundle:Player:_connected.html.twig */
class __TwigTemplate_ee7a9eafa8e73907c93f56c797caac91 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<div class=\"widget last-wars online-users\">
    <h3>";
        // line 2
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Online users"), "html", null, true);
        echo "</h3>
    <ul>
        ";
        // line 4
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getContext($context, "players"));
        foreach ($context['_seq'] as $context["_key"] => $context["user"]) {
            // line 5
            echo "        <li>
            <a href=\"";
            // line 6
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("player_show", array("user_id" => $this->getAttribute($this->getContext($context, "user"), "id"))), "html", null, true);
            echo "\">
                <span class=\"team\">
                    <img src=\"";
            // line 8
            echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl((("bundles/ihqsnuitblanche/images/ico/player_status_" . $this->getAttribute($this->getContext($context, "user"), "status")) . ".gif")), "html", null, true);
            echo "\" alt=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "user"), "status"), "html", null, true);
            echo "\" />
                    ";
            // line 9
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "user"), "username"), "html", null, true);
            echo "
                </span>
            </a>
        </li>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['user'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 14
        echo "    </ul>
    <div class=\"bottom-link\">
        <a href=\"";
        // line 16
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("player_list"), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("User list"), "html", null, true);
        echo "</a>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "IHQSNuitBlancheBundle:Player:_connected.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  56 => 14,  61 => 14,  31 => 5,  27 => 4,  59 => 11,  52 => 11,  26 => 3,  66 => 24,  62 => 23,  54 => 18,  24 => 3,  19 => 1,  259 => 76,  256 => 75,  251 => 15,  246 => 6,  239 => 127,  237 => 126,  214 => 108,  209 => 106,  197 => 97,  188 => 91,  175 => 81,  169 => 77,  167 => 75,  157 => 68,  151 => 65,  147 => 64,  140 => 62,  132 => 59,  124 => 56,  116 => 53,  108 => 50,  100 => 47,  94 => 43,  92 => 42,  85 => 38,  81 => 37,  75 => 34,  45 => 9,  38 => 9,  34 => 6,  29 => 6,  22 => 2,  79 => 20,  72 => 14,  69 => 15,  60 => 16,  58 => 18,  53 => 15,  51 => 13,  48 => 12,  42 => 9,  39 => 8,  37 => 6,  33 => 5,  123 => 55,  120 => 54,  117 => 53,  114 => 52,  107 => 47,  105 => 46,  101 => 44,  99 => 43,  95 => 41,  93 => 40,  89 => 38,  87 => 37,  76 => 19,  63 => 21,  57 => 17,  55 => 16,  49 => 14,  47 => 9,  43 => 13,  41 => 8,  35 => 6,  30 => 4,);
    }
}
