<?phpif (!defined('BASEPATH')) exit('No direct script allowed! ');class Display_lib{    function main_page()    {        $CI =& get_instance();        $CI->load->view('system_header_view');        $CI->load->view('header_mainpage_view');        $CI->load->view('mainpage_view');        $CI->load->view('footer_view');    }    /***************************������*****************************/    function main_admin_page($data)    {        $CI =& get_instance();        $CI->load->view('administration/admin_header_view');        $CI->load->view('administration/admin_top_view', $data);        $CI->load->view('administration/admin_leftmenu_view', $data);        $CI->load->view('administration/admin_content_view', $data);        $CI->load->view('administration/admin_footer_view');    }    /*********************** ������ ����������� ******************************/    function user_access($data)    {        $CI =& get_instance();        $CI->load->view('administration/pages/users/users_header_view.php');        $CI->load->view('administration/admin_top_view', $data);        $CI->load->view('administration/admin_leftmenu_view', $data);        $CI->load->view('administration/pages/users/users_access_view', $data);        $CI->load->view('administration/admin_footer_view');    }    /*DCS Units*/    function edit_category_units($data)    {        $CI =& get_instance();        $CI->load->view('administration/pages/users/users_header_view.php');        $CI->load->view('administration/admin_top_view', $data);        $CI->load->view('administration/admin_leftmenu_view', $data);        $CI->load->view('administration/pages/dcs_units/edit_units_view', $data);        $CI->load->view('administration/admin_footer_view');    }}?>