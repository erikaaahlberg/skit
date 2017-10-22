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
        
        </div>
        <!--.add_to_do-->
        
        <div class="box_existing_to_do">

        <h3>YOUR TO DO LIST</h3>
                   
<?php
            
            $clear_all = false;
            
                foreach ($to_do_list as $to_do)
                {
                    $id = $to_do["id"];
                    
            echo $to_do["title"] . 
            ' (' . $to_do["createdBy"] . ') 
                
        <form id="complete" method="POST">
        
        <input type="submit" name="completed_' . $id . '" value="DONE">
        </form>
        <br/>';
                    if (isset($_POST["completed_$id"])){
                completed_to_do($id);
                    }
        }
            ?>
            
             
            <?php
            
            if (count($to_do_list) > 0){
           
            $completed_to_do = fetch_completed_list($to_do_list);
                
               // require "partials/fetch_completed_list.php";
           // $completed_list = fetch_completed_list($completed_to_do);
                
                if (count($completed_to_do > 0))
                {
            
            foreach ($completed_to_do as $completed)
            {
                echo '<h4>COMPLETED TO DO\'S</h4>
                <br/>' 
                    . $completed ["title"] . '<br/>';
            }
                }
           
            echo '<form id="clear_list" method="POST">
            <input type="submit" name="clear" value="CLEAR ALL">
            </form>';
                
                if (isset($_POST["clear"]))
                {
                    $clear_all = true;
                    clear_database($clear_all);
                    
                }
                
            }
        
            ?>
            
            </div>


    </div>
    <!--.wrapper_lists-->
</main>
