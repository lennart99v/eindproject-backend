<a href="/post/create">Create post</a>
<h2>
    Home Page
</h2>
<? for($i = 0; $i < count($posts) ; $i += 3) {
    echo "<div>";
    echo "<h3>". $posts[$i] ."</h3>";
    echo "<p>". $posts[$i + 1] ."</p>";
    echo "<p> written by: ". $posts[$i + 2] ."</p> </br>";
    echo "</div>";
}?>