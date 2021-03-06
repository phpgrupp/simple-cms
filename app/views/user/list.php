<?php require VIEW_ROOT . '/user/templates/header.php'; ?>
<?php require VIEW_ROOT . '/user/templates/sidenav.php'; ?>
<div id="page-content-wrapper">
    <div class="container mt-3">
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <?php if(isset($_GET['success'])): ?>
                <div class="alert alert-success" role="alert">Post was successfully
                    <?php echo $_GET['success'] . '!'; ?>
                </div>
                <?php endif ?>
                <?php if (isset($_GET['access'])): ?>
                <div class="alert alert-danger" role="alert">Acess was
                    <?php echo $_GET['access'] . '.';?>
                </div>
                <?php endif ?>
                <h2>Your posts</h2>
                <?php if (empty($userPosts)): ?>
                <p>No posts at the moment.</p>
                <?php else: ?>
                <table class="table table-responsive table-hover">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Created</th>
                            <th>Updated</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($userPosts as $post): ?>
                        <tr scope="row">
                            <td>
                                <a href="<?php echo BASE_URL; ?>/page.php?post_id=<?php echo $post['post_id']; ?>">
                                    <?php echo escape($post['title']); ?>
                                </a>
                            </td>
                            <td>
                                <?php echo $post['created']; ?>
                            </td>
                            <td>
                                <?php if (isset($post['updated'])) echo $post['updated']; ?>
                            </td>
                            <td><a class="btn btn-info" role="button" href="<?php echo BASE_URL; ?>/user/edit.php?post_id=<?php echo $post['post_id']; ?>">Edit</a></td>
                            <td>
                                <button class="btn btn-info delete-btn pointer" data-name="<?php echo $post['title'];?>" data-link="<?php echo BASE_URL . '/user/delete.php?post_id=' . $post['post_id']; ?>">Delete</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php endif; ?>
        <a href="#menu-toggle" class="btn btn-default" id="menu-toggle"><i class="fa fa-arrows-h" aria-hidden="true"></i> Toggle menu</a>
    </div>
</div>
</div>
<!--script for sweet-alert popups on delete-->
<script src="<?php echo BASE_URL?>/assets/js/delete-alerts.js"></script>
<?php require VIEW_ROOT . '/user/templates/footer.php'; ?>
