<?php

namespace Helper;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class Utils
{
    /********************************************************************/
    // REDIRECIONA PARA A PÁGINA DE ERRO DEFAULT
    public function errorDefault($msgError, $action, $nameButton, $redirect, $sessionDestroy)
    {
        $_SESSION['error'] = [
            'msgError' => $msgError,             // 'Erro S400: Erro ao atualizar foto de perfil'
            'action' => $action,                 // 'Sucesso', 'Erro'
            'nameButton' => $nameButton,         // 'Voltar', 'Sair', 'Login'
            'redirect' => $redirect,             // 'login-controller/index' (CONTROLLER/MÉTODO/PARÂMETRO)
            'sessionDestroy' => $sessionDestroy, // 'S', 'N'
        ];

        header("location: " . URL . "error-controller/error");
        exit;
    }

    /********************************************************************/
    // VALIDA EMAIL RETORNA TRUE OU FALSE
    public function valEmail($email)
    {
        // REMOVE OS CARACTERES E DEIXA O E-MAIL VÁLIDO
        // $email = filter_var($email, FILTER_SANITIZE_EMAIL);

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }

    /********************************************************************/
    // FUNÇÃO PARA FORMATAR COORDENADAS 
    public function formatCoords($string)
    {                                       // (-23.647848381080646, -46.45407951552733)
        $search = array("(", ")", " ");  
        $replace = array("");            
        $string = str_replace($search, $replace, $string); // -23.647848381080646,-46.45407951552733

        return explode(",", $string);   // [0] => -23.647848381080646 [1] => -46.45407951552733
    }
}
