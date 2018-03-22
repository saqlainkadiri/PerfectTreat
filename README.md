# PerfectTreat

Sweet Shop Website using PHP

## Technologies Used

1.HTML

2.CSS

3.Javascript

4.jQuery

5.PHP

6.MySQL

7.XML

8.MySQL


## Main Features

1.Sending Email in Contact Form (using PHPMailer)

2.SMS on Order Booking (using Twilio)

3.Live Search on JSON Data File using jQuery

4.Rating System

5.Animation while Adding to Shopping Cart 

6.Carousel for Offers

7.Separate User and Admin Dashboard

8.Admin Functionality for adding balance to PerfectTreat Card.

## Steps of Installation 

1.Download or Clone "PerfectTreat" from here.

2.Verify and Enter your database username and password at "PerfectTreat/php/db_connection.php".

3.Create a database "theperfecttreat" and import the database from "database/theperfecttreat.sql".

4.Make a Twilio account to get Account SID, Auth Token and Twilio Mobile Number and substitute them in the placeholders at "PerfectTreat/php/tracking.php".

5.Place "cacert.pem" inside any directory inside C drive.

6.Open php.ini and uncomment the line "curl.cainfo = " by removing the semicolon at the start of the line.

7.Update curl.cainfo="C:/path/of/file/cacert.pem" and restart WAMP/XAMPP.

8.Substitute your Gmail account credentials and Contact Queries receiving Email Address in the placeholders at "PerfectTreat/php/contact_us.php".

9.Allow use of less secured apps in the Settings Panel of your Gmail Account (just in case Sending Emails is not working).

10.Get the Google Map API Key from google and substitute it in the placeholder at “PerfectTreat/php/findus.php”. 

## NOTE 

1.Twilio only sends SMS between morning 9am to evening 9pm.

2.To change the Data for Live Search update the file at “PerfectTreat/html/product_data.json”.

## Screenshots

### Home Page

![Home Page](/screenshots/Home%20Page.PNG)

### Order Summary Page

![Order Summary Page](/screenshots/Order%20Summary%20Page.PNG)

### Previous Order Page

![Previous Order Page](/screenshots/Previous%20Order%20Page.PNG)

### Live Search Page

![Live Search Page](/screenshots/Live%20Search%20Page.PNG)

### Contact Us Page

![Contact Us Page](/screenshots/Contact%20Us%20Page.PNG)

### Rating Page

![Rating Page](/screenshots/Rating%20Page.PNG)
