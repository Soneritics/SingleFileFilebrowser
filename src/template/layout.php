<!DOCTYPE html>
<html>
    <head>
        <title><?php echo !empty($title) ? $this->encode($title) : 'Filebrowser'; ?></title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,400italic,700,700italic" rel="stylesheet" type="text/css">
        <style>
            * {
                font-family: 'Open Sans', Verdana, Arial;
            }

            header, footer {
                padding: 40px 0;
                background-color: #6f5499;
                color: #fff;
            }

            footer p {
                color: #fff;
            }

            article {
                padding: 40px 0;
            }

            h1 {
                color: #fff;
                margin: 0;
                font-size: 40px;
            }

            h3 {
                margin-top: 0;
            }

            body, p {
                font-size: 18px;
                color: #313132;
                line-height: 30px;
            }

            #copyright {
                background-color: #da3b01;
                padding: 10px;
                color: #fff;
                text-align: center;
                font-size: 15px;
            }

            #copyright a {
                color: #fff;
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
        <header><h1 class="container">Filebrowser</h1></header>
        <?php echo $content; ?>
        <div id="copyright">
            &copy; 2015 - <a href="mailto:mail@jordijolink.nl">Jordi Jolink</a> -
            <a href="https://github.com/Soneritics/SingleFileFilebrowser/blob/master/LICENSE">MIT License</a> -
            Project on <a href="https://github.com/Soneritics/SingleFileFilebrowser">Github</a>
        </div>
    </body>
</html>