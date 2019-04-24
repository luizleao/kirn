<!-- JS -->
<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script> 

<!-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>  -->

<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/jquery.mask.js"></script>
<script type="text/javascript" src="js/comum.js"></script>
<script type="text/javascript" src="js/crud.js"></script>

<script type="text/javascript" src="bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="bootstrap-datetimepicker/locales/bootstrap-datetimepicker.pt-BR.js"></script>


<script src="https://apis.google.com/js/platform.js" async defer></script>
<script>
function onSignIn(googleUser) {
    var profile = googleUser.getBasicProfile();
    console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
    console.log('Name: ' + profile.getName());
    console.log('Image URL: ' + profile.getImageUrl());
    console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.

    $("#imgUser").attr("src", profile.getImageUrl());
    $("#nameUser").html(profile.getName());
}
</script>