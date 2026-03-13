<div class="modal fade" id="ratingModal">

<div class="modal-dialog">

<div class="modal-content">

<div class="modal-header">
<h5 class="modal-title">Rate Business</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>

<div class="modal-body">

<form id="ratingForm">

<input type="hidden" name="business_id" id="business_id">

<div class="form-group">
<label>Name</label>
<input type="text" name="name" class="form-control">
</div>

<div class="form-group">
<label>Email</label>
<input type="email" name="email" class="form-control">
</div>

<div class="form-group">
<label>Phone</label>
<input type="text" name="phone" class="form-control">
</div>

<div class="form-group">
<label>Rating</label>
<div id="ratingStar"></div>
<input type="hidden" name="rating" id="rating">
</div>

</form>

</div>

<div class="modal-footer">

<button type="button" class="btn btn-secondary" data-dismiss="modal">
Close
</button>

<button type="button" class="btn btn-success" onclick="submitRating()">
Submit
</button>

</div>

</div>

</div>

</div>

</div>