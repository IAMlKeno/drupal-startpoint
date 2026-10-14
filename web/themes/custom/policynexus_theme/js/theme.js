/**
 * PolicyLink Nexus Theme JavaScript
 * Mobile menu toggle and basic interactions
 */

(function () {
  'use strict';

  document.addEventListener('DOMContentLoaded', function () {
    // Mobile Menu Toggle
    const menuToggle = document.querySelector('.header__menu-toggle');
    const nav = document.querySelector('.header__nav');

    if (menuToggle && nav) {
      menuToggle.addEventListener('click', function () {
        nav.classList.toggle('is-open');
        const expanded = nav.classList.contains('is-open');
        menuToggle.setAttribute('aria-expanded', expanded);
      });

      // Close menu on link click
      const navLinks = nav.querySelectorAll('a');
      navLinks.forEach(link => {
        link.addEventListener('click', function () {
          nav.classList.remove('is-open');
          menuToggle.setAttribute('aria-expanded', 'false');
        });
      });

      // Close menu on Escape key
      document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && nav.classList.contains('is-open')) {
          nav.classList.remove('is-open');
          menuToggle.setAttribute('aria-expanded', 'false');
        }
      });
    }
  });
})();

(function ($, Drupal) {
  Drupal.behaviors.researchAjxAction = {
    attach: function (context, settings) {
      console.log('ready')
      // Look for our custom class inside the sidebar block
      $('.research-post-link', context).on('click', function (e) {
        e.preventDefault();
        var nodeId = $(this).data('nid');
        console.log('ready again')

        // Loop through all active AJAX Views instances on the current page
        if (Drupal.views && Drupal.views.instances) {
          $.each(Drupal.views.instances, function (key, view) {
            // Match the exact machine name of your Main Content Panel view
            if (view.settings.view_name === 'research_comments') {
              // 1. Force feed the new node ID argument into the view configuration
              view.settings.view_args = String(nodeId);
              console.debug('vuew', view.settings.view_args);
              if (view.element_settings && view.element_settings.data) {
                view.element_settings.data.view_args = String(nodeId);
              }

              // 2. Target the modern wrapper class prefix (.js-view-dom-id-)
              var viewSelector = '.js-view-dom-id-' + view.settings.view_dom_id;
              
              // 3. Trigger Drupal's native AJAX routine
              $(viewSelector).trigger('RefreshView');
            }
          });
        } else {
          console.error("Drupal.views.instances is not available. Check your theme dependencies.");
        }

        // Find the main content view instance running on the page
        // $.each(Drupal.views.instances, function (key, view) {
        //   console.debug('vuew', view.settings.view_args);
        //   if (view.settings.view_name === 'research_comments') {
        //     // Pass the new Node ID as the contextual filter argument
        //     view.settings.view_args = nodeId;
        //     console.debug('vuew', view.settings.view_args);
            
        //     // Trigger Drupal's native AJAX view refresh
        //     $('.view-dom-id-' + view.settings.view_dom_id).trigger('RefreshView');
        //   }
        // });
      });
    }
  };
})(jQuery, Drupal);
