<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="PfYAuZ0DUSrslwxQFk09srL3zFE4lkzuECSaOTSI">
        <title>HYLearn</title>
        <!-- Fonts -->
        <link rel="stylesheet" href="css/fonts.css">
        <!-- Styles -->
        <link rel="stylesheet" href="css/app.css">
        <!-- Scripts -->
        <script src="Js/app.js" defer="defer"></script>
    </head>
    <body>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            Hello <strong> {{ $userName }} </strong> <br><br>
            We received an account recovery request on HYLearn for <strong> {{ $userEmail }} </strong><br><br>
            Your account password is : <strong> {{ $password }} </strong> <br><br>
            <a href="#" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Login directly</a>
        </div>
    </div>
</body>

</html>