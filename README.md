# myauth
Simple authentication and authorization library for codeigniter


How to use ?

1. Copy the myauth folder in the third party folder.


2. Autoload the package and library in autoload.php <br>

      &nbsp;&nbsp; $autoload['packages'] = array(APPPATH.'third_party/myauth'); <br>
      &nbsp;&nbsp; $autoload['libraries'] = array('myauth' , 'form_validation' , 'session'); <br>
      &nbsp;&nbsp; $autoload['helper'] = array('url' , 'form'); <br>



3. Copy the Auth.php controller from myauth controllers folder and copy it to your application controllers folder.


4. Import the myauth.sql to your mysql database.
<br><br>

<strong>Note - For using the reset pasword functionality, please make sure you have correctly configured the email settings.</strong>

You can do so by adding email.php in application/config folder.
