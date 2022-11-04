<?php

namespace Helper;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class Utils
{
    // ********************************************************************
    // REDIRECIONA PARA A PÁGINA DE ERRO DEFAULT
    public function valSession()
    {
        if (!isset($_SESSION['id_usuario'])) {
            header("location: " . URL . "error-controller/error/404");
            exit;
        }
    }

    // ********************************************************************
    // REDIRECIONA PARA A PÁGINA DE ERRO DEFAULT
    public function errorDefault($msgError, $status, $nameButton, $redirect, $sessionDestroy)
    {
        $_SESSION['error'] = [
            'msgError' => $msgError,             // 'Erro S400: Erro ao atualizar foto de perfil'
            'status' => $status,                 // 'Sucesso', 'Erro'
            'nameButton' => $nameButton,         // 'Voltar', 'Sair', 'Login'
            'redirect' => $redirect,             // 'login-controller/index' (CONTROLLER/MÉTODO/PARÂMETRO)
            'sessionDestroy' => $sessionDestroy, // 'S', 'N'
        ];

        header("location: " . URL . "error-controller/error");
        exit;
    }

    // ********************************************************************
    // VALIDA SE O CAMPO ESTÁ VAZIO
    public function valEmpty($string)
    {
        if (!empty($string)) {
            return true;
        }
        return false;
    }

    // ********************************************************************
    // VALIDA SE O CAMPO ULTRAPASSOU O MÁXIMO DE CARACTERES PERMITIDOS
    public function valMinChar($string)
    {
        if ((strlen($string) <= 30)) {
            return true;
        }
        return false;
    }

    // ********************************************************************
    // VALISA SE ESTÁ VAZIO OU PASSOU O MÁXIMO DE CARACTERES PERMITIDOS
    public function vaEmptyMinChar($string)
    {
        if (!empty($string)) {

            if ((strlen($string) <= 30)) {
                return true;
            }
        }
        return false;
    }

    // ********************************************************************
    // VALIDA SE ESTÁ VAZIO, PERMITE SOMENTE LETRAS E ACEITA UM TAMANHO DINÂMICO
    public function valString($string, $qtd)
    {
        if (!empty($string)) {

            if (preg_match("/^[a-zA-Zà-úÀ-Ú\s]*$/", $string)) {

                if ((strlen($string) <= $qtd)) {
                    return true;
                }
            }
        }
        return false;
    }

    // ********************************************************************
    // VALIDA SE ESTÁ VAZIO, SOMENTE LETRAS E NÚMEROS E ACEITA UM TAMANHO DINÂMICO
    public function valStringTwo($string, $qtd)
    {
        if (!empty($string)) {

            if (preg_match("/^[a-zA-Zà-úÀ-Ú0-9\s]*$/", $string)) {

                if ((strlen($string) <= $qtd)) {
                    return true;
                }
            }
        }
        return false;
    }

    // ********************************************************************
    // VALIDA SE ESTÁ VAZIO, PERMITE SOMENTE NÚMEROS, PONTO, HÍFEN E ACEITA UM TAMANHO DINÂMICO
    public function valNumber($string, $qtd, $type = NULL)
    {
        if (!empty($string)) {

            if (preg_match("/^[\d.-]+$/", $string)) {

                if (!isset($type)) {
                    if ((strlen($string) == $qtd)) {
                        return true;
                    }
                } else {
                    if ((strlen($string) <= $qtd)) {
                        return true;
                    }
                }
            }
        }
        return false;
    }

    // ********************************************************************
    // VALIDA SE ESTÁ VAZIO, PERMITE SOMENTE NÚMEROS, BARRA, HÍFEN E ACEITA UM TAMANHO DINÂMICO
    public function valNumberTwo($string, $qtd, $type = NULL)
    {
        if (!empty($string)) {

            if (preg_match("/^[\d\/-]+$/", $string)) {

                if (!isset($type)) {
                    if ((strlen($string) == $qtd)) {
                        return true;
                    }
                } else {
                    if ((strlen($string) <= $qtd)) {
                        return true;
                    }
                }
            }
        }
        return false;
    }

    // ********************************************************************
    // VALIDA EMAIL
    public function valEmail($string)
    {
        if (filter_var($string, FILTER_VALIDATE_EMAIL)) {

            if ((strlen($string) <= 70)) {
                return true;
            }
        }
        return false;
    }

    // ********************************************************************
    // VALIDA SENHA
    public function valPassword($string)
    {
        if (!empty($string)) {

            if (preg_match("/^(?=.*\d)(?=.*[!@#$%^&*])(?=.*[a-z])(?=.*[A-Z]).{8,}$/", $string)) {
                if ((strlen($string) >= 8) and (strlen($string) <= 70)) {
                    return true;
                }
            }
        }
        return false;
    }

    // ********************************************************************
    // VALIDA TELEFONE
    public function valPhone($string)
    {
        if (!empty($string)) {

            if (preg_match("/^[- ()0-9]+$/", $string)) {

                if ((strlen($string) == 14) or (strlen($string) == 15)) {
                    return true;
                }
            }
        }
        return false;
    }
}
