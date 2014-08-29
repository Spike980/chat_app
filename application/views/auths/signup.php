<div id = "signup-bar">
   <img src = "/img/Globe.png" id="globe">
   <h1 class="sitename"><em> My Chat </em> </h1>
</div>

<img src="/img/siteadd.gif" id="add">

<form method="POST" action = "/auths/submit" class="signupform">
<fieldset>
<legend> Sign-up </legend>

<h4> Fill in the form details. </h4>

<div>
<label for="email" class="fixedwidth"> E-mail </label>
<input type="email" name="email" id="email">
</div>

<br>

<div>
<label for="pass" class="fixedwidth"> Password </label>
<input type="password" name="pass" id="pass">
</div>

<br>

<div>
<label for="repass" class="fixedwidth"> Re-enter Password </label>
<input type="password" name="repass" id="repass">
</div>

<br>


<div>
<label for="username" class="fixedwidth"> Username </label>
<input type="text" name="user" id="user">
</div>


<br>


<div>
<label for="dob" class="fixedwidth"> Date-Of-Birth </label>
<select name="date" id="date">
<?php for($i=1;$i<32 ; $i++) echo "<option> $i </option>"; ?> 
</select>

<select name="month" id="month">
<?php for($i=1; $i<13; $i++) echo "<option> $i </option>"; ?> 
</select>

<select name="year" id="year">
<?php $year = date('Y'); for($i=1950; $i<=$year; $i++) echo "<option> $i </option>"; ?>
</select>
</div>

<br>

<div class="sex">
<input type="radio" name="sex" id="male" value="male">
<label for="male"> Male </label>

<input type="radio" name="sex" id="female" value="female">
<label for="female"> Female </label>
</div>

<br>

<div>
<input type="submit" id="signupform" name="signup" value="Sign-Up">
</fieldset>
</form>

