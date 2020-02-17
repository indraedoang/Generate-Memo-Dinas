<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <div id="sidebar-menu">
            <ul>  
                <li class="has_sub">
                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-home"></i> <span>Dashboard </span></a> 
                </li>

                <!-- administrator -->
                <?php if(flow_user("role_id") == "1"):?>  
                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-database"></i> <span>Master </span> <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled">
                            <li><a href="<?=base_url()?>admin/Generator/index/department">Department</a></li>
                            <li><a href="<?=base_url()?>admin/Generator/user">User</a></li>
                        </ul>
                    </li>
                <?php elseif(flow_user("role_id") == "2"):?>
                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-shopping-cart"></i> <span>Request </span> <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled">
                            <li><a href="<?=base_url()?>request/mega/index/<?=fogit("1")?>">Memo Dinas</a></li>
                             <li><a href="<?=base_url()?>request/mega/index/<?=fogit("2")?>">Surat Keluar</a></li>
                        </ul>
                    </li>
                <?php endif;?>
                <li class="has_sub">
                    <a href="<?=base_url()?>auth/change_password" class="waves-effect"><i class="fa fa-key"></i> <span>Change Password </span></a> 
                 <li class="has_sub">
                    <a href="<?=base_url()?>auth/logout" class="waves-effect"><i class="ti-power-off m-r-10 text-danger"></i> <span>Logout </span></a> 
                </li>

            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
    <div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">