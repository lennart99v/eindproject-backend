<h2>Create Post </h2><br>    
    <div class="post-create">    
    <form id="login" method="post" action="/post/create">    
        <label><b>Post title    
        </b>    
        </label>    
        <input type="text" name="post-title" id="title" placeholder="Post title here...">    
        <br><br>    
        <label><b>Post content   
        </b>    
        </label>    
        <textarea type="Password" name="post-content" id="content" rows="5" cols="80">    </textarea>
        <br><br>   
        <?=$errorMsg?> 
        <input type="submit" name="post" id="post" value="Post it!">            
        <br><br>       
    </form>       
</div>   