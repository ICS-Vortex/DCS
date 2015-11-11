<?php
	if ( ! defined('BASEPATH')) exit('No direct script allowed! ');
class Main extends Controller {
    
	function __constructor()
	{
		parent::Controller();
        
        	
	}
	
	public function index()
	{        
		$this->functions_lib->main_authorize();            
        $this->display_lib->main_page();
	}
    
        /******************************************************************************************************/
        /*******************************************РЕМ*******************************************************/
        /******************************************************************************************************/
    public function rem()
    {
        $this->functions_lib->main_authorize();
        $data=array();
        $data['adress'] = $this->main_model->get_adress();    
        $this->display_lib->rem_page($data);    
    }
    public function rem_objects()
    {
        $this->functions_lib->main_authorize();
        $data=array();
        $data['objects'] = $this->main_model->get_objects();    
        $this->display_lib->rem_objects_page($data);    
    }
    public function rem_counters()
    {
        $this->functions_lib->main_authorize(); 
        $this->display_lib->rem_counters_page();    
    }   
    function rem_get_adress_stat()
    {
        $this->functions_lib->main_authorize();
        $from = $this->input->post('from');
        $to = $this->input->post('to');
        
        //echo $from." - ".$to;exit();

            $adress = $this->input->post('adress');
            $rem = $this->main_model->get_by_adress($from,$to,$adress); 
            //print_r($rem);exit();           

        echo '<table class="features-table" >
                        <thead>
                        	<tr>
                        		<td>Населений пункт</td>
                                <td>дата</td> 
                                <td>№ лічильника</td>                                
                        		<td class="grey">кВт</td>
                        	</tr>
                        </thead>                         
                        <tbody >';           
        $sum = 0;
        foreach($rem as $item):
        {
            $date = $this->functions_lib->change_date($item['date']);
            echo '
                <tr>
              		<td nowrap>'.$item['addr'].'</td>
                    <td nowrap>'.$date.'</td>
                    <td nowrap>'.$item['counter'].'</td>                    
              		<td class="grey">'.$item['total'].'</td>
                </tr> 
            ';
            $sum = $sum + $item['total'];   
        }
        endforeach;
        echo '</tbody>                         
                            <tfoot>
                               	<tr>
                              		<td nowrap>РАЗОМ</td>                                    
                              		<td nowrap></td>   
                                    <td nowrap></td>                                 
                                    <td class="grey">'.$sum.'</td>
                               	</tr>
                            </tfoot>      	
                        </table>';
    }
    
    function get_stat()
    {
        $this->functions_lib->main_authorize();
        $from = $this->input->post('from');
        $to = $this->input->post('to');
        
        //echo $from." - ".$to;exit();
        $type = $this->input->post('type');
        $rem = $this->main_model->get_by_type($from,$to,$type);            
        
        //print_r($rem);exit();
        echo '<table class="features-table" >
                        <thead>
                        	<tr>
                        		<td>Населений пункт</td>
                        		<td class="grey">кВт</td>
                        	</tr>
                        </thead>                         
                        <tbody >';           
        $sum = 0;
        foreach($rem as $item):
        {            
            echo '
                <tr>
              		<td nowrap>'.$item['addr'].'</td>
              		<td class="grey">'.$item['SUM(total)'].'</td>
                </tr> 
            ';
            $sum = $sum + $item['SUM(total)'];   
        }
        endforeach;
        echo '</tbody>                         
                            <tfoot>
                               	<tr>
                              		<td nowrap>РАЗОМ</td>
                              		<td class="grey">'.$sum.'</td>
                               	</tr>
                            </tfoot>      	
                        </table>';
            
            
        
    }
    function rem_get_object_stat()
    {
        $this->functions_lib->main_authorize();
        $from = $this->input->post('from');
        $to = $this->input->post('to');
        
        //echo $from." - ".$to;exit();
        
        if($this->input->post('object'))
        {
            $object = $this->input->post('object');
            $rem = $this->main_model->get_by_object($from,$to,$object); 
            //print_r($rem);exit();           
        }
        else
        {
            $rem = $this->main_model->get_rem_stat($from,$to);   
        }
        echo '<table class="features-table" >
                        <thead>
                        	<tr>
                        		<td>Населений пункт</td>
                                <td>№ лічильника</td>
                                <td>Дата</td>                                
                        		<td class="grey">кВт</td>
                        	</tr>
                        </thead>                         
                        <tbody >';           
        $sum = 0;
        foreach($rem as $item):
        { 
            $date = $this->functions_lib->change_date($item['date']);
            echo '
                <tr>
              		<td nowrap>'.$item['addr'].'</td>
                    <td nowrap>'.$item['counter'].'</td>
                    <td nowrap>'.$date.'</td>                    
              		<td class="grey">'.$item['total'].'</td>
                </tr> 
            ';
            $sum = $sum + $item['total'];   
        }
        endforeach;
        echo '</tbody>                         
                            <tfoot>
                               	<tr>
                              		<td nowrap>РАЗОМ</td>                                    
                              		<td nowrap></td>  
                                    <td nowrap></td>                                   
                                    <td class="grey">'.$sum.'</td>
                               	</tr>
                            </tfoot>      	
                        </table>';   
    }   
    
        /******************************************************************************************************/
        /************************************************ГАЗ**************************************************/
        /******************************************************************************************************/
    
    /*********************************************Управління даними по ГАЗУ*********************************************************/
    public function gas()
    {
        $this->functions_lib->main_authorize();
        $data=array();
        $data['adress'] = $this->main_model->gas_adress();    
        $this->display_lib->gas_page($data);          
    }
    
    function gas_get_adress_stat()
    {
        $this->functions_lib->main_authorize();
        $from = $this->input->post('from');
        $to = $this->input->post('to');
        
        //echo $from." - ".$to;exit();

            $adress = $this->input->post('adress');
            $gas = $this->main_model->gas_by_adress($from,$to,$adress); 
            //print_r($rem);exit();           

        echo '<table class="features-table" >
                        <thead>
                        	<tr>
                        		<td>Населений пункт</td>
                                <td>дата</td> 
                                <td>№ лічильника</td>                                
                        		<td class="grey">кубометри</td>
                        	</tr>
                        </thead>                         
                        <tbody >';           
        $sum = 0;
        foreach($gas as $item):
        {
            $date = $this->functions_lib->change_date($item['date']);
            echo '
                <tr>
              		<td nowrap>'.$item['addr'].'</td>
                    <td nowrap>'.$date.'</td>
                    <td nowrap>'.$item['counter'].'</td>                    
              		<td class="grey">'.$item['total'].'</td>
                </tr> 
            ';
            $sum = $sum + $item['total'];   
        }
        endforeach;
        echo '</tbody>                         
                            <tfoot>
                               	<tr>
                              		<td nowrap>РАЗОМ</td>                                    
                              		<td nowrap></td>   
                                    <td nowrap></td>                                 
                                    <td class="grey">'.$sum.'</td>
                               	</tr>
                            </tfoot>      	
                        </table>';
    }
    
    
    public function gas_stat()
    {
        $this->functions_lib->main_authorize();
        $this->display_lib->gas_total();          
    }
    function gas_total()
    {
        $this->functions_lib->main_authorize();
        $from = $this->input->post('from');
        $to = $this->input->post('to');
        $gas = $this->main_model->get_total($from,$to); 
        
        echo '<table class="features-table" >
                        <thead>
                        	<tr>
                        		<td>Населений пункт</td>                             
                        		<td class="grey">кВт</td>
                        	</tr>
                        </thead>                         
                        <tbody >';           
        $sum = 0;
        foreach($gas as $item):
        { 
            //$date = $this->functions_lib->change_date($item['date']);
            echo '
                <tr>
              		<td nowrap>'.$item['addr'].'</td>              
              		<td class="grey">'.$item['SUM(total)'].'</td>
                </tr> 
            ';
            $sum = $sum + $item['SUM(total)'];   
        }
        endforeach;
        echo '</tbody>                         
                            <tfoot>
                               	<tr>
                              		<td nowrap>РАЗОМ</td>                                                                       
                                    <td class="grey">'.$sum.'</td>
                               	</tr>
                            </tfoot>      	
                        </table>';  
    } 
    public function gas_import()
    {
        $this->functions_lib->main_authorize();
        $this->display_lib->gas_import();   
    }
    
 
    
    
    
        /******************************************************************************************************/
        /*****************************************ПАЛИВО****************************************************/
        /******************************************************************************************************/
        
        public function fuel()
        {
            $this->functions_lib->main_authorize();    
            $this->display_lib->fuel_page();      
        }
        function fuel_stat()
        {
            $this->functions_lib->main_authorize();
            $from = $this->input->post('from');
            $to = $this->input->post('to');
            
            //echo $from." - ".$to;exit();
    
                $adress = $this->input->post('adress');
                $fuel = $this->main_model->fuel_stat($from,$to); 
                //print_r($rem);exit();           
    
            echo '<table class="features-table" >
                            <thead>
                            	<tr>
                            		<td>Дата</td>
                                    <td>КМ</td> 
                                    <td>Літри</td>                                
                            		<td class="grey">Сума</td>
                            	</tr>
                            </thead>                         
                            <tbody >';           
            $sum_money = 0;
            $sum_km = 0;
            $sum_liters = 0;
            foreach($fuel as $item):
            {
                $date = $this->functions_lib->change_date($item['date']);
                echo '
                    <tr>
                  		<td nowrap>'.$date.'</td>
                        <td nowrap>'.$item['km'].'</td>
                        <td nowrap>'.$item['liters'].'</td>                    
                  		<td nowrap>'.$item['price'].'</td>
                    </tr> 
                ';
                $sum_km = $sum_km + $item['km'];
                $sum_liters = $sum_liters + $item['liters'];
                $sum_money = $sum_money + $item['price'];   
            }
            endforeach;
            echo '</tbody>                         
                                <tfoot>
                                   	<tr>
                                  		<td class="grey">РАЗОМ</td>                                    
                                  		<td class="grey">'.$sum_km.'</td>   
                                        <td class="grey">'.$sum_liters.'</td>                                 
                                        <td class="grey">'.$sum_money.'</td>
                                   	</tr>
                                </tfoot>      	
                            </table>';   
            } 
            public function fuel_calc()
            {
                $this->functions_lib->main_authorize();    
                $this->display_lib->fuel_calc();   
            }
            function fuel_insert ()
            {
                $ip = $_SERVER["REMOTE_ADDR"];
                $this->sessions_lib->check_ip($ip);
                $this->sessions_lib->check_sesions();
                $this->sessions_lib->check_admin(); 
                $data = array();
                $data['date'] = strval($this->input->post('date'));
                $data['km'] = $this->input->post('km');
                $data['liters'] = $this->input->post('liters');
                $data['price'] = $this->input->post('price'); 
                $this->main_model->add_fuel($data);
                echo "added";
            }
            
           
           /****************************Амортизація**************************/
           /****************************Амортизація**************************/
           /****************************Амортизація**************************/ 
          
           public function new_asset()
           {
                $this->functions_lib->main_authorize();
                $data = array();
                $bookkeeper = $this->session->userdata('login');
                $data['cities'] = $this->main_model->get_cities($bookkeeper);
                ///exit(print_r($data['cities']));
                $data['funds'] = $this->main_model->get_all_funds();
                $data['category'] = $this->main_model->get_category();
                $this->display_lib->asset_add($data);
                                                   
           }
           function get_sub_number()
           {
                $this->functions_lib->main_authorize();
                $sub_number = $this->input->post('sub_number');
                $get_sub = $this->main_model->get_sub_number($sub_number);
                echo '<label class="col-xs-3 control-label">Категорія</label>';
                echo '<select class="form-control" id="category">';
                echo '<option value="">Вкажіть категорію</option>';
                foreach ($get_sub as $item):
                {
                    echo '<option value="'.$item['category_id'].'">'.$item['category_title'].'</option>';   
                }
                endforeach;
                echo '</select>';                
           }
           function asset_add()
           {
                $this->functions_lib->main_authorize();
                $data = array();
                $data['asset_title'] = $this->input->post('asset_title'); 
                $data['city_id'] = $this->input->post('city');
                $data['category_id'] = $this->input->post('category');
                $data['inventory_number'] = $this->input->post('inventory_number');
                $data['sub_number'] = $this->input->post('sub_number');
                $data['first_price'] = $this->input->post('first_price');
                $data['amort_price'] = $this->input->post('amort_price');
                $data['bookkeeper'] = $this->session->userdata('login');
                $total_calc_amort = $this->input->post('total_calc_amort');
                $data['funds_id'] = $this->input->post('funds_id');
                //print_r($data);exit();
                //echo $data['bookkeeper'];exit(); 
                if($data['bookkeeper'] == '')
                {
                    exit('fail');
                }
                $record = $this->main_model->insert_asset($data);
                //echo $record;exit();
                $asset_id = $this->main_model->get_new_asset_id();
                //print_r($asset_id);exit();
                
                $amortisation = array();
                $period_year = $this->input->post('period_year');
                $period_kvartal = $this->input->post('period_kvartal');
                $amortisation['period'] = $period_year.$period_kvartal;
                $amortisation['funds_id'] = $data['funds_id'];
                $amortisation['category_id'] = $data['category_id'];
                $amortisation['asset_id'] = $asset_id['asset_id'];
                $amortisation['amortisation'] = $total_calc_amort;
                //print_r($amortisation);exit();
                $record_amortisation = $this->main_model->insert_amortisation($amortisation);                              
                if ($record==TRUE && $record_amortisation==TRUE) 
                {
                    echo 'success';
                }
                else
                {
                    echo 'fail';
                }
           }
           function category_add()
           {
                $category = $this->input->post('category_title');
                $useful_time = intval($this->input->post('useful_time'));
                $sub_number = intval($this->input->post('sub_number'));
                $check_category = $this->main_model->check_category($category);
                if ($check_category > 0)
                {
                    echo 'exist';   
                }
                else
                {
                    $data = array();
                    $data['category_title'] = $category;
                    $data['useful_time'] = $useful_time;
                    $data['sub_number'] = $sub_number;
                    $record = $this->main_model->add_category($data);
                    if ($record == TRUE) 
                    {
                        echo 'success';
                    }
                    else
                    {
                        echo 'fail';
                    }   
                }
                
           }
            public function new_city()
           {
                $this->functions_lib->main_authorize();
                $this->display_lib->add_city();
           }
           function city_add()
           {
                $this->functions_lib->main_authorize();
                $city = $this->input->post('city');
                $check_city = $this->main_model->check_city($city);
                if ($check_city > 0)
                {
                    echo 'exist';   
                }
                else
                {
                    $data = array();
                    $data['title'] = $city;
                    $record = $this->main_model->add_city($data);
                    if ($record == TRUE) 
                    {
                        echo 'success';
                    }
                    else
                    {
                        echo 'fail';
                    }   
                }
           }
           
           public function calculate_amortisation()
           {
                $this->functions_lib->main_authorize();                
                $this->display_lib->calculate_amortisation();    
           }
           function do_calculate()
           {
                $this->functions_lib->main_authorize();
                $date = $this->input->post('period_year').$this->input->post('period_kvartal');
                //exit($date);
                $bookkeeper = $this->session->userdata('login');
                $calculating= $this->main_model->get_calc_info($bookkeeper);                
                //print_r($calculating);exit();                
                $values = "";
                foreach ($calculating as $item):
                {   
                    $asset_id = $item['asset_id'];
                    $category_id = $item['category_id'];
                    $last_amort = $item['total_amort'];
                    //echo $last_amort;exit();
                    $amort_price = $item['price'];
                    //exit($amort_price);
                    $useful_time = $item['useful_time'];
                    if ($last_amort < $amort_price)
                    {
                        $year_norm = round($amort_price/$useful_time);
                        $calculate = round($year_norm/12)*3;
                        //exit($calculate);
                        $total_amort = $calculate + $last_amort;
                        //exit($total_amort);
                        if ($total_amort > $amort_price)
                        {
                            $amortisation = $amort_price - $last_amort;                            
                            //echo $amortisation;exit();
                        }
                        else 
                        {
                            $amortisation = $calculate;
                        }                                     
                           
                    }
                    else                    
                    {
                        $amortisation = 0;
                    }
                    $values = $values."('$date','$category_id',$asset_id,$amortisation),";                                     
                      
                }                   
                endforeach;
                $values = substr($values, 0, -1);
                $record = $this->main_model->insert_calculating($values);
                if ($record == TRUE) 
                {
                    echo 'success';
                }
                else
                {
                    echo 'fail';
                }
                
           }
           
           /*****************Перерахунок амортизації*****************/
           
           public function amortisation()
           {
                $this->functions_lib->main_authorize();
                $bookkeeper = $this->session->userdata('login');
                $data = array();
                $data['cities'] = $this->main_model->get_cities($bookkeeper);
                $data['bookkeeper'] = $bookkeeper;
                $data['sub_numbers'] = $this->main_model->get_bookkeeper_sub_numbers($bookkeeper);
                $this->display_lib->get_amortisation($data);                
           }
           function get_funds_by_bookkeeper()
           {
                header('Content-Type: text/html; charset=utf-8');
                $bookkeeper = $this->input->post('bookkeeper');
                $sub_number = $this->input->post('sub_number');
                //echo $bookkeeper." ".$sub_number;
                $funds = $this->main_model->get_funds_bookkeeper($bookkeeper,$sub_number);
                //print_r($funds);exit();
                if (empty($funds) || $funds == '')
                {
                    echo "false";
                }
                else
                {
                    echo '<div class="form-group">';
                        echo '<label for="inputEmail3" class="col-sm-2 control-label">тип коштів</label>';
                        echo '<div class="col-sm-10">';
                            echo '<select class="form-control" name="funds_type" id="funds_type">';
                                foreach ($funds as $item):
                                    echo '<option value="'.(int)$item['funds_id'].'">'.$item['fund_title'].'</option>'; 
                                endforeach;   
                            echo '</select>';
                        echo '</div>';
                    echo '</div>';
                }
                
           } 
           function get_amortisation()
           {
                $data = array();                
                $this->functions_lib->main_authorize();
                $bookkeeper = $this->session->userdata('login');
                $full_name = $this->main_model->get_full_name($bookkeeper);
                //print_r($full_name);exit();
                $data['full_name'] = $full_name['full_name'];
                $sub_number = $this->input->post('sub_number');
                //exit($sub_number);
                $period_year = $this->input->post('period_year');
                $period_kvartal = $this->input->post('period_kvartal');
                $period = $period_year.$period_kvartal;
                //echo $period;exit();
                $object = $this->input->post('city_id');
                $funds_id = $this->input->post('funds_type');
                //exit($object);
                $raport = $this->main_model->get_amort_by_object($sub_number,$object,$period,$bookkeeper,$funds_id);
                if (empty($raport))
                {
                    echo "Інформація по даному періоду відсутня!";
                }
                else
                {
                    $data['raport'] = $raport;
                    $this->load->view('amortisation/raport_view',$data);
                }
                //print_r($amortisation);
           } 
           
}


/****************************FORMING NEW CSV FILE**************************/
/*

$date = $this->input->post('calc_date');
        //echo $date;exit();
        $config['upload_path'] = './rem/';
  		$config['allowed_types'] = 'csv|xls';
  		$config['max_size']	= '1500';
        $this->load->library('upload', $config);
        if ($this->upload->do_upload())
        {
            $upload_data = $this->upload->data();
            $file = $upload_data['file_name']; 
            //echo $file; 
            $fp = @fopen("./rem/file.csv", "a+");            
            
            $handle = @fopen('./rem/'.$file, "r"); 
            $date = strval($date);
            
            $row = 0;
            while (($data = fgets($handle, 4096)) !== FALSE) {
                $text =  $date.";".iconv('windows-1251','utf-8',$data);
                fwrite($fp, $text);                
            }
            fclose($handle);
            fclose($fp);
            $file_csv = 'file.csv';
            $this->main_model->insert_rem($file_csv);
            unlink('./rem/'.$file);
            unlink('./rem/file.csv');
            $this->display_lib->success_import(); 
*/





