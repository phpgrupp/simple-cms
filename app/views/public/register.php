<?php require VIEW_ROOT . '/public/templates/header.php'; ?>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-sm-10">
                <h2 class="text-center">Create account</h2>
                <form method="POST" action="<?php BASE_URL . '/public/register.php'?>" class="d-flex mt-2" autocomplete="off">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="username">Choose a username</label>
                            <input type="text" name="username" class="form-control" maxlength="20" placeholder="johnny_cool" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Choose a password</label>
                            <input type="password" name="password" class="form-control" maxlength="20" required>
                        </div>
                        <div class="form-group">
                            <label for="firstname">Firstname</label>
                            <input type="text" name="firstname" class="form-control" maxlength="30" placeholder="Johnny" required>
                        </div>
                        <div class="form-group">
                            <label for="lastname">Lastname</label>
                            <input type="text" name="lastname" class="form-control" maxlength="30" placeholder="Rotten" required>
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" name="email" class="form-control" maxlength="30" placeholder="johnny@example.com" required>
                        </div>
                        <div class="form-group">
                            <label for="profession">Profession</label>
                            <input type="text" name="profession" class="form-control" maxlength="30" placeholder="What do you do?">
                        </div>
                        <div class="form-group">
                            <label for="picture">Profile pic URL</label>
                            <input type="text" name="picture" class="form-control" maxlength="200" placeholder="http://www.example/image.jpg">
                        </div>
                        <div class="form-group">
                            <label for="description">Presentation</label>
                            <textarea name="description" class="form-control" rows="3" maxlength="200" placeholder="Tell us something about yourself!"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" id="register-user-button">
                        <div>
                    </div>
                </form>
                </div>
                </div>
            </div>


<?php require VIEW_ROOT . '/public/templates/footer.php'; ?>
