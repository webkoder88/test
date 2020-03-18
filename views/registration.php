<div class="wrapper-page">
    <div class=" card-box">
        <div class="panel-heading">
            <h3 class="text-center"><?php echo _('Sign Up to '); ?><strong class="text-custom">Peligrim</strong> </h3>
        </div>

        <div class="panel-body">
            <?php echo language_widget(); ?>
            <form class="form-horizontal m-t-20" method="post" action="/registration">
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

                <div class="form-group ">
                    <div class="col-xs-12">
                        <input class="form-control" type="text" required placeholder="<?php echo _('Name'); ?>" name="name">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" type="password" required placeholder="<?php echo _('Password'); ?>" name="password" minlength="6" pattern="[0-9a-zA-Z]{6,}"
                               title="Please enter correct password min length 6, numbers, charsets">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <div class="checkbox checkbox-primary">
                            <input id="checkbox-signup" type="checkbox" checked="checked" required>
                            <label for="checkbox-signup"><?php echo _('I accept'); ?><a href="#"><?php echo _('Terms and Conditions'); ?></a></label>
                        </div>
                    </div>
                </div>

                <div class="form-group text-center m-t-40">
                    <div class="col-xs-12">
                        <button class="btn btn-pink btn-block text-uppercase waves-effect waves-light" type="submit" name="registration" value="Registration">
                            <?php echo _('Register'); ?>
                        </button>
                    </div>
                </div>

            </form>

        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 text-center">
            <p>
                <?php echo _('Already have account ?'); ?><a href="/login" class="text-primary m-l-5"><b><?php echo _('Sign In'); ?></b></a>
            </p>
        </div>
    </div>

</div>
