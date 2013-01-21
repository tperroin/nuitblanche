<?php

/* IHQSNuitBlancheBundle:Secured:_login.html.twig */
class __TwigTemplate_2c4fb333e5b66ca9d80c07dfd7a092f0 extends Twig_Template
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
        echo "<div class=\"block-login\">
    ";
        // line 2
        if ($this->getContext($context, "error")) {
            // line 3
            echo "        <div class=\"error\">";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, "error"), "message"), "html", null, true);
            echo "</div>
    ";
        }
        // line 5
        echo "
    <form action=\"";
        // line 6
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getPath("_security_check"), "html", null, true);
        echo "\" method=\"post\" id=\"login\">
        <input type=\"hidden\" id=\"remember_me\" name=\"_remember_me\" value=\"on\" />

        <fieldset id=\"log\" >
             <legend>Login</legend>

             <p class=\"para_standard\" id=\"para_login\" >
                <label>";
        // line 13
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Login"), "html", null, true);
        echo " </label>
                <input type=\"text\" id=\"username\" name=\"_username\" value=\"";
        // line 14
        echo twig_escape_filter($this->env, ((array_key_exists("last_username", $context)) ? (_twig_default_filter($this->getContext($context, "last_username"), "login")) : ("login")), "html", null, true);
        echo "\" />
            </p>

            <p class=\"para_standard\" id=\"para_password\" >
                <label>";
        // line 18
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Password"), "html", null, true);
        echo " </label>
                <input type=\"password\" id=\"password\" name=\"_password\" value=\"password\" />
            </p>

            <p class=\"para_standard\" id=\"para_submit\" >
                <label>";
        // line 23
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Connect"), "html", null, true);
        echo "</label>
                <input type=\"submit\" value=\"";
        // line 24
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Connect"), "html", null, true);
        echo "\" class=\"submit\"  />
            </p>
        </fieldset>
    </form>
</div>";
    }

    public function getTemplateName()
    {
        return "IHQSNuitBlancheBundle:Secured:_login.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  66 => 24,  62 => 23,  54 => 18,  24 => 3,  19 => 1,  259 => 76,  256 => 75,  251 => 15,  246 => 6,  239 => 127,  237 => 126,  214 => 108,  209 => 106,  197 => 97,  188 => 91,  175 => 81,  169 => 77,  167 => 75,  157 => 68,  151 => 65,  147 => 64,  140 => 62,  132 => 59,  124 => 56,  116 => 53,  108 => 50,  100 => 47,  94 => 43,  92 => 42,  85 => 38,  81 => 37,  75 => 34,  45 => 13,  38 => 9,  34 => 8,  29 => 6,  22 => 2,  79 => 20,  72 => 14,  69 => 13,  60 => 19,  58 => 18,  53 => 15,  51 => 13,  48 => 12,  42 => 9,  39 => 8,  37 => 7,  33 => 6,  123 => 55,  120 => 54,  117 => 53,  114 => 52,  107 => 47,  105 => 46,  101 => 44,  99 => 43,  95 => 41,  93 => 40,  89 => 38,  87 => 37,  76 => 19,  63 => 21,  57 => 17,  55 => 16,  49 => 14,  47 => 14,  43 => 13,  41 => 8,  35 => 6,  30 => 5,);
    }
}
