@extends('admin::layouts.content')

@section('page_title')
    {{ __('About Us') }}
@stop
<!-- @section('content-wrapper') -->
@push('css')
    <style>
      th.sub_heading {
    width: 50%;
}

.bg-danger {
    background-color: black !important;
}

.btn-light {
    background-color: black !important;
    border: 1px solid white !important;
    /* border-color: #f8f9fa; */
}

button.btn.btn-light:hover {
    color: white !important;
}

select#locale {
    height: 30px !important;
    width: 100% !important;
}

select#locales {
    height: 30px !important;
    width: 100% !important;
}
    </style>
@endpush

  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css' />
  <link rel='stylesheet'
    href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css' />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.css" />

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js'></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
  <!--  -->
  @section('content-wrapper')
  <!--  -->
 <!-- <div class="content full-page dashboard">
   <div class="page-header">
     <div class="page-title">
      <h1>About Us Content</h1>
     </div>

     <div class="page-action">

     </div>
   </div> 

  <div class="page-content"> -->

  <!--  -->
  <accordian :title="'{{ 'About Us Contenet' }}'" :active="true">
    <div slot="body">
  <div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add About Us Content </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="#" method="POST" id="add_employee_form" enctype="multipart/form-data">
        @csrf
        <div class="modal-body p-4 bg-light">
          <div class="row">
             <div class="col-lg">
              <label for="section">Section</label>
              <input type="text" name="section" class="form-control" placeholder="section">
            </div> 
            <div class="col-lg">
              <label for="heading">Heading</label>
              <input type="text" name="heading" class="form-control" placeholder="Heading">
            </div> 
          </div>
          <!-- <div class="my-2">
            <label for="sub_heading">Sub Heading</label>
            <input type="text" name="sub_heading" class="form-control" placeholder="sub_heading">
          </div> -->
          <div class="my-2">
            <label for="content">Content</label>
            <textarea id="content" name="content" rows="4" cols="50" class="form-control"></textarea>
          </div>
          <!-- <div class="my-2 upload-img">
            <label for="avatar">Upload Images</label>
            <input type="file" name="avatars[]" class="form-control" multiple="multiple">
             </div> -->
          <!--  -->

          <div class="col-lg">
            <label for="locale">Choose a locale:</label>
            <select name="locale" id="locale">
              <option value="en">en</option>
              <option value="fr">fr</option>
            </select>
          </div>

          <!--  -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="add_employee_btns" class="btn btn-primary">Add</button>
        </div>
      </form>
    </div>
  </div>
</div>
  
  <!--  -->

<!--  -->

<div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="exampleModalLabel"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Content</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('update') }}" method="POST" id="edit_employee_form" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="emp_id" id="emp_id">
        <input type="hidden" name="emp_avatar" id="emp_avatar">
        <div class="modal-body p-4 bg-light">
          <div class="row">
            <div class="col-lg">
            <label for="section">Section</label>
              <input type="text" name="section" class="form-control" id="section" placeholder="section">
            </div>
            <div class="col-lg">
            <label for="heading">Heading</label>
              <input type="text" name="heading" class="form-control" id="heading" placeholder="Heading">
            </div>
          </div>
          <!-- <div class="my-2">
          <label for="sub_heading">Sub Heading</label>
            <input type="text" name="sub_heading" class="form-control" id="sub_heading" placeholder="sub_heading">
          </div> -->
          <div class="my-2">
          <label for="content">Content</label>
            <textarea id="contents" name="content" rows="4" cols="50" class="form-control"></textarea>
          </div>
          <!-- <div class="my-2">
            <label for="avatar">Select Avatar</label>
            <input type="file" name="avatars" class="form-control">
          </div>
          <div class="mt-2" id="avatar">
          </div> -->
          <div class="col-lg">
            <label for="locale">Choose a locale:</label>
            <select name="locales" id="locales">
              <option value="en">en</option>
              <option value="fr">fr</option>
            </select>
          </div>
        </div> 
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" id="edit_employee_btn" class="btn btn-success">Update Employee</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!--  -->

<!-- -->
  <div class="container">
    <div class="row my-5">
      <div class="col-lg-12">
        <div class="card shadow">
          <div class="card-header bg-danger d-flex justify-content-between align-items-center">
            <h3 class="text-light">About Us Content</h3>
            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addEmployeeModal"><i
                class="bi-plus-circle me-2"></i>Add Section</button>
          </div>
          <div class="card-body" id="show_all_employees">
            <h1 class="text-center text-secondary my-5">Loading...</h1>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end accordin -->
  </div>
</accordian>
  <!--  -->
<!--  -->
  <!-- </div>
</div> -->
@stop
<!-- -->
@push('scripts')
<script>
  
    $(function() {

     
      
//add

       $("#add_employee_form").submit(function(e) {
        e.preventDefault();
        $(document).ajaxStart(function(){
            Swal.fire(
                'Added!',
                'Data Added Successfully!',
                'success'
              )
            location.reload();
           });
        const fd = new FormData(this);
        $("#add_employee_btns").text('Adding...');
        $.ajax({
          url: '{{ route('stores') }}',
          method: 'post',
          data: fd,
          cache: false,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function(response) {
            
            fetchAllEmployeess();
            
            $("#add_employee_btns").text('Add Employee');
            $("#add_employee_form")[0].reset();
            $("#addEmployeeModal").modal('hide');
          }
        });
      });
// 
    
// 

// fecth all data
fetchAllEmployeess();

function fetchAllEmployeess() {
  $.ajax({
    url: '{{ route('fetchAlls') }}',
    method: 'get',
    success: function(response) {
      $("#show_all_employees").html(response);
      
    }
  });
}


// delete employee ajax request
$(document).on('click', '.deleteIcon', function(e) {
        e.preventDefault();
        $(document).ajaxStart(function(){
            Swal.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
                )
            location.reload();
});
        let id = $(this).attr('id');
        let csrf = '{{ csrf_token() }}';
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: '{{ route('deletes') }}',
              method: 'delete',
              data: {
                id: id,
                _token: csrf
              },
              success: function(response) {
                console.log(response);
                fetchAllEmployeess();
              }
            });
          }
        })
      });

      // edit employee ajax request
      $(document).on('click', '.editIcon', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        $.ajax({
          url: '{{ route('edits') }}',
          method: 'get',
          data: {
            id: id,
            _token: '{{ csrf_token() }}'
          },
          success: function(response) {
            $("#section").val(response.section);
            $("#heading").val(response.heading);
            $("#sub_heading").val(response.sub_heading);
            $("#contents").val(response.content);
            $("#locales").val(response.locale);
            $("#avatar").html(
              `<img src="http://151.80.237.29/public/storage/public/images/${response.images}" width="100" class="img-fluid img-thumbnail">`);
            $("#emp_id").val(response.id);
            $("#emp_avatar").val(response.avatar);
          }
        });
      });


      // update employee ajax request
      $("#edit_employee_form").submit(function(e) {
        e.preventDefault();
        $(document).ajaxComplete(function(){
            Swal.fire(
                'Updated!',
                'Employee Updated Successfully!',
                'success'
              )
        location.reload();
      });
        const fd = new FormData(this);
        $("#edit_employee_btn").text('Updating...');
        $.ajax({
          url: '{{ route('updates') }}',
          method: 'post',
          data: fd,
          cache: false,
          contentType: false,
          processData: false,
          dataType: 'json',
          success: function(response) {
            
              fetchAllEmployeess();
            
            $("#edit_employee_btn").text('Update Employee');
            $("#edit_employee_form")[0].reset();
            $("#editEmployeeModal").modal('hide');
          }
        });
      });
});
</script>
<!--  -->


@endpush
