<h2>Login Page </h2><br>    
    <div class="login">    
    <form id="login" method="post" action="/auth/login">    
        <label><b>email     
        </b>    
        </label>    
        <input type="text" name="email" id="email" placeholder="E-mail">    
        <br><br>    
        <label><b>Password     
        </b>    
        </label>    
        <input type="Password" name="password" id="password" placeholder="Password">    
        <br><br>   
        <?=$errorMsg?> 
        <input type="submit" name="log" id="log" value="Log In">       
        <a href="/auth/register">register</a>         
        <br><br>    
         <a href="#">Forgot Password</a>    
    </form>     
   
</div>    