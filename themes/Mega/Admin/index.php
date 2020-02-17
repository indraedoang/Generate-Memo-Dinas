<div class="row">
	<div class="col-lg-12">
		<div class="card-box">
			<div style="border-bottom: solid 1px  #E3E3E3;">
				<h4 class="m-t-0 header-title"><b>Department</b></h4>
				<!-- <p class="text-muted font-13 m-b-30"> Form Request Memo Dinas dan Surat Keluar</p> -->
			</div>	
			<br>
	        		<form class="form-horizontal" role="form"  data-parsley-validate novalidate method="post" action="<?=base_url()?>admin/generator/index/department/<?= empty($id) ? '' : fogit($id)?>">
						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Nama*</label>
							<div class="col-sm-10">
								<input type="name" required name="nama" value="<?php echo empty($MasterData->department) ? '' : $MasterData->department ?>" class="form-control" id="inputEmail3" placeholder="Nama">
							</div>
						</div>

						<div class="form-group">
							<label for="inputEmail3" class="col-sm-2 control-label">Format no MD*</label>
							<div class="col-sm-10">
								<input type="name" required name="singkatan" value="<?php echo empty($MasterData->singkatan) ? '' : $MasterData->singkatan ?>" class="form-control" id="inputEmail3" placeholder="Format no MD">
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
            <h4 class="m-t-0 header-title"><b>Data Department</b></h4>
            <p class="text-muted font-13 m-b-30">
                Datatable Depatment 
            </p>
            	<?php echo $this->table->generate(@$datatable); ?>
        </div>
    </div>
</div>
