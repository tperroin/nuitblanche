<?php

/* IHQSNuitBlancheBundle:News:_teasers.html.twig */
class __TwigTemplate_bc3e883b66e19653c810db77786789ce extends Twig_Template
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
        echo "<div class=\"news-teaser\">
    <h3>";
        // line 2
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans($this->getContext($context, "title")), "html", null, true);
        echo "</h3>
    ";
        // line 3
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getContext($context, "news"));
        foreach ($context['_seq'] as $context["_key"] => $context["new"]) {
            // line 4
            echo "    <div class=\"news\" style=\"clear:both;\">
        <span class=\"meta\">";
            // line 5
            echo $this->getAttribute($this->getContext($context, "new"), "formattedDate");
            echo "</span>
        <img src=\"";
            // line 6
            if ($this->getAttribute($this->getContext($context, "new"), "team")) {
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "new"), "team"), "icon"), "html", null, true);
            } else {
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getContext($context, "new"), "teamGame"), "icon"), "html", null, true);
            }
            echo "\" class=\"flag\" />
        <img src=\"";
            // line 7
            echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl((("bundles/ihqsnuitblanche/images/flags/" . $this->getAttribute($this->getContext($context, "new"), "lang")) . ".gif")), "html", null, true);
            echo "\" alt=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "new"), "lang"), "html", null, true);
            echo "\" class=\"flag\" />

        <a href=\"";
            // line 9
            echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("news_show", array("news_id" => $this->getAttribute($this->getContext($context, "new"), "id"))), "html", null, true);
            echo "\"><strong>";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "new"), "title"), "html", null, true);
            echo "</strong></a>
        <p class=\"meta\" style=\"float:right;\">
            <strong>";
            // line 11
            echo twig_escape_filter($this->env, twig_length_filter($this->env, $this->getAttribute($this->getContext($context, "new"), "comments")), "html", null, true);
            echo "</strong> com(s)
        </p>
    </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['new'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 15
        echo "</div>";
    }

    public function getTemplateName()
    {
        return "IHQSNuitBlancheBundle:News:_teasers.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  59 => 11,  52 => 9,  26 => 3,  66 => 24,  62 => 23,  54 => 18,  24 => 3,  19 => 1,  259 => 76,  256 => 75,  251 => 15,  246 => 6,  239 => 127,  237 => 126,  214 => 108,  209 => 106,  197 => 97,  188 => 91,  175 => 81,  169 => 77,  167 => 75,  157 => 68,  151 => 65,  147 => 64,  140 => 62,  132 => 59,  124 => 56,  116 => 53,  108 => 50,  100 => 47,  94 => 43,  92 => 42,  85 => 38,  81 => 37,  75 => 34,  45 => 7,  38 => 9,  34 => 8,  29 => 6,  22 => 2,  79 => 20,  72 => 14,  69 => 15,  60 => 19,  58 => 18,  53 => 15,  51 => 13,  48 => 12,  42 => 9,  39 => 8,  37 => 6,  33 => 5,  123 => 55,  120 => 54,  117 => 53,  114 => 52,  107 => 47,  105 => 46,  101 => 44,  99 => 43,  95 => 41,  93 => 40,  89 => 38,  87 => 37,  76 => 19,  63 => 21,  57 => 17,  55 => 16,  49 => 14,  47 => 14,  43 => 13,  41 => 8,  35 => 6,  30 => 4,);
    }
}
