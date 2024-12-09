<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="<?= base_url('bootstrap/css/editprofilestyle.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            flex: 1;
            padding: 20px;
            position: relative;
            background: url('<?= base_url("images/tekkw.png") ?>') no-repeat center center;
            background-size: cover; /* Memenuhi seluruh area */
            z-index: 1; /* Membawa konten ke atas */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Profile</h1>
        <div class="profile-edit-form">
            <!-- Flash Messages -->
            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <p><?= esc(session()->getFlashdata('success')) ?></p>
                </div>
            <?php endif; ?>

            <?php if (session()->getFlashdata('errors')): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach (session()->getFlashdata('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <!-- Form Edit Profile -->
            <form action="<?= base_url('/profile/update') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" value="<?= esc($username) ?>" placeholder="Your username">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?= esc($email) ?>" placeholder="Your email">
                </div>

                <div class="form-group">
                    <label for="bio">Bio</label>
                    <textarea id="bio" name="bio" rows="4" placeholder="Tell us about yourself..."><?= esc($bio) ?></textarea>
                </div>

                <div class="form-group">
                    <label for="profile_picture">Profile Picture</label>
                    <input type="file" id="profile_picture" name="profile_picture" accept="image/*">
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn save-btn"><i class="fas fa-save"></i> Save Changes</button>
                    <a href="<?= base_url('/profile') ?>" class="btn cancel-btn"><i class="fas fa-times"></i> Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>