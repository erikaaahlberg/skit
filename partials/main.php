<main>

    <div class="wrapper_lists">


        <div class="box_add_to_do">

            <div class="span_box">
                <span class="do_little">
                    Do little
                    to remember 
                    what to do
                    </span>
            </div>
            <!--.span_box-->

            <h1>ENTER YOUR NAME</h1>

            <form id="add" method="POST">

                <input type="text" name="createdBy">

                <h2>ADD TO YOUR TO DO LIST</h2>

                <input type="text" name="title">

                <br/>

                <input type="submit" value="ADD">

            </form>

            <?php
            
            
            //Deklarerar variabler så att jag når dem överallt
            //Den första listan som ska skrivas ut är ofärdiga to do's, därav completed = 0
            
            $completed = 0;
            $title = "";
            $createdBy = "";
            $id = "";
            
            if (isset($_POST["createdBy"]) && isset($_POST["title"]))
            {
                $title = $_POST["title"];
                $createdBy = $_POST["createdBy"];
                
                require "partials/functions/insert_to_do_list.php";
                
                insert_to_do_list($title, $completed, $createdBy);
            }
            ?>

        </div><!--.add_to_do-->
        
        

        <div class="box_existing_to_do">

            <h3>YOUR TO DO LIST</h3>

                <?php
           
                require "partials/functions/fetch_to_do_list.php";
                $to_do_list = fetch_to_do_list($completed);
            
            
                foreach ($to_do_list as $to_do)
                {
                    
                    $title = $to_do["title"];
                    $createdBy = $to_do["createdBy"];
                    $id = $to_do["id"];
                    
                    echo 
                    '<br/>
                    <div class="form_wrapper">

                        <form id="edit" class="edit_task" method="POST">
                        <input type="text" name="title_' . $id . '" 
                        value="' . $title . '">
                        <br/>
                        <input type="text" name"createdBy_' . $id . '"
                        value="By ' . $createdBy . '">

                    </div><!--form_wrapper--->
            
                
                
                    <!--Knappar för redigering av listan-->    
                    <div class="button_wrapper">

                        <input type="submit" class="edit_task" id="edit_button" form="edit" value="EDIT">

                        </form><!--Form id="edit"--> 
               
                        <form class="remove_task" method="POST">
                        <input type="hidden" 
                        name="remove_' . $id . '"> 
                        <input type="submit" value="REMOVE">
                        </form> 


                        <form id="complete" method="POST">
                        <input type="hidden" 
                        name="completed_' . $id . '"> 
                        <input type="submit" value="DONE">
                        </form>

                    </div>'
                        ;?>

                    <div class="clear"></div>

                    <?php
                    
                    
                    //Ifall användaren trycker på "DONE"
                    if (isset($_POST["completed_$id"])) 
                        { 
                              $completed = 1;
                              $title = $to_do["title"];
                              $createdBy = $to_do["createdBy"];

                             require "partials/functions/update_to_do.php"; 
     
     
                        update_to_do($completed, $title, $createdBy, $id); 
                        
                        fetch_to_do_list($completed);
                        
                        } //end if
                    
                    
                    
                    
                    //Ifall användaren trycker på "REMOVE"
                    elseif (isset($_POST["remove_$id"]))
                    {
                        require "partials/functions/clear_single_task.php";

                        clear_single_task($id);
                        fetch_to_do_list($completed);

                    }//end elseif
                    
                    
                    
                    
                    //Ifall användaren redigerar "title"
                    elseif (isset($_POST["title_$id"]))
                    {
                        $title = $_POST["title_$id"];
                        $completed = 0;
                        $createdBy = $to_do["createdBy"];
                        $id = $to_do["id"];

                        require "partials/functions/update_to_do.php";

                        update_to_do($completed, $title, $createdBy, $id);
                        fetch_to_do_list($completed);


                    }//end elseif
     
                    
                    
                    
                    //Ifall användaren redigerar "createdBy"
                    elseif (isset($_POST["createdBy_$id"]))
                    {
                        $createdBy = $_POST["createdBy_$id"];
                        $completed = 0;
                        $title = $to_do["title"];
                        $id = $to_do["id"];

                            require "partials/functions/update_to_do.php";

                        update_to_do($completed, $title, $createdBy, $id);
                        fetch_to_do_list($completed);

                    }//end elseif
                 }//end foreach
            
            
            
             
            
            //Hämtar listan på färdiga to_do's, därav completed = 1
            $completed = 1;
            $completed_to_do = fetch_to_do_list($completed);
                        

            
            //Skrivs endast ut om det finns några färdiga to do's
            if (count($completed_to_do) > 0)
            {
                    echo 
                    '<br/>
                    <br/>
                    <hr>
                    <br/>
                    <h4>COMPLETED TO DO\'S</h4>'; 
            
                
            foreach ($completed_to_do as $completed)
            {
                $id = $completed["id"];
                
                echo '<li>' . $completed["title"] .  
                ' (' . $completed["createdBy"] . ') </li>
            
            <div class="button_wrapper">
        
                <form class="remove_task" method="POST">
                    <input type="hidden" 
                    name="remove_' . $id . '"> 
                    <input type="submit" value="REMOVE">
                </form>
            </div><!--button_wrapper-->
            
            <div class="clear">';
                
                
                
            //Om användaren trycker på remove    
            if (isset($_POST["remove_$id"]))
            {
                require "partials/functions/clear_single_task.php";
                clear_single_task($id);
                fetch_to_do_list($completed);
                
            }// end if
        }//end foreach
    }//end if ?>
                    

                    <div class="clear"></div>
                    

            <?php
            
            
            //Om det finns några to do's
            if (count($to_do_list) > 0 || count($completed_to_do) > 0)
            {
                            
                echo '<form id="clear_list" method="POST">
                <input type="hidden" name="clear">
                <input type="submit" value="CLEAR ALL">
                </form>';
                
                
                
                //Om användaren trycker på "CLEAR ALL"
                if (isset($_POST["clear"]))
                {
                    require "partials/functions/clear_database.php";
                    $clear_all = true;
                    clear_database($clear_all);
                    
                }//end if
                
            }//end if
                    
        
            ?>
            
        </div><!--.box_existing_to_do-->

    </div><!--.wrapper_lists-->
</main>
