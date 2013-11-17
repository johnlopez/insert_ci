<?php
class Formproyectotitulo extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('formproyectotitulo_model');
    }
    
    function index()
    {
        $this->load->view('formproyectotitulo_view');
    }
    
    //funcion para procesar el formulario
    function insertar_comentarios()
    {
        //si se ha pulsado el botón submit validamos el formulario con codeIgniter
        if($this->input->post('submit'))
        {
            //hacemos las comprobaciones que deseemos en nuestro formulario
            $this->form_validation->set_rules('autor','autor','trim|required|xss_clean|max_lenght[50]|min_length[2]');
            /*
            validacion para un Email
            
            $this->form_validation->set_rules('titulo','titulo','trim|valid_email|required|xss_clean');*/

            $this->form_validation->set_rules('titulo','titulo','trim|required|xss_clean|max_lenght[50]|min_length[2]');

            $this->form_validation->set_rules('descripcion','descripcion','trim|required|xss_clean|max_lenght[250]|min_length[2]');
            $this->form_validation->set_rules('resumen','resumen','trim|required|xss_clean');
            $this->form_validation->set_rules('archivo','archivo','trim|required|xss_clean');
            
            //validamos que se introduzcan los campos requeridos con la función de ci required
            $this->form_validation->set_message('required', 'Campo %s es obligatorio');
            //validamos el email con la función de ci valid_email
            $this->form_validation->set_message('valid_email', 'El %s no es v&aacute;lido');
            //comprobamos que se cumpla el mínimo de caracteres introducidos
            $this->form_validation->set_message('min_length', 'Campo %s debe tener al menos %s car&aacute;cteres');
            //comprobamos que se cumpla el máximo de caracteres introducidos
            $this->form_validation->set_message('max_length', 'Campo %s debe tener menos %s car&aacute;cteres');
            
            if (!$this->form_validation->run())
            {
                //si no pasamos la validación volvemos al formulario mostrando los errores
                $this->index();
            }
            //si pasamos la validación correctamente pasamos a hacer la inserción en la base de datos
            else 
            {
                $autor = $this->input->post('autor');    
                $titulo = $this->input->post('titulo');        
                $descripcion = $this->input->post('descripcion');                            
                $resumen = $this->input->post('resumen');
                $archivo = $this->input->post('archivo');
                //conseguimos la hora de nuestro país, en mi caso españa
                date_default_timezone_set("Chile/Continental");
                $fecha = date('Y-m-d');
                 $hora= date("H:i:s");
                //ahora procesamos los datos hacía el modelo que debemos crear
                $nueva_insercion = $this->formproyectotitulo_model->nuevo_comentario($autor,$titulo,$descripcion,$resumen,$archivo,$fecha,$hora);
            }
        }
    }
}
 
/*fin del archivo comentarios*/
?>