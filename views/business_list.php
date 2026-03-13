<!DOCTYPE html>
<html>

<head>

<title>Business Listing</title>
<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

<link rel="stylesheet" href="assets/css/raty.css">

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>


<script src="assets/js/raty.js"></script>

<script src="assets/js/business.js"></script>

</head>

<body>

<div class="container mt-5">

<h2>Business Listing</h2>

<button
class="btn btn-primary mb-3"
data-toggle="modal"
data-target="#businessModal"
onclick="resetForm()">
Add Business
</button>

<table class="table table-bordered">

<thead>

<tr>

<th>ID</th>
<th>Name</th>
<th>Address</th>
<th>Phone</th>
<th>Email</th>
<th>Average Rating</th>
<th>Actions</th>
<th>Rating</th>

</tr>

</thead>

<tbody id="businessTable">

<?php foreach($businesses as $b): ?>

<tr>

<td><?= $b['id'] ?></td>

<td><?= $b['name'] ?></td>

<td><?= $b['address'] ?></td>

<td><?= $b['phone'] ?></td>

<td><?= $b['email'] ?></td>

<td class="avg-rating-value" data-id="<?= $b['id'] ?>"><?= $b['avg_rating'] ?? 0 ?></td>


<td>

<button
class="btn btn-warning btn-sm"
onclick="editBusiness(
'<?= $b['id'] ?>',
'<?= $b['name'] ?>',
'<?= $b['address'] ?>',
'<?= $b['phone'] ?>',
'<?= $b['email'] ?>'
)">
Edit
</button>

<button
class="btn btn-danger btn-sm"
onclick="deleteBusiness(<?= $b['id'] ?>)">
Delete
</button>

</td>
<td>
<div class="business-rating"
     data-id="<?= $b['id'] ?>"
     data-score="<?= $b['avg_rating'] ?>">
</div>
</td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

</div>

<!-- ADD / EDIT BUSINESS MODAL -->

<div class="modal fade" id="businessModal">

<div class="modal-dialog">

<div class="modal-content">

<div class="modal-header">

<h5 class="modal-title">
Add / Edit Business
</h5>

<button class="close"
data-dismiss="modal">
&times;
</button>

</div>

<div class="modal-body">

<form id="businessForm">

<input type="hidden"
name="id"
id="id">

<div class="form-group">

<label>Name</label>

<input
type="text"
class="form-control"
name="name"
id="name"
required>

</div>

<div class="form-group">

<label>Address</label>

<input
type="text"
class="form-control"
name="address"
id="address">

</div>

<div class="form-group">

<label>Phone</label>

<input
type="text"
class="form-control"
name="phone"
id="phone">

</div>

<div class="form-group">

<label>Email</label>

<input
type="email"
class="form-control"
name="email"
id="email">

</div>

</form>

</div>

<div class="modal-footer">

<button
class="btn btn-success"
onclick="addEditBusiness()">
Save
</button>

<button
class="btn btn-secondary"
data-dismiss="modal">
Close
</button>

</div>

</div>

</div>

</div>

<?php require __DIR__ . '/rating_modal.php'; ?>
</body>

</html>