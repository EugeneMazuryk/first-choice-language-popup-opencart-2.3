<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-bestseller" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
                <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
            <h1><?php echo $heading_title; ?></h1>
            <ul class="breadcrumb">
				<?php foreach ($breadcrumbs as $breadcrumb) { ?>
                    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
				<?php } ?>
            </ul>
        </div>
    </div>
    <div class="container-fluid">
		<?php if ($error_warning) { ?>
            <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
		<?php } ?>
		<?php if ($success) { ?>
            <div class="alert alert-success alert-dismissible"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
		<?php } ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
            </div>
            <div class="panel-body">
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-bestseller" class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-default-language"><span data-toggle="tooltip" title="<?php echo $help_default_language; ?>"><?php echo $entry_default_language; ?></span></label>
                        <div class="col-sm-10">
                            <select name="module_fclp_wl_default_language" id="input-default-language" class="form-control">
								<?php if (0 == $module_fclp_wl_default_language) { ?>
                                    <option value="0" selected="selected"><?php echo $text_select_default_language; ?></option>
								<?php } else { ?>
                                    <option value="0"><?php echo $text_select_default_language; ?></option>
								<?php } ?>
								<?php foreach ($module_fclp_wl_languages as $language) { ?>
									<?php if ($language['code'] == $module_fclp_wl_default_language) { ?>
                                        <option value="<?php echo $language['code']; ?>" selected="selected"><?php echo $language['name']; ?></option>
									<?php } else { ?>
                                        <option value="<?php echo $language['code']; ?>"><?php echo $language['name']; ?></option>
									<?php } ?>
								<?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-status"><?php echo $entry_status; ?></label>
                        <div class="col-sm-10">
                            <select name="module_fclp_wl_status" id="input-status" class="form-control">
								<?php if ($module_fclp_wl_status) { ?>
                                    <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                                    <option value="0"><?php echo $text_disabled; ?></option>
								<?php } else { ?>
                                    <option value="1"><?php echo $text_enabled; ?></option>
                                    <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
								<?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2">
                            <div class="pull-right">
                                <a href="<?php echo $fclp_wl_clear_session; ?>" data-toggle="tooltip" class="btn btn-default">
                                    <i class="fa fa-refresh"> <?php echo $entry_clear_session; ?></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php echo $footer; ?>
