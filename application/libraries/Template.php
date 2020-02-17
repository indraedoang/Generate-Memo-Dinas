    <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class template {


        var $_layout = '';
        var $_sidebar = '';

        
        function template(){
            $this->CI =& get_instance();
            $this->_init_vars();
            $this->theme = $this->_web_settings('sites','themes');
        }

        function _init_vars(){
            define('IS_AJAX', (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=="XMLHttpRequest"));
        }
        function _web_settings($option,$name)
        {
            $this->CI->load->model('M_setting', 'mUtils');
            $themes = $this->CI->mUtils->select($option,$name);
            return $themes->content;
        }
        function use_layout($layout=False)
        {
            if ($layout===False || !$layout) return;
            if ($layout=="default") $this->_layout = "layout";
            else $this->_layout = 'layout-'.$layout;
        }
        function _get_view($view='')
        {
            // get view name from controller & name if not stated
            if (!$view):
                $view = $this->CI->uri->rsegment(2);
            endif;
            return $view;
        }
        function render($view='', $data=False, $layout=False)
        {
            $dir = $this->CI->router->fetch_module();
            if(!$view) $t_view = $this->_get_view();
            else $t_view = $view;

            $_layout = $this->theme.'/'.$this->_layout; // default layout
            $layout = $_layout;
            if (IS_AJAX) $layout = $t_view;
            $data['__content'] = $dir. '/' .$t_view;
            $this->CI->load->view($layout, $data);
        }

        function render_partial($t_view, $data=False, $outbuff=False)
        {
            $t_view = (is_login())? ''.$t_view : 'sites/'.$t_view ;
            if (!preg_match('/^\//i', $t_view)):
                if($this->_layout!='default') $t_view = $this->theme.'/'.$t_view;
            endif;

            return $this->CI->load->view($t_view, $data, $outbuff);
        }

        function respond_with($view='', $data=False, $layout='')
        {
            if (IS_AJAX):
                $rv['message'] = $this->render_partial($view, $data, True);
                return $this->ajax_response(json_encode($rv));
            endif;
            $this->render($view, $data, $layout);
        }
        function ajax_response($message, $response_code='200')
        {
            $this->CI->output->enable_profiler(False);
            $this->CI->output->set_status_header($response_code);
            $this->CI->output->set_output($message);
        }
    }