$(document).ready(function(){
    $("#VirtualUserDomainId").change(function(event){
        setEmail($(this).val());
    });
    $("#VirtualUserUsername").change(function(event){
        setEmail($("#VirtualUserDomainId").val());
    });
})

function setEmail(domain_value) {
    $("#VirtualUserDomainId option").each(function (id) {
        if (id == domain_value) {
            $.ajax({
              type: "POST",
              url: $("#VirtualUserListEmailsUrl").val(),
              data: {
                domain_id: domain_value,
              }
            }).done(function( msg ) {
                $("#list_emails").html("");
                $("#list_emails").html(msg);
            });            
        }
        if (id == domain_value && domain_value != '') {
            var newEmail =  $("#VirtualUserUsername").val() + "@" + $(this).text();
            event.preventDefault();
            $.ajax({
              type: "POST",
              url: $("#VirtualUserValidEmailUrl").val(),
              data: {
                email: newEmail,
              }
            }).done(function( msg ) {
                $("#isExistingEmail").text("");
                if (msg != 'none') {
                    $(".submit input").val("EMAIL ADDRESS ALREADY EXISTS");
                } else {
                    $(".submit input").val("Create Email Address");
                }
                $("#VirtualUserEmail").val(newEmail);
            });
        }
    }); 
}