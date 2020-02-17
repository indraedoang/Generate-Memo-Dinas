<div class="row">
	<div class="col-lg-12">
		<div class="card-box">
			<div style="border-bottom: solid 1px  #E3E3E3;">
				<h4 class="m-t-0 header-title"><b>User</b></h4>
				<p class="text-muted font-13 m-b-30"> Create User dan Login  </p>
			</div>	
			<br>
	        		<form class="form-horizontal" role="form"  data-parsley-validate novalidate method="post" action="<?=base_url()?>admin/Generator/user">
						
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">NIK*</label>
							<div class="col-sm-10">
								<input type="name" required name="nik" class="form-control" id="inputEmail3" placeholder="NIK">
							</div>
						</div>

						<div class="form-group" style="margin-top: -2%;">
							<label for="inputEmail3" class="col-sm-2 control-label">Full Name*</label>
							<div class="col-sm-10">
								<input type="name" required name="full_name" class="form-control" id="inputEmail3" placeholder="Full Name">
							</div>
						</div>

						<div class="form-group" style="margin-top: -2%;">
							<label for="inputEmail3" class="col-sm-2 control-label">Department*</label>
							<div class="col-sm-10">
								<select class="form-control select2" name="department_id">
									<option>  Select Department  </option>	
									<?php foreach ($department as $key => $value) { ?>
										<option value="<?=$value->id?>">   <?=$key+1;?>. <?=$value->department ?></option>
									<?php } ?>							
								</select>
							</div>
						</div>

						<div class="form-group" style="margin-top: -2%;">
							<label for="inputEmail3" class="col-sm-2 control-label">Extension*</label>
							<div class="col-sm-10">
								<input type="name" required name="extension"  class="form-control" id="inputEmail3" placeholder="Extension">
							</div>
						</div>
						<div class="form-group" style="margin-top: -2%;">
							<label for="inputEmail3" class="col-sm-2 control-label">Username *</label>
							<div class="col-sm-10">
								<input type="name" required name="username"  class="form-control" id="inputEmail3" placeholder="Username">
							</div>
						</div>

						<div class="form-group" style="margin-top: -2%;">
							<label for="inputEmail3" class="col-sm-2 control-label">Password *</label>
							<div class="col-sm-10">
								<input type="Password" required name="password"  class="form-control" id="inputEmail3" placeholder="Password">
							</div>
						</div>

						<div class="form-group" style="margin-top: -2%;">
							<label for="inputEmail3" class="col-sm-2 control-label">Role *</label>
							<div class="col-sm-10">
								<select class="form-control select2" name="role_id">
									<option>  Select Role  </option>	
									<?php foreach ($role as $key => $value) { ?>
										<option value=" <?=$value->id?>" > <?=$key+1;?>. <?=$value->name ?></option>
									<?php } ?>							
								</select>
							</div>
						</div>


						
						<div class="form-group text-right m-b-0">
							<button class="btn btn-primary waves-effect waves-light" type="submit">
								Submit
							</button>
							<button type="reset" class="btn btn-default waves-effect waves-light m-l-5">
								Reset
							</button>
						</div>

					</form>            

		</div>
	</div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive">
            <h4 class="m-t-0 header-title"><b>Data USer</b></h4>
            <p class="text-muted font-13 m-b-30">
                Datatable User  
            </p>
            	<?php echo $this->table->generate(@$datatable); ?>
        </div>
    </div>
</div>
