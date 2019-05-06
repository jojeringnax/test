
<div class="container">
    <form method="post">
        <div class="form-group">
            <label for="email">Email address</label>
            <input name="email"  type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="username">Username*</label>
            <input name="username" type="text" class="form-control" id="username" placeholder="Username">
        </div>
        <div class="form-group">
            <label for="password">Password*</label>
            <input type="password" name="password" class="form-control" id="password" />
        </div>
        <div class="form-group form-check">
            <input name="admin" type="checkbox" class="form-check-input" id="admin">
            <label class="form-check-label" for="admin">Admin*</label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
