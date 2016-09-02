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
        $__internal_be3acde4550ae9c9d40e7ab6758981eb3209031dc7ba66fad642334be229e98f = $this->env->getExtension("native_profiler");
        $__internal_be3acde4550ae9c9d40e7ab6758981eb3209031dc7ba66fad642334be229e98f->enter($__internal_be3acde4550ae9c9d40e7ab6758981eb3209031dc7ba66fad642334be229e98f_prof = new Twig_Profiler_Profile($this->getTemplateName(), "template", "@Twig/Exception/exception_full.html.twig"));

        $this->parent->display($context, array_merge($this->blocks, $blocks));
        
        $__internal_be3acde4550ae9c9d40e7ab6758981eb3209031dc7ba66fad642334be229e98f->leave($__internal_be3acde4550ae9c9d40e7ab6758981eb3209031dc7ba66fad642334be229e98f_prof);

    }

    // line 3
    public function block_head($context, array $blocks = array())
    {
        $__internal_89175644ee72a52a361a41354049b82ae4959137677132ad4081255f515eac5b = $this->env->getExtension("native_profiler");
        $__internal_89175644ee72a52a361a41354049b82ae4959137677132ad4081255f515eac5b->enter($__internal_89175644ee72a52a361a41354049b82ae4959137677132ad4081255f515eac5b_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "head"));

        // line 4
        echo "    <link href=\"";
        echo twig_escape_filter($this->env, $this->env->getExtension('request')->generateAbsoluteUrl($this->env->getExtension('asset')->getAssetUrl("bundles/framework/css/exception.css")), "html", null, true);
        echo "\" rel=\"stylesheet\" type=\"text/css\" media=\"all\" />
";
        
        $__internal_89175644ee72a52a361a41354049b82ae4959137677132ad4081255f515eac5b->leave($__internal_89175644ee72a52a361a41354049b82ae4959137677132ad4081255f515eac5b_prof);

    }

    // line 7
    public function block_title($context, array $blocks = array())
    {
        $__internal_72aaa45509346746b29f551bc08bb589516a867a46a4c2ba22260320c7151bf5 = $this->env->getExtension("native_profiler");
        $__internal_72aaa45509346746b29f551bc08bb589516a867a46a4c2ba22260320c7151bf5->enter($__internal_72aaa45509346746b29f551bc08bb589516a867a46a4c2ba22260320c7151bf5_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "title"));

        // line 8
        echo "    ";
        echo twig_escape_filter($this->env, $this->getAttribute((isset($context["exception"]) ? $context["exception"] : $this->getContext($context, "exception")), "message", array()), "html", null, true);
        echo " (";
        echo twig_escape_filter($this->env, (isset($context["status_code"]) ? $context["status_code"] : $this->getContext($context, "status_code")), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, (isset($context["status_text"]) ? $context["status_text"] : $this->getContext($context, "status_text")), "html", null, true);
        echo ")
";
        
        $__internal_72aaa45509346746b29f551bc08bb589516a867a46a4c2ba22260320c7151bf5->leave($__internal_72aaa45509346746b29f551bc08bb589516a867a46a4c2ba22260320c7151bf5_prof);

    }

    // line 11
    public function block_body($context, array $blocks = array())
    {
        $__internal_cdc746a1332908548a0ed2c803bfead5641bd8bd6c604b20bb4ac3b97ae035d7 = $this->env->getExtension("native_profiler");
        $__internal_cdc746a1332908548a0ed2c803bfead5641bd8bd6c604b20bb4ac3b97ae035d7->enter($__internal_cdc746a1332908548a0ed2c803bfead5641bd8bd6c604b20bb4ac3b97ae035d7_prof = new Twig_Profiler_Profile($this->getTemplateName(), "block", "body"));

        // line 12
        echo "    ";
        $this->loadTemplate("@Twig/Exception/exception.html.twig", "@Twig/Exception/exception_full.html.twig", 12)->display($context);
        
        $__internal_cdc746a1332908548a0ed2c803bfead5641bd8bd6c604b20bb4ac3b97ae035d7->leave($__internal_cdc746a1332908548a0ed2c803bfead5641bd8bd6c604b20bb4ac3b97ae035d7_prof);

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
