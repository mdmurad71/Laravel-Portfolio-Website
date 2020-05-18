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



<!-- Modal -->
<div class="modal fade" id="courseDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content p-3 text-center">
      <h5 class="mt-3">Do you to delete?</h5>
      <h6 id="courseDeleteId" class="mt-3"></h6>

      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No</button>
        <button  id="coursedeleteConfirm" type="button" class="btn btn-sm btn-danger">Yes</button>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="updateCourseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Update Course</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body  text-center">
      
      <h5 id="courseEditId" class="mt-4 d-none">  </h5>

       <div id="courseEditForm" class="container d-none">

        <div class="row">
          <div class="col-md-6">
          <input id="CourseNameUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Name">
          <input id="CourseDesUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Description">
          <input id="CourseFeeUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Fee">
          <input id="CourseEnrollUpdateId" type="text" id="" class="form-control mb-3" placeholder="Total Enroll">
          </div>
          <div class="col-md-6">
          <input id="CourseClassUpdateId" type="text" id="" class="form-control mb-3" placeholder="Total Class">      
          <input id="CourseLinkUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Link">
          <input id="CourseImgUpdateId" type="text" id="" class="form-control mb-3" placeholder="Course Image">
          </div>
        </div>
       </div>

          <img id="courseEditLoader" class="loading-icon m-5" src="{{asset('images/loader.svg')}}">
          <h5 id="courseEditWrong" class="d-none">Something Went Wrong !</h5>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Cancel</button>
        <button  id="CourseUpdateConfirmBtn" type="button" class="btn  btn-sm  btn-danger">Save</button>
      </div>
    </div>
  </div>
</div>






@endsection

@section('script')

<script type="text/javascript">


//Course data edit korar 1st function code 
function updateConfirmBtn(detailsId) {
    axios.post('/CourseDeatails', {
            id: detailsId
        })
        .then(function(response) {
            if (response.status == 200) {
                $('#courseEditForm').removeClass('d-none');
                $('#courseEditLoader').addClass('d-none');

                var jsonData = response.data;
                $('#CourseNameUpdateId').val(jsonData[0].course_name);
                $('#CourseDesUpdateId').val(jsonData[0].course_desc);
                $('#CourseFeeUpdateId').val(jsonData[0].course_fee);
                $('#CourseEnrollUpdateId').val(jsonData[0].course_totalenroll);
                $('#CourseClassUpdateId').val(jsonData[0].course_totalclass);
                $('#CourseLinkUpdateId').val(jsonData[0].course_link);
                $('#CourseImgUpdateId').val(jsonData[0].course_image);
            } else {
                $('#courseEditLoader').addClass('d-none');
                $('#courseEditWrong').removeClass('d-none');
            }

        }).catch(function(error) {
            $('#courseEditLoader').addClass('d-none');
            $('#courseEditWrong').removeClass('d-none');
        });

}


//update ar modal ar save button ar jonno click function
$('#CourseUpdateConfirmBtn').click(function() {
    var courseID = $('#courseEditId').html();
    var courseName = $('#CourseNameUpdateId').val();
    var courseDesc = $('#CourseDesUpdateId').val();
    var courseFee = $('#CourseFeeUpdateId').val();
    var courseEnroll = $('#CourseEnrollUpdateId').val();
    var courseClass = $('#CourseClassUpdateId').val();
    var courseLink = $('#CourseLinkUpdateId').val();
    var courseImage = $('#CourseImgUpdateId').val();
    CourseUpdate(courseID, courseName, courseDesc, courseFee, courseEnroll, courseClass, courseLink, courseImage);

})


//data update korar function code

function CourseUpdate(courseID, courseName, courseDesc, courseFee, courseEnroll, courseClass, courseLink, courseImage) {

    if (courseName.length == 0) {
        toastr.error('Course Name is Empty !');
    } else if (courseDesc.length == 0) {
        toastr.error('Course Description is Empty !');
    } else if (courseFee.length == 0) {
        toastr.error('Course Fee is Empty !');
    } else if (courseEnroll.length == 0) {
        toastr.error('Course Enroll is Empty !');
    } else if (courseClass.length == 0) {
        toastr.error('Course Class is Empty !');
    } else if (courseLink.length == 0) {
        toastr.error('Course Link is Empty !');
    } else if (courseImage.length == 0) {
        toastr.error('Course Image is Empty !');
    } else {

        $('#CourseUpdateConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>")
        axios.post('/Courseupdate', {
            id: courseID,
            course_name: courseName,
            course_desc: courseDesc,
            course_fee: courseFee,
            course_totalenroll: courseEnroll,
            course_totalclass: courseClass,
            course_link: courseLink,
            course_image: courseImage,

        }).then(function(response) {
            $('#CourseUpdateConfirmBtn').html("Save");
            if (response.status == 200) {
                if (response.data == 1) {
                    $('#updateCourseModal').modal('hide');
                    toastr.success('Update success');
                    CoursesData();
                } else {
                    $('#updateCourseModal').modal('hide');
                    toastr.error('Update fail');
                    CoursesData();
                }
            } else {
                $('#updateCourseModal').modal('hide');
                toastr.error('Something went wrong');

            }
        }).catch(function(error) {
            $('#updateCourseModal').modal('hide');
            toastr.error('Something went wrong');
        });


    }

}




//delete ar modal ar yes button ar jonno click function
$('#coursedeleteConfirm').click(function() {
    var id = $('#courseDeleteId').html();
    CourseDeleteConfirm(id);

})


function CourseDeleteConfirm(courseDeleteId) {
    $('#coursedeleteConfirm').html("<div class='spinner-border spinner-border-sm' role='status'></div>");
    axios.post('/CourseDelete', {
            id: courseDeleteId
        })
        .then(function(response) {
            $('#coursedeleteConfirm').html("Yes");
            if (response.data == 1) {
                $('#courseDeleteModal').modal('hide');
                toastr.success('Delete Success.');
                CoursesData();
            } else {
                $('#courseDeleteModal').modal('hide');
                toastr.error('Delete Failed .');
                CoursesData();
            }
        }).catch(function(error) {
            $('#courseDeleteModal').modal('hide');
            toastr.error('something went wrong.');

        });


}




//add course portion
$('#addCourseBtn').click(function() {
    $('#addCourseModal').modal('show');

})

$('#CourseAddConfirmBtn').click(function() {
    var CourseName = $('#CourseNameId').val();
    var CourseDesc = $('#CourseDesId').val();
    var CourseFee = $('#CourseFeeId').val();
    var CourseEnroll = $('#CourseEnrollId').val();
    var CourseClass = $('#CourseClassId').val();
    var CourseLink = $('#CourseLinkId').val();
    var CourseImage = $('#CourseImgId').val();

    AddCourse(CourseName, CourseDesc, CourseFee, CourseEnroll, CourseClass, CourseLink, CourseImage);
})




//data add korar function code 
function AddCourse(CourseName, CourseDesc, CourseFee, CourseEnroll, CourseClass, CourseLink, CourseImage) {

    $('#CourseAddConfirmBtn').html("<div class='spinner-border spinner-border-sm' role='status'></div>");


    if (CourseName.length == 0) {
        toastr.error('course name can not be empty.');
    } else if (CourseDesc == 0) {
        toastr.error('course description can not be empty.');
    } else if (CourseFee == 0) {
        toastr.error('course fee can not be empty.');
    } else if (CourseEnroll == 0) {
        toastr.error('course emroll can not be empty.');
    } else if (CourseClass == 0) {
        toastr.error('course class can not be empty.');
    } else if (CourseLink == 0) {
        toastr.error('course link can not be empty.');
    } else if (CourseImage == 0) {
        toastr.error('course image can not be empty.');
    } else {
        axios.post('/CourseAddFinal', {

                course_name: CourseName,
                course_desc: CourseDesc,
                course_fee: CourseFee,
                course_totalenroll: CourseEnroll,
                course_totalclass: CourseClass,
                course_link: CourseLink,
                course_image: CourseImage,
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




//course ar data get korar function

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


                $('.CourseDeleteBtn').click(function() {

                    var id = $(this).data('id');
                    $('#courseDeleteId').html(id);
                    $('#courseDeleteModal').modal('show');
                })


                $('.CourseUpdateBtn').click(function() {

                    var id = $(this).data('id');
                    updateConfirmBtn(id);
                    $('#courseEditId').html(id);
                    $('#updateCourseModal').modal('show');
                })




            } else {
                $('#CoursewrongDiv').removeClass('d-none');
                $('#CourseloaderDiv').addClass('d-none');
            }

        }).catch(function(error) {

        });
}
            


</script>

@endsection
