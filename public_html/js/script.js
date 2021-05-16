$(document).ready(function () {
  $(".hide").hide();
  $(".show").show();

  // Hide cookie away when clicked
  $("#cookie-away").on("click", function (event) {
    event.preventDefault();
    $("#cookie-wrap").slideUp();
    $.ajax({
      method: "post",
      url: "/hide-cookie",
    });
  });

  function slideUp(x, y){
    window.scrollTo(x, y ); 
  }


  $(".bars").on("click", function (e) {
    e.preventDefault();
    var nav_wrapper = $("." + $(this).data("nav-class")),
    action = $(this).data('action');
      
    if( action == 'slide-up'){
      slideUp(0, 0); 
    }



 
    if (nav_wrapper.is(":visible")) {
      nav_wrapper.hide();
      // $(this).children('.fa').addClass('fa-bars').removeClass("fa-times");
    } else {
      nav_wrapper.show();
      // $(this).children('.fa').addClass('fa-times').removeClass("fa-bars");
    }
  });

  // $(".close_mobile_nav").on("click", function (e) {
  //   e.preventDefault();
  //   var nav_wrapper = $(".nav_wrapper");
  //   nav_wrapper.hide();
  // });

  /*
  if ($(".dataTable").length) {
    // Call the dataTables jQuery plugin
    $(".dataTable").DataTable({
      language: {
        sEmptyTable: "Tabellen innehåller ingen data",
        sInfo: "Visar _START_ till _END_ av totalt _TOTAL_ rader",
        sInfoEmpty: "Visar 0 till 0 av totalt 0 rader",
        sInfoFiltered: "(filtrerade från totalt _MAX_ rader)",
        sInfoPostFix: "",
        sInfoThousands: " ",
        sLengthMenu: "Visa _MENU_ rader",
        sLoadingRecords: "Laddar...",
        sProcessing: "Bearbetar...",
        sSearch: "Sök:",
        sZeroRecords: "Hittade inga matchande resultat",
        oPaginate: {
          sFirst: "Första",
          sLast: "Sista",
          sNext: "Nästa",
          sPrevious: "Föregående",
        },
        oAria: {
          sSortAscending:
            ": aktivera för att sortera kolumnen i stigande ordning",
          sSortDescending:
            ": aktivera för att sortera kolumnen i fallande ordning",
        },
      },
    });
  }

  function toggleSidebar() {
    var toggled = "";
    if ($("#accordionSidebar").hasClass("toggled")) {
      toggled = "toggled";
    } else {
      toggled = "open";
    }
    $.ajax({
      url: siteVar.SITE_URL + "/api/set-sidenav/" + toggled,
      method: "put",
      dataType: "json",
      success: function (data) {
        console.log(data);
      },
    });
  }
  $("#sidebarToggleTop").on("click", function () {
    toggleSidebar();
  });

  $("#sidebarToggle").on("click", function () {
    toggleSidebar();
  });

*/
});
