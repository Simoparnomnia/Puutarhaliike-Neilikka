<?php
#Kotitehtävä 12.09.2022, rakenna Neilikan sivu tähän malliin, katso Slack-kanava
#Käytä ympäristömuuttujaa SCRIPT_NAME polkujen löytämiseen 
#jne.

    include('navigointi.html')
    //$path=pathinfo($_SERVER['SCRIPT_NAME']);
    //$sivu=ucfirst($path['filename']);
    
?>


<?php
    /* Pankki-API valuutta-esimerkki 

        //Haetaan POST-ympäristömuuttujasta syötetyn kohdevaluutan arvo muuttujaan
        $valuutat = $_REQUEST['valuutat'];
        $valuutat = isset($_POST['valuutat']) ?
        $_POST['valuutat'] :
        ''
        //Vaihtoehto, vieläkin lyhyempi ternary-operaattori (shorthand)
        $valuutat=$_POST['initial'] ?: '';




    */


    /*
    GET-esimerkki
    $getesimerkki=$_GET['muuttujaname']
    */
    $vakio=30;
    
    /* Funktioesimerkki */
    function summaErotus($luku1, $luku2){
        //globaali muuttuja funktioon:
        //global $vakio;
        //echo  $vakio;
        $summa=$luku1+$luku2;
        $erotus=$luku1-$luku2;
        return array('s' => $summa,'e' => $erotus);
    }
    
    $a=false;
    $b=[];
    $c=($a == $b);
    $SERVER= array('a' => 1,2,3);
    //$ykkonen=['a']
    
    list($summa,$erotus)=summaErotus(16,3);
    echo "Summa: $summa Erotus: $erotus";
    echo "c:$c<br>";
    echo '<h1>$_SERVER-muuttujat</h1><br>';

    foreach ($_SERVER AS $key => $value){
        echo "$key':'.$value.'<br>";
    };
?>



<?php
    include('footer.html')
?>