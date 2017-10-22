<main>

    <div class="wrapper_lists">


        <div class="box_add_to_do">

            <h1>ENTER YOUR NAME</h1>

            <form id="add" method="POST">
               
                <input type="text" name="createdBy">

            <h2>ADD TO YOUR TO DO LIST</h2>
                
                <input type="text" name="title">
                
                <br/>
                
                <input type="submit" value="ADD">
                
            </form>
            
            <?php
            
            if (isset($_POST["createdBy"]) && isset($_POST["title"]))
            {
                $title = $_POST["title"];
                $createdBy = $_POST["createdBy"];
                
                require "partials/insert_to_do_list.php";
                
                insert_to_do_list($title, $createdBy);
            }
            ?>
        
        </div>
        <!--.add_to_do-->
        
        <div class="box_existing_to_do">

        <h3>YOUR TO DO LIST</h3>
                   
<?php
            require "partials/fetch_to_do_list.php";
            
            //$to_do_list = array(
                    //array()
            //);
            
            //fetch_to_do_list($to_do_list);
            
            $id = "";
            $i = 0;
            
                foreach ($to_do_list as $to_do)
                {
                    $id = $to_do["id"];
                    
            echo $to_do["title"] . 
            ' (' . $to_do["createdBy"] . ') <br/>'
              . var_dump($to_do["completed"]) .  
                
        '<form id="complete" method="POST">
        <input type="hidden" 
        name="completed_' . $id . '"> 
        <input type="submit" value="DONE">
        </form>
        
        <form id="remove_task" method="POST">
        <input type="hidden" 
        name="remove_' . $id . '"> 
        <input type="submit" value="DONE">
        </form>'; 
                    
                    
 if (isset($_POST["completed_$id"])) { require "partials/update_to_do.php"; update_to_do($id); }
                    
$i++;
                }
                    
            //$completed_to_do = array(
                    //array());
            

                        require "partials/fetch_completed_list.php";
                        
                    $completed_to_do = fetch_completed_list();
                        
                    
           
            //fetch_completed_list($completed_to_do);
               
            if (count($completed_to_do) > 0)
            {
                    echo '<h4>COMPLETED TO DO\'S</h4>
                <br/>'; 
            
            foreach ($completed_to_do as $completed)
            {
                
                    echo $completed["title"] . '<br/>';
                var_dump($completed["title"]);
            }
                    }
            
               
                        if (count($to_do_list) > 0 ||
                           count($completed_to_do) > 0)
                        {
                            
            echo '<form id="clear_list" method="POST">
            <input type="hidden" name="clear">
            <input type="submit" value="CLEAR ALL">
            </form>';
                
                if (isset($_POST["clear"]))
                {
                    require "partials/clear_database.php";
                    $clear_all = true;
                    clear_database($clear_all);
                    
                }
                
            }
                    
        
            ?>
            </div>


    </div>
    <!--.wrapper_lists-->
</main>
