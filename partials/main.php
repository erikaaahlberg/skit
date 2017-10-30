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

            <form id="add" action="index.php" method="POST">

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
            $add_priority = false;
            $sort_list = false;
            
            
            
            //Hämtar info från databasen
            require "partials/functions/fetch_to_do_list.php";
            $to_do_list = fetch_to_do_list($completed);
            
            
            
            //Ifall sort by priority är valt så sorteras listan med denna funktion
                if (isset($_POST["sort_list"]))
                {
                    $sort_list = true;
                    
                    require "partials/functions/sort_list.php";
                    $to_do_list = sort_list($sort_list);
                    
                }//end if
            
            
            if (isset($_POST["createdBy"]) && isset($_POST["title"]))
            {
                $title = $_POST["title"];
                $createdBy = $_POST["createdBy"];
                
                require "partials/functions/check_if_dublette.php";
                $is_dublette = check_if_dublette($to_do_list, $title);
                
                if (!$is_dublette)
                {
                require "partials/functions/insert_to_do_list.php";
                    
                insert_to_do_list($title, $completed, $createdBy);
                $to_do_list = fetch_to_do_list($completed);
                    
                }
                
                else
                {
                    echo '<br/><p class="error_message">
                    That\'ve already been added!</p>';
                }
                
            }
            ?>

        </div><!--.add_to_do-->
        
        

        <div class="box_existing_to_do">

            

                <?php
            
                
                if (count($to_do_list) > 0)
                {
                    echo '<h3>YOUR TO DO LIST</h3>
                    <h5>(Click on the task to edit)</h5>
                    <ul>';
                    
                    //Kollar ifall användaren vill visa priority
                    if (isset($_GET["add_priority"]))
                    {
                        $add_priority = true;
                         
                    }//end if
                    
                    
                    //Kollar ifall priority är ifyllt sen innan och visar endast ifall det är valt
                    for ($i = 0; $i < count($to_do_list); $i++)
                    {
                        if($to_do_list[$i]["priority"] > 0)
                        {
                           $add_priority = true; 
                        }
                    }//end for
                    
                    if ($add_priority)
                    {
                        echo '<li class="priority">
                        Priority
                        </li>';  
                    }
                    
                 
                    
                    echo 
                    '<li class="task">TASK</li>
                    <li class="name">NAME</li>
                    
                    <li class="add_priority_button">
                    <form action="index.php"
                    method="GET"
                    class="add_priority">
                    <input type="hidden"
                    name="add_priority"
                    value="1">
                    <input type="submit"
                    value="ADD PRIORITY">
                    </form>
                    </li>
                    </ul>
                    <br/>
                    <hr/>';
                    

                foreach ($to_do_list as $to_do)
                {
                    $title = $to_do["title"];
                    $createdBy = $to_do["createdBy"];
                    $id = $to_do["id"];
                    $priority = $to_do["priority"];
                    
                    echo '<br/><div class="form_wrapper">
                        
                        
                        <form id="edit"
                        action="index.php"
                        class="edit_task" 
                        method="POST">';
                          
                     if ($add_priority)
                     {
                         echo '<input type="number" 
                        name="priority_' . $id . '"
                        value="' . $priority . '">';
                      }
                    
                        echo '<input type="text" 
                        name="title_' . $id . '" 
                        value="' . $title . '">
                        
                        <input type="text" 
                        name="createdBy_' . $id . '"
                        value="' . $createdBy . '">
                       
                        <input type="submit" 
                        value="EDIT">
                       
                        </form><!--Form id="edit"-->
                     

                
                    <!--Knappar för redigering av listan-->  
                    
                        <form id="remove_task" 
                        action="index.php"
                        method="POST">
                        
                        <input type="hidden" 
                        name="remove_' . $id . '"> 
                        
                        <input type="submit" 
                        value="REMOVE">
                        </form> 


                        <form id="complete" 
                        action="index.php"
                        method="POST">
                        
                        <input type="hidden" 
                        name="completed_' . $id . '">
                        
                        <input type="submit" 
                        value="DONE">
                        </form>

                    
                    </div><!--form_wrapper--->'
                        ;?>

                    <div class="clear"></div>

                    <?php
                    
                    //Ifall användaren trycker på "DONE"
                    if (isset($_POST["completed_$id"])) 
                        { 
                              $completed = 1;

                             require "partials/functions/update_to_do.php"; 
     
     
                        update_to_do($completed, $title, $createdBy, $id, $priority); 
                     
                        
                        } //end if
                    
                    
                    
                    
                    //Ifall användaren trycker på "REMOVE"
                    
                    elseif (isset($_POST["remove_$id"]))
                    {
                        require "partials/functions/clear_single_task.php";

                        clear_single_task($id);
                        

                    }//end elseif
                    
                    
                    
                    
                    //Ifall användaren redigerar "title"/"priority" eller "createdby"
                    elseif (isset($_POST["title_$id"]) ||
                           isset($_POST["priority_$id"]) ||
                           isset($_POST["createdBy_$id"]))
                    { 
                            $title = $_POST["title_$id"]; 
                            $priority = $_POST["priority_$id"];
                            $createdBy = $_POST["createdBy_$id"];


                            require "partials/functions/update_to_do.php";
                            update_to_do($completed, $title, $createdBy, $id, $priority); 
                       
                    }//end elseif
                    
                    }//end if
                 }//end foreach
            
            else {
                echo '<p class="empty_list">
                YOUR TO\'DO LIST IS EMPTY!
                </p>';
            }
            
         
            
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
                            
                echo '
                <div class="button_wrapper2">
                
                    <form id="clear_list" 
                    method="POST">
                    <input type="hidden" 
                    name="clear">
                    <input type="submit" 
                    value="CLEAR ALL">
                    </form>
                    
                    <form id="prior_list" 
                    method="POST">
                    <input type="hidden" 
                    name="sort_list">
                    <input type="submit" 
                    value="SORT BY PRIORITY">
                    </form>
                </div>';
                
                
                
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
