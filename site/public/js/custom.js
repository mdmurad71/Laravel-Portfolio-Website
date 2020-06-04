// Owl Carousel Start..................



$(document).ready(function() {
    var one = $("#one");
    var two = $("#two");

    $('#customNextBtn').click(function() {
        one.trigger('next.owl.carousel');
    })
    $('#customPrevBtn').click(function() {
        one.trigger('prev.owl.carousel');
    })
    one.owlCarousel({
        autoplay:true,
        loop:true,
        dot:true,
        autoplayHoverPause:true,
        autoplaySpeed:100,
        margin:10,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:4
            }
        }
    });

    two.owlCarousel({
        autoplay:true,
        loop:true,
        dot:true,
        autoplayHoverPause:true,
        autoplaySpeed:100,
        margin:10,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    });

});

$('#sendConfirmBtn').click(function () {
    var Name= $('#NameId').val();
    var Mobile=$('#MobileId').val();
    var Email=$('#EmailId').val();
    var Message=$('#MessageId').val();
    contactSend(Name, Mobile, Email, Message);

})

function contactSend(name, mobile, email, message){
    if (name.length==0){
        toastr.error('service name can not be empty.');
    }else if(mobile.length==0){
        $('#MobileId').html("write down your name") ;
    }else if(email.length==0){
        $('#EmailId').html("write down your name") ;
    }else if(message.length==0){
        $('#MessageId').html("write down your name") ;
    }


    axios.post('/ContactSend',{
        contact_name: name,
        contact_mobile: mobile,
        contact_email: email,
        contact_message: message
    })
        .then(function (reponse) {
            alert(reponse.data)

        }).catch(function (error) {

    })
}








// Owl Carousel End..................
