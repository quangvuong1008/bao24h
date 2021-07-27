<?php


namespace App\Models;


use App\Models\Interfaces\ContentInterface;
use App\Models\Interfaces\ImageAssetInterface;
use App\Models\Interfaces\UrlInterface;

class SiteMapUrlModel extends BaseModel
{
    protected $table = 'site_map_url';
    protected $primaryKey = 'id';
    protected $allowedFields = ['link', 'level'];
    /**
     * @param string|null $scenario
     * @return array
     */
    public function getRules(string $scenario = null): array
    {
       return  [];
    }

    public function insert_link_site_map($link,$level)
    {
        return $this->db->query('insert into `site_map_url`(link,level) 
                          value (?,?)',[$link,$level]);
    }

    public function select_all_link()
    {
        return (new SiteMapUrlModel())->orderBy('level', SORT_DESC)->findAll();
    }

    public function select_all_link_by_level($level)
    {
        return (new SiteMapUrlModel())->where(['level' => $level])->findAll();
    }

    public function get_link_site_map($link){
        $link_site_map_model = $this->where('link', $link)->find();
        if ($link_site_map_model) {
            return true;
        } else {
            return false;
        }
    }

    public function get_all_site_map(){
        $link_site_map_model = $this->findAll();
        if ($link_site_map_model) {
            return true;
        } else {
            return false;
        }
    }
}