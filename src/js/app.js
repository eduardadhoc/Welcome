//AMAGAR SITE-HEADER AL FER SCROLL
var prevScrollpos = window.pageYOffset;
window.onscroll = function() {
  var currentScrollPos = window.pageYOffset;
  var element = document.getElementById("capdamunt");
  if (prevScrollpos > currentScrollPos) {
    element.classList.add('visible');
  } else {
    element.classList.remove('visible');
  }
  prevScrollpos = currentScrollPos;
}

document.addEventListener('DOMContentLoaded', function () {

  // Dropdowns

  var $dropdowns = getAll('.dropdown:not(.is-hoverable)');

  if ($dropdowns.length > 0) {
    $dropdowns.forEach(function ($el) {
      $el.addEventListener('click', function (event) {
        event.stopPropagation();
        $el.classList.toggle('is-active');
      });
    });

    document.addEventListener('click', function (event) {
      closeDropdowns();
    });
  }

  function closeDropdowns() {
    $dropdowns.forEach(function ($el) {
      $el.classList.remove('is-active');
    });
  }

  // Close dropdowns if ESC pressed
  document.addEventListener('keydown', function (event) {
    var e = event || window.event;
    if (e.keyCode === 27) {
      closeDropdowns();
    }
  });

  // Functions

  function getAll(selector) {
    return Array.prototype.slice.call(document.querySelectorAll(selector), 0);
  }
});

//<![CDATA[
  var boton = document.getElementById('getlink');
  boton.addEventListener('click', function (e) {
    if (boton.id == 'getlink') {
      var aux = document.createElement('input');
      aux.setAttribute('value', window.location.href.split('?')[0].split('#')[0]);
      document.body.appendChild(aux);
      aux.select();
      try {
        document.execCommand('copy');
        var aviso = document.createElement('div');
        aviso.setAttribute('id', 'aviso');
        aviso.style.cssText = 'position:fixed; z-index: 9999999;top: 0;left:0;right:0; background: #EDF67D;font-family: "Poppins",sans-serif;font-size:20px;font-weight:600;padding: 3rem 1rem; text-align:center';
        aviso.innerHTML = 'URL copiada';
        document.body.appendChild(aviso);
        document.load = setTimeout('document.body.removeChild(aviso)', 2000);
        document.load = setTimeout('boton.id = "getlink"', 2500);
        boton.id = '';
      } catch (e) {
        alert('Tu navegador no soporta la función de copiar');
      }
      document.body.removeChild(aux);
    }
  });
  //]]></script>


/**
 * A partir d'aquí jQuery
 */


 (function($, root, undefined) {

  $('.taula').DataTable({
    'lengthChange': false,
    'searching': false,
    'ordering': false,
    'pageLength': 10,
    'language': {
      info: '_PAGE_ - _PAGES_',
      paginate: {
        previous: '&#60;',
        next: '&#62;'
      }
    }
  });

  $(".is-clickable").on('click', function() {
    window.location = $(this).find("a").attr("href");
    return false;
  });

  // skip link (https://www.bignerdranch.com/blog/web-accessibility-skip-navigation-links/)

  // bind a click event to the 'skip' link
  $(".skip-link").on("click", function(event) {
    // strip the leading hash and declare
    // the content we're skipping to
    var skipTo = "#" + this.href.split("#")[1];

    // Setting 'tabindex' to -1 takes an element out of normal
    // tab flow but allows it to be focused via javascript
    $(skipTo)
      .attr("tabindex", -1)
      .on("blur focusout", function() {
        // when focus leaves this element,
        // remove the tabindex attribute
        $(this).removeAttr("tabindex");
      })
      .focus(); // focus on the content container
  });


  //popups
  $(document).on('click', function() {
    $(".tag").removeClass('is-active');
  });
  $('.tag span').on('click', function(e) {
    e.stopPropagation();
    $(".tag").removeClass('is-active');
    $(this).parent().toggleClass('is-active');
  });

})(jQuery, this);
