<html>
    <head>
    </head>

    <body>
        <p>Hi {{ $name }},</p>

        <p>Welcome to Booker Earth! An account has been created for in Booker Earth with your email. Please click the link below to verify.</p>

        <center>
            {{ url('user/activation', $link) }}
        </center>

        <p>
            Regards,<br>
            Booker Earth Team
        </p>
    </body>
</html>