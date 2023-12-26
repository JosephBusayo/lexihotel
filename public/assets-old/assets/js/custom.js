/* ====== Index ======

1. SCROLLBAR CONTENT
2. TOOLTIPS AND POPOVER
3. JVECTORMAP HOME WORLD
4. JVECTORMAP USA REGIONS VECTOR MAP
5. COUNTRY SALES RANGS
6. JVECTORMAP HOME WORLD
7. CODE EDITOR
8. QUILL TEXT EDITOR
9. MULTIPLE SELECT
10. LOADING BUTTON
11. TOASTER
12. INFO BAR
13. PROGRESS BAR
14. DATA TABLE
15. OWL CAROUSEL

====== End ======*/

$(document).ready(function () {
  "use strict";

  /*======== 1. SCROLLBAR CONTENT ========*/

  function scrollWithBigMedia(media) {
    var $elDataScrollHeight = $("[data-scroll-height]");
    if (media.matches) {
      /* The viewport is greater than, or equal to media screen size */
      $elDataScrollHeight.each(function () {
        var scrollHeight = $(this).attr("data-scroll-height");
        $(this).css({
          height: scrollHeight + "px",
          overflow: "hidden"
        });
      });

      //For content that needs scroll
      $(".slim-scroll")
        .slimScroll({
          opacity: 0,
          height: "100%",
          color: "#999",
          size: "5px",
          touchScrollStep: 50
        })
        .mouseover(function () {
          $(this)
            .next(".slimScrollBar")
            .css("opacity", 0.4);
        });
    } else {
      /* The viewport is less than media screen size */
      $elDataScrollHeight.css({
        height: "auto",
        overflow: "auto"
      });
    }
  }

  var media = window.matchMedia("(min-width: 992px)");
  scrollWithBigMedia(media); // Call listener function at run time
  media.addListener(scrollWithBigMedia); // Attach listener function on state changes

  /*======== 2. TOOLTIPS AND POPOVER ========*/
  $('[data-toggle="tooltip"]').tooltip({
    container: "body",
    template: '<div class="tooltip" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
  });
  $('[data-toggle="popover"]').popover();


  /*======== 9. MULTIPLE SELECT ========*/
  var select2Multiple = $(".js-example-basic-multiple");
  if (select2Multiple.length != 0) {
    select2Multiple.select2();
  }
  var select2Country = $(".country");
  if (select2Country.length != 0) {
    select2Country.select2({
      minimumResultsForSearch: -1
    });
  }


  /*======== 10. LOADING BUTTON ========*/
  var laddaButton = $('.ladda-button');
  if (laddaButton.length != 0) {
    Ladda.bind(".ladda-button", {
      timeout: 1000
    });
  }

  /*======== 11. TOASTER ========*/
  var toaster = $('#toaster')

  function callToaster(positionClass) {
    toastr.options = {
      closeButton: true,
      debug: false,
      newestOnTop: false,
      progressBar: true,
      positionClass: positionClass,
      preventDuplicates: false,
      onclick: null,
      showDuration: "300",
      hideDuration: "1000",
      timeOut: "5000",
      extendedTimeOut: "1000",
      showEasing: "swing",
      hideEasing: "linear",
      showMethod: "fadeIn",
      hideMethod: "fadeOut"
    };
    toastr.success("Welcome to Mono Dashboard", "Howdy!");
  }

  if (toaster.length != 0) {

    if (document.dir != "rtl") {
      callToaster("toast-top-right");
    } else {
      callToaster("toast-top-left");
    }

  }

  /*======== 12. INFO BAR ========*/
  var infoTeoaset = $('#toaster-info, #toaster-success, #toaster-warning, #toaster-danger');
  if (infoTeoaset !== null) {
    infoTeoaset.on('click', function () {
      toastr.options = {
        closeButton: true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "3000",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
      }
      var thisId = $(this).attr('id');
      if (thisId === 'toaster-info') {
        toastr.info("Welcome to Mono", " Info message");

      } else if (thisId === 'toaster-success') {
        toastr.success("Welcome to Mono", "Success message");

      } else if (thisId === 'toaster-warning') {
        toastr.warning("Welcome to Mono", "Warning message");

      } else if (thisId === 'toaster-danger') {
        toastr.error("Welcome to Mono", "Danger message");
      }

    });
  }

  /*======== 14. DATA TABLE ========*/
  var productsTable = $('#productsTable');
  if (productsTable.length != 0) {
    productsTable.DataTable({
      "info": false,
      "lengthChange": false,
      "lengthMenu": [
        [5, 10, 15, -1],
        [5, 10, 15, "All"]
      ],
      "scrollX": true,
      "order": [
        [2, "asc"]
      ],
      "columnDefs": [{
        "orderable": false,
        "targets": [, 0, 6, -1]
      }],
      "language": {
        "search": "_INPUT_",
        "searchPlaceholder": "Search..."
      }
    });
  }

  var productSale = $('#product-sale');
  if (productSale.length != 0) {
    productSale.DataTable({
      "info": false,
      "paging": false,
      "searching": false,
      "scrollX": true,
      "order": [
        [0, "asc"]
      ],
      "columnDefs": [{
        "orderable": false,
        "targets": [-1]
      }],
    });
  }

  /*======== 15. OWL CAROUSEL ========*/
  var slideOnly = $(".slide-only");
  if (slideOnly.length != 0) {
    slideOnly.owlCarousel({
      items: 1,
      autoplay: true,
      loop: true,
      dots: false,
    });
  }

  var carouselWithControl = $(".carousel-with-control");
  if (carouselWithControl.length != 0) {
    carouselWithControl.owlCarousel({
      items: 1,
      autoplay: true,
      loop: true,
      dots: false,
      nav: true,
      navText: ['<i class="mdi mdi-chevron-left"></i>', '<i class="mdi mdi-chevron-right"></i>'],
      center: true
    });
  }

  var carouselWithIndicators = $(".carousel-with-indicators");
  if (carouselWithIndicators.length != 0) {
    carouselWithIndicators.owlCarousel({
      items: 1,
      autoplay: true,
      loop: true,
      nav: true,
      navText: ['<i class="mdi mdi-chevron-left"></i>', '<i class="mdi mdi-chevron-right"></i>'],
      center: true
    });
  }

  var caoruselWithCaptions = $(".carousel-with-captions");
  if (caoruselWithCaptions.length != 0) {
    caoruselWithCaptions.owlCarousel({
      items: 1,
      autoplay: true,
      loop: true,
      nav: true,
      navText: ['<i class="mdi mdi-chevron-left"></i>', '<i class="mdi mdi-chevron-right"></i>'],
      center: true
    });
  }

  var carouselUser = $(".carousel-user");
  if (carouselUser.length != 0) {
    carouselUser.owlCarousel({
      items: 4,
      margin: 80,
      autoplay: true,
      loop: true,
      nav: true,
      navText: ['<i class="mdi mdi-chevron-left"></i>', '<i class="mdi mdi-chevron-right"></i>'],
      responsive: {
        0: {
          items: 1,
          margin: 0,
        },
        768: {
          items: 2,
        },
        1000: {
          items: 3,
        },
        1440: {
          items: 4,
        },
      }
    });
  }

  var carouselTestimonial = $(".carousel-testimonial");
  if (carouselTestimonial.length != 0) {
    carouselTestimonial.owlCarousel({
      items: 3,
      margin: 135,
      autoplay: false,
      loop: true,
      nav: true,
      navText: ['<i class="mdi mdi-chevron-left"></i>', '<i class="mdi mdi-chevron-right"></i>'],
      responsive: {
        0: {
          items: 1,
          margin: 0,
        },
        768: {
          items: 1,
        },
        1000: {
          items: 2,
        },
        1440: {
          items: 3,
        },
      }
    });
  }

});