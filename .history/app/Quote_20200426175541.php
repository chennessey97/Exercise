<?php

use Illuminate\Support\Arr;

class Quote extends ArrayObject
{

    /* Member Fields */
    private $quotelist = array();

    /* Class Constructor */
    public function __construct($arr=array())
    {
        $this -> quotelist = $arr;
    }

    /* Class Functions */
    // Should return the entire array of Quote.
    function getQuote(){
        return $this -> quotelist;
    }

    function getQuote($n){
        $list = array();
        $list = $this -> quoteObj();
        $quote = $list[$n];
        return $quote;
    }

    // Replace the array of Quote.
    function setQuote($Quote=array()){
        $this -> quotelist = $Quote;
    }

    // Should accept a Date as the input, and should always
    // return the same quote for a given day within a month.
    function quotd($date)
    {
        $properdate = strtotime($date=date('yyyy-mm-dd'));
        echo $date->format('d', $properdate);
        $i = var_dump($date);
        $qotd = $this -> getQuote($i);
        return $qotd;
    }

    // Return a random quote from the list of Quote.
    function random($arr){
        if(empty($arr))
            $arr = $this -> quoteObj();
        $randomQuote = Arr::pull($arr, rand(0, sizeof($arr)));
        return $randomQuote -> with($arr);
    }

    // Return an array of all Quote where the text includes
    // the passed-in term.
    function search($word){
        $quotelist = $this -> getQuote();
        $includelist = array();
        for($n = 0; $n <= 40; $n++) {
            $author = $quotelist[$n]["author"];
            $quote = $quotelist[$n]["quote"];
            if($word == $author || $word == $quote)
                array_push($includelist, ["author" => $author,
                                          "quote" => $quote]);
        }
        return $includelist;
    }

    function quoteObj(){
        $list = array();
        $list = new Quote(config(['config/QuoteList.php']));
        return $list;
    }

 }

?>
