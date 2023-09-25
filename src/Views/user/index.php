<div class="offset-2 col-6">
    <?php
    if(isset($data->error)){ ?>
        <div class="alert alert-danger" role="alert">
            <?=$data->error?>
        </div>
        <?php
    }
?>

    <h1>Create your account</h1>
    <form action="/register" method="POST">
        <div class="mb-3 mt-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
        </div>
        <div class="mb-3">
            <label for="pwd" class="form-label">Password:</label>
            <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address:</label>
            <input type="text" class="form-control" id="pwd" placeholder="Confirm password" name="address">
        </div>
        <div class="form-check mb-3">
            <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="remember"> Remember me
            </label>
        </div>
        <button type="submit" class="btn btn-primary">Sign up</button>
    </form>
</div>