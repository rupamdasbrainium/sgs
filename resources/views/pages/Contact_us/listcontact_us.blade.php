<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('../Dashboard') }}
        </h2>
    </x-slot>
<div class="container mt-2">
<div class="row">
<div class="col-lg-12 margin-tb">
<div class="pull-left">
<h2>Contact Us</h2>
</div>
<div class="pull-right mb-2">
<a class="btn btn-success" onClick="add()" href="javascript:void(0)"> Create Contact</a>
</div>
</div>
</div>
@if ($message = Session::get('success'))
<div class="alert alert-success">
<p>{{ $message }}</p>
</div>
@endif
<div class="card-body">
<table class="table table-bordered" id="contact">
<thead>
<tr>
<th>Id</th>
<th>Name</th>
<th>Email</th>
<th>Comment</th>
<th>Action</th>
</tr>
</thead>
</table>
</div>
</div>
<!-- boostrap company model -->
<div class="modal fade" id="contact-modal" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="ContactModal"></h4>
</div>
<div class="modal-body">
<form action="javascript:void(0)" id="ContactForm" name="ContactForm" class="form-horizontal" method="POST">
<input type="hidden" name="id" id="id">
<div class="form-group">
<label for="title" class="col-sm-2 control-label">Name</label>
<div class="col-sm-12">
<input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" maxlength="50" required="">
</div>
</div>  
<div class="form-group">
<label for="content" class="col-sm-2 control-label">Email</label>
<div class="col-sm-12">
<input type="text" class="form-control" id="email" name="email" placeholder="Enter Your Email" maxlength="50" required="">
</div>
<div class="form-group">
<label for="content" class="col-sm-2 control-label">Content</label>
<div class="col-sm-12">
     <textarea name="comment" id="editor">
        &lt;p&gt;This is some sample content.&lt;/p&gt;
    </textarea>
</div>
</div>
<div class="col-sm-offset-2 col-sm-10">
<button type="submit" class="btn btn-primary" id="btn-save">Save changes
</button>
</div>
</form>
</div>
<div class="modal-footer">
</div>
</div>
</div>
</div>
<!-- end bootstrap model -->
</body>
<script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .then( editor => {        editor.ui.view.editable.editableElement.style.height = '300px';     } )
            .catch( error => {
                console.error( error );
            } );
    </script>
<script type="text/javascript">
$(document).ready( function () {
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }

});
$('#contact').DataTable({
processing: true,
serverSide: true,
ajax: "{{ url('Contact') }}",
columns: [
{ data: 'id', name: 'id' },
{ data: 'name', name: 'name' },
{ data: 'email', name: 'email' },
{ data: 'comment', name: 'comment' },
{data: 'action', name: 'action', orderable: false},
],
order: [[0, 'desc']]
});
});
function add(){
$('#ContactForm').trigger("reset");
$('#ContactModal').html("Add Contact");
$('#contact-modal').modal('show');
$('#id').val('');
}   
function editFunc(id){
$.ajax({
type:"POST",
url: "{{ url('edit-contact') }}",
data: { id: id },
dataType: 'json',
success: function(res){
$('#ContactModal').html("Edit Contact");
$('#contact-modal').modal('show');
$('#id').val(res.id);
$('#name').val(res.name);
$('#email').val(res.email);
$('#comment').val(res.comment);
}
});
}  
function deleteFunc(id){
if (confirm("Delete Record?") == true) {
var id = id;
// ajax
$.ajax({
type:"POST",
url: "{{ url('delete-contact') }}",
data: { id: id },
dataType: 'json',
success: function(res){
var oTable = $('#contact').dataTable();
oTable.fnDraw(false);
}
});
}
}
$('#ContactForm').submit(function(e) {
e.preventDefault();
var formData = new FormData(this);
$.ajax({
type:'POST',
url: "{{ url('store-contact')}}",
data: formData,
cache:false,
contentType: false,
processData: false,
success: (data) => {
$("#contact-modal").modal('hide');
var oTable = $('#contact').dataTable();
oTable.fnDraw(false);
$("#btn-save").html('Submit');
$("#btn-save"). attr("disabled", false);
},
error: function(data){
console.log(data);
}
});
});</script>    
</x-app-layout>