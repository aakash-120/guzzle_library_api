<?php
//  require_once ""
 require_once "../vendor/autoload.php";
          
 use GuzzleHttp\Client;
   
use Phalcon\Mvc\Controller;


class IndexController extends Controller
{
    public function indexAction()
    {      
        $host = 'https://openlibrary.org/search.json?q=';
        $url = $this->request->get('search');
        $len = strlen($url);
        for ($i = 0; $i < $len; $i++) {
            if ($url[$i] == ' ') {
                $url[$i] = '+';
            }
        }
        $path = '&mode=ebooks&has_fulltext=true';
        $url2 = $host.$url.$path;
         
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => $url2,
        ]);
          
        
        $response = $client->request('GET');
          
          
        $body = $response->getBody();
        $arr_body = json_decode($body,true);
        // echo "<pre>";
        // print_r($arr_body);
        // die;

        // $response = $client->get('https://openlibrary.org/search.json?q=fantastic+mr+fox&mode=ebooks&has_fulltext=true');

        // // $body = $client->getBody();
        // // $arr_body = json_decode($body);
        //    echo "<pre>";
        // print_r($response);
        // die;
   

       $this->view->nescafe = $arr_body;
     // die();

    }
    public function searchAction() {

    }


    public function detailAction() {
        print_r($this->request->getPost());
        $this->view->data = $this->request->getPost();
        //die();
    }

    // public function googleAction()
    // {
    //     print_r($this->request->getPost());
    //     die();
    // }
}