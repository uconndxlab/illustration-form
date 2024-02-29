<!DOCTYPE html>
<html>
    <head>
        <title>Illustration Request</title>
    </head>
    <body>
        <h1>Illustration request form:</h1>
        <form action="{{ route('test.submit') }}" method="post" enctype="multipart/form-data">
            @csrf

            <label><strong>Primary contact information:</strong></label><br>
            <label for="user_name">Full Name:</label><br>
            <input type="text" id="user_name" name="users_name"><br>
            <label for="email">Email:</label><br>
            <input type="text" id="email" name="users_email"><br>
            <label for="phone">Phone</label><br>
            <input type="text" id="phone" name="phone"><br>
            <br>

            <input type="submit" value="Submit">
    </form>
    <script>
    </script>
    </body>
</html>

