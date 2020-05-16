@extends('layout.app')

@section('content')


<div id="mainDiv" class="container d-none">
<div class="row">
<div class="col-md-12 p-5">
<button id="addService" class=" btn btn-danger mb-3">Add New</button>

<table id="" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">Image</th>
	  <th class="th-sm">Name</th>
	  <th class="th-sm">Description</th>
	  <th class="th-sm">Edit</th>
	  <th class="th-sm">Delete</th>
    </tr>
  </thead>
  <tbody id="service_table">
  
		
  </tbody>
</table>


</div>
</div>
</div>

<div id="loaderDiv" class="container text-center ">
<div class="row">
<div class="col-md-12 p-5 ">
<img class="mt-5" src="{{asset('images/loader.svg')}}" alt="">

</div>
</div>
</div>

<div id="wrongDiv" class="container text-center d-none">
<div class="row">
<div class="col-md-12 p-5">
<h3>Something went wrong!</h3>

</div>
</div>
</div>




<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content p-3 text-center">
      <h5 class="mt-3">Do you to delete?</h5>
      <h6 id="serviceDeleteId" class="mt-3"></h6>

      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
        <button  id="deleteConfirm" type="button" class="btn btn-sm btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content p-5 text-center">
      <h5 class="mt-3">Update Here</h5>
      <h6 id="updateId" class="mt-3"></h6>
      <div class="modal-body">
       <input id="serviceName" type="message"  class="form-control mb-4" placeholder="Name">
       <input id="serviceDescription" type="message"  class="form-control mb-4" placeholder="Description">
       <input id="serviceImage" type="message"  class="form-control mb-4" placeholder="Image link">

      </div>
      <!--
      <img id="serviceEditLoader" class="loading-icon m-5" src="{{asset('images/loader.svg')}}" alt="">
      <h5 id="serviceEditWrong" class="d-none">Something went wrong!!</h5>-->

      
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">cancel</button>
        <button data-id=" " id="updateConfirm" type="button" class="btn btn-sm btn-danger">save</button>
      </div>
    </div>
  </div>
</div>





<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content p-5 text-center">
      <div class="modal-body">
       <input id="serviceAddName" type="message"  class="form-control mb-4" placeholder="Name">
       <input id="serviceAddDescription" type="message"  class="form-control mb-4" placeholder="Description">
       <input id="serviceAddImage" type="message"  class="form-control mb-4" placeholder="Image link">

      </div>
      <!--
      <img id="serviceEditLoader" class="loading-icon m-5" src="{{asset('images/loader.svg')}}" alt="">
      <h5 id="serviceEditWrong" class="d-none">Something went wrong!!</h5>-->

      
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">cancel</button>
        <button data-id=" " id="addConfirm" type="button" class="btn btn-sm btn-danger">save</button>
      </div>
    </div>
  </div>
</div>



@endsection

@section('script')

<script type="text/javascript">
getServicesData();



//service page ar code. amra jkhane db theke service table ar data get kore show korai 
function getServicesData() {
    axios.get('/getServicesData')
        .then(function(response) {

            if (response.status == 200) {
                $('#mainDiv').removeClass('d-none');
                $('#loaderDiv').addClass('d-none');
                $('#service_table').empty();

                var jsonData = response.data;
                $.each(jsonData, function(i, item) {
                    $('<tr>').html(
                        "<td><img class='table-img' src=" + jsonData[i].service_image + "</td>" +
                        "<td>" + jsonData[i].service_name + "</td>" +
                        "<td>" + jsonData[i].service_desc + "</td>" +
                        "<td><a class='serviceUpdateBtn' data-id=" + jsonData[i].id + " ><i class='fas fa-edit'></i></a></td>" +
                        "<td><a class='serviceDeleteBtn' data-id=" + jsonData[i].id + "><i class='fas fa-trash-alt'></i></a></td>"
                    ).appendTo('#service_table');
                });


                //service page theke data delete korar code
                $('.serviceDeleteBtn').click(function() {

                    var id = $(this).data('id');
                    $('#serviceDeleteId').html(id);

                    $('#deleteModal').modal('show');
                })



                //service page theke data update korar code
                $('.serviceUpdateBtn').click(function() {
                    var id = $(this).data('id');
                    $('#updateId').html(id);
                    updateConfirmBtn(id);
                    $('#updateModal').modal('show');
                })

            } else {
                $('#wrongDiv').removeClass('d-none');
                $('#loaderDiv').addClass('d-none');
            }

        }).catch(function(error) {

        });
}



//delete ar modal ar yes button ar jonno click function
$('#deleteConfirm').click(function() {
    var id = $('#serviceDeleteId').html();
    deleteConfirmBtn(id);

})




//data delete korar function code 
function deleteConfirmBtn(deleteId) {
    $('#deleteConfirm').html("<div class='spinner-border spinner-border-sm' role='status'></div>");

    axios.post('/ServiceDelete', {
            id: deleteId
        })
        .then(function(response) {
            $('#updateConfirm').html("Yes");
            if (response.data == 1) {
                $('#deleteModal').modal('hide');
                toastr.success('Delete Success.');
                getServicesData();
            } else {
                $('#deleteModal').modal('hide');
                toastr.error('Delete Failed .');
                getServicesData();
            }
        }).catch(function(error) {
            $('#deleteModal').modal('hide');
            toastr.error('something went wrong.');

        });

}



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


//update ar modal ar save button ar jonno click function
$('#updateConfirm').click(function() {
    var id = $('#updateId').html();
    var name = $('#serviceName').val();
    var desc = $('#serviceDescription').val();
    var image = $('#serviceImage').val();

    updateLast(id, name, desc, image);

})



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



// add modal ar click function
$('#addService').click(function() {
    $('#addModal').modal('show');



})

//add ar modal ar save button ar jonno click function
$('#addConfirm').click(function() {
    var name = $('#serviceAddName').val();
    var desc = $('#serviceAddDescription').val();
    var image = $('#serviceAddImage').val();

    AddService(name, desc, image);

})


//data add korar last function code 
function AddService(serviceName, serviceDesc, serviceImage) {

    $('#addConfirm').html("<div class='spinner-border spinner-border-sm' role='status'></div>");


    if (serviceName.length == 0) {
        toastr.error('service name can not be empty.');
    } else if (serviceDesc == 0) {
        toastr.error('service description can not be empty.');
    } else if (serviceImage == 0) {
        toastr.error('service image can not be empty.');
    } else {
        axios.post('/addfinal', {

                name: serviceName,
                desc: serviceDesc,
                image: serviceImage,
            })
            .then(function(response) {
                $('#addConfirm').html("Save");
                if (response.status == 200) {

                    if (response.data == 1) {
                        $('#addModal').modal('hide');
                        toastr.success('Add Success.');
                        getServicesData();
                    } else {
                        $('#addModal').modal('hide');
                        toastr.error('Add Failed .');
                        getServicesData();
                    }
                } else {
                    $('#addModal').modal('hide');
                    toastr.error('something went wrong.');
                }

            }).catch(function(error) {
                $('#addModal').modal('hide');
                toastr.error('something went wrong.');

            });

    }


}
        



</script>

@endsection



