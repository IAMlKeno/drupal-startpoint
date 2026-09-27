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

/* themes/custom/policynexus_theme/templates/node--team-member.html.twig */
class __TwigTemplate_bd9caae830e44a1407435cb60f1dd1bd extends Template
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
<article";
        // line 15
        yield (string) $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["attributes"] ?? null), "addClass", ["node", "node--team-member", "team-member"], "method", false, false, true, 15), "html", null, true);
        yield ">
  ";
        // line 16
        if ((($tmp = ($context["page"] ?? null)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
            // line 17
            yield "    <!-- Full page view -->
    <div class=\"team-member__hero\">
      ";
            // line 19
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_featured_image", [], "any", false, false, true, 19)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 20
                yield "        <div class=\"team-member__image\">
          ";
                // line 21
                yield (string) $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_featured_image", [], "any", false, false, true, 21), "html", null, true);
                yield "
        </div>
      ";
            } else {
                // line 24
                yield "        <div class=\"team-member__image-placeholder\">
          <div class=\"team-member__initials\">";
                // line 25
                yield (string) $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, Twig\Extension\CoreExtension::first($this->env->getCharset(), ($context["label"] ?? null)), "html", null, true);
                yield "</div>
        </div>
      ";
            }
            // line 28
            yield "    </div>

    <div class=\"container\">
      <div class=\"team-member__wrapper\">
        <!-- Main Profile -->
        <main class=\"team-member__main\">
          <header class=\"team-member__header\">
            <h1";
            // line 35
            yield (string) $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["title_attributes"] ?? null), "addClass", ["team-member__name"], "method", false, false, true, 35), "html", null, true);
            yield ">";
            yield (string) $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["label"] ?? null), "html", null, true);
            yield "</h1>
            ";
            // line 36
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_job_title", [], "any", false, false, true, 36)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 37
                yield "              <p class=\"team-member__title\">";
                yield (string) $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_job_title", [], "any", false, false, true, 37), "html", null, true);
                yield "</p>
            ";
            } else {
                // line 39
                yield "              <p class=\"team-member__title\">Team Member</p>
            ";
            }
            // line 41
            yield "          </header>

          <!-- Bio -->
          <div class=\"team-member__bio\">
            ";
            // line 45
            yield (string) $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "body", [], "any", false, false, true, 45), "html", null, true);
            yield "
          </div>

          <!-- Research Areas -->
          ";
            // line 49
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_research_area", [], "any", false, false, true, 49)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 50
                yield "            <section class=\"team-member__research\">
              <h2>Research Expertise</h2>
              <div class=\"team-member__areas\">
                ";
                // line 53
                yield (string) $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_research_area", [], "any", false, false, true, 53), "html", null, true);
                yield "
              </div>
            </section>
          ";
            }
            // line 57
            yield "
          <!-- Contact -->
          ";
            // line 59
            if (((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_email", [], "any", false, false, true, 59)) && $tmp instanceof Markup ? (string) $tmp : $tmp) || (($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_phone", [], "any", false, false, true, 59)) && $tmp instanceof Markup ? (string) $tmp : $tmp))) {
                // line 60
                yield "            <section class=\"team-member__contact\">
              <h2>Get in Touch</h2>
              <div class=\"team-member__contact-info\">
                ";
                // line 63
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_email", [], "any", false, false, true, 63)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 64
                    yield "                  <p>
                    <strong>Email:</strong>
                    ";
                    // line 66
                    yield (string) $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_email", [], "any", false, false, true, 66), "html", null, true);
                    yield "
                  </p>
                ";
                }
                // line 69
                yield "                ";
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_phone", [], "any", false, false, true, 69)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 70
                    yield "                  <p>
                    <strong>Phone:</strong>
                    ";
                    // line 72
                    yield (string) $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_phone", [], "any", false, false, true, 72), "html", null, true);
                    yield "
                  </p>
                ";
                }
                // line 75
                yield "              </div>
            </section>
          ";
            }
            // line 78
            yield "
          <!-- Auto-render all remaining fields -->
          ";
            // line 80
            yield (string) $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, $this->extensions['Drupal\Core\Template\TwigExtension']->withoutFilter(($context["content"] ?? null), "title", "body", "featured_image", "field_job_title", "field_research_area", "field_email", "field_phone", "field_social_links"), "html", null, true);
            yield "
        </main>

        <!-- Sidebar -->
        <aside class=\"team-member__sidebar\">
          <!-- Profile Card -->
          <div class=\"card card--featured\">
            ";
            // line 87
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_featured_image", [], "any", false, false, true, 87)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 88
                yield "              <div class=\"card__image team-member__card-image\">
                ";
                // line 89
                yield (string) $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_featured_image", [], "any", false, false, true, 89), "html", null, true);
                yield "
              </div>
            ";
            }
            // line 92
            yield "            <h3 class=\"card__title\">";
            yield (string) $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["label"] ?? null), "html", null, true);
            yield "</h3>
            <p class=\"card__subtitle\">";
            // line 93
            yield (string) $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_job_title", [], "any", false, false, true, 93), "html", null, true);
            yield "</p>

            ";
            // line 95
            if (((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_email", [], "any", false, false, true, 95)) && $tmp instanceof Markup ? (string) $tmp : $tmp) || (($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_phone", [], "any", false, false, true, 95)) && $tmp instanceof Markup ? (string) $tmp : $tmp))) {
                // line 96
                yield "              <div class=\"team-member__card-contact\">
                ";
                // line 97
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_email", [], "any", false, false, true, 97)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 98
                    yield "                  <a href=\"mailto:";
                    yield (string) $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_email", [], "any", false, false, true, 98), "html", null, true);
                    yield "\" class=\"button button--small button--primary\">Email</a>
                ";
                }
                // line 100
                yield "                ";
                if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_phone", [], "any", false, false, true, 100)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                    // line 101
                    yield "                  <a href=\"tel:";
                    yield (string) $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_phone", [], "any", false, false, true, 101), "html", null, true);
                    yield "\" class=\"button button--small button--secondary\">Call</a>
                ";
                }
                // line 103
                yield "              </div>
            ";
            }
            // line 105
            yield "          </div>

          <!-- Social Links (if available) -->
          <div class=\"card\">
            <h3 class=\"card__title\">Connect</h3>
            <div class=\"team-member__social\">
              <a href=\"#\" class=\"team-member__social-link\">LinkedIn</a>
              <a href=\"#\" class=\"team-member__social-link\">Twitter</a>
            </div>
          </div>
        </aside>
      </div>

      <!-- Other Team Members -->
      <section class=\"team-member__related\">
        <h2>Meet the Team</h2>
        <div class=\"grid grid--4col\">
          <!-- Related team members would render here -->
        </div>
      </section>
    </div>
  ";
        } else {
            // line 127
            yield "    <!-- Teaser/Card view -->
    <div class=\"card team-member__card\">
      ";
            // line 129
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_featured_image", [], "any", false, false, true, 129)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 130
                yield "        <div class=\"card__image team-member__card-image\">
          ";
                // line 131
                yield (string) $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_featured_image", [], "any", false, false, true, 131), "html", null, true);
                yield "
        </div>
      ";
            } else {
                // line 134
                yield "        <div class=\"team-member__card-placeholder\">
          <div class=\"team-member__initials\">";
                // line 135
                yield (string) $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, Twig\Extension\CoreExtension::first($this->env->getCharset(), ($context["label"] ?? null)), "html", null, true);
                yield "</div>
        </div>
      ";
            }
            // line 138
            yield "      <h3";
            yield (string) $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["title_attributes"] ?? null), "addClass", ["card__title"], "method", false, false, true, 138), "html", null, true);
            yield ">
        <a href=\"";
            // line 139
            yield (string) $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["url"] ?? null), "html", null, true);
            yield "\" rel=\"bookmark\">";
            yield (string) $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["label"] ?? null), "html", null, true);
            yield "</a>
      </h3>
      ";
            // line 141
            if ((($tmp = CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_job_title", [], "any", false, false, true, 141)) && $tmp instanceof Markup ? (string) $tmp : $tmp)) {
                // line 142
                yield "        <p class=\"card__subtitle\">";
                yield (string) $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, CoreExtension::getAttribute($this->env, $this->source, ($context["content"] ?? null), "field_job_title", [], "any", false, false, true, 142), "html", null, true);
                yield "</p>
      ";
            }
            // line 144
            yield "      <a href=\"";
            yield (string) $this->extensions['Drupal\Core\Template\TwigExtension']->escapeFilter($this->env, ($context["url"] ?? null), "html", null, true);
            yield "\" class=\"button button--small button--secondary\">View Profile</a>
    </div>
  ";
        }
        // line 147
        yield "</article>
";
        $this->env->getExtension('\Drupal\Core\Template\TwigExtension')
            ->checkDeprecations($context, ["attributes", "page", "content", "label", "title_attributes", "url"]);        return; yield;
    }

    /**
     * @codeCoverageIgnore
     */
    public function getTemplateName(): string
    {
        return "themes/custom/policynexus_theme/templates/node--team-member.html.twig";
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
        return array (  309 => 147,  302 => 144,  296 => 142,  294 => 141,  287 => 139,  282 => 138,  276 => 135,  273 => 134,  267 => 131,  264 => 130,  262 => 129,  258 => 127,  234 => 105,  230 => 103,  224 => 101,  221 => 100,  215 => 98,  213 => 97,  210 => 96,  208 => 95,  203 => 93,  198 => 92,  192 => 89,  189 => 88,  187 => 87,  177 => 80,  173 => 78,  168 => 75,  162 => 72,  158 => 70,  155 => 69,  149 => 66,  145 => 64,  143 => 63,  138 => 60,  136 => 59,  132 => 57,  125 => 53,  120 => 50,  118 => 49,  111 => 45,  105 => 41,  101 => 39,  95 => 37,  93 => 36,  87 => 35,  78 => 28,  72 => 25,  69 => 24,  63 => 21,  60 => 20,  58 => 19,  54 => 17,  52 => 16,  48 => 15,  45 => 14,);
    }

    public function getSourceContext(): Source
    {
        return new Source("", "themes/custom/policynexus_theme/templates/node--team-member.html.twig", "/var/www/html/web/themes/custom/policynexus_theme/templates/node--team-member.html.twig");
    }
    
    public function ensureSecurityChecked(): void
    {
        if ($this->sandbox->isSandboxed($this->source)) {
            $this->checkSecurity();
        }
    }
    
    public function checkSecurity()
    {
        static $tags = ["if" => 16];
        static $filters = ["escape" => 15, "first" => 25, "without" => 80];
        static $functions = [];
        static $tests = [];

        try {
            $this->sandbox->checkSecurity(
                [0 => "if"],
                [0 => "escape", 1 => "first", 2 => "without"],
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
