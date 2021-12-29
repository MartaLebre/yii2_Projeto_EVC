<?php
/* @var $content string */

use yii\bootstrap4\Breadcrumbs;
?>
<style>
    .content-wrapper{
        background-color: #fff;
    }
</style>

<div class="content-wrapper">
    <!-- Main content -->
    <br>
    <div class="content">
        <?= $content ?><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    
    <?php /*
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">
                        <?php
                        if(!is_null($this->title)){
                            echo \yii\helpers\Html::encode($this->title);
                        }
                        else{
                            echo \yii\helpers\Inflector::camelize($this->context->id);
                        }
                        ?>
                    </h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    */?>
</div>