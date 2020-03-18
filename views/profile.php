<!-- Start content -->
<div class="content">
    <div class="container">

        <!-- Page-Title -->
        <div class="row">
            <div class="col-sm-12 m-b-15">
                <h4 class="page-title"><?php echo _('Profile'); ?></h4>
                <?php echo language_widget(); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
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
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card-box">
                    <h4 class="m-t-0 header-title"><b><?php echo _('Upload photo'); ?></b></h4>
                    <div class="row">
                        <div class="col-md-12">
                            <form class="form-horizontal" role="form" method="post" action="/profile" enctype="multipart/form-data" >
                                <div class="col-sm-4">
                                    <img src="<?php echo get_photo($user['id']) ?>" alt="image" class="img-responsive img-rounded" width="200">
                                </div>
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <div class="col-md-10">
                                            <input type="file" class="filestyle" name="photo" data-buttonname="btn-white">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success waves-effect waves-light" name="upload-photo" value="Upload photo"><?php echo _('Upload'); ?></button>
                                </div>
                                <input type="hidden" name="id" value="<?php echo $user['id']?:'' ?>">

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card-box">
                    <h4 class="m-t-0 header-title"><b><?php echo _('Edit profile data'); ?></b></h4>
                    <div class="row">
                        <div class="col-md-12">
                            <form class="form-horizontal" role="form" method="post" action="/profile">
                                <input type="hidden" name="id" value="<?php echo $user['id']?:'' ?>">
                                <div class="form-group">
                                    <label class="col-md-2 control-label"><?php echo _('Name'); ?></label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" value="<?php echo $user['name']?:'' ?>" required name="name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="example-email">Email</label>
                                    <div class="col-md-10">
                                        <input type="email" id="example-email" class="form-control" name="email" value="<?php echo $user['email']?:'' ?>">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success waves-effect waves-light" name="update" value="Update"><?php echo _('Update'); ?></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card-box">
                    <h4 class="m-t-0 header-title"><b><?php echo _('Change password'); ?></b></h4>
                    <div class="row">
                        <div class="col-md-12">
                            <form class="form-horizontal" role="form" method="post" action="/profile">
                                <input type="hidden" name="id" value="<?php echo $user['id']?:'' ?>">
                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="old-password"><?php echo _('Old password'); ?></label>
                                    <div class="col-md-10">
                                        <input type="password" id="old-password" class="form-control" name="old-password" minlength="6">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="password"><?php echo _('New password'); ?></label>
                                    <div class="col-md-10">
                                        <input type="password" id="password" class="form-control" name="password" minlength="6" pattern="[0-9a-zA-Z]{6,}"
                                               title="<?php echo _('Please enter correct password min length 6, numbers, charsets'); ?>">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success waves-effect waves-light" name="change-password" value="Update"><?php echo _('Update'); ?></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div> <!-- container -->

</div> <!-- content -->
