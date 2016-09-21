<?php use yii\helpers\Url;

$this->title = 'Companies'; ?>

<div class="row-fluid sortable">
	<div class="box span12">
		<a href="<?= Url::to(['company/create']) ?>" class="btn btn-primary">Create company</a>
		<div class="box-header" data-original-title>
			<h2><i class="icon-building"></i><span class="break"></span>Companies</h2>
			<div class="box-icon">
<!--				<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>-->
				<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
				<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
			</div>
		</div>
		<div class="box-content">
			<table class="table table-striped table-bordered bootstrap-datatable datatable">
				<thead>
				<tr>
					<th>Name</th>
					<th>Description</th>
					<th>Logo</th>
					<th>Actions</th>
				</tr>
				</thead>
				<tbody>
					<tr>
						<td>Company 1</td>
						<td class="center">Company 1 description</td>
						<td class="center">Image</td>
						<td class="center">
							<a class="btn btn-success" href="#">
								<i class="halflings-icon white zoom-in"></i>
							</a>
							<a class="btn btn-info" href="#">
								<i class="halflings-icon white edit"></i>
							</a>
							<a class="btn btn-danger" href="#">
								<i class="halflings-icon white trash"></i>
							</a>
						</td>
				</tr>
				</tbody>
			</table>
		</div>
	</div><!--/span-->

</div>