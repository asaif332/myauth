<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>Login</title>
  </head>
  <body>
    <div class="container-fluid py-5">
        <?php if(!empty($this->session->flashdata())) :?>
        <div class="alert alert-info alert-dismissible fade show" style="position:absolute;top:0;right:0;" role="alert">
        <?php foreach($this->session->flashdata() as $error) :?>
            <?=$error;?> <br>
        <?php endforeach;?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php endif; ?>
        <div class="card col-md-8 mx-auto p-0">
            <div class="card-header text-center"><h4>Login</h4></div>
            <div class="card-body">
                <?=form_open('auth/login_user');?>

                    <div class="form-group">
                        <label for="name">Email:</label>
                        <input type="email" name="email" value="<?=set_value('email');?>" class="form-control">
                        <span class="text-danger"><?=form_error('email');?></span>
                    </div>

                    <div class="form-group">
                    <label for="pass">Password</label>
                    <input type="password" name="password" class="form-control">
                    <span class="text-danger"><?=form_error('password');?></span>
                    </div>

                     <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" name="remember_me">
                        <label class="form-check-label" for="exampleCheck1">remember me</label>
                    </div>

                    <div class="text-center">
                        <input type="submit" name="submit" value="Login" class="btn btn-info">
                        <a href="<?=base_url();?>auth/forgot_password" class="float-right btn btn-sm">forgot password </a>
                        <a href="<?=base_url();?>auth/register" class="float-right btn btn-sm"> register</a>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>