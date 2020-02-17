<div class="row">
	<div class="col-lg-12">
		<div class="card-box">
			<h4 class="m-t-0 header-title"><b>change password</b></h4>
			<p class="text-muted font-13 m-b-30">
            </p>
                        
			<form action="<?=base_url();?>admin/Generator/change_password/<?=fogit($id_user)?>" method="post" data-parsley-validate novalidate  enctype="multipart/form-data">

				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Password new*</label>
					<div class="col-sm-10">
						<input type="password" class="form-control" placeholder="Password new" name="password">
					</div>
				</div>	
				
				
				<div class="form-group text-right m-b-0">
					<button class="btn btn-primary waves-effect waves-light" type="submit">
						Submit
					</button>
					<button type="reset" class="btn btn-default waves-effect waves-light m-l-5">
						Cancel
					</button>
				</div>
				
			</form>
		</div>
	</div>
</div>