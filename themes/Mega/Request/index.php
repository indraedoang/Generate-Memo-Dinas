<div class="row">
	<div class="col-lg-12">
		<div class="card-box">
			<h4 class="m-t-0 header-title"><b>Form Request <?=$masterModul;?></b></h4>
			<p class="text-muted font-13 m-b-30">
                Generate <?=$masterModul;?> 
            </p>
                        
			<form action="<?=base_url();?>request/mega/index/<?=fogit($modul)?>" method="post" data-parsley-validate novalidate  enctype="multipart/form-data">
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Perihal*</label>
					<div class="col-sm-10">
						<input type="name" class="form-control" required="" placeholder="Perihal" name="perihal">
					</div>
				</div>	
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Tujuan*</label>
					<div class="col-sm-10">
						<input type="name" class="form-control" required="" placeholder="Tujuan" name="tujuan">
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Keterangan*</label>
					<div class="col-sm-10">
						<textarea type="name" class="form-control" required="" placeholder="Keterangan" name="keterangan" ></textarea>
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">Document*</label>
					<div class="col-sm-10">
						<input type="file" class="form-control" placeholder="Perihal" name="dokument">
						  <p>Only Extension File(.pdf, .docx, .jpg, .png, .xlsx, .csv, .xls)</p>
					</div>
				</div>
				<br>
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