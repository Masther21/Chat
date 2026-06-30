<?php
    class Orm    
    {
        protected $id;
        protected $table;
        protected $db;
        
        public function __construct($id, $table, PDO $coneccion)
        {
            $this->id = $id;
            $this->table = $table;
            $this->db = $coneccion;
        }

        public function getAll()
        {
           $stm = $this->db->prepare("SELECT * FROM {$this->table}"); 
           $stm->execute();
           return $stm->fetchAll(); 
        }

        public function getModulsAll()
        {
            $ejecutar = $this->db->query("SELECT * FROM {$this->table}");
			$requerir = $ejecutar->fetchAll(PDO::FETCH_ASSOC);
			return $requerir;
        }

         public function getMensajes($outgoing_id, $incoming_id)
        {
            $sql = "SELECT m.id_m, m.id_saliente_m, m.id_entrante_m, m.msj_m, m.fecha_m, u.img_u, u.name_u 
                    FROM {$this->table} m JOIN usuarios u ON m.id_saliente_m = u.id_unico_u
                    WHERE (m.id_saliente_m = :outgoing_id AND m.id_entrante_m = :incoming_id) 
                    OR   (m.id_saliente_m = :incoming_id AND m.id_entrante_m = :outgoing_id) 
                    ORDER BY m.fecha_m ASC";

            $stm = $this->db->prepare($sql);
            $stm->bindValue(":outgoing_id", $outgoing_id, PDO::PARAM_INT);
            $stm->bindValue(":incoming_id", $incoming_id, PDO::PARAM_INT);
            $stm->execute();

            return $stm->fetchAll(PDO::FETCH_ASSOC); 
        }

        public function getUnreadCount($idSender, $idReceiver)
        {
            $sql = "SELECT COUNT(*) FROM mensajes WHERE id_saliente_m = :idSender AND id_entrante_m = :idReceiver AND leido_m = 0";
            $stm = $this->db->prepare($sql);
            $stm->bindValue(':idSender', $idSender, PDO::PARAM_INT);
            $stm->bindValue(':idReceiver', $idReceiver, PDO::PARAM_INT);
            $stm->execute();
            return (int) $stm->fetchColumn();
        }

        public function markAsRead($idSender, $idReceiver)
        {
            $sql = "UPDATE mensajes SET leido_m = 1 WHERE id_saliente_m = :idSender AND id_entrante_m = :idReceiver AND leido_m = 0";
            $stm = $this->db->prepare($sql);
            $stm->bindValue(':idSender', $idSender, PDO::PARAM_INT);
            $stm->bindValue(':idReceiver', $idReceiver, PDO::PARAM_INT);
            return $stm->execute();
        }

        public function getAllUnread($idReceiver)
        {
            $sql = "SELECT id_saliente_m, COUNT(*) AS unread_count FROM mensajes WHERE id_entrante_m = :receiver AND leido_m = 0 GROUP BY id_saliente_m";
            $stm = $this->db->prepare($sql);
            $stm->bindValue(":receiver", $idReceiver);
            $stm->execute();
            return $stm->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getById($id)
        {
            $stm = $this->db->prepare("SELECT * FROM {$this->table} WHERE id_u = :id");
            $stm->bindValue(":id", $id); 
            $stm->execute();
            return $stm->fetch();
        }
        
        public function getByIdUniq($id_uniq)
        {
            $stm = $this->db->prepare("SELECT * FROM {$this->table} WHERE id_unico_u = :idUniq");
            $stm->bindValue(":idUniq", $id_uniq); 
            $stm->execute();
            return $stm->fetch();
        }
        
        public function getByMail($mail)
        {
            $stm = $this->db->prepare("SELECT * FROM {$this->table} WHERE correo_u = :mail");
            $stm->bindValue(":mail", $mail); 
            $stm->execute();
            return $stm->fetch();
        }

        public function insert($data)
        {
            $sql = "INSERT INTO {$this->table} (";
                foreach ($data as $key => $value) {
                    $sql .= "{$key},";
                }
                $sql = trim($sql, ',');
            $sql .=" ) VALUES (";

                foreach ($data as $key => $value) {
                    $sql .= ":{$key},";
                }
                $sql = trim($sql, ',');
            $sql .= ")";

            $stm = $this->db->prepare($sql);

            foreach ($data as $key => $value) {
                $stm->bindValue(":{$key}", $value);
            }
            $stm->execute();
        }
    }
    

    
