
//add  
$(".add_project").on("click", function (e) {
    e.preventDefault();
    $("#project_form").attr("method", "post");
    $("#project_form").attr("action", siteVar.SITE_URL + "/customers");
    $("#project_modal .modal-title").html("Lägg till Projekt");
    $("#project_form input").val(""); 
    $("#project_modal .name").focus();
  });
  