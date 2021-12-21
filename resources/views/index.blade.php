@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html>

<body>
 
<div class="container">
    
    <div class="row">
    
    <div class="theme-switch-wrapper">
        <label class="theme-switch" for="checkbox">
            <input type="checkbox" id="checkbox" />
            <div class="slider round"></div>
        </label>
      <label style="margin-left: 10px;">Select Mode</label>
    </div><br> 
        <div class="col-12" >
          <a href="javascript:void(0)" class="btn btn-success mb-2" id="create-new-post">Add post</a> 
          
          <table class="table table-bordered" id="laravel_crud">
           <thead style="color: burlywood">
              <tr>
                 <th>Id</th>
                 <th>Name</th>
                 <th>Email</th>
                 <td colspan="2">Action</td>
              </tr>
           </thead>
           <tbody id="posts-crud" style="color:blue">
              @foreach($posts as $post)
              <tr id="post_id_{{ $post->id }}">
    
                 <td >{{ $post->id  }}</td>
                 <td>{{ $post->title }}</td>
                 <td>{{ $post->body }}</td>
                 <td><a href="javascript:void(0)" id="edit-post" data-id="{{ $post->id }}" class="btn btn-info ">Edit</a></td>
                 <td>
                  <a href="javascript:void(0)" id="delete-post" data-id="{{ $post->id }}" class="btn btn-danger delete-post">Delete</a></td>
              </tr>
              @endforeach
           </tbody>
          </table>
          
       </div> 
    </div>
</div>
<div class="modal fade" id="ajax-crud-modal" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title" id="postCrudModal"></h4>
    </div>
    <div class="modal-body">
        <form id="postForm" name="postForm" class="form-horizontal" style="color: blue">
           <input type="hidden" name="post_id" id="post_id">
            <div class="form-group" >
                <label for="name" class="col-sm-2 control-label">Title</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="title" name="title" value="" required="">
                </div>
            </div>
 
            <div class="form-group">
                <label class="col-sm-2 control-label">Body</label>
                <div class="col-sm-12">
                    <input class="form-control" id="body" name="body" value="" required="">
                </div>
            </div>
            <div class="col-sm-offset-2 col-sm-10">
             <button type="submit" class="btn btn-primary" id="btn-save" value="create">Save
             </button>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        
    </div>
</div>
</div>
</div>
</body>
</html>
<script>
  $(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#create-new-post').click(function () {
        $('#btn-save').val("create-post");
        $('#postForm').trigger("reset");
        $('#postCrudModal').html("Add New post");
        $('#ajax-crud-modal').modal('show');
    });
 
    $('body').on('click', '#edit-post', function () {
      var post_id = $(this).data('id');
      $.post('edit/'+post_id+'edit', function (data) {
         $('#postCrudModal').html("Edit post");
          $('#btn-save').val("edit-post");
          $('#ajax-crud-modal').modal('show');
          $('#post_id').val(data.id);
          $('#title').val(data.title);
          $('#body').val(data.body);  
      });
   });

    $('body').on('click', '#delete-post', function (e) {
        
        if(!confirm("Do you really want to do this?")) {
       return false;
     }

    e.preventDefault();
    // var id = $(this).data("id");
    var post_id = $(this).data("id");
    // var id = $(this).attr('data-id');
    var token = $("meta[name='csrf-token']").attr("content");
    var url = e.target;
    
        
        $.ajax({
            type: "DELETE",
            url: "{{ url('delete')}}"+'/'+post_id,
            success: function (data) {
                $("#post_id_" + post_id).remove();
            },
            error: function (data) {
                console.log('Error:', data);
                
            }
        });
    });   
});
 
 if ($("#postForm").length > 0) {
      $("#postForm").validate({
 
     submitHandler: function(form) {
      var actionType = $('#btn-save').val();
      $('#btn-save').html('Sending..');
      
      $.ajax({
          data: $('#postForm').serialize(),
          url: "{{ route('store') }}",
          type: "POST",
          dataType: 'json',
          success: function (data) {
              var post = '<tr id="post_id_' + data.id + '"><td>' + data.id + '</td><td>' + data.title + '</td><td>' + data.body + '</td>';
              post += '<td><a href="javascript:void(0)" id="edit-post" data-id="' + data.id + '" class="btn btn-info">Edit</a></td>';
              post += '<td><a href="javascript:void(0)" id="delete-post" data-id="' + data.id + '" class="btn btn-danger delete-post">Delete</a></td></tr>';
               
              
              if (actionType == "create-post") {
                  $('#posts-crud').prepend(post);
              } else {
                  $("#post_id_" + data.id).replaceWith(post);
              }
 
              $('#postForm').trigger("reset");
              $('#ajax-crud-modal').modal('hide');
              $('#btn-save').html('Save Changes');
              
          },
          error: function (data) {
              console.log('Error:', data);
              $('#btn-save').html('Save Changes');
          }
      });
    }
  });
}
   
  
</script>
@endsection