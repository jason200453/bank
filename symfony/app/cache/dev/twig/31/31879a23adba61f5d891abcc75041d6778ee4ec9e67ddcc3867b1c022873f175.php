<?php

/* @Twig/Exception/exception_full.html.twig */
class __TwigTemplate_7920e1eb3034c227d7f0b76ff6dd1837c84a9f89b3feda553f13b16b27bc3638 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 1
        $this->parent = $this->loadTemplate("@Twig/layout.html.twig", "@Twig/Exception/exception_full.html.twig", 1);
        $this->blocks = array(
            'head' => array($this, 'block_head'),
            'title' => array($this, 'block_title'),
            'body' => array($this, 'block_body'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "@Twig/layout.html.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $__internal_e1e7f28603ed523fb4198d61d1315f14bb831f876c4fde285b42dfc3b97679ef = $this->env->getExtension("native_profiler");
        $__internal_e1e7f28603ed523fb4198d61d1315f14bb831f876c4fde285b42dfc3b97679ef->enter($__internal_e1e7f28603ed523fb4198d61d1315f14bb831f876c4fde285b42dfc3b97679ef_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@Twig/Exception/exception_full.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_e1e7f28603ed523fb4198d61d1315f14bb831f876c4fde285b42dfc3b97679ef->leave($__internal_e1e7f28603ed523fb4198d61d1315f14bb831f876c4fde285b42dfc3b97679ef_prof);

    }

    // line 3
    public function block_head($context, array $blocks = array())
    {
        $__internal_b86db90ef5b8aeefa805451f54db205a927190aa6475cdd358f10e67bea042d7 = $this->env->getExtension("native_profiler");
        $__internal_b86db90ef5b8aeefa805451f54db205a927190aa6475cdd358f10e67bea042d7->enter($__internal_b86db90ef5b8aeefa805451f54db205a927190aa6475cdd358f10e67bea042d7_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "head"));

        // line 4
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('request')->generateAbsoluteUrl($this->env->getExtension('asset')->getAssetUrl("bundles/framework/css/exception.css")), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />
";
        
        $__internal_b86db90ef5b8aeefa805451f54db205a927190aa6475cdd358f10e67bea042d7->leave($__internal_b86db90ef5b8aeefa805451f54db205a927190aa6475cdd358f10e67bea042d7_prof);

    }

    // line 7
    public function block_title($context, array $blocks = array())
    {
        $__internal_903f4cbb3112e9a100eafb512584fa549a3dc4973fabb243c8033a52e134e5f0 = $this->env->getExtension("native_profiler");
        $__internal_903f4cbb3112e9a100eafb512584fa549a3dc4973fabb243c8033a52e134e5f0->enter($__internal_903f4cbb3112e9a100eafb512584fa549a3dc4973fabb243c8033a52e134e5f0_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        // line 8
        echo "    ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["exception"]) ? $context["exception"] : $this->getContext($context, "exception")), "message", array()), "html", null, true);
        echo " (";
        echo twig_escape_filter($this->env, (isset($context["status_code"]) ? $context["status_code"] : $this->getContext($context, "status_code")), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, (isset($context["status_text"]) ? $context["status_text"] : $this->getContext($context, "status_text")), "html", null, true);
        echo ")
";
        
        $__internal_903f4cbb3112e9a100eafb512584fa549a3dc4973fabb243c8033a52e134e5f0->leave($__internal_903f4cbb3112e9a100eafb512584fa549a3dc4973fabb243c8033a52e134e5f0_prof);

    }

    // line 11
    public function block_body($context, array $blocks = array())
    {
        $__internal_33a6781741ab2484ddcce5b79facaec81ee3564774b102c8017c2d314975ee59 = $this->env->getExtension("native_profiler");
        $__internal_33a6781741ab2484ddcce5b79facaec81ee3564774b102c8017c2d314975ee59->enter($__internal_33a6781741ab2484ddcce5b79facaec81ee3564774b102c8017c2d314975ee59_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 12
        echo "    ";
        $this->loadTemplate("@Twig/Exception/exception.html.twig", "@Twig/Exception/exception_full.html.twig", 12)->display($context);
        
        $__internal_33a6781741ab2484ddcce5b79facaec81ee3564774b102c8017c2d314975ee59->leave($__internal_33a6781741ab2484ddcce5b79facaec81ee3564774b102c8017c2d314975ee59_prof);

    }

    public function getTemplateName()
    {
        return "@Twig/Exception/exception_full.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  78 => 12,  72 => 11,  58 => 8,  52 => 7,  42 => 4,  36 => 3,  11 => 1,);
    }
}
/* {% extends '@Twig/layout.html.twig' %}*/
/* */
/* {% block head %}*/
/*     <link href="{{ absolute_url(asset('bundles/framework/css/exception.css')) }}" rel="stylesheet" type="text/css" media="all" />*/
/* {% endblock %}*/
/* */
/* {% block title %}*/
/*     {{ exception.message }} ({{ status_code }} {{ status_text }})*/
/* {% endblock %}*/
/* */
/* {% block body %}*/
/*     {% include '@Twig/Exception/exception.html.twig' %}*/
/* {% endblock %}*/
/* */
