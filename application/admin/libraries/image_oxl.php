<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Image_oxl extends CI_Controller {

	###############################################################
							//Thumb Function
	###############################################################
	public function make_thumb($mypath,$pathtostore,$width_req,$height_req)  
   	{ 
      if (!is_dir($pathtostore)) {
            if (!mkdir($pathtostore, 0777, TRUE)) {
                exit('dir not created.');
            }
        }
      $config_manip=array();
         $list = list($width, $height) = getimagesize($mypath);
      $data=$this->calculateDimensions($width,$height,$width_req,$height_req);
      $path=$pathtostore;
      $source_path = $mypath;
      $target_path = $path;
      $config_manip = array(
           'image_library' => 'gd2',
           'source_image' => $source_path,
           'new_image' => $target_path,
           'maintain_ratio' => TRUE,
           'create_thumb' => FALSE,
           'thumb_marker' => '_thumb',
           'width' => $data['width'],
           'height' =>$data['height']
       );
      // $this->load->library('image_lib', $config_manip);
      $this->load->library('image_lib');
      $this->image_lib->initialize($config_manip);
       if (!$this->image_lib->resize()) {
           echo $this->image_lib->display_errors();
       }
         unset($config_manip);
	}
  function calculateDimensions($width,$height,$maxwidth,$maxheight)
{

        if($width != $height)
        {
            if($width > $height)
            {
                $t_width = $maxwidth;
                $t_height = (($t_width * $height)/$width);
                //fix height
                if($t_height > $maxheight)
                {
                    $t_height = $maxheight;
                    $t_width = (($width * $t_height)/$height);
                }
            }
            else
            {
                $t_height = $maxheight;
                $t_width = (($width * $t_height)/$height);
                //fix width
                if($t_width > $maxwidth)
                {
                    $t_width = $maxwidth;
                    $t_height = (($t_width * $height)/$width);
                }
            }
        }
        else
            $t_width = $t_height = min($maxheight,$maxwidth);

        return array('height'=>(int)$t_height,'width'=>(int)$t_width);
    }
    ###############################################################
							//Thumb Function
	############################################################### 
  
  public function uploadimage($targetpath,$imagename,$size,$onlyimage=1)
  { 
    if (!is_dir($targetpath)) {
            if (!mkdir($targetpath, 0777, TRUE)) {
                exit('dir not created.');
            }
        }
    $config['upload_path'] = $targetpath;
    /*$config['allowed_types'] = 'gif|jpg|png|doc|txt|pdf|xls|docx|xlsx';*/
    $config['allowed_types'] = '*';
    // $config['allowed_types'] = 'gif|jpg|png';
    $config['max_size']  = 10240 * 5;
    $config['encrypt_name'] = TRUE;
    $config['overwrite'] = false;
    $this->load->library('image_lib');
    $this->load->library('upload', $config);
    
    if ($this->upload->do_upload($imagename))
    {
        extract($this->upload->data($imagename));
        $vImage = $file_name;
        if ($onlyimage == 1) 
        {
          $mypath=$targetpath.'/'.$vImage;
          $pathtostore=$targetpath.'/thumb/';
          $this->make_thumb($mypath,$pathtostore,$size,$size);
        }
        $this->image_lib->clear();
        return  $vImage;

    }
    else
    {
        $err = array('MESSAGE' => $this->upload->display_errors());
        echo json_encode($err);
    }
  }
}

/* End of file image_oxl.php */
/* Location: .//C/Users/Rahul-Kumawat/AppData/Local/Temp/fz3temp-1/image_oxl.php */