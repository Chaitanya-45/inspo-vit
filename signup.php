<?php
// Establish connections to the databases
$connUser = mysqli_connect("localhost", "root", "", "user_db");
$connLogin = mysqli_connect("localhost", "root", "", "user_db");

// Check the connections
if (!$connUser || !$connLogin) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['submit'])) {
    $Email = mysqli_real_escape_string($connUser, $_POST['Email']);
    $User = mysqli_real_escape_string($connUser, $_POST['Username']);
    $Phone_no = mysqli_real_escape_string($connUser, $_POST['Phone_no']);
    $Set_Pwd = md5($_POST['Set_Pwd']);
    $Confirm_Pwd = md5($_POST['Confirm_Pwd']);

    // Check if the email already exists in the user_form table
    $checkEmailQuery = "SELECT * FROM user_form WHERE Email = '$Email'";
    $result = mysqli_query($connUser, $checkEmailQuery);

    if (mysqli_num_rows($result) > 0) {
        $error[] = 'Email already exists!';
    } else {
        // Check if passwords match
        if ($Set_Pwd !== $Confirm_Pwd) {
            $error[] = 'Passwords do not match!';
        } else {
            // Insert username and password into the logindetails table
            $insertQuery = "INSERT INTO logindetails (Username, Password) VALUES ('$User', '$Set_Pwd')";

            if (mysqli_query($connLogin, $insertQuery)) {
                header('location: login.php');
                exit();
            } else {
                $error[] = 'Error: ' . mysqli_error($connLogin);
            }
        }
    }
}

mysqli_close($connUser);
mysqli_close($connLogin);
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inspo - Register</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="profstyle.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <style>
      .material-symbols-outlined {
        font-variation-settings:
        'FILL' 0,
        'wght' 400,
        'GRAD' 0,
        'opsz' 24
      }
      </style>
</head>
<body>
<section class="header">
        <div class="logo">
            <svg width="154" style="padding-top:30px; padding-left:30px; margin:0px;" height="34" viewBox="0 0 154 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M17 23C13.6863 23 11 20.3137 11 17C11 13.6863 13.6863 11 17 11C20.3137 11 23 13.6863 23 17C23 20.3137 20.3137 23 17 23Z" fill="#1901F3"/>
                <path d="M5.37629 19.0497C3.63754 19.3563 2.44572 21.0359 3.11317 22.6705C4.04501 24.9525 5.53164 26.9857 7.45895 28.5745C10.2149 30.8462 13.6909 32.0601 17.2619 31.9978C20.8329 31.9355 24.2645 30.601 26.9395 28.2344C28.8101 26.5794 30.2249 24.4955 31.0766 22.1824C31.6866 20.5255 30.4368 18.8885 28.6884 18.6428C26.9401 18.3971 25.3703 19.6697 24.5067 21.2097C24.0386 22.0444 23.4309 22.8017 22.7029 23.4458C21.1681 24.8037 19.1992 25.5693 17.1504 25.6051C15.1015 25.6408 13.1071 24.9444 11.5259 23.6409C10.7758 23.0226 10.1421 22.287 9.64508 21.4691C8.72829 19.9602 7.11504 18.7431 5.37629 19.0497Z" fill="#AABB14"/>
                <path d="M31.884 18.8745C31.9606 18.2604 32 17.6348 32 17C32 8.71573 25.2843 2 17 2C8.71573 2 2 8.71573 2 17C2 17.8147 2.06495 18.6142 2.18996 19.3937C2.87894 18.4505 3.95426 17.7772 5.11576 17.5724C6.37245 17.3508 7.51458 17.6556 8.48027 18.2253C8.42322 17.8251 8.3937 17.416 8.3937 17C8.3937 12.2469 12.2469 8.3937 17 8.3937C21.7531 8.3937 25.6063 12.2469 25.6063 17C25.6063 17.3134 25.5895 17.6229 25.5569 17.9276C26.5022 17.3243 27.6332 16.9796 28.8971 17.1573C30.0647 17.3214 31.1625 17.9564 31.884 18.8745Z" fill="#DBF301"/>
                <path d="M50.152 24V12.08H52.328V24H50.152ZM57.6208 24V12.08H59.3168L65.8767 20.912L64.9968 21.088V12.08H67.1728V24H65.4608L58.9968 15.104L59.7968 14.928V24H57.6208ZM76.7361 24.192C75.9788 24.192 75.2748 24.0533 74.6241 23.776C73.9841 23.4987 73.4295 23.1147 72.9601 22.624C72.5015 22.1227 72.1655 21.5413 71.9521 20.88L73.7601 20.096C74.0481 20.7787 74.4641 21.3173 75.0081 21.712C75.5521 22.096 76.1655 22.288 76.8481 22.288C77.2321 22.288 77.5628 22.2293 77.8401 22.112C78.1281 21.984 78.3468 21.8133 78.4961 21.6C78.6561 21.3867 78.7361 21.1307 78.7361 20.832C78.7361 20.48 78.6295 20.192 78.4161 19.968C78.2135 19.7333 77.9041 19.552 77.4881 19.424L75.2001 18.688C74.2721 18.4 73.5735 17.968 73.1041 17.392C72.6348 16.816 72.4001 16.1387 72.4001 15.36C72.4001 14.6773 72.5655 14.0747 72.8961 13.552C73.2375 13.0293 73.7068 12.624 74.3041 12.336C74.9121 12.0373 75.6055 11.888 76.3841 11.888C77.0988 11.888 77.7548 12.016 78.3521 12.272C78.9495 12.5173 79.4615 12.864 79.8881 13.312C80.3255 13.7493 80.6508 14.2667 80.8641 14.864L79.0721 15.664C78.8375 15.0667 78.4855 14.608 78.0161 14.288C77.5468 13.9573 77.0028 13.792 76.3841 13.792C76.0215 13.792 75.7015 13.856 75.4241 13.984C75.1468 14.1013 74.9281 14.272 74.7681 14.496C74.6188 14.7093 74.5441 14.9653 74.5441 15.264C74.5441 15.5947 74.6508 15.888 74.8641 16.144C75.0775 16.3893 75.4028 16.5813 75.8401 16.72L78.0321 17.408C78.9815 17.7173 79.6908 18.144 80.1601 18.688C80.6401 19.232 80.8801 19.904 80.8801 20.704C80.8801 21.3867 80.7041 21.9893 80.3521 22.512C80.0001 23.0347 79.5148 23.4453 78.8961 23.744C78.2775 24.0427 77.5575 24.192 76.7361 24.192ZM85.8395 24V12.08H90.2875C91.0982 12.08 91.8128 12.2293 92.4315 12.528C93.0608 12.816 93.5515 13.2427 93.9035 13.808C94.2555 14.3627 94.4315 15.04 94.4315 15.84C94.4315 16.6293 94.2502 17.3067 93.8875 17.872C93.5355 18.4267 93.0502 18.8533 92.4315 19.152C91.8128 19.4507 91.0982 19.6 90.2875 19.6H88.0155V24H85.8395ZM88.0155 17.68H90.3195C90.7142 17.68 91.0555 17.6053 91.3435 17.456C91.6315 17.296 91.8555 17.0773 92.0155 16.8C92.1755 16.5227 92.2555 16.2027 92.2555 15.84C92.2555 15.4667 92.1755 15.1467 92.0155 14.88C91.8555 14.6027 91.6315 14.3893 91.3435 14.24C91.0555 14.08 90.7142 14 90.3195 14H88.0155V17.68ZM105.087 24.192C104.212 24.192 103.396 24.0373 102.639 23.728C101.881 23.4187 101.22 22.9867 100.655 22.432C100.089 21.8773 99.6465 21.2267 99.3265 20.48C99.0172 19.7227 98.8625 18.9067 98.8625 18.032C98.8625 17.1467 99.0172 16.3307 99.3265 15.584C99.6358 14.8373 100.073 14.1867 100.639 13.632C101.204 13.0773 101.865 12.6507 102.623 12.352C103.38 12.0427 104.201 11.888 105.087 11.888C105.972 11.888 106.793 12.0427 107.551 12.352C108.308 12.6613 108.969 13.0933 109.535 13.648C110.1 14.192 110.537 14.8373 110.847 15.584C111.167 16.3307 111.327 17.1467 111.327 18.032C111.327 18.9067 111.167 19.7227 110.847 20.48C110.527 21.2267 110.084 21.8773 109.519 22.432C108.953 22.9867 108.292 23.4187 107.535 23.728C106.788 24.0373 105.972 24.192 105.087 24.192ZM105.087 22.208C105.673 22.208 106.212 22.1067 106.703 21.904C107.193 21.6907 107.62 21.3973 107.983 21.024C108.356 20.6507 108.639 20.208 108.831 19.696C109.033 19.184 109.135 18.6293 109.135 18.032C109.135 17.4347 109.033 16.8853 108.831 16.384C108.639 15.872 108.356 15.4293 107.983 15.056C107.62 14.672 107.193 14.3787 106.703 14.176C106.212 13.9733 105.673 13.872 105.087 13.872C104.511 13.872 103.977 13.9733 103.487 14.176C102.996 14.3787 102.564 14.672 102.191 15.056C101.828 15.4293 101.545 15.872 101.343 16.384C101.14 16.8853 101.039 17.4347 101.039 18.032C101.039 18.6293 101.14 19.184 101.343 19.696C101.545 20.208 101.828 20.6507 102.191 21.024C102.564 21.3973 102.996 21.6907 103.487 21.904C103.977 22.1067 104.511 22.208 105.087 22.208Z" fill="black"/>
                </svg>
        </div>
        <nav>
            <a href="index.html"></a>
            <div class="nav-links" id="navLinks">
                <i class="fa fa-times" onclick="hidemenu()"></i>
                <ul>
                    <li><a href="index.html">HOME</a></li>
                    <!-- <li><a href="about.html">ABOUT</a></li> -->
                    <!-- <li><a href="">LOGIN</a></li>
                    <li><a href="">SIGNUP</a></li> -->
                    <li><a href="signup.php">REGISTER</a></li>
                     <li><a href="login.php">LOGIN</a></li>
                    <!-- <li><a href="">PROFILE</a></li> -->
                    <!-- <div class="user-actions">
                        <a href="login.php">Login</a>
                        <a href="signup.php">Sign Up</a>
                    </div> -->

                </ul>
            </div>
            <i class="fa fa-bars" onclick="showMenu()"></i>
        </nav>
        <div class="profile-container signup-container">
        <h1 style="padding-left:300px;">Sign-up</h1><br>
            <form id="signup-form" method="post" action="" style="padding-left: 200px;">
                <?php
                if (isset($error)) {
                    foreach ($error as $error) {
                        echo '<span class="error-msg">' . $error . '</span>';
                    }
                }
                ?>
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="Email" required style="margin-left: 120px; height:20px;">
                <br><br>
                <label for="username">Username:</label>
                <input type="text" id="username" name="Username" required style="margin-left: 90px; height:20px;">
                <br><br>
                <label for="phno">Phone Number:</label>
                <input type="text" id="phno" name="Phone_no" required style="margin-left: 56px; height:20px;">
                <br><br>
                <label for="password">Set password:</label>
                <input type="password" id="password" name="Set_Pwd" required style="margin-left: 67px; height:20px;">
                <br><br>
                <label for="cpassword">Confirm password:</label>
                <input type="password" id="cpassword" name="Confirm_Pwd" required style="margin-left: 30px; height:20px;">
                <br><br><br>
                <button class="hero-btn" type="submit" name="submit" style="background-color:#DBF301; margin-left:150px;">Submit</button>
            </form>
        </div>
    </section>
    <script src="script.js"></script>
</body>
</html>
