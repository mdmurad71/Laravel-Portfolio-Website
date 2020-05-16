@extends('layout.app')


@section('content')

<div class="page-wrapper">




<div id="mainDiv" class="container d-none">
<div class="row">
<div class="col-md-12 p-5">
    <button id="addbutton" class="btn btn-primary mb-3">Add Services</button>
<table id="" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">No</th>
      <th class="th-sm">Name</th>
	  <th class="th-sm">Roll</th>
	  <th class="th-sm">Class</th>
	  <th class="th-sm">Edit</th>
	  <th class="th-sm">Delete</th>
    </tr>
  </thead>
  <tbody id="home_table">
  
	
	
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
<div class="modal fade" id="HomeDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content p-3 text-center">
      <h5 class="mt-3">Do you to delete?</h5>
      <h6 id="HomeDeleteId" class="mt-3"></h6>

      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
        <button  id="HomeDeleteConfirm" type="button" class="btn btn-sm btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="HomeUpdateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content p-3 text-center">
    <h5 class="mt-3">Update Here</h5>
      <h6 id="updateId" class="mt-3"></h6>
      <div class="modal-body">
       <input id="HomeNo" type="message"  class="form-control mb-4" placeholder="No">
       <input id="HomeName" type="message"  class="form-control mb-4" placeholder="Name">
       <input id="HomeRoll" type="message"  class="form-control mb-4" placeholder="Roll">
       <input id="HomeClass" type="message"  class="form-control mb-4" placeholder="Class">

      </div>
       <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
        <button  id="HomeUpdateConfirm" type="button" class="btn btn-sm btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>




</div>
 @endsection

  @section('script')
  <script type="text/javascript">
        homeData();




</script>

@endsection


