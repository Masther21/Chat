<?php
    class Mensajes extends Orm
    {
        public function __construct(PDO $coneccion)
        {
            parent::__construct('id_m','mensajes', $coneccion);
        }
    }
    
