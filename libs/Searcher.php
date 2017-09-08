<?php
class Searcher
{
    private $data = array();
  
    function get_data($search)
    {
        $query = str_replace(' ', '+', $search);
        $page = $this->get_page($query);

        $this->pars_dom($page, 'h3');
        $this-> pars_dom($page, 'span');
        $this->pars_dom($page, 'div');

        return $this->data;
    }
   
   
    function get_page($query)
    {
        $curl = curl_init(); 
        $headers = array
            (
                'User-Agent: Mozilla/5.0 (Windows; U; Windows NT 6.1; ru; rv:1.9.0.19) Gecko/2010031422 Firefox/3.0.19 (.	  NET CLR 3.5.30729)',
                'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                'Accept-Language: ru,en-us;q=0.7,en;q=0.3',
            );

        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_URL, 'https://www.google.com.ua/search?q='.$query.'');   
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);   
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);

        $page = curl_exec($curl);
        curl_close($curl); 

        return $page;
    }


    function pars_dom($page, $tag)
    {
        $dom = new DOMDocument();
        @$dom->loadHTML($page);
        $centerBlock = $dom->getElementById('ires');
        $unitBlock = $centerBlock->getElementsByTagName($tag);

        for ($i = $unitBlock->length; --$i >= 0; )
        {
            $unit = $unitBlock->item($i);
            switch ($unit->getAttribute('class'))
            {
            case 'r' :
                $this->data[title][] = $unit->nodeValue;
                break;
            case 'kv' :
                $this->data[url][] = $unit->firstChild->nodeValue;
                break;
            case 'st' :
                $this->data[text][] = $unit->nodeValue;
                break;           
            }
        }

        return true;
    }
}


