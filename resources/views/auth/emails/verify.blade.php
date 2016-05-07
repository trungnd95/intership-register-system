<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Xác nhận đăng kí</h2>

        <div>
        Cám ơn bạn đã đăng kí thành viên tại hệ thống đăng kí thực tập của <a href="fit.uet.vnu.edu.vn">fit.uet.vnu.edu.vn</a>
        Để xác nhận bạn thực sự là thành viên. Vui lòng click vào link bên dưới. 
            {{ URL::to('register/verify/' . $confirmation_code) }}.<br/>
        </div>

    </body>
</html>