<html>
    <head>
        <title>Installation Wizard</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" />
    </head>
    <style>
        #box { min-height: 100vh; width: 100%; background: #e1e1e1; } #box .plate { background: #ffffff; border-radius: 10px; padding: 20px; width: 600px; } #box .dg-group { width: 150px; }
    </style>
    <body>
        <div class="d-flex align-items-center" id="box">
            <div class="container">
                <div class="plate m-auto">
                    @yield('body')
                </div>
            </div>
        </div>
    </body>
</html>