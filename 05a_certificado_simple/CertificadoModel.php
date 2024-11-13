<?php
    class CertificadoModel{
        public function generarResultado($cedula,$nombres,$nota1,$nota2){
            //procesamiento de la informacion:
            $promedio=($nota1+$nota2)/2;
            if($promedio>=7){
                $mensaje="$nombres ha aprobado el curso. Promedio: $promedio";
            }else{
                $mensaje="$nombres ha asistido al curso. Promedio: $promedio";
            }
            return $mensaje;
        }
    }
?>