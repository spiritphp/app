<div class="container">
    <div class="row">
        <div class="col-md-6 ml-md-auto mr-md-auto">

            <h1 class="mb-4">Reset Password</h1>

            <? if (count(errors())): ?>
                <div class="alert alert-danger">
                    <?= errors()->join(); ?>
                </div>
            <? elseif (session('success')): ?>
                <div class="alert alert-success">
                    We have sent you an email with instruction
                </div>
            <? endif; ?>

            <? if (!session('success')): ?>
                <form action="" method="POST">
                    <?=inputToken();?>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" value="" required class="form-control" />
                    </div>
                    <div class="form-group text-right">
                        <button class="btn btn-success">
                            Send reset instruction
                        </button>
                    </div>
                </form>
            <? endif; ?>

        </div>
    </div>
</div>
