<?php
if (count($data->items) > 0) {
    foreach ($data->items as $product) {
        require __DIR__ . '/../templates/cartViewOrdered.php';
    }
    ?>
    <div class="row mt-5">
        <div class="col-12 text-end">
            <a class="btn btn-outline-success mt-auto" href="/checkout">Checkout</a>
        </div>
    </div>
    <?php
} else {    ?>
    <div class="row mt-5">
        <div class="col-12 text-center">
            <h2>You have not ordered yet.</h2>
        </div>
    </div>
    <?php
}
?>