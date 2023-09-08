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
<h2>About Us</h2>
</div>
<div class="pull-right mb-2">
<a class="btn btn-success" onClick="add()" href="javascript:void(0)"> Create New</a>
</div>
</div>
</div>
@if ($message = Session::get('success'))
<div class="alert alert-success">
<p>{{ $message }}</p>
</div>
@endif
<div class="card-body">
<table class="table table-bordered" id="about">
<thead>
<tr>
<th>Id</th>
<th>title</th>
<th>content</th>
<th>Action</th>
</tr>
</thead>
</table>
</div>
</div>
<!-- boostrap company model -->
<div class="modal fade" id="about-modal" aria-hidden="true">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<h4 class="modal-title" id="AboutModal"></h4>
</div>
<div class="modal-body">
<form action="javascript:void(0)" id="AboutForm" name="AboutForm" class="form-horizontal" method="POST">
<input type="hidden" name="id" id="id">
<div class="form-group">
<label for="title" class="col-sm-2 control-label">Title</label>
<div class="col-sm-12">
<input type="text" class="form-control" id="title" name="title" placeholder="Enter title" maxlength="50" required="">
</div>
</div>  
<div class="form-group">
<label for="content" class="col-sm-2 control-label">Content</label>
<div class="col-sm-12">
{{-- <input type="text" class="form-control" id="content" name="content" placeholder="Enter content" maxlength="50" required=""> --}}
<textarea class="form-control" name="content" id="content" placeholder="Enter content" required cols="30" rows="10"></textarea>
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
<script type="text/javascript">
$(document).ready( function () {
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }

});
$('#about').DataTable({
processing: true,
serverSide: true,
ajax: "{{ url('About') }}",
columns: [
{ data: 'id', name: 'id' },
{ data: 'title', name: 'title' },
{ data: 'content', name: 'content' },
{data: 'action', name: 'action', orderable: false},
],
order: [[0, 'desc']]
});
});
function add(){
$('#AboutForm').trigger("reset");
$('#AboutModal').html("Add About");
$('#about-modal').modal('show');
$('#id').val('');
}   
function editFunc(id){
$.ajax({
type:"POST",
url: "{{ url('edit-about') }}",
data: { id: id },
dataType: 'json',
success: function(res){
$('#AboutModal').html("Edit About");
$('#about-modal').modal('show');
$('#id').val(res.id);
$('#title').val(res.title);
$('#content').val(res.content);
}
});
}  
function deleteFunc(id){
if (confirm("Delete Record?") == true) {
var id = id;
// ajax
$.ajax({
type:"POST",
url: "{{ url('delete-about') }}",
data: { id: id },
dataType: 'json',
success: function(res){
var oTable = $('#about').dataTable();
oTable.fnDraw(false);
}
});
}
}
$('#AboutForm').submit(function(e) {
e.preventDefault();
var formData = new FormData(this);
$.ajax({
type:'POST',
url: "{{ url('store-about')}}",
data: formData,
cache:false,
contentType: false,
processData: false,
success: (data) => {
$("#about-modal").modal('hide');
var oTable = $('#about').dataTable();
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