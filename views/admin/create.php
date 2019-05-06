<div class="container">
    <form method="post">
        <div class="form-group">
            <label for="email">Email address</label>
            <input name="email" value="" type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" />
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input name="username" type="text" value="" class="form-control" id="username" placeholder="Username" />
        </div>
        <div class="form-group">
            <label for="content">Example textarea</label>
            <textarea name="content" class="form-control" id="content" rows="3"></textarea>
        </div>
        <?php if (\jojer\core\App::$isAdmin) { ?>
        <div class="form-group form-check">
            <input name="status" type="checkbox" class="form-check-input" id="status" />
            <label class="form-check-label" for="status">Check me out</label>
        </div>
        <?php } ?>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>