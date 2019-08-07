<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: relative;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
        <link href="/css/app.css" rel="stylesheet" media="screen">
        <script src="/js/jquery.min.js"></script>
    </head>
    <body>
        <div class="container">
            
            <div class="top-right links">
                    <a href="{{ url('/home') }}">BroadSmS</a>
            </div>
            <br/>
            <div class="content">
                <div class="card">
                    <div class="card-head">
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                menu
                            </div>
                            <div class="col-9">
                                <div class="well">
                                    <form>
                                        <div class="form-group">
                                            <label>Sender ID:</label>
                                            <input type="text" id="sender" class="form-control"><br>
                                            <font color="red"></font>
                                        </div>
                                        <div class="form-group">
                                            <label>Recipients:</label>
                                            <textarea class="form-control loadable" placeholder="enter a comma separated numbers" id="recipient"></textarea><br>
                                            <font color="red"></font><br>
                                            <small>Recipient(s): <span id="recipient-count">0</span></small>
                                        </div>
                                        <div class="form-group">
                                            <label>Message:</label>
                                            <textarea class="form-control loadable" placeholder="enter your message" id="message"></textarea><br>
                                            <font color="red"></font><br>
                                            <small>SMS Pg: <span id="page-count">0</span></small>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-success loadable" id="send" type="button">send <i class="fa fa-spin fa-spinner loading" style="display:none"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <div>
                    </div>
                </div>
            </div>
        </div>
        <script src="/js/script.js"></script>
    </body>
</html>
