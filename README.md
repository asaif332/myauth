# myauth
Simple authentication and authorization library for codeigniter


How to setup ?

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

<br>
<br>

<h2> How to use ? </h2>
<p>
      1. Simply go to <i> "your project / auth / login"</i> for login page.<br>
      2. Simply go to <i> "your project / auth / register"</i> for register page.<br>
</p>
<br>
<h4> Authorization functions</h4>
<p>
      <b>check()</b><br>
      Syntax - $this->myauth->check() <br>
      Use - checks whether the user is logged in or not.<br>
      Return - Function returns true if user is logged in else false.<br>
      
      Parameters - If you are using parameters in check() function then use role names as parameters.
      Example - $this->myauth->check('admin')
      This will check that user is logged in as well as it is a admin.
</p>
