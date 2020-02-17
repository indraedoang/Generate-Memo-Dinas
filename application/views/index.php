<div class="row">
    <!-- administrator -->
    <?php if(flow_user("role_id") == "1"):?>
        <?php foreach ($dashboard_admin as $key => $value) { ?>
            <div class="col-md-6 col-lg-3">
                <a href="<?=base_url()?>request/mega/adminDasfboard/<?=fogit($value->dept_id);?>">
                    <div class="widget-bg-color-icon card-box">
                        <div class="bg-icon bg-icon-info pull-left">
                            <i class="fa  fa-file-text-o text-info"></i>
                        </div>
                        <div class="text-right">
                            <h3 class="text-dark"><b class="counter"><?=$value->jumlah;?></b></h3>
                            <p class="text-muted"><?=get_department_name($value->dept_id)?></p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        <?php } ?>
    <!-- user  -->
    <?php elseif(flow_user("role_id") == "2"):?>
        <div class="col-md-6 col-lg-3">
            <a href="<?=base_url()?>request/mega/memodinas/<?=fogit('1');?>">
                <div class="widget-bg-color-icon card-box">
                    <div class="bg-icon bg-icon-info pull-left">
                        <i class="fa  fa-file-text-o text-info"></i>
                    </div>
                    <div class="text-right">
                        <h3 class="text-dark"><b class="counter"><?=$memodinas;?></b></h3>
                        <p class="text-muted">Memo Dinas	</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>

        <div class="col-md-6 col-lg-3">
            <a href="<?=base_url()?>request/mega/memodinas/<?=fogit('2');?>">
                <div class="widget-bg-color-icon card-box">
                    <div class="bg-icon bg-icon-custom pull-left">
                        <i class="fa  fa-file-text text-custom"></i>
                    </div>
                    <div class="text-right">
                        <h3 class="text-dark"><b class="counter"><?=$suratKeluar?></b></h3>
                        <p class="text-muted">Surat Keluar</p>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card-box table-responsive">
                <h4 class="m-t-0 header-title"><b>Data REquest</b></h4>
                <p class="text-muted font-13 m-b-30">
                    Datatable Request 
                </p>
                    <?php echo $this->table->generate(@$datatable); ?>
            </div>
        </div>
    </div>
    <?php endif;?>
