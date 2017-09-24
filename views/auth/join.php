<div class="container">
    <div class="row">
        <div class="col-md-6 ml-md-auto mr-md-auto">

            <h1 class="mb-4">Sign Up</h1>

            <? if ($error): ?>
                <div class="alert alert-danger">
                    <?= implode('<br/>', $error); ?>
                </div>
            <? endif; ?>

            <form action="" method="POST">
                <?=inputToken();?>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="<?= $old['email']; ?>" required class="form-control" />
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" required class="form-control"/>
                </div>
                <div class="form-group text-right">
                    <button class="btn btn-success">
                        Sign Up
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
