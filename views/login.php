<?php

?>

<div class="container">
    <h3 class="alert-danger"><?=$error?></h3>
<form method="post">
    <div class="form-group row">
        <label for="username" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
            <input name="username" type="text" class="form-control-plaintext" id="username" placeholder="Login..." />
        </div>
    </div>
    <div class="form-group row">
        <label for="password" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-10">
            <input name="password" type="password" class="form-control" id="password" placeholder="Password...">
        </div>
    </div>
    <button class="btn btn-success" type="submit">Login</button>
</form>
</div>
