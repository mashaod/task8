<?php
include ('config.php');
include('libs/Searcher.php');
include ('libs/View.php');

try
{
    $searcher = new Searcher();
    $view = new View(TEMPLATE);

    if (isset($_POST['search']) && !empty($_POST['search']))
    {
        $search = $_POST['search'];
        $data = $searcher->get_data($search);
        $view->createString($data);
    }
    
    $view->createTemplate();
}
catch(Exception $e)
{
    echo $e->getMessage();
}

