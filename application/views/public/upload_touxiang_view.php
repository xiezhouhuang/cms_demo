</html>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="A complete example of Cropper.">
  <meta name="keywords" content="HTML, CSS, JS, JavaScript, jQuery, PHP, image cropping, web development">
  <meta name="author" content="Fengyuan Chen">
  <title>修改头像</title>
  <link href="/public/extends/touxiang/assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="/public/extends/touxiang/dist/cropper.min.css" rel="stylesheet">
  <link href="/public/extends/touxiang/css/main.css" rel="stylesheet">
</head>
<body>
  <div class="container" id="crop-avatar">
   <!-- Cropping modal -->
    <div id="avatar-modal" aria-labelledby="avatar-modal-label" role="dialog" tabindex="-1">
      <div >
        <div >
          <form class="avatar-form" action="/cropAvatar/go_do" enctype="multipart/form-data" method="post">
            <div class="modal-body">
              <div class="avatar-body">

                <!-- Upload image and data -->
                <div class="avatar-upload">
                  <input class="avatar-src" name="avatar_src" type="hidden">
                  <input class="avatar-data" name="avatar_data" type="hidden">
                  <label for="avatarInput">图片上传</label>
                  <input class="avatar-input" id="avatarInput" name="avatar_file" type="file">
                </div>

                <!-- Crop and preview -->
                <div class="row">
                  <div class="col-md-9">
                    <div class="avatar-wrapper"></div>
                  </div>
                  <div class="col-md-3">
                    <div class="avatar-preview preview-lg"></div>
                    <div class="avatar-preview preview-md"></div>
                    <div class="avatar-preview preview-sm"></div>
                  </div>
                </div>

                <div class="row avatar-btns">
                  <div class="col-offset-md-9 col-md-3">
                    <button class="btn btn-primary btn-block avatar-save" type="submit">完成</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- <div class="modal-footer">
              <button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
            </div> -->
          </form>
        </div>
      </div>
    </div><!-- /.modal -->

    <!-- Loading state -->
    <div class="loading" aria-label="Loading" role="img" tabindex="-1"></div>
  </div>

  <script src="/public/extends/touxiang/assets/js/jquery.min.js"></script>
  <script src="/public/extends/touxiang/assets/js/bootstrap.min.js"></script>
  <script src="/public/extends/touxiang/dist/cropper.min.js"></script>
  <script src="/public/extends/touxiang/js/main.js"></script>
</body>
</html>
