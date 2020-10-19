<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;1,300;1,400;1,600&display=swap"
          rel="stylesheet">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
</head>
<body>

<div class="container">
    <div class="screen-login">
        <input type="text" name="nickname" placeholder="Enter your nickname">
        <button class="btn-enter">Enter</button>
    </div>

    <div class="screen-chat hide">
        <div class="messages-content">
            <!--Noi dung chat-->
            <ul>

            </ul>
        </div>

        <div class="footer">
            <textarea name="message" class="input-message" cols="30" rows="10"></textarea>
            <div>
                <button class="btn-send-message">Send</button>
            </div>
        </div>
    </div>
</div>

<script>
    const BASE_URL = 'http://127.0.0.1:8000/api/';
    var nickname = '';
    var lastId = 0;

    function loadMessage() {
        $.ajax({
            url: `${BASE_URL}get_messages?last_id=${lastId}`,
            method: 'GET',
            dataType: 'json',
            success: function (resp) {
                console.log(resp);
                let messages = resp.messages.data;
                if (lastId == 0) {
                    for (let i = messages.length - 1; i >= 0; i--) {
                        $('.messages-content ul').append(`<li>
                    <a class="nickname" href="">${messages[i].nickname}</a>
                    <div class="message">${messages[i].message}</div>
                     </li>`);
                    }
                    if (messages.length > 0) {
                        lastId = messages[0].id;
                    }
                } else {
                    for (let i = 0; i < messages.length; i++) {
                        for (let i = messages.length - 1; i >= 0; i--) {
                            $('.messages-content ul').append(`<li>
                    <a class="nickname" href="">${messages[i].nickname}</a>
                    <div class="message">${messages[i].message}</div>
                     </li>`);
                        }
                    }
                    if (messages.length > 0) {
                        lastId = messages[messages.length - 1].id;
                    }
                }//end if

                $('.messages-content')
                    .animate({scrollTop: 9999}, 'slow');
            }
        });
    }

    loadMessage();
    setInterval(function () {
        loadMessage();
    }, 3000);

    $('.btn-enter').click(function () {
        nickname = $('input[name="nickname"]').val();
        if (nickname == null || nickname == '') {
            alert('Please enter your nickname');
            return;
        }

        $('.screen-login').addClass('hide');
        $('.screen-chat').removeClass('hide');
    })

    $('.btn-send-message').click(function () {
        let message = $('.input-message').val();
        if (message != null && message != '') {
            $.ajax({
                url: `${BASE_URL}insert_message`,
                method: 'POST',
                dataType: 'json',
                data: {
                    message,
                    nickname: nickname
                },
                success: function () {
                    $('.input-message').val('');
                    //reload lại message
                }
            })
        }
    });
</script>

<style>
    * {
        font-family: 'Open Sans', sans-serif;
    }

    .container {
        width: 500px;
        margin: 0px auto;
        border: 1px solid #cdcdcd;
    }

    .container > .screen-login {
        height: 500px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .container > .screen-login input[type="text"] {
        padding: 10px;
        border: 1px solid #ccc;
    }

    .container > .screen-login button {
        padding: 10px;
        font-weight: bold;
        font-size: 16px;
        margin-top: 10px;
        background: #ff8c5f;
        border: none;
        color: #ffffff;
    }

    .container > .screen-chat {
        height: 500px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .container > .screen-chat > .messages-content {
        height: 600px;
        overflow-y: scroll;
        width: 100%;
    }

    .container > .screen-chat > .messages-content ul {
        margin: 0px;
        padding: 0px;
    }

    .container > .screen-chat > .messages-content ul li {
        list-style: none;
        margin-left: 10px;
        margin-right: 10px;
        margin-top: 20px;
        background-color: #d3d3d347;
        padding: 10px;
        border-radius: 5px;
    }

    .container > .screen-chat > .messages-content ul li a.nickname {
        text-decoration: none;
        font-weight: bold;
        font-size: 14px;
    }

    .container > .screen-chat > .footer {
        width: 100%;
        padding-top: 10px;
    }

    .container > .screen-chat > .footer textarea {
        width: 95%;
        margin-left: 10px;
        margin-right: 10px;
    }

    .container > .screen-chat > .footer button {
        padding: 10px;
        font-weight: bold;
        font-size: 16px;
        margin-top: 10px;
        background: #ff8c5f;
        border: none;
        color: #ffffff;
        margin-left: 10px;
        margin-bottom: 10px;
    }

    .container > .hide {
        display: none;
    }
</style>
</body>
</html>