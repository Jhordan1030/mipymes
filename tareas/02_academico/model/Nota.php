<?php
    class Nota{
        private $cedula;
        private $nombres;
        private $nota1;
        private $nota2;
        private  $promedio;

        

        

        /**
         * Get the value of cedula
         */ 
        public function getCedula()
        {
                return $this->cedula;
        }

        /**
         * Set the value of cedula
         *
         * @return  self
         */ 
        public function setCedula($cedula)
        {
                $this->cedula = $cedula;

                return $this;
        }

        /**
         * Get the value of nombres
         */ 
        public function getNombres()
        {
                return $this->nombres;
        }

        /**
         * Set the value of nombres
         *
         * @return  self
         */ 
        public function setNombres($nombres)
        {
                $this->nombres = $nombres;

                return $this;
        }

        /**
         * Get the value of nota1
         */ 
        public function getNota1()
        {
                return $this->nota1;
        }

        /**
         * Set the value of nota1
         *
         * @return  self
         */ 
        public function setNota1($nota1)
        {
                $this->nota1 = $nota1;

                return $this;
        }

        /**
         * Get the value of nota2
         */ 
        public function getNota2()
        {
                return $this->nota2;
        }

        /**
         * Set the value of nota2
         *
         * @return  self
         */ 
        public function setNota2($nota2)
        {
                $this->nota2 = $nota2;

                return $this;
        }

        /**
         * Get the value of promedio
         */ 
        public function getPromedio()
        {
                return $this->promedio;
        }

        /**
         * Set the value of promedio
         *
         * @return  self
         */ 
        public function setPromedio($promedio)
        {
                $this->promedio = $promedio;

                return $this;
        }
    }
?>