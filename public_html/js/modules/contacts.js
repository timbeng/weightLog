// #################### Contacts ####################

$(".contact_select").select2({
  theme: "bootstrap",
});

//add contact
$(".add_contact").on("click", function (e) {
  e.preventDefault();
  $("#contacts_form").attr("method", "post");
  $("#contacts_form").attr("action", siteVar.SITE_URL + "/contacts");
  $("#contacts_modal .modal-title").html("Lägg till kontaktperson");
  $("#contacts_form .companies").val("");
  $("#contacts_form .firstname").val("");
  $("#contacts_form .lastname").val("");
  $("#contacts_form .title").val("");
  $("#contacts_form .personal_identity_number").val("");
  $("#contacts_form .street").val("");
  $("#contacts_form .zip").val("");
  $("#contacts_form .city").val("");
  $("#contacts_form .email").val("");
  $("#contacts_form .cell").val("");
  $("#contacts_form .phone").val("");
  $("#contacts_modal").modal("show");
  $("#contacts_modal .firstname").focus();
});

// edit contact
$(".edit_contact").on("click", function (e) {
  e.preventDefault();
  var contact_id = $(this).data("contact-id");
 

  // get contact
  $.ajax({
    url: siteVar.SITE_URL + "/contacts/" + contact_id + "/json",
    method: "get",
    dataType: "json",
    data: $(this).serialize(),
    success: function (data) {
      $("#contacts_form").attr("method", "put");
      $("#contacts_form").attr(
        "action",
        siteVar.SITE_URL + "/contacts/" + contact_id
      );
      $("#contacts_modal .modal-title").html("Ändra kontaktperson");

      $("#contacts_form .firstname").val(data.firstname);
      $("#contacts_form .lastname").val(data.lastname);
      $("#contacts_form .personal_identity_number").val(
        data.personal_identity_number
      );

      $("#contacts_form .title").val(data.title);
      $("#contacts_form .street").val(data.street);
      $("#contacts_form .zip").val(data.zip);
      $("#contacts_form .city").val(data.city);
      $("#contacts_form .email").val(data.email);
      $("#contacts_form .cell").val(data.cell);
      $("#contacts_form .phone").val(data.phone);

      var customers = [];
      $.each(data.customers, function (key, value) {
        customers.push(key);
      });

      $("#contacts_form .customers").val(customers).trigger("change");

      $("#contacts_modal").modal("show");
      $("#contacts_modal .contact_name").focus();
    },
    error: function (data) {
      console.log(data);
    },
  });
});

//
$("#contacts_form").on("submit", function (e) {
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

// Delete contact
$(".delete_contact").on("click", function (e) {
  e.preventDefault();
  var contact_id = $(this).data("contact-id");

  if (confirm("Är du säker på att du vill ta bort Kontaktpersonen?")) {
    $.ajax({
      url: siteVar.SITE_URL + "/contacts/" + contact_id,
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
