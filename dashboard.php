<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['detsuid'] == 0)) {
    header('location:logout.php');
} else {
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Money Manager</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/datepicker3.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">

    <!--Custom Font-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
    <style>
        /* Style for chatbot button */
        #chatbot-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            font-size: 18px;
            cursor: pointer;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        #chatbot-button:focus {
            outline: none;
        }

        /* Style for chatbot container */
        #chatbot-container {
            position: fixed;
            bottom: 80px;
            right: 20px;
            width: 350px;
            max-height: 70vh;
            overflow: auto;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0px 8px 10px rgba(0, 0, 0, 0.1);
            display: none;
        }

        #chatbot-header {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }

        #chatbot-body {
            padding: 15px;
        }

        #chatbot-input {
            width: calc(100% - 40px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        #chatbot-send {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 15px;
            cursor: pointer;
            margin-left: 10px;
        }

        #chatbot-send:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>

    <?php include_once('includes/header.php'); ?>
    <?php include_once('includes/sidebar.php'); ?>

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#">
                        <em class="fa fa-home"></em>
                    </a></li>
                <li class="active">Dashboard</li>
            </ol>
        </div><!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Dashboard</h1>
            </div>
        </div><!--/.row-->

        <div class="row">
            <div class="col-xs-6 col-md-3">
                <div class="panel panel-default">
                    <!-- Panel content for Today's Expense -->
                </div>
            </div>
            <div class="col-xs-6 col-md-3">
                <div class="panel panel-default">
                    <!-- Panel content for Yesterday's Expense -->
                </div>
            </div>
            <div class="col-xs-6 col-md-3">
                <div class="panel panel-default">
                    <!-- Panel content for Weekly Expense -->
                </div>
            </div>
            <div class="col-xs-6 col-md-3">
                <div class="panel panel-default">
                    <!-- Panel content for Monthly Expense -->
                </div>
            </div>
        </div><!--/.row-->

        <div class="row">
            <div class="col-xs-6 col-md-3">
                <div class="panel panel-default">
                    <!-- Panel content for Current Year Expenses -->
                </div>
            </div>
            <div class="col-xs-6 col-md-3">
                <div class="panel panel-default">
                    <!-- Panel content for Total Expenses -->
                </div>
            </div>
        </div>

        <!-- Chatbot button -->
        <button id="chatbot-button" onclick="toggleChatbot()">Chat</button>

        <!-- Chatbot container -->
        <div id="chatbot-container">
            <div id="chatbot-header">
                Chatbot
            </div>
            <div id="chatbot-body">
                <!-- Chatbot messages will be displayed here -->
            </div>
            <div id="chatbot-input-container">
                <input type="text" id="chatbot-input" placeholder="Type your message...">
                <button id="chatbot-send" onclick="sendMessage()">Send</button>
            </div>
        </div>

    </div>
    <!--/.main-->

    <?php include_once('includes/footer.php'); ?>
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/chart.min.js"></script>
    <script src="js/chart-data.js"></script>
    <script src="js/easypiechart.js"></script>
    <script src="js/easypiechart-data.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/custom.js"></script>

    <script>
        function toggleChatbot() {
            var chatbotContainer = document.getElementById('chatbot-container');
            if (chatbotContainer.style.display === 'none') {
                chatbotContainer.style.display = 'block';
            } else {
                chatbotContainer.style.display = 'none';
            }
        }

        function sendMessage() {
            // Code to send message to the chatbot
            // This function will be called when the user clicks the send button
        }
    </script>
</body>

</html>
<?php } ?>
