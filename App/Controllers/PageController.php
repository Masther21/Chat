<?php

    #Inicio de la seccion
        session_start(); 
    #Requerir el modelo de Usuario 
        require_once(__DIR__. '/../Models/Usuario.php');
        require_once(__DIR__. '/../Models/Mensajes.php');
    
    #Aquí prodemos encontrar los controladores de llaman las vistas y otros procesos  
        class PageController extends Controller 
        {
            private $UsuarioModel;
            private $MensajesModel;
            public function __construct(PDO $coneccion) 
            {
                $this->UsuarioModel = new Usuario($coneccion);
                $this->MensajesModel = new Mensajes($coneccion);
            }

            public function home() 
            {
                $resUser = new Result();
                $this->render('home', [], 'site');
            }

            public function registro() 
            {
                $this->render('registro', [], 'site');
            }

            public function chat() 
            {
                $resUser = new Result();
                if (!isset($_SESSION['unique_id'])) {
                    // Si no hay sesión activa, redirige al login
                    header("Location: crital/public/");
                    exit;
                }
                $this->render('chat', [], 'site');   
            }

            public function OptenerUser() 
            {
                $resUser = new Result();
                $postData = file_get_contents('php://input');
                $dataUser = json_decode($postData, TRUE);

                // Buscar usuario por email
                $modelUsuario = $this->UsuarioModel->getByMail($dataUser['email']);

                if (!$modelUsuario) {
                    $resUser->success = false;
                    $resUser->message = 'Usuario no encontrado';
                    echo json_encode($resUser);
                    return;
                }

                // Validar contraseña
                if ($dataUser['pass'] !== $modelUsuario['pass_u']) {
                    $resUser->success = false;
                    $resUser->message = 'Contraseña incorrecta';
                    echo json_encode($resUser);
                    return;
                }

                // Login correcto → guardar sesión

                $_SESSION['estado_id'] = $modelUsuario['estado_u'];
                $_SESSION['unique_id'] = $modelUsuario['id_unico_u'];

                $resUser->success = true;
                $resUser->message = 'Login exitoso';
                $resUser->result = $modelUsuario;

                echo json_encode($resUser);
            }

            public function OptMsnUser() 
            {
                $resUser = new Result();
                if (!isset($_SESSION['unique_id'])) {
                    header("Location: /");
                    exit;
                }

                $idSalUnic = $_SESSION['unique_id'];
                $idUsuario = intval($_POST['id_u'] ?? null);

                if (!$idUsuario) {
                    $resUser->success = false;
                    $resUser->message = 'No se recibió ID';
                    echo json_encode($resUser);
                    exit;
                }

                // Buscar usuario destino
                $modelUsuario = $this->UsuarioModel->getById($idUsuario);
                $idEntUnic = $modelUsuario['id_unico_u'];

                // Marcar mensajes como leídos
                $this->MensajesModel->markAsRead(
                    $idEntUnic, 
                    $idSalUnic  
                );
                
                // Obtener mensajes entre ambos CM2025
                $allChating = $this->MensajesModel->getMensajes($idSalUnic, $idEntUnic);
                
                if (empty($allChating)) {
                    $resUser->success = false;
                    $resUser->message = 'No se encontraron mensajes';
                    $resUser->result = [];
                    $resUser->answer = $modelUsuario;
                } else {
                    foreach ($allChating as &$msg) {
                        // Calcula tipo según remitente
                        $msg['tipo'] = ($msg['id_saliente_m'] == $idSalUnic) ? 'enviado' : 'recibido';
                        
                        // Usa directamente el campo fecha_m y lo formatea
                        $msg['fecha'] = (!empty($msg['fecha_m'])) ? date("H:i",strtotime($msg['fecha_m'])) : NULL;
                    }
                    
                    $resUser->success = true;
                    $resUser->message = 'Chats Encontrados';
                    $resUser->result = $allChating;
                    $resUser->answer = $modelUsuario;
                }
                
                echo json_encode($resUser);
            }

            public function UnreadMessages()
            {
                $resUser = new Result();
                if(!isset($_SESSION['unique_id'])) {
                    exit;
                }

                $receiver = $_SESSION['unique_id'];

                $rows = $this->MensajesModel->getAllUnread($receiver);

                $users = $this->UsuarioModel->getAll();

                $result=[];

                foreach($users as $user) {
                    $count=0;
                    foreach($rows as $row) {
                        if ($row["id_saliente_m"] == $user["id_unico_u"]) {
                            $count = $row["unread_count"];
                            break;
                        }
                    }

                    $result[] = ["id_u" => $user["id_u"], "unread_count" => $count];
                }
                $resUser->success = true;
                $resUser->message = 'Mensaje detectados!';
                $resUser->result = $result;
                
                echo json_encode($resUser);
            }

            public function create() 
            {
                $resUserC = new Result();

                $idUnico = rand(10000000, 99999999);

                // Datos de texto
                $nombre  = $_POST['nombre'] ?? null;
                $email   = $_POST['email'] ?? null;
                $pass    = $_POST['pass'] ?? null;
                $conPass = $_POST['conPass'] ?? null;

                // Imagen
                $upload_path = 'NO IMAGE'; 

                if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
                    $img_name = $_FILES['img']['name'];
                    $img_type = $_FILES['img']['type'];
                    $tmp_name = $_FILES['img']['tmp_name'];
                    $img_size = $_FILES['img']['size'];

                    $allowed_types = ['image/jpg', 'image/jpeg', 'image/png', 'image/gif'];
                    if (in_array($img_type, $allowed_types)) {

                        $base_dir = __DIR__ . "/../../Public/Assets/IMG/";
                        $base_dDB = "/crital/Public/Assets/IMG/";
                        $month_folder = date("F"); 
                        $upload_dir = $base_dir . $month_folder . "/";
                        $db_table = $base_dDB . $month_folder . "/";     
                        
                        if (!is_dir($upload_dir)) {
                            mkdir($upload_dir, 0777, true);
                        }

                        $new_name = uniqid() . "_" . basename($img_name);
                        $upload_path = $upload_dir . $new_name;
                        $cargar_img = $db_table . $new_name;

                        if (move_uploaded_file($tmp_name, $upload_path)) {
                            // Ruta pública para mostrar en navegador
                            $public_path = "/crital/Public/Assets/IMG/" . $month_folder . "/" . $new_name;
                        } else {
                            $public_path = "UPLOAD ERROR";
                        }

                    }
                }

                // Insertar en la base de datos (una sola vez)
                $this->UsuarioModel->insert([
                    'id_unico_u' => $idUnico,
                    'name_u'     => $nombre,
                    'correo_u'   => $email,
                    'pass_u'     => $pass,
                    'conf_pass_u'=> $conPass,
                    'img_u'      => $cargar_img,
                ]);

                $resUserC->success = true;
                $resUserC->message = 'El registro fue insertado correctamente';
                echo json_encode($resUserC);
            }
            
            public function SendMessage() 
            {
                $resData = new Result();
                                
                // Validar sesión
                if (!isset($_SESSION['unique_id'])) {
                    echo json_encode(["success" => false, "message" => "No hay sesión activa"]);
                    exit;
                }

                // Recibir datos del formulario
                $idSender   = intval($_POST['id_sender'] ?? 0);
                $idReceiver = intval($_POST['id_receiver'] ?? 0);
                $mensaje    = trim($_POST['mensaje'] ?? '');

                $modelUsuario = $this->UsuarioModel->getById($idReceiver);
                $idUnicReceiver = $modelUsuario['id_unico_u'];
                
                $upload_path = 'NO IMAGE'; // valor por defecto si no se sube nada

                if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] === UPLOAD_ERR_OK) {
                    $img_name = $_FILES['archivo']['name'];
                    $img_type = $_FILES['archivo']['type'];
                    $tmp_name = $_FILES['archivo']['tmp_name'];
                    $img_size = $_FILES['archivo']['size'];

                    $allowed_types = ['image/jpg', 'image/jpeg', 'image/png', 'image/gif'];
                    if (in_array($img_type, $allowed_types)) {
                        
                        $base_dir = "../Public/Assets/IMG/";
                        $month_folder = date("F"); 
                        $upload_dir = $base_dir . $month_folder . "/";

                        if (!is_dir($upload_dir)) {
                            mkdir($upload_dir, 0777, true);
                        }

                        $new_name = uniqid() . "_" . basename($img_name);
                        $upload_path = $upload_dir . $new_name;

                        if (move_uploaded_file($tmp_name, $upload_path)) {
                            // archivo movido correctamente
                        } else {
                            $upload_path = 'UPLOAD ERROR';
                        }
                    }
                }

                // Validar datos mínimos
                if (empty($idSender) || empty($idUnicReceiver) || empty($mensaje)) {
                    echo json_encode(["success" => false, "message" => "Datos incompletos"]);
                    exit;
                }

                // Insertar en la base de datos (una sola vez)
                $this->MensajesModel->insert([
                    'id_entrante_m' => $idUnicReceiver,
                    'id_saliente_m' => $idSender,
                    'msj_m'         => $mensaje,
                    'archivo_m'     => $upload_path,
                    'leido_m'       => 0 
                ]);

                // Obtener mensajes entre ambos
                $allChating = $this->MensajesModel->getMensajes($idSender, $idUnicReceiver);

                if (empty($allChating)) {
                    $resData->success = false;
                    $resData->message = 'No se encontraron mensajes';
                    $resData->result = [];
                    $resData->answer = $modelUsuario;
                } else {
                    foreach ($allChating as $msg) {
                        // Calcula tipo según remitente
                        $msg['tipo'] = ($msg['id_saliente_m'] == $idSender) ? 'enviado' : 'recibido';
                        
                        // Usa directamente el campo fecha_m y lo formatea
                        $msg['fecha'] = (!empty($msg['fecha_m'])) ? date("H:i",strtotime($msg['fecha_m'])) : NULL;
                    }
                    $resData->success = true;
                    $resData->message = 'Chats encontrados y el registro fue agregado correctamente';
                    $resData->result = $allChating;
                    $resData->answer = $modelUsuario;
                }
                echo json_encode($resData);
            }

            public function dataLogued()
            {
                $resUser = new Result();

                if (!isset($_SESSION['unique_id'])) {
                    $resUser->success = false;
                    $resUser->message = 'No hay sesión activa';
                    echo json_encode($resUser);
                    exit;
                }

                // Usuario logueado
                $userId = $_SESSION['unique_id'];
                
                // Datos del usuario logueado
                $modelUsuario = $this->UsuarioModel->getByIdUniq($userId);

                // Todos los usuarios
                $modelAllUser = $this->UsuarioModel->getAll();

                // Agregar cantidad de mensajes no leídos
                foreach ($modelAllUser as $key => $user) {
                    // Opcional: no mostrar al usuario logueado en la lista
                    if ($user['id_unico_u'] == $userId) {
                        continue;
                    }

                    $modelAllUser[$key]['unread_count'] = $this->MensajesModel->getUnreadCount(
                        $user['id_unico_u'], // usuario que envió
                        $userId        // usuario logueado
                    );

                }
                
                $resUser->success = true;
                $resUser->message = 'Datos obtenidos correctamente';
                $resUser->result  = $modelUsuario;
                $resUser->answer  = $modelAllUser;

                header('Content-Type: application/json');
                echo json_encode($resUser);
            }

            public function logout() 
            {
                $resUser = new Result();
                // Iniciar sesión si no está iniciada
                if (!isset($_SESSION['unique_id'])) {
                    $resUser->success = false;
                    $resUser->message = 'No hay sesión activa';
                    echo json_encode($resUser);
                    exit;
                }
                
                // Destruir todos los datos de sesión
                session_destroy();
                $resUser->success = true;
                $resUser->message = 'Sesión cerrada correctamente';
                echo json_encode($resUser);
                
            }
        }
    
