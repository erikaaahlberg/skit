<main>

    <div class="wrapper_lists">


        <div class="box_add_to_do">

            <h1>ENTER YOUR NAME</h1>

            <form name="add" method="POST">
               
                <input type="text" name="createdBy">

            <h2>ADD TO YOUR TO DO LIST</h2>
                
                <input type="text" name="title">
                
                <input type="submit" value="ADD">
                
            </form>
        
        </div>
        <!--.add_to_do-->
        
               
       
        <?php
            
            if(isset($_POST["createdBy"]) && isset($_POST["title"])){
            require "partials/fetch_database.php";
                
            echo '<div class="box_existing_to_do">'
 
            . $to_do_list[0]["title"] .
           
        
        '<input type="submit" form="add" name="completed" value="DONE">
        
        </div><!--.existing_to_do-->';
            
             }
            ?>


        <div class="clear"></div>

    </div>
    <!--.wrapper_lists-->
</main>
