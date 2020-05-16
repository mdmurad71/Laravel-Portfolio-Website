//visitor page js code
$(document).ready(function() {
    $('#VisitorDt').DataTable();
    $('.dataTables_length').addClass('bs-select');
});




function homeData(){
   
    axios.get('/getHomeWorkData')
      .then(function (response) {

        if(response.status==200){
            $('#mainDiv').removeClass('d-none');
            $('#loaderDiv').addClass('d-none');
            $('#home_table').empty();



        var jsonData = response.data;
        $.each(jsonData, function(i, item) {
           
            $('<tr>').html(
                            "<td>" + jsonData[i].no + "</td>" +
                            "<td>" + jsonData[i].name + "</td>" +
                            "<td>" + jsonData[i].roll + "</td>" +
                            "<td>" + jsonData[i].class + "</td>" +
                            "<td><a class='homeUpdateBtn' data-id=" + jsonData[i].id + " ><i class='fas fa-edit'></i></a></td>" +
                            "<td><a class='homeDeleteBtn' data-id=" + jsonData[i].id + "><i class='fas fa-trash-alt'></i></a></td>"
                        ).appendTo('#home_table');
            });


            //data delete
            $('.homeDeleteBtn').click(function(){
                var id= $(this).data('id');
                $('#HomeDeleteId').html(id);
              $('#HomeDeleteModal').modal('show');

            })

            $('.homeUpdateBtn').click(function(){
                var id=$(this).data('id');
                $('#updateId').html(id);
                homeUpdateConfirm(id);
                $('#HomeUpdateModal').modal('show');
            })
           



        }else{
             $('#wrongDiv').removeClass('d-none');
             $('#loaderDiv').addClass('d-none');
        }

      }) .catch(function (error) {
        
      });
       
      }
//data delete save button

      $('#HomeDeleteConfirm').click(function(){
       var id= $('#HomeDeleteId').html();
       homeDeleteBtn(id);

      })


      function homeDeleteBtn(deleteId){
          axios.post('/homeDelete',{
              id:deleteId
          })
          .then(function(response){
              if(response.data==1){
                $('#HomeDeleteModal').modal('hide'); 
                toastr.success('Delete Success.'); 
                homeData();
              }else{
                $('#HomeDeleteModal').modal('hide'); 
                toastr.error('Delete fail!!.'); 
                homeData();
              }
          }).catch(function(error){
            $('#HomeDeleteModal').modal('hide'); 
            toastr.error('something went wrong.'); 
            
          });
      }


      function homeUpdateConfirm(updateId){
          axios.post('/homeUpdate', {id:updateId
      }).then (function(response){
          if(response.status==200){
              var jsonData=response.data;
              $('#HomeNo').val(jsonData[0].no);
              $('#HomeName').val(jsonData[0].name);
              $('#HomeRoll').val(jsonData[0].roll);
              $('#HomeClass').val(jsonData[0].class);

          }
      }).catch(function(error){

      });
      }


























/*  //service page theke data update korar code
                $('.serviceUpdateBtn').click(function() {
                    var id = $(this).data('id');
                    $('#updateId').html(id);
                    updateConfirmBtn(id);
                    $('#updateModal').modal('show');
                })


//update ar modal ar save button ar jonno click function
$('#updateConfirm').click(function() {
    var id = $('#updateId').html();
    var name = $('#serviceName').val();
    var desc = $('#serviceDescription').val();
    var image = $('#serviceImage').val();

    updateLast(id, name, desc, image);

})



//data edit korar 1st function code 
function updateConfirmBtn(updateId) {
    axios.post('/serviceUpdate', {
            id: updateId
        })
        .then(function(response) {
            if (response.status == 200) {
                var jsonData = response.data;
                $('#serviceName').val(jsonData[0].service_name);
                $('#serviceDescription').val(jsonData[0].service_desc);
                $('#serviceImage').val(jsonData[0].service_image);


            }
        }).catch(function(error) {

        });

}





//data edit korar last function code 
function updateLast(updateId, serviceName, serviceDesc, serviceImage) {

    $('#updateConfirm').html("<div class='spinner-border spinner-border-sm' role='status'></div>");


    if (serviceName.length == 0) {
        toastr.error('service name can not be empty.');
    } else if (serviceDesc == 0) {
        toastr.error('service description can not be empty.');
    } else if (serviceImage == 0) {
        toastr.error('service image can not be empty.');
    } else {
        axios.post('/updatefinal', {
                id: updateId,
                name: serviceName,
                desc: serviceDesc,
                image: serviceImage,
            })
            .then(function(response) {
                $('#updateConfirm').html("Save");
                if (response.status == 200) {

                    if (response.data == 1) {
                        $('#updateModal').modal('hide');
                        toastr.success('Update Success.');
                        getServicesData();
                    } else {
                        $('#updateModal').modal('hide');
                        toastr.error('Update Failed .');
                        getServicesData();
                    }
                } else {
                    $('#updateModal').modal('hide');
                    toastr.error('something went wrong.');
                }

            }).catch(function(error) {
                $('#updateModal').modal('hide');
                toastr.error('something went wrong.');

            });

    }


}

*/