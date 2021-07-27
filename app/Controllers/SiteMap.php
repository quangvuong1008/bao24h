<?php
namespace App\Controllers;
use App\Models\SiteMapUrlModel;

class SiteMap extends BaseController
{

 public function filterAllTagLinkOnPage()
 {
     $url = "https://www.baotinnhanh.org/";
     $html = file_get_contents($url);
     $doc = new \DOMDocument();
     @$doc->loadHTML($html); //helps if html is well formed and has proper use of html entities!
     $xpath = new \DOMXpath($doc);
     $nodes = $xpath->query('//a');
     foreach($nodes as $node) {
       $link = $node->getAttribute('href');
       if ($link == '/'){
           $link = $url;
       }
       $check_link_exist = (new SiteMapUrlModel())->get_link_site_map($link);
       $str = strpos($link, $url) === false ? false : true;
       $validate_url = $this->validate_url($link);
       if ($validate_url && $str && !$check_link_exist){
           $level = 1;
           if ( $link == $url){
               $level = 0;
           }
           $res = (new SiteMapUrlModel())->insert_link_site_map($link,$level);
       }
     }
     $all_link_level_1 = (new SiteMapUrlModel())->select_all_link_by_level(1);
     foreach ($all_link_level_1 as $item){
       $res = $this->scanLinkSubLevel($item->link,2);
       if (!$res) continue;
     }
     $time_last_mod = date("Y-m-d\Th:m:s+00:00");
     if(file_exists('sitemap.xml')){
         $time_last_mod = filemtime("sitemap.xml");
         $time_last_mod = date("Y-m-d\Th:m:s+00:00", $time_last_mod);
     }

     $text = '';
     $list_priority = [
         '0' => 1,
         '1' => 0.8,
         '2' => 0.64,
         '3' => 0.51
     ];

     $all_link_site_map = (new SiteMapUrlModel())->select_all_link();
     foreach ($all_link_site_map as $item){
        $priority = $list_priority[$item->level];
         $text .= "<url>\n".
                  "<loc>$item->link</loc>\n".
                  "<lastmod>$time_last_mod</lastmod>\n".
                  "<priority>$priority</priority>\n".
                  "</url>\n";
     }
     $pf = fopen ('sitemap.xml', "w");
     if (!$pf) {
         echo "Cannot create file!" . NL;
         return;
     }
     fwrite ($pf, "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n" .
         "<!-- Created with iProDev PHP XML Sitemap Generator " . 1.1 . " http://iprodev.com -->\n" .
         "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\"\n" .
         "        xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"\n" .
         "        xsi:schemaLocation=\"http://www.sitemaps.org/schemas/sitemap/0.9\n" .
         "        http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\">\n" .
         $text);
     fwrite ($pf, "</urlset>\n");
     fclose ($pf);
     return $this->response->redirect(route_to('admin_setting'));
 }

public function validate_url($url) {
        $path = parse_url($url, PHP_URL_PATH);
        $encoded_path = array_map('urlencode', explode('/', $path));
        $url = str_replace($path, implode('/', $encoded_path), $url);
        return filter_var($url, FILTER_VALIDATE_URL) ? true : false;
    }


 public function scanLinkSubLevel($url,$level)
 {
     $file_headers = @get_headers($url);
     if($file_headers[0] == 'HTTP/1.1 404 Not Found') {
         return false;
     }
     else {
         $html = file_get_contents($url);
         $doc = new \DOMDocument();
         @$doc->loadHTML($html); //helps if html is well formed and has proper use of html entities!
         $xpath = new \DOMXpath($doc);
         $nodes = $xpath->query('//a');
         foreach($nodes as $node) {
             $link = $node->getAttribute('href');
             if ($link == '/'){
                 $link = $url;
             }
             $check_link_exist = (new SiteMapUrlModel())->get_link_site_map($link);
             $str = strpos($link,'https://www.baotinnhanh.org/') === false ? false : true;
             $validate_url = $this->validate_url($link);
             if ($validate_url && $str && !$check_link_exist){
                 $level = $level;
                 if ( $link == $url){
                     $level = 0;
                 }
                 $res = (new SiteMapUrlModel())->insert_link_site_map($link,$level);
                 $this->scanLinkSubLevel($link,3);
             }
         }
     }
 }
}