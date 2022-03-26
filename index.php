<?php
session_start();
if(isset($_SESSION['userid'])){
    $userid=$_SESSION['userid'];
    echo "User :- ".$userid;
include 'db-config.php';
?>
<br>
<a href="profile.php"><button>My Profile</button></a><br>
<a href="add-post.php"><button>Add Post</button></a><br>
<h2>LATESTS POSTS</h2>
    
    <?php
        $post_sql = "SELECT * FROM `posts` ORDER BY `posts`.`posts_id` DESC";
        $post_query = mysqli_query($con,$post_sql);
        if(!empty($post_query))
        {
            while($post_data = mysqli_fetch_array($post_query))
            {
                ?>
                <h2><?php echo $post_data['post_title'];?></h2>
                <?php
                if($post_data['user_id']==$userid)
                {
                    ?><a href="edit-post.php"><button>Edit Post</button></a><br><br><?php
                }
                if($post_data['post_image']!=NULL)
                {
                    ?><img src="./post-image/<?php echo $post_data['post_image']; ?>" width="200" height="220" /><?php
                }
                ?>
                
                <h4><?php echo $post_data['post_category'];?></h4>
                <p><?php echo $post_data['post_description'];?></p>
                <p><?php echo $post_data['post_created'];?></p>
                <?php #echo "<br><br>";
            }
            
        }
        else
        {
            echo "There is no post available";
        }

    
}

else{
    
    header("location: logout.php");
}

?>