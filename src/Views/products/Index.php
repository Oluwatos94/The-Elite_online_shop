<div class="offset-e col-6">
    <?php if(isset($data->error)) { ?>
    <div class="alert alert-danger" role="alert">
        <?=$data->error ?>
    </div>
    <?php
    }
    ?>

    <?php if(isset($data->success)) { ?>
        <div class="alert alert-success" role="alert">
            <?=$data->success ?>
        </div>
        <?php
    }
    require_once __DIR__ . "/productPage.php";
    ?>
</div>
<div class="col-6">
<?php require_once __DIR__ . "/moreProducts.php";?>
</div>
