<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <form action="formphp.php" method="POST">
        <h2>Personal Information</h2>
        <div>
            <label for="">First Name: </label>
            <input type="text" name="name" value=<?php if(isset($_POST['name'])) echo $_POST ['name']; ?>>
        </div>
        <br>
        <div>
            <label for="">Last Name: </label>
            <input type="text" name="lastname" value=<?php if(isset($_POST['lastname'])) echo $_POST ['lastname']; ?>>
        </div>
        <br>
        <div>
            <label for="">Email: </label>
            <input type="text" name="email" value=<?php if(isset($_POST['email'])) echo $_POST ['email']; ?>>
        </div>
        <h2>Credit Card Information: </h2>
        <div>
            <Label>Credit card type: </Label>
            <select name="" id="">
                <option value="">Visa</option>
            </select>
        </div>
        <br>
        <div>
            <label for="">Cardholder: </label>
            <input type="text" name="cardholder" value=<?php if(isset($_POST['cardholder'])) echo $_POST ['cardholder']; ?>>
        </div>
        <br>
        <div>
            <label for="">Card Number: </label>
            <input type="text" name="cardnumber" value=<?php if(isset($_POST['cardnumber'])) echo $_POST ['cardnumber']; ?>>
        </div>
        <br>
        <div>
            <label for="">CVV2:  </label>
            <input type="text" name="cvv2" value=<?php if(isset($_POST['cvv2'])) echo $_POST ['cvv2']; ?>>
        </div>
        <br>
        <div>
            <label for="">Exp-Data: </label>
            <select name="" id="">
                <option value="">01</option>
            </select>
            <select name="" id=""><option value="">2008</option></select>
        </div>
        <h2>Address</h2>
        <div>
            <label for="">Street Addres: </label>
            <input type="text" name="address" value=<?php if(isset($_POST['address'])) echo $_POST ['address']; ?>>
        </div>
        <br>
        <div>
            <label for="">City: </label>
            <input type="text" name="city" value=<?php if(isset($_POST['city'])) echo $_POST ['city']; ?>>
        </div>
        <br>
        <div>
            <label for="">State </label>
            <select name="" id="">
                <option value="">None</option>
            </select>
        </div>
        <br>
        <div>
            <label for="">ZIP: </label>
            <input type="text" name="zip" value=<?php if(isset($_POST['zip'])) echo $_POST ['zip']; ?>>
        </div>
        <br>
        <div>
            <label for="">Country: </label>
            <select name="" id="">
                <option value="">United States</option>
            </select>
        </div>
        <br>
        <div>
            <label for="">Enter Security code: </label>
            <input type="text">
        </div>
    </form>
    
</body>
</html>