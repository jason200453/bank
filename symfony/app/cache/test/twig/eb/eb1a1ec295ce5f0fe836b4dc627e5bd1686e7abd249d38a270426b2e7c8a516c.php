<?php

/* @Twig/Exception/exception_full.html.twig */
class __TwigTemplate_2f2f04494ae1d786e4dfb1fb096dff02b8f4adc7a81867b1109b7379a1e2e830 extends Twig_Template
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
        $__internal_a26dc5bcd744283af5cf8a279b5935febef446a19212abe6faf92c5d84529590 = $this->env->getExtension("native_profiler");
        $__internal_a26dc5bcd744283af5cf8a279b5935febef446a19212abe6faf92c5d84529590->enter($__internal_a26dc5bcd744283af5cf8a279b5935febef446a19212abe6faf92c5d84529590_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@Twig/Exception/exception_full.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_a26dc5bcd744283af5cf8a279b5935febef446a19212abe6faf92c5d84529590->leave($__internal_a26dc5bcd744283af5cf8a279b5935febef446a19212abe6faf92c5d84529590_prof);

    }

    // line 3
    public function block_head($context, array $blocks = array())
    {
        $__internal_e61f0816b56f0fe0b3e45afcd1c6508cc3f707fb29940a013269f8108011ffff = $this->env->getExtension("native_profiler");
        $__internal_e61f0816b56f0fe0b3e45afcd1c6508cc3f707fb29940a013269f8108011ffff->enter($__internal_e61f0816b56f0fe0b3e45afcd1c6508cc3f707fb29940a013269f8108011ffff_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "head"));

        // line 4
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('request')->generateAbsoluteUrl($this->env->getExtension('asset')->getAssetUrl("bundles/framework/css/exception.css")), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />
";
        
        $__internal_e61f0816b56f0fe0b3e45afcd1c6508cc3f707fb29940a013269f8108011ffff->leave($__internal_e61f0816b56f0fe0b3e45afcd1c6508cc3f707fb29940a013269f8108011ffff_prof);

    }

    // line 7
    public function block_title($context, array $blocks = array())
    {
        $__internal_1f9f00814752493dc44658065b73ca9a1abaa54c0ecf905c6d32d8b33ce1daaa = $this->env->getExtension("native_profiler");
        $__internal_1f9f00814752493dc44658065b73ca9a1abaa54c0ecf905c6d32d8b33ce1daaa->enter($__internal_1f9f00814752493dc44658065b73ca9a1abaa54c0ecf905c6d32d8b33ce1daaa_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        // line 8
        echo "    ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["exception"]) ? $context["exception"] : $this->getContext($context, "exception")), "message", array()), "html", null, true);
        echo " (";
        echo twig_escape_filter($this->env, (isset($context["status_code"]) ? $context["status_code"] : $this->getContext($context, "status_code")), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, (isset($context["status_text"]) ? $context["status_text"] : $this->getContext($context, "status_text")), "html", null, true);
        echo ")
";
        
        $__internal_1f9f00814752493dc44658065b73ca9a1abaa54c0ecf905c6d32d8b33ce1daaa->leave($__internal_1f9f00814752493dc44658065b73ca9a1abaa54c0ecf905c6d32d8b33ce1daaa_prof);

    }

    // line 11
    public function block_body($context, array $blocks = array())
    {
        $__internal_06f845d1f88b99bbab8233c3c99358f635967d2934717525e9c7c3c31fdc516b = $this->env->getExtension("native_profiler");
        $__internal_06f845d1f88b99bbab8233c3c99358f635967d2934717525e9c7c3c31fdc516b->enter($__internal_06f845d1f88b99bbab8233c3c99358f635967d2934717525e9c7c3c31fdc516b_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 12
        echo "    ";
        $this->loadTemplate("@Twig/Exception/exception.html.twig", "@Twig/Exception/exception_full.html.twig", 12)->display($context);
        
        $__internal_06f845d1f88b99bbab8233c3c99358f635967d2934717525e9c7c3c31fdc516b->leave($__internal_06f845d1f88b99bbab8233c3c99358f635967d2934717525e9c7c3c31fdc516b_prof);

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
