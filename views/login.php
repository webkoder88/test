<div class="wrapper-page">
    <div class=" card-box">
        <div class="panel-heading">
            <h3 class="text-center"><?php echo _('Sign In to'); ?><strong class="text-custom"> Peligrim</strong> </h3>
        </div>
        <div class="panel-body">
            <?php echo language_widget(); ?>
            <form class="form-horizontal m-t-20" method="post" action="/login">
                <?php if($_REQUEST['error']): ?>
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $_REQUEST['error']['message']; ?>
                    </div>
                <?php endif; ?>
                <?php if($_REQUEST['success']): ?>
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <?php echo $_REQUEST['success']['message']; ?>
                    </div>
                <?php endif; ?>
                <div class="form-group ">
                    <div class="col-xs-12">
                        <input class="form-control" type="email" required placeholder="Email" name="email">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" type="password" required placeholder="<?php echo _('Password'); ?>" name="password">
                    </div>
                </div>

                <div class="form-group text-center m-t-40">
                    <div class="col-xs-12">
                        <button class="btn btn-pink btn-block text-uppercase waves-effect waves-light" type="submit" name="login" value="Login">
                            <?php echo _('Log In'); ?>
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 text-center">
            <p><?php echo _('Don\'t have an account?'); ?> <a href="/registration" class="text-primary m-l-5"><b><?php echo _('Sign Up'); ?></b></a></p>
        </div>
    </div>

</div>
