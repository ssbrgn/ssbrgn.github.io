<!DOCTYPE html>
<form action="new_pass.php" method="post">
    <fieldset>
        <div class="form-group">
            <input autocomplete="off" autofocus class="form-control" name="old_password" placeholder="Old Password" type="password"/>
        </div>

        <div class="form-group">
            <input autocomplete="off" autofocus class="form-control" name="new_pass" placeholder="New Password" type="password"/>
        </div>
        <div class="form-group">
            <input class="form-control" name="conf_newpass" placeholder="New Password Again" type="password"/>
        </div>
        <div class="form-group">
            <button class="btn btn-default" type="submit">
                <span aria-hidden="true" class="glyphicon glyphicon-log-in"></span>
                Change
            </button>
        </div>
    </fieldset>
</form>
<div>
    or <a href="index.php">Cancel</a>
</div>