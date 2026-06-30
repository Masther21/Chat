<?php
    #Inicio de la seccion
        session_start();
    #Requerir el modelo de Usuario 
     require_once(__DIR__. '/../Models/Usuario.php');

    class HomeController extends Controller
    {
        private $UsuarioModel;
        private $ModuloModel;
        private $PermisoModel;
        private $RollesModel; 
        
        public function __construct(PDO $coneccion) 
        {
            $this->UsuarioModel = new Usuario($coneccion);
            $this->RollesModel = new Rolles($coneccion);
            $this->PermisoModel = new Permisos($coneccion);
            $this->ModuloModel = new Modulos($coneccion);
        }


        public function home() 
        {

            $res = new Result();
            $ModulosMenu = $this->ModuloModel->getAll();
            $res->success = True;
            $res->result = $ModulosMenu;
            echo json_encode($res);

            $this->render('home', [], 'site');
        }
    }
    
