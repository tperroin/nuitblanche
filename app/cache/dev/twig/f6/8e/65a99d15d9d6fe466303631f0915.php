<?php

/* IHQSNuitBlancheBundle::layout_base.html.twig */
class __TwigTemplate_f68e65a99d15d9d6fe466303631f0915 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'stylesheets' => array($this, 'block_stylesheets'),
            'main' => array($this, 'block_main'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
        <meta name=\"keywords\" content=\"nuit blanche, starcraft 2, multigaming, female gaming\" />
        <title>Nuit Blanche, Fair Gamers since 1996 | ";
        // line 6
        $this->displayBlock('title', $context, $blocks);
        echo "</title>

        <link rel=\"shortcut icon\" href=\"";
        // line 8
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("favicon.ico"), "html", null, true);
        echo "\" />
        <link rel=\"stylesheet\" href=\"";
        // line 9
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/ihqsnuitblanche/css/styles.css"), "html", null, true);
        echo "\" type=\"text/css\" media=\"all\" />
        <link href='http://fonts.googleapis.com/css?family=Give+You+Glory&v2' rel='stylesheet' type='text/css'>

        <script type=\"text/javascript\" src=\"http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 13
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/ihqswysiwyg/js/wysiwyg.js"), "html", null, true);
        echo "\"></script>
        <script type=\"text/javascript\" src=\"";
        // line 14
        echo twig_escape_filter($this->env, $this->env->getExtension('assets')->getAssetUrl("bundles/ihqsnuitblanche/js/nb.js"), "html", null, true);
        echo "\"></script>
        ";
        // line 15
        $this->displayBlock('stylesheets', $context, $blocks);
        // line 16
        echo "        <script type=\"text/javascript\">

          var _gaq = _gaq || [];
          _gaq.push(['_setAccount', 'UA-23673822-1']);
          _gaq.push(['_trackPageview']);

          (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
          })();

        </script>
    </head>
    <body>
  \t<div id=\"page\">
            <a name=\"top\"></a>
            <div id=\"header\">
                <h1><span>Nuit Blanche - ";
        // line 34
        $this->displayBlock("title", $context, $blocks);
        echo "</span></h1>
                <span class=\"baseline\">fair gamers since 1996.</span>
                <ul class=\"lang\">
                    <li><a href=\"";
        // line 37
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("lang", array("lang" => "fr_FR")), "html", null, true);
        echo "\" class=\"fr\"><span>fr</span></a></li>
                    <li><a href=\"";
        // line 38
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("lang", array("lang" => "en_US")), "html", null, true);
        echo "\" class=\"en\"><span>en</span></a></li>
                </ul>

               
                    ";
        // line 42
        echo $this->env->getExtension('actions')->renderAction("IHQSNuitBlancheBundle:Secured:_login", array(), array());
        // line 43
        echo "                

                <ul class=\"menu\">
                    <li class=\"first\">
                        <a href=\"";
        // line 47
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("homepage"), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Home"), "html", null, true);
        echo "</a>
                    </li>
                    <li>
                        <a href=\"";
        // line 50
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("news_archives"), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("News"), "html", null, true);
        echo "</a>
                    </li>
                    <li>
                        <a href=\"";
        // line 53
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("team_list"), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Team"), "html", null, true);
        echo "</a>
                    </li>
                    <li>
                        <a href=\"";
        // line 56
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("war_list"), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Matchs"), "html", null, true);
        echo "</a>
                    </li>
                    <li>
                        <a href=\"";
        // line 59
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("league_list"), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Leagues"), "html", null, true);
        echo "</a>
                    </li>
                    <li>
                        <a href=\"";
        // line 62
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("replay_list"), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Replays"), "html", null, true);
        echo "</a>
                    </li>
                    <li class=\"stream-";
        // line 64
        echo $this->env->getExtension('actions')->renderAction("IHQSNuitBlancheBundle:Stream:_status", array(), array());
        echo "\">
                        <a href=\"";
        // line 65
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("stream_live"), "html", null, true);
        echo "\" class=\"disabled\">Web TV</a>
                    </li>
                    <li class=\"last\">
                        <a href=\"#\">";
        // line 68
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Forum"), "html", null, true);
        echo "</a>
                    </li>
                </ul>

                <div style=\"clear: both\"></div>
            </div>

            ";
        // line 75
        $this->displayBlock('main', $context, $blocks);
        // line 77
        echo "
            <div id=\"footer\">
                <ul>
                    <li class=\"footer-item-category\">
                        <p>";
        // line 81
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Credits"), "html", null, true);
        echo "</p>
                        <ul>
                            <li>developped by <a href=\"http://www.ihqs.net\" target=\"_blank\">ihqs</a></li>
                            <li>see source code at <a href=\"http://github.com/AlepH-FR/nuitblanche\" target=\"_blank\">github</a></li>
                            <li>powered by Symfony 2</li>
                            <li>using  <a href=\"http://github.com/AlepH-FR/SC2Chart\" target=\"_blank\">SC2Chart</a> & SC2Replay</li>
                            <li>using  <a href=\"http://github.com/AlepH-FR/SC2Ranks\" target=\"_blank\">SC2Ranks</a></li>
                        </ul>
                    </li>
                    <li class=\"footer-item-category\">
                        <p>";
        // line 91
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Partners"), "html", null, true);
        echo "</p>
                        <ul>
                            <li>(<a target=\"_blank\" href=\"http://www.ihqs.net\">go</a>) ihqs</li>
                        </ul>
                    </li>
                    <li class=\"footer-item-category\">
                        <p>";
        // line 97
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Useful links"), "html", null, true);
        echo "</p>
                        <ul>
                            <li>(<a target=\"_blank\" href=\"http://www.pandaria-wars.com\">go</a>) pandaria</li>
                            <li>(<a target=\"_blank\" href=\"http://www.sc2cl.com\">go</a>) sc2cl</li>
                            <li>(<a target=\"_blank\" href=\"http://www.esl.eu\">go</a>) esl</li>
                            <li>(<a target=\"_blank\" href=\"http://www.sc2ranks.com\">go</a>) sc2ranks</li>
                        </ul>
                    </li>
                    <li class=\"footer-item-category\">
                        <p>";
        // line 106
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("Misc."), "html", null, true);
        echo "</p>
                        <ul>
                            <li><a href=\"";
        // line 108
        echo twig_escape_filter($this->env, $this->env->getExtension('routing')->getUrl("to_come"), "html", null, true);
        echo "\">";
        echo twig_escape_filter($this->env, $this->env->getExtension('translator')->trans("to come"), "html", null, true);
        echo "</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

        <script type=\"text/javascript\">
            \$(document).ready(function() {
                CKEDITOR.plugins.addExternal( 'nuitblanche', '/bundles/ihqsnuitblanche/js/ckeditor/plugins/nuitblanche/' );
            });
            ihqs.wysiwyg.setSettings({
                extraPlugins : 'nuitblanche',
                toolbar : [
                    ['Format', 'Bold', 'Italic', 'Strike', 'RemoveFormat', '-', 'Flash', 'Image', 'Link', '-', 'AddPlayer', 'AddClanWar', 'AddRaceImage', '-', 'Clean', 'Preview']
                ]
            });
        </script>
        ";
        // line 126
        echo $this->env->getExtension('actions')->renderAction("IHQSWysiwygBundle:Script:init", array(), array());
        // line 127
        echo "\t<script type=\"text/javascript\" src=\"http://static.wowhead.com/widgets/power.js\"></script>
    </body>
</html>
";
    }

    // line 6
    public function block_title($context, array $blocks = array())
    {
    }

    // line 15
    public function block_stylesheets($context, array $blocks = array())
    {
    }

    // line 75
    public function block_main($context, array $blocks = array())
    {
        // line 76
        echo "            ";
    }

    public function getTemplateName()
    {
        return "IHQSNuitBlancheBundle::layout_base.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  259 => 76,  256 => 75,  251 => 15,  246 => 6,  239 => 127,  237 => 126,  214 => 108,  209 => 106,  197 => 97,  188 => 91,  175 => 81,  169 => 77,  167 => 75,  157 => 68,  151 => 65,  147 => 64,  140 => 62,  132 => 59,  124 => 56,  116 => 53,  108 => 50,  100 => 47,  94 => 43,  92 => 42,  85 => 38,  81 => 37,  75 => 34,  45 => 13,  38 => 9,  34 => 8,  29 => 6,  22 => 1,  79 => 20,  72 => 14,  69 => 13,  60 => 19,  58 => 18,  53 => 15,  51 => 13,  48 => 12,  42 => 9,  39 => 8,  37 => 7,  33 => 5,  123 => 55,  120 => 54,  117 => 53,  114 => 52,  107 => 47,  105 => 46,  101 => 44,  99 => 43,  95 => 41,  93 => 40,  89 => 38,  87 => 37,  76 => 19,  63 => 21,  57 => 17,  55 => 16,  49 => 14,  47 => 11,  43 => 9,  41 => 8,  35 => 6,  30 => 4,);
    }
}
