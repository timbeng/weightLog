$(document).ready(function () {
  // #################### Customers ####################

  // Lägg till Kund
  $(".add_customer").on("click", function (e) {
    e.preventDefault();
    $("#customer_form").attr("method", "post");
    $("#customer_form").attr("action", siteVar.SITE_URL + "/customers");
    $("#customer_modal .modal-title").html("Lägg till Kund");

    $("#customer_form .customer_name").val("");
    $("#customer_form .customer_type_id").val("");
    $("#customer_form .org").val("");
    $("#customer_form .street").val("");
    $("#customer_form .zip").val("");
    $("#customer_form .city").val("");
    $("#customer_form .email").val("");
    $("#customer_form .cell").val("");
    $("#customer_form .phone").val("");

    $("#customer_modal").modal("show");
    $("#customer_modal .customer_name").focus();
  });

  // Ändra Kunden
  $(".edit_customer").on("click", function (e) {
    e.preventDefault();

    var customer_id = $(this).data("customer-id");

    // Hämta customer
    $.ajax({
      url: siteVar.SITE_URL + "/customers/" + customer_id + "/json",
      method: "get",
      dataType: "json",
      data: $(this).serialize(),
      success: function (data) {
        console.log(data);
        $("#customer_form").attr("method", "put");
        $("#customer_form").attr(
          "action",
          siteVar.SITE_URL + "/customers/" + customer_id
        );
        $("#customer_modal .modal-title").html("Ändra Kunden");

        $("#customer_form .customer_name").val(data.name);  
        
        if(data.customer_type_id == 1){ 
          $("#customer_form #company").prop('checked', true); 
        }
        else {
          $("#customer_form #private").prop('checked', true); 
        }

        $("#customer_form .org").val(data.org);
        $("#customer_form .street").val(data.street);
        $("#customer_form .zip").val(data.zip);
        $("#customer_form .city").val(data.city);
        $("#customer_form .email").val(data.email);
        $("#customer_form .cell").val(data.cell);
        $("#customer_form .phone").val(data.phone);

        $("#customer_modal").modal("show");
        $("#customer_modal .customer_name").focus();
      },
      error: function (data) {
        console.log(data);
      },
    });
  });

  //
  $("#customer_form").on("submit", function (e) {
    e.preventDefault();

    $.ajax({
      url: $(this).attr("action"),
      method: $(this).attr("method"),
      dataType: "json",
      data: $(this).serialize(),
      success: function (data) {
        if (data.success == true) {
          window.location.reload();
        }
        console.log(data);
      },
      error: function (data) {
        console.log(data);
      },
    });
  });

  // Delete customer
  $(".delete_customer").on("click", function (e) {
    e.preventDefault();
    var customer_id = $(this).data("customer-id");

    if (confirm("Är du säker på att du vill ta bort företaget?")) {
      $.ajax({
        url: siteVar.SITE_URL + "/customers/" + customer_id,
        method: "delete",
        dataType: "json",
        data: $(this).serialize(),
        success: function (data) {
          if (data.success == true) {
            window.location.reload();
          }
        },
        error: function (data) {
          console.log(data);
        },
      });
    }
  });
});
