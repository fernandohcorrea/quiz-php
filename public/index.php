<?php
define('DS', DIRECTORY_SEPARATOR);
chdir(realpath(__DIR__ . DS . '../'));

require 'vendor/autoload.php';


try {
    $bootstrap = \Quiz\Bootstrap::getInstance();
    $showMan = new \Quiz\ShowMan();
    $random_questions = $showMan->getRandonQuestions();

    $order = $random_questions['order'];
    $questions = $random_questions['questions'];

    
} catch (Exception $ex) {

    echo "<pre>" . print_r($ex, 1) . "</pre>";
    die(__FILE__ . '[' . __LINE__ . ']');
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Quiz - PHP</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="css/quiz.css">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    </head>
    <body class="qz-body-main" role="document">
        <nav class="navbar navbar-inverse navbar-fixed-top hidden-print">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Quiz-PHP</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="#">Home</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Questões <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Action</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        
        <div class="container">
            <div class="page-header">
                <h1>Questões</h1>
            </div>
            
            <?php 
            foreach ($order as $ordem => $question_idx) : 
                $question = $questions[$question_idx];
            ?>
            <div class="row">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">Questão - <?php echo $ordem?>:</h3>
                    </div>
                    <div class="panel-body">
                        
                        <div class="well qz-question">
                            <h2><?php echo $question->getQuestion()?></h2>
                        </div>
                        
                        <?php if($question->getFileCodeSample()): ?>
                        <div style="">
                            <pre class="qz-question-samplecode" >
                                <?php echo $question->getHighlightCodeSample ()?>
                            </pre>
                        </div>
                        <?php endif; ?>
                
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            
        </div>
        
    </body>

</html>

