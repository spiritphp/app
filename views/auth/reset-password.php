<div class="container">
    <div class="row">
        <div class="col-md-6 ml-md-auto mr-md-auto">

            <h1 class="mb-4">Change password</h1>

            <? if ($error): ?>
                <div class="alert alert-danger">
                    <?= $error; ?>
                </div>
            <? endif; ?>

            <form action="" method="POST">
                <?=inputToken();?>
                <div class="form-group">
                    <label>New password</label>
                    <input type="password" name="password" value="" required class="form-control" />
                </div>
                <div class="form-group">
                    <label>Confirm password</label>
                    <input type="password" name="password_confirm" value="" required class="form-control" />
                </div>
                <div class="form-group text-right">
                    <button class="btn btn-success">
                        Change
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
