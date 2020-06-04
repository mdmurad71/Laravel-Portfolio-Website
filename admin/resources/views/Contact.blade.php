@extends('layout.app')
@section('content')

<div id="mainDivContact" class="container d-none">
<div class="row" style="margin-left: 45px">
<div class="col-md-12 p-5">

<table id="ContactTableId" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">Name</th>
	  <th class="th-sm">Mobile</th>
      <th class="th-sm">Email</th>
      <th class="th-sm">Message</th>
	  <th class="th-sm">Delete</th>
    </tr>
  </thead>
  <tbody id="contact_table">
  
		
  </tbody>
</table>


</div>
</div>
</div>

<div id="loaderDivContact" class="container text-center ">
<div class="row">
<div class="col-md-12 p-5 ">
<img class="mt-5" src="{{asset('images/loader.svg')}}" alt="">

</div>
</div>
</div>

<div id="wrongDivContact" class="container text-center d-none">
<div class="row">
<div class="col-md-12 p-5">
<h3>Something went wrong!</h3>

</div>
</div>
</div>


<!-- Modal -->
<div class="modal fade" id="ContactDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content p-3 text-center">
      <h5 class="mt-3">Do you to delete?</h5>
      <h6 id="tableId3" class="mt-3"></h6>

      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
        <button  id="ContactDeleteConfirm" type="button" class="btn btn-sm btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('script')

<script type="text/javascript">

 getContactData();

function getContactData(){
    axios.get('/getContactData')
    .then(function(response){
        if(response.status==200){
            $('#mainDivContact').removeClass('d-none');
                $('#loaderDivContact').addClass('d-none');

                $('#ContactTableId').DataTable().destroy();
                $('#contact_table').empty();
        
        var jsonData= response.data;
        $.each(jsonData, function(i, item){
            $('<tr>').html(
                "<td>"+jsonData[i].contact_name+"</td>"+
                "<td>"+jsonData[i].contact_Mobile+"</td>"+
                "<td>"+jsonData[i].contact_message+"</td>"+
                "<td>"+jsonData[i].contact_email+"</td>"+
                "<td><a class='contactDeleteBtn' data-id=" + jsonData[i].id + "><i class='fas fa-trash-alt'></i></a></td>"
            ).appendTo('#contact_table')
        });

        $('.contactDeleteBtn').click(function(){
            var id= $(this).data('id');
            $('#tableId3').html(id);
          $('#ContactDeleteModal').modal('show');  
        })



        }else{
            $('#wrongDivContact').removeClass('d-none');
                $('#loaderDivContact').addClass('d-none');
        }


    }).catch(function(error){

    })
}


    $('#ContactDeleteConfirm').click(function(){
        var id = $('#tableId3').html();
        deleteMethod(id);
    })


    function deleteMethod(deleteId){

     $('#ContactDeleteConfirm').html("<div class='spinner-border spinner-border-sm' role='status'></div>");

        axios.post('/contactDelete', {
            id: deleteId
        }).then(function(response){
          $('#ContactDeleteConfirm').html("Yes");
            if(response.data==1){
               $('#ContactDeleteModal').modal('hide');
               toastr.success('Delete Success');
               getContactData();

            }else{
                $('#ContactDeleteModal').modal('hide');
               toastr.error('Delete Fail');
               getContactData();

            }
        }).catch(function(error){
            $('#ContactDeleteModal').modal('hide');
            toastr.error('Something Went Wrong');
        });
    }


</script>




@endsection