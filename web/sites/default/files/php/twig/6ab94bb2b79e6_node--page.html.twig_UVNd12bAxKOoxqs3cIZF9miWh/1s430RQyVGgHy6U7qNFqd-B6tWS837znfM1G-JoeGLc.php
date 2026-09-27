<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\CoreExtension;
use Twig\Extension\SandboxExtension;
use Twig\MacroNamespace;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Sandbox\SecurityNotAllowedTestError;
use Twig\Source;
use Twig\Template;
use Twig\TemplateWrapper;

/* themes/custom/policynexus_theme/templates/node--page.html.twig */
class __TwigTemplate_7d2d8e4c9d7a3dae6a14d0dc78b92a7f extends Template
{
    private Source $source;
    /**
     * @var array<string, MacroNamespace>
     */
    private array $macros = [];

    public function __construct(Environment $env)
    {
        $this->sandbox = $env->getExtension(SandboxExtension::class)->getChecker();
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = []): iterable
    {
        $macros = $this->macros;
        // line 14
        yield "
";
        // line 15
        if ((($tmp = ($context["page"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 16
            yield "  <!-- Full page view with hero -->
  <header class=\"page__hero\">
    <div class=\"container\">
      <div class=\"page__hero-content\">
        <!-- Eyebrow label -->
        ";
            // line 21
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["node"] ?? null), "field_eyebrow", [], "any", false, false, true, 21), "value", [], "any", false, false, true, 21)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 22
                yield "          <div class=\"page__eyebrow\">";
                yield (string) $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["node"] ?? null), "field_eyebrow", [], "any", false, false, true, 22), "value", [], "any", false, false, true, 22), "html", null, true);
                yield "</div>
        ";
            }
            // line 24
            yield "
        <!-- Main heading -->
        ";
            // line 26
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["node"] ?? null), "field_header_text", [], "any", false, false, true, 26), "value", [], "any", false, false, true, 26)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 27
                yield "          <h1 class=\"page__hero-title\">";
                yield (string) $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, CoreExtension::getAttribute($this->env, $this->source, ($context["node"] ?? null), "field_header_text", [], "any", false, false, true, 27), "value", [], "any", false, false, true, 27), "html", null, true);
                yield "</h1>
        ";
            } else {
                // line 29
                yield "          <h1 class=\"page__hero-title\">";
                yield (string) $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["label"] ?? null), "html", null, true);
                yield "</h1>
        ";
            }
            // line 31
            yield "
        <!-- Description -->
        ";
            // line 33
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "body", [], "any", false, false, true, 33)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 34
                yield "          <div class=\"page__hero-description\">
            ";
                // line 35
                yield (string) $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "body", [], "any", false, false, true, 35), "html", null, true);
                yield "
          </div>
        ";
            }
            // line 38
            yield "
        <!-- CTA Buttons -->
        <div class=\"page__hero-actions\">
          ";
            // line 41
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["node"] ?? null), "cta", [], "any", false, false, true, 41)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 42
                yield "            ";
                $context['_parent'] = $context;
                $context['_seq'] = CoreExtension::ensureTraversable(CoreExtension::getAttribute($this->env, $this->source, ($context["node"] ?? null), "cta", [], "any", false, false, true, 42));
                foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                    // line 43
                    yield "              <a href=\"";
                    yield (string) $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["item"], "uri", [], "any", false, false, true, 43), "html", null, true);
                    yield "\" class=\"button button--primary\">
                ";
                    // line 44
                    yield (string) $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, $context["item"], "title", [], "any", false, false, true, 44), "html", null, true);
                    yield "
              </a>
            ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_key'], $context['item'], $context['_parent']);
                $context = array_intersect_key($context, $_parent);
                $context += $_parent;
                // line 47
                yield "          ";
            }
            // line 48
            yield "        </div>
      </div>

      <!-- Featured Image -->
      ";
            // line 52
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_featured_image", [], "any", false, false, true, 52)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 53
                yield "        <div class=\"page__hero-image\">
          ";
                // line 54
                yield (string) $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_featured_image", [], "any", false, false, true, 54), "html", null, true);
                yield "
        </div>
      ";
            }
            // line 57
            yield "    </div>
  </header>

  <!-- Additional content -->
  <article";
            // line 61
            yield (string) $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", ["node", "node--page", "page"], "method", false, false, true, 61), "html", null, true);
            yield ">
    <div class=\"container\">
      <div class=\"page__content\">
        ";
            // line 64
            yield (string) $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->withoutFilter(($context["content"] ?? null), "title", "body", "field_header_text", "field_eyebrow", "field_featured_image", "cta"), "html", null, true);
            yield "
      </div>
    </div>
  </article>
";
        } else {
            // line 69
            yield "<article";
            yield (string) $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", ["node", "node--page", "page"], "method", false, false, true, 69), "html", null, true);
            yield ">
    <!-- Teaser/Card view -->
    <header class=\"page__header\">
      <h2";
            // line 72
            yield (string) $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["title_attributes"] ?? null), "addClass", ["page__title"], "method", false, false, true, 72), "html", null, true);
            yield ">
        <a href=\"";
            // line 73
            yield (string) $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["url"] ?? null), "html", null, true);
            yield "\" rel=\"bookmark\">";
            yield (string) $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["label"] ?? null), "html", null, true);
            yield "</a>
      </h2>
    </header>
    <div class=\"page__teaser\">
      ";
            // line 77
            yield (string) $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "body", [], "any", false, false, true, 77), "html", null, true);
            yield "
    </div>
  </article>
";
        }
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["page", "node", "label", "content", "attributes", "title_attributes", "url"]);        return; yield;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "themes/custom/policynexus_theme/templates/node--page.html.twig";
    }

    /**
     * @codeCoverageIgnore
     */
    public function isTraitable(): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDefaultEscapeStrategy(): string|false
    {
        return "html";
    }

    /**
     * @codeCoverageIgnore
     */
    public function getDebugInfo(): array
    {
        return array (  185 => 77,  176 => 73,  172 => 72,  165 => 69,  157 => 64,  151 => 61,  145 => 57,  139 => 54,  136 => 53,  134 => 52,  128 => 48,  125 => 47,  115 => 44,  110 => 43,  105 => 42,  103 => 41,  98 => 38,  92 => 35,  89 => 34,  87 => 33,  83 => 31,  77 => 29,  71 => 27,  69 => 26,  65 => 24,  59 => 22,  57 => 21,  50 => 16,  48 => 15,  45 => 14,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "themes/custom/policynexus_theme/templates/node--page.html.twig", "/var/www/html/web/themes/custom/policynexus_theme/templates/node--page.html.twig");
    }
    
    public function ensureSecurityChecked(): void
    {
        if ($this->sandbox->isSandboxed($this->source)) {
            $this->checkSecurity();
        }
    }
    
    public function checkSecurity()
    {
        static $tags = ["if" => 15, "for" => 42];
        static $filters = ["escape" => 22, "without" => 64];
        static $functions = [];
        static $tests = [];

        try {
            $this->sandbox->checkSecurity(
                [0 => "if", 1 => "for"],
                [0 => "escape", 1 => "without"],
                [],
                [],
                $this->source
            );
        } catch (SecurityError $e) {
            if ($e instanceof SecurityNotAllowedTagError && isset($tags[$e->getTagName()])) {
                $e->setTemplateLine($tags[$e->getTagName()]);
            } elseif ($e instanceof SecurityNotAllowedFilterError && isset($filters[$e->getFilterName()])) {
                $e->setTemplateLine($filters[$e->getFilterName()]);
            } elseif ($e instanceof SecurityNotAllowedFunctionError && isset($functions[$e->getFunctionName()])) {
                $e->setTemplateLine($functions[$e->getFunctionName()]);
            } elseif ($e instanceof SecurityNotAllowedTestError && isset($tests[$e->getTestName()])) {
                $e->setTemplateLine($tests[$e->getTestName()]);
            }

            throw $e;
        }

    }
}
