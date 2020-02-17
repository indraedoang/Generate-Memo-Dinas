<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive">
            <h4 class="m-t-0 header-title"><b>Data <?=get_department_name($dept_id)?></b></h4>
            <p class="text-muted font-13 m-b-30">
                Datatable Request <?=get_department_name($dept_id)?>
            </p>
            	<?php echo $this->table->generate(@$datatable); ?>
        </div>
    </div>
</div>