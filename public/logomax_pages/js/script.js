
$(document).on('click', 'ul.dash-tab li a.nav-link', function(){
  $(this).addClass('active').siblings().removeClass('active')
})


$(document).ready(function() {
    $("#show_hide_password a").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_password input').attr("type") == "text"){
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass( "fa-eye-slash" );
            $('#show_hide_password i').removeClass( "fa-eye" );
        }else if($('#show_hide_password input').attr("type") == "password"){
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass( "fa-eye-slash" );
            $('#show_hide_password i').addClass( "fa-eye" );
        }
    });
});

// $('.Show').click(function() {
//     $('#target').show(200);
//     $('.Show').hide(0);
//     $('.Hide').show(0);
// });
// $('.Hide').click(function() {
//     $('#target').hide(500);
//     $('.Show').show(0);
//     $('.Hide').hide(0);
// });
$('.toggle').click(function() {
    $('#target').toggle('slow');
});