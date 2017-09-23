<div class="container">
    <div class="row">
        <div class="col-md-6 ml-md-auto mr-md-auto">

            <h1 class="mb-4">Sign in</h1>

            <? if ($error): ?>
                <div class="alert alert-danger">
                    <?= $error; ?>
                </div>
            <? endif; ?>

            <form action="" method="POST">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="<?= $old['email']; ?>" required class="form-control" />
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" required class="form-control"/>
                </div>
                <div class="form-group row">
                    <div class="col">
                        <label class="form-check-label">
                            <input type="checkbox" value="1" name="is_remember" class="form-check-input">
                            Remember me
                        </label>
                    </div>
                    <div class="col text-right">
                        <button class="btn btn-success">
                            Login
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
