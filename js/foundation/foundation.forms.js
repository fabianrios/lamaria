/*jslint unparam: true, browser: true, indent: 2 */

;(function ($, window, document, undefined) {
  'use strict';

  Foundation.libs.forms = {
    name : 'forms',

    version : '4.0.0',

    settings : {
      disable_class: 'no-custom'
    },

    init : function (scope, method, options) {
      this.scope = scope || this.scope;

      if (typeof method === 'object') {
        $.extend(true, this.settings, method);
      }

      if (typeof method != 'string') {
        if (!this.settings.init) {
          this.events();
        }

        this.assemble();

        return this.settings.init;
      } else {
        return this[method].call(this, options);
      }
    },

    assemble : function () {
      $('form.custom input[type="radio"]').not('[data-customforms="disabled"]')
        .each(this.append_custom_markup);
      $('form.custom input[type="checkbox"]').not('[data-customforms="disabled"]')
        .each(this.append_custom_markup);
      $('form.custom select').not('[data-customforms="disabled"]')
        .each(this.append_custom_select);
    },

    events : function () {
      var self = this;

      $(this.scope)
        .on('click.fndtn.forms', 'form.custom span.custom.checkbox', function (e) {
          e.preventDefault();
          e.stopPropagation();
          self.toggle_checkbox($(this));
        })
        .on('click.fndtn.forms', 'form.custom span.custom.radio', function (e) {
          e.preventDefault();
          e.stopPropagation();
          self.toggle_radio($(this));
        })
        .on('change.fndtn.forms', 'form.custom select:not([data-customforms="disabled"])', function (e) {
          self.refresh_custom_select($(this));
        })
        .on('click.fndtn.forms', 'form.custom label', function (e) {
          var $associatedElement = $('#' + self.escape($(this).attr('for')) + ':not([data-customforms="disabled"])'),
              $customCheckbox,
              $customRadio;
          if ($associatedElement.length !== 0) {
            if ($associatedElement.attr('type') === 'checkbox') {
              e.preventDefault();
              $customCheckbox = $(this).find('span.custom.checkbox');
              //the checkbox might be outside after the label
              if ($customCheckbox.length == 0) {
                $customCheckbox = $(this).next('span.custom.checkbox');
              }
              //the checkbox might be outside before the label
              if ($customCheckbox.length == 0) {
                $customCheckbox = $(this).prev('span.custom.checkbox');
              }
              self.toggle_checkbox($customCheckbox);
            } else if ($associatedElement.attr('type') === 'radio') {
              e.preventDefault();
              $customRadio = $(this).find('span.custom.radio');
              //the radio might be outside after the label
              if ($customRadio.length == 0) {
                $customRadio = $(this).next('span.custom.radio');
              }
              //the radio might be outside before the label
              if ($customRadio.length == 0) {
                $customRadio = $(this).prev('span.custom.radio');
              }
              self.toggle_radio($customRadio);
            }
          }
        })
        .on('click.fndtn.forms', 'form.custom div.custom.dropdown a.current, form.custom div.custom.dropdown a.selector', function (e) {
          var $this = $(this),
              $dropdown = $this.closest('div.custom.dropdown'),
              $select = $dropdown.prev();

          // make sure other dropdowns close
          if(!$dropdown.hasClass('open'))
            $(self.scope).trigger('click');

          e.preventDefault();
          if (false === $select.is(':disabled')) {
            $dropdown.toggleClass('open');

            if ($dropdown.hasClass('open')) {
              $(self.scope).on('click.fndtn.forms.customdropdown', function () {
                $dropdown.removeClass('open');
                $(self.scope).off('.fndtn.forms.customdropdown');
              });
            } else {
              $(self.scope).on('.fndtn.forms.customdropdown');
            }
            return false;
          }
        })
        .on('click.fndtn.forms touchend.fndtn.forms', 'form.custom div.custom.dropdown li', function (e) {
          var $this = $(this),
              $customDropdown = $this.closest('div.custom.dropdown'),
              $select = $customDropdown.prev(),
              selectedIndex = 0;

          e.preventDefault();
          e.stopPropagation();

          if ( ! $(this).hasClass('disabled')) {
            $('div.dropdown').not($customDropdown).removeClass('open');

            var $oldThis= $this
              .closest('ul')
              .find('li.selected');
            $oldThis.removeClass('selected');

            $this.addClass('selected');

            $customDropdown
              .removeClass('open')
              .find('a.current')
              .html($this.html());

            $this.closest('ul').find('li').each(function (index) {
              if ($this[0] == this) {
                selectedIndex = index;
              }

            });
            $select[0].selectedIndex = selectedIndex;

            //store the old value in data
            $select.data('prevalue', $oldThis.html());
            $select.trigger('change');
          }
        });

      this.settings.init = true;
    },

    append_custom_markup : function (idx, sel) {
      var $this = $(sel).hide(),
          type  = $this.attr('type'),
          $span = $this.next('span.custom.' + type);

      if ($span.length === 0) {
        $span = $('<span class="custom ' + type + '"></span>').insertAfter($this);
      }

      $span.toggleClass('checked', $this.is(':checked'));
      $span.toggleClass('disabled', $this.is(':disabled'));
    },

    append_custom_select : function (idx, sel) {
      var self = Foundation.libs.forms,
          $this = $( sel ),
          $customSelect = $this.next( 'div.custom.dropdown' ),
          $customList = $customSelect.find( 'ul' ),
          $selectCurrent = $customSelect.find( ".current" ),
          $selector = $customSelect.find( ".selector" ),
          $options = $this.find( 'option' ),
          $selectedOption = $options.filter( ':selected' ),
          maxWidth = 0,
          liHtml = '',
          $listItems,
          $currentSelect = false;

      if ($this.hasClass(self.settings.disable_class)) return;

      if ($customSelect.length === 0) {
        var customSelectSize = $this.hasClass( 'small' )   ? 'small'   :
                               $this.hasClass( 'medium' )  ? 'medium'  :
                               $this.hasClass( 'large' )   ? 'large'   :
                               $this.hasClass( 'expand' )  ? 'expand'  : '';

        $customSelect = $('<div class="' + ['custom', 'dropdown', customSelectSize ].join( ' ' ) + '"><a href="#" class="selector"></a><ul /></div>');
        $selector = $customSelect.find(".selector");
        $customList = $customSelect.find("ul");
        liHtml = $options.map(function() { return "<li>" + $( this ).html() + "</li>"; } ).get().join( '' );
        $customList.append(liHtml);
        $currentSelect = $customSelect.prepend('<a href="#" class="current">' + $selectedOption.html() + '</a>' ).find( ".current" );
        $this
          .after( $customSelect )
          .hide();

      } else {
        liHtml = $options.map(function() {
            return "<li>" + $( this ).html() + "</li>";
          })
          .get().join('');
        $customList
          .html('')
          .append(liHtml);

      } // endif $customSelect.length === 0
      $customSelect.toggleClass('disabled', $this.is( ':disabled' ) );
      $listItems = $customList.find( 'li' );

      $options.each( function ( index ) {
        if ( this.selected ) {
          $listItems.eq( index ).addClass( 'selected' );

          if ($currentSelect) {
            $currentSelect.html( $( this ).html() );
          }

        }
        if ($(this).is(':disabled')) {
          $listItems.eq( index ).addClass( 'disabled' );
        }
      });

      //
      // If we're not specifying a predetermined form siz