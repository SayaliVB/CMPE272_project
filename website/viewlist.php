<?php include "header.html" ?>
    <div>
    <section class = "list">
    <p style='font-family: "Georgia Bold Italic";font-size: 30pt; text-align: center'>
        Type in your username and password below.
        <br />
        <span style="color: #0000FF; font-size: 20pt; font-weight: bold">
            Note that password will be sent as plain text
        </span>
    </p>
    
    <form action="login.php" method="post" >
        <br />
        <table cellspacing="0" style="
                font-size: 25pt; text-align: center; border: none" cellpadding="0" align = center>
            <tr>
                <td style=" font-family: 'Shadows Into Light', cursive; border: none">
                    <strong>Username:</strong>
                </td>
            </tr>
            <tr>
            <td style="border: none">
                <input style = "line-height: 2em" size="40" name="USERNAME" />
            </td>
            </tr>
            <tr>
                <td  style=" font-family: 'Shadows Into Light', cursive; border: none">
                    <strong>Password: </strong>
                </td>
            </tr>
            <tr>
                <td style=" border: none">
                    <input style = "line-height: 2em" size="40" name="PASSWORD" type="password" /> <br />
                </td>
            </tr>
            <tr>
                <td style="border: none;padding: 20px; margin: 20px">
                    <input style=" font-family: 'Shadows Into Light', cursive; width: 200px" type="submit" name="Enter" value="Enter"/>
                </td>
            </tr>
        </table>
    </form>
    </section>
    <p style="font-size: 22px">
    This is a class project<br> username and password are 'admin'
    </p>
    </div>
    
<?php include "footer.html" ?>