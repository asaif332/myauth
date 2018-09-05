# myauth
Simple authentication and authorization library for codeigniter


How to use ?

1. Copy the myauth folder in the third party folder.

2. Autoload the package and library in autoload.php <br>
      $autoload['packages'] = array(APPPATH.'third_party/myauth'); <br>
      $autoload['libraries'] = array('myauth' , 'form_validation' , 'session'); <br>
      $autoload['helper'] = array('url' , 'form'); <br>
      

3. Copy the Auth.php controller from myauth controllers folder and copy it to your application controllers folder.

4. Import the myauth.sql to your mysql database.
