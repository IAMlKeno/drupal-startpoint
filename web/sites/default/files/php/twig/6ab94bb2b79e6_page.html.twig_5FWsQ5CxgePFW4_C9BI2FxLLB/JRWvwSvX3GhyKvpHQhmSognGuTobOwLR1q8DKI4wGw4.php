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

/* themes/custom/policynexus_theme/templates/page.html.twig */
class __TwigTemplate_d0663a232d74d7e6a2b06a71eb8c3b11 extends Template
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
        // line 12
        yield "
<header class=\"header\" role=\"banner\">
  <div class=\"container\">
    <div class=\"header__inner\">
      <div class=\"header__logo\">
        ";
        // line 17
        yield (string) $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["site_name"] ?? null), "html", null, true);
        yield "
      </div>
      <nav class=\"header__nav\" role=\"navigation\" aria-label=\"Main\">
        ";
        // line 20
        yield (string) $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "primary_menu", [], "any", false, false, true, 20), "html", null, true);
        yield "
      </nav>
      <button class=\"header__menu-toggle\" aria-label=\"Toggle menu\" aria-expanded=\"false\">
        ☰
      </button>
    </div>
  </div>
</header>

";
        // line 30
        $context["has_page_hero"] = ((($tmp = Twig\Extension\CoreExtension::trim(Twig\Extension\CoreExtension::striptags($this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "content", [], "any", false, false, true, 30))))) && $tmp instanceof Markup ? (string) $tmp : $tmp) && CoreExtension::inFilter("page__hero", $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "content", [], "any", false, false, true, 30))));
        // line 31
        yield "
";
        // line 32
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "hero", [], "any", false, false, true, 32)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 33
            yield "  <div class=\"hero\">
    ";
            // line 34
            yield (string) $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "hero", [], "any", false, false, true, 34), "html", null, true);
            yield "
  </div>
";
        }
        // line 37
        yield "
<main class=\"main-content\" role=\"main\">
  ";
        // line 39
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "content", [], "any", false, false, true, 39)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 40
            yield "    ";
            if ((($tmp = ($context["has_page_hero"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 41
                yield "      ";
                // line 42
                yield "      ";
                yield (string) $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "content", [], "any", false, false, true, 42), "html", null, true);
                yield "
    ";
            } else {
                // line 44
                yield "      ";
                // line 45
                yield "      <div class=\"container\">
        ";
                // line 46
                yield (string) $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "content", [], "any", false, false, true, 46), "html", null, true);
                yield "
      </div>
    ";
            }
            // line 49
            yield "  ";
        }
        // line 50
        yield "</main>

<footer class=\"footer\" role=\"contentinfo\">
  <div class=\"container\">
    <div class=\"footer__inner\">
      ";
        // line 55
        if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "footer", [], "any", false, false, true, 55)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 56
            yield "        <div class=\"footer__menu\">
          ";
            // line 57
            yield (string) $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["page"] ?? null), "footer", [], "any", false, false, true, 57), "html", null, true);
            yield "
        </div>
      ";
        }
        // line 60
        yield "      <div class=\"footer__bottom\">
        <p>&copy; ";
        // line 61
        yield (string) $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Twig\Extension\CoreExtension']->formatDate("now", "Y"), "html", null, true);
        yield " ";
        yield (string) $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["site_name"] ?? null), "html", null, true);
        yield ". All rights reserved.</p>
        <div class=\"footer__social\">
          <!-- Social links can be added here -->
        </div>
      </div>
      <div class=\"footer__copyright\">
        ";
        // line 67
        yield (string) $this->extensions['Drupal\Core\Template\TwigExtension']->renderVar(t("Built with Drupal 11"));
        yield "
      </div>
    </div>
  </div>
</footer>
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["site_name", "page"]);        return; yield;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "themes/custom/policynexus_theme/templates/page.html.twig";
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
        return array (  149 => 67,  138 => 61,  135 => 60,  129 => 57,  126 => 56,  124 => 55,  117 => 50,  114 => 49,  108 => 46,  105 => 45,  103 => 44,  97 => 42,  95 => 41,  92 => 40,  90 => 39,  86 => 37,  80 => 34,  77 => 33,  75 => 32,  72 => 31,  70 => 30,  58 => 20,  52 => 17,  45 => 12,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "themes/custom/policynexus_theme/templates/page.html.twig", "/var/www/html/web/themes/custom/policynexus_theme/templates/page.html.twig");
    }
    
    public function ensureSecurityChecked(): void
    {
        if ($this->sandbox->isSandboxed($this->source)) {
            $this->checkSecurity();
        }
    }
    
    public function checkSecurity()
    {
        static $tags = ["set" => 30, "if" => 32];
        static $filters = ["escape" => 17, "trim" => 30, "striptags" => 30, "render" => 30, "date" => 61, "t" => 67];
        static $functions = [];
        static $tests = [];

        try {
            $this->sandbox->checkSecurity(
                [0 => "set", 1 => "if"],
                [0 => "escape", 1 => "trim", 2 => "striptags", 3 => "render", 4 => "date", 5 => "t"],
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
