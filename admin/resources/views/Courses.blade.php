@extends('layout.app')

@section('content')



<div class="page-wrapper">


<div id="CourseMaindiv" class="container d-none">
<div class="row">
<div class="col-md-12 p-5">
<button id="addCourseBtn" class=" btn btn-danger mb-3">Add New</button>

<table id="" class="table table-striped table-bordered" cellspacing="0" width="100%">
  <thead>
    <tr>
      <th class="th-sm">Name</th>
	  <th class="th-sm">Fee</th>
      <th class="th-sm">Class</th>
      <th class="th-sm">Enroll</th>
	  <th class="th-sm">Details</th>
	  <th class="th-sm">Edit</th>
	  <th class="th-sm">Delete</th>
    </tr>
  </thead>
  <tbody id="course_table">
  
	
  </tbody>
</table>

</div>
</div>
</div>
</div>

<div id="CourseloaderDiv" class="container text-center ">
<div class="row">
<div class="col-md-12 p-5 ">
<img class="mt-5" src="{{asset('images/loader.svg')}}" alt="">

</div>
</div>
</div>

<div id="CoursewrongDiv" class="container text-center d-none">
<div class="row">
<div class="col-md-12 p-5">
<h3>Something went wrong!</h3>

</div>
</div>
</div>



<div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">addCourseModal
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Add New Course</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">
       <div class="container">
       	<div class="row">
       		<div class="col-md-6">
             	<input id="CourseNameId" type="text" id="" class="form-control mb-3" placeholder="Course Name">
          	 	<input id="CourseDesId" type="text" id="" class="form-control mb-3" placeholder="Course Description">
    		 	<input id="CourseFeeId" type="text" id="" class="form-control mb-3" placeholder="Course Fee">
     			<input id="CourseEnrollId" type="text" id="" class="form-control mb-3" placeholder="Total Enroll">
       		</div>
       		<div class="col-md-6">
     			<input id="CourseClassId" type="text" id="" class="form-control mb-3" placeholder="Total Class">      
     			<input id="CourseLinkId" type="text" id="" class="form-control mb-3" placeholder="Course Link">
     			<input id="CourseImgId" type="text" id="" class="form-control mb-3" placeholder="Course Image">
       		</div>
       	</div>
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="CourseAddConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>



@endsection

@section('script')

<script type="text/javascript">



$('#addCourseBtn').click(function() {
    $('#addCourseModal').modal('show');

})





$('#CourseAddConfirmBtn').click(function() {
  var CourseName=$('#CourseNameId').val();
  var CourseDes=$('#CourseDesId').val();
  var CourseFee=$('#CourseFeeId').val();
  var CourseEnroll=$('#CourseEnrollId').val();    
  var CourseClass=$('#CourseClassId').val();
  var CourseLink=$('#CourseLinkId').val();
  var CourseImg=$('#CourseImgId').val();
  
  AddCourse(CourseName,CourseDes,CourseFee,CourseEnroll,CourseClass,CourseLink,CourseImg);
})








//data add korar function code 
function AddCourse(CourseName,CourseDes,CourseFee,CourseEnroll,CourseClass,CourseLink,CourseImg) {

    $('#CourseAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");


    if (CourseName.length == 0) {
        toastr.error('course name can not be empty.');
    } else if (CourseDes == 0) {
        toastr.error('course description can not be empty.');
    } else if (CourseFee == 0) {
        toastr.error('course fee can not be empty.');
    }else if (CourseEnroll == 0) {
        toastr.error('course emroll can not be empty.');
    }else if (CourseClass == 0) {
        toastr.error('course class can not be empty.');
    }else if (CourseLink == 0) {
        toastr.error('course link can not be empty.');
    }else if (CourseImg == 0) {
        toastr.error('course image can not be empty.');
    }
     else {
        axios.post('/CourseaddFinal', {

          course_name: CourseName,
            course_des: CourseDes,
            course_fee: CourseFee,
            course_totalenroll: CourseEnroll,
            course_totalclass: CourseClass,
            course_link: CourseLink,
            course_img: CourseImg,   
            })
            .then(function(response) {
                $('#CourseAddConfirmBtn').html("Save");
                if (response.status == 200) {

                    if (response.data == 1) {
                      $('#addCourseModal').modal('hide');
                      toastr.success('Add Success');
                      CoursesData();
                    } else {
                      $('#addCourseModal').modal('hide');
                      toastr.error('Add Fail');
                       CoursesData();
                    }
                } else {
                  $('#addCourseModal').modal('hide');
                   toastr.error('Something Went Wrong !');
                }

            }).catch(function(error) {
              $('#addCourseModal').modal('hide');
             toastr.error('Something Went Wrong !');

            });

    }


}













CoursesData();

function CoursesData() {
    axios.get('/getCoursesData')
        .then(function(response) {

            if (response.status == 200) {
                $('#CourseMaindiv').removeClass('d-none');
                $('#CourseloaderDiv').addClass('d-none');
                $('#course_table').empty();

                var jsonData = response.data;
                $.each(jsonData, function(i, item) {
                    $('<tr>').html(
                        "<td>" + jsonData[i].course_name + "</td>" +
                        "<td>" + jsonData[i].course_fee + "</td>" +
                        "<td>" + jsonData[i].course_totalenroll + "</td>" +
                        "<td>" + jsonData[i].course_totalclass + "</td>" +

                        "<td><a class='CourseDetailsBtn' data-id=" + jsonData[i].id + " ><i class='fas fa-eye'></i></a></td>" +

                        "<td><a class='CourseUpdateBtn' data-id=" + jsonData[i].id + " ><i class='fas fa-edit'></i></a></td>" +

                        "<td><a class='CourseDeleteBtn' data-id=" + jsonData[i].id + "><i class='fas fa-trash-alt'></i></a></td>"
                    ).appendTo('#course_table');
                });
            }else{
              $('#CoursewrongDiv').removeClass('d-none');
                $('#CourseloaderDiv').addClass('d-none');
            }

        }).catch(function(error) {

        });
}

            


</script>

@endsection
