<?php

require dirname(__DIR__).'/require/header.view.php';
?>

<div class="main-container ace-save-state" id="main-container">
    <script type="text/javascript">
        try{ace.settings.loadState('main-container')}catch(e){}
    </script>
    <?php 
    require dirname(__DIR__).'/require/leftbar.view.php';
    ?>
    <div class="main-content">
        <div class="main-content-inner">
            <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                <ul class="breadcrumb">
                    <li>
                        <i class="ace-icon fa fa-home home-icon"></i>
                        <a href="">Home</a>
                    </li>
                    <li class="active">Dashboard</li>
                </ul><!-- /.breadcrumb -->

            </div>

            <div class="page-content">
                <div class="ace-settings-container" id="ace-settings-container">
                    <div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
                        <i class="ace-icon fa fa-cog bigger-130"></i>
                    </div>

                    <div class="ace-settings-box clearfix" id="ace-settings-box">
                        <div class="pull-left width-50">
                            <div class="ace-settings-item">
                                <div class="pull-left">
                                    <select id="skin-colorpicker" class="hide">
                                        <option data-skin="no-skin" value="#438EB9">#438EB9</option>
                                        <option data-skin="skin-1" value="#222A2D">#222A2D</option>
                                        <option data-skin="skin-2" value="#C6487E">#C6487E</option>
                                        <option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
                                    </select>
                                </div>
                                <span>&nbsp; Choose Skin</span>
                            </div>

              

                            <div class="ace-settings-item">
                                <input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-add-container" autocomplete="off" />
                                <label class="lbl" for="ace-settings-add-container">
                                Inside
                                <b>.container</b>
                                </label>
                            </div>
                        </div><!-- /.pull-left -->

                        <div class="pull-left width-50">
                          
                            <div class="ace-settings-item">
                                <div class="pull-left">
                                    <select id="skin-colorpicker" class="hide">
                                        <option data-skin="no-skin" value="#438EB9">#438EB9</option>
                                        <option data-skin="skin-1" value="#222A2D">#222A2D</option>
                                        <option data-skin="skin-2" value="#C6487E">#C6487E</option>
                                        <option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
                                    </select>
                                </div>
                                <span>&nbsp; Choose Skin</span>
                            </div>
                            <div class="ace-settings-item">
                                <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-compact" autocomplete="off" />
                                <label class="lbl" for="ace-settings-compact"> Compact Sidebar</label>
                            </div>

                            <div class="ace-settings-item">
                                <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-highlight" autocomplete="off" />
                                <label class="lbl" for="ace-settings-highlight"> Alt. Active Item</label>
                            </div>
                        </div><!-- /.pull-left -->
                    </div><!-- /.ace-settings-box -->
                </div><!-- /.ace-settings-container -->

                <div class="page-header">
                    <h1 style="font-weight: bold">
                        Products
                    </h1>
                </div><!-- /.page-header -->

                <div class="row">
                    <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                        <div class="row">
                            <div class="col-xs-12">
                                <a href="/admin/products/add" style="margin-bottom: 10px;" class="btn btn-success fa fa-plus-square fa-lg" title=""> Add Product</a>
                                <?php 
                                    if(isset($_SESSION['msg'])){
                                ?>
                                <div class="alert alert-success" role="alert">
                                    <strong>
                                        <?php 
                                            echo $_SESSION['msg']; 
                                            unset($_SESSION['msg']);
                                        ?>        
                                    </strong> 
                                </div>
                                <?php } ?>
                                <table id="simple-table" class="table  table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                Id
                                            </th>
                                            <th class="text-center">
                                                Product Info
                                            </th>
                                            <th class="text-center">
                                                Color
                                            </th>
                                            <th class="text-center">
                                                Size
                                            </th>
                                            <th class="text-center">
                                                Quantity
                                            </th>
                                            <th class="text-center">
                                                Action
                                            </th>
                                            
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php 
                                            foreach ($products as $item) {
                                                $id=$item->id;
                                                $product_info_id=$item->product_info_id;
                                                $color_id=$item->color_id;
                                                $size_id=$item->size_id;
                                                $quantity=$item->quantity;
                                        ?>    
                                        <tr>
                                            <td class="text-center">
                                                <?php echo $id; ?>
                                            </td>
        
                                            <td class="text-center">
                                                <?php 
                                                    foreach ($product_info as $key => $item) {
                                                        $id_info=$item->id;
                                                        $name=$item->name;
                                                        if($product_info_id==$id_info){
                                                            echo $name;
                                                        }
                                                    }
                                                ?>
                                                
                                            </td>
                                            
                                            <td class="text-center">
                                                <?php 
                                                    foreach ($colors as $key => $item) {
                                                        $name=$item->name;
                                                        if($item->id==$color_id){
                                                            echo $name;
                                                        }
                                                    }
                                            
                                                ?>
                                            </td>

                                            <td class="text-center">
                                                <?php 
                                                    foreach ($sizes as $key => $item) {
                                                        $name=$item->size;
                                                        if($item->id==$size_id){
                                                            echo $name;
                                                        }
                                                    }
                                            
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo $quantity; ?>
                                            </td>
                                            <td class="text-center">
                                                <div class="hidden-sm hidden-xs btn-group">
                                                    <a class="btn btn-xs btn-info" href="/admin/products/edit/<?php echo $id; ?>">
                                                        <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                    </a>
                        
                                                    <a class="btn btn-xs btn-danger" onclick="return confirm('Are you sure to delete ? ');" href="/admin/products/delete/<?php echo $id; ?>">
                                                        <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                    </a>
                                                       
                                                </div>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- /.row -->

                        <div class="row text-center cover-pagination">
                            <?php 
                              echo $paging;
                            ?>
                        </div>
                  <!-- PAGE CONTENT ENDS -->
                    
                    </div><!-- /.row -->
                </div><!-- /.page-content -->
            </div>
        </div><!-- /.main-content -->
    </div>
</div>
<?php 
require dirname(__DIR__).'/require/footer.view.php';
?>