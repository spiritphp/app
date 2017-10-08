<div class="container">
    <div class="row">
        <div class="col-md-6 ml-md-auto mr-md-auto">

            <h1 class="mb-4">Sign In</h1>

            <? if (count(errors())): ?>
                <div class="alert alert-danger">
                    <?= errors()->join(); ?>
                </div>
            <? endif; ?>

            <form action="" method="POST">
                <?=inputToken();?>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="<?= old('email'); ?>" required class="form-control" />
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" required class="form-control"/>
                </div>
                <div class="form-group row">
                    <div class="col">
                        <label class="form-check-label">
                            <input type="checkbox" value="1" <?= old('is_remember') ? 'checked' : ''; ?>
                                   name="is_remember"
                                   class="form-check-input">
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

            <div class="text-center">
                <a href="<?=route('recovery');?>">Forgot Your Password?</a>
            </div>

        </div>
    </div>
</div>
