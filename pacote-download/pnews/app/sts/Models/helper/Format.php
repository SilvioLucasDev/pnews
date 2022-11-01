<?php

namespace Helper;

if (!defined('URL')) {
    header("Location: /");
    exit();
}

class Format
{
    // ********************************************************************
    // ENCODE STRING EVITANDO INJECTION
    public function encodeString($string)
    {
        $search = array(">", "<", "'", '"', ";", "=", "+", "-", "&", "$", "%", "and", "And", "AND", "or", "Or", "OR", "OR", "where", "Where", "WHERE", "update", "Update", "UPDATED", "select", "Select", "SELECT", "delete", "Delete", "DELETE", "insert", "Insert", "INSERT", "from", "From", "FROM", "table", "Table", "TABLE", "inner", "Inner", "INNER", "join", "Join", "JOIN", "right", "Right", "RIGHT", "left", "Left", "LEFT", "on", "On", "ON", "group", "Group", "GROUP", "order", "Order", "ORDER", "by", "By", "BY", "drop", "Drop", "DROP");

        // Show, Data Base, DESC, ASC, DESC, alter, having, IN, NOT, NULL, Distinct, Count, Sum, Min, Max, avg, grant, all, privileges, limit, offset, *, between, USE, ROOT, PASS, SET, values, truncate, if, case, trim, ltrim, rtrim, concat, format, date, year, month, day, hour, minute, second, CREATE

        $replace = array("ma1100r", "m33n00r", "a55p55imp", "a55pDupl@@", "p00ntV11r", "11gu@0l", "m@@11s", "m33n00s", "ecomercial", "c11fr@@o", "p00rc33nto", "@@nnd",  "@@nnD", "@@NND", "00rr", " 00rrR", "00RR", "wh33r33", "Wh33r33", "WH33R33", "upd@@t33", "Upd@@t33", "UPD@@T33", "s33l33ct", "S33l33ct", "S33L33CT", "d33l33t33", "D33l33t33", "D33L33T33", "11ns33rt", "11ns33rT", "11NS33RT", "fr00m", "Fr00m", "FR00M", "t@@bl33", "T@@bl33", "T@@BL33", "11nn33r", "11ne33R", "11NN33R", "j0011n", "J0011n", "J0011N", "r11ght", "R11ght", "R11GHT", "l33ft", "L33ft", "L33FT",  "00n", "00NN", "00N", "gr00up", "Gr00up", "GR00UP", "00rd33r", "00rd33R", "00RD33R", "b11", "BB11", "B11", "dr00p", "Dr00p", "DR00P");
        return $string = str_replace($search, $replace, $string);
    }

    // ********************************************************************
    // DECODE STRING EVITANDO INJECTION
    public function decodeString($string)
    {
        $search = array("ma1100r", "m33n00r", "a55p55imp", "a55pDupl@@", "p00ntV11r", "11gu@0l", "m@@11s", "m33n00s", "ecomercial", "c11fr@@o", "p00rc33nto", "@@nnd",  "@@nnD", "@@NND", "00rr", " 00rrR", "00RR", "wh33r33", "Wh33r33", "WH33R33", "upd@@t33", "Upd@@t33", "UPD@@T33", "s33l33ct", "S33l33ct", "S33L33CT", "d33l33t33", "D33l33t33", "D33L33T33", "11ns33rt", "11ns33rT", "11NS33RT", "fr00m", "Fr00m", "FR00M", "t@@bl33", "T@@bl33", "T@@BL33", "11nn33r", "11ne33R", "11NN33R", "j0011n", "J0011n", "J0011N", "r11ght", "R11ght", "R11GHT", "l33ft", "L33ft", "L33FT",  "00n", "00NN", "00N", "gr00up", "Gr00up", "GR00UP", "00rd33r", "00rd33R", "00RD33R", "b11", "BB11", "B11", "dr00p", "Dr00p", "DR00P");

        $replace = array(">", "<", "'", '"', ";", "=", "+", "-", "&", "$", "%", "and", "And", "AND", "or", "Or", "OR", "OR", "where", "Where", "WHERE", "update", "Update", "UPDATED", "select", "Select", "SELECT", "delete", "Delete", "DELETE", "insert", "Insert", "INSERT", "from", "From", "FROM", "table", "Table", "TABLE", "inner", "Inner", "INNER", "join", "Join", "JOIN", "right", "Right", "RIGHT", "left", "Left", "LEFT", "on", "On", "ON", "group", "Group", "GROUP", "order", "Order", "ORDER", "by", "By", "BY", "drop", "Drop", "DROP");
        return $string = str_replace($search, $replace, $string);
    }

    // ********************************************************************
    // REMOVE SOMENTE ACENTOS POUCOS USADOS PT-BR
    public function removeAccents($string)
    {
        $search = array("Ä", "Å", "Æ",  "Ë", "Î", "Ï", "Ð", "Ñ", "Ö", "Ø", "Ù", "Ú", "Û", "Ü", "ü", "Ý", "Þ", "ß", "ä", "å", "æ", "ë", "í", "î", "ï", "ñ", "ö", "ø", "ù", "ú", "û", "ý", "ý", "þ", "ÿ");

        $remover = array("A", "A", "A", "E", "I", "I", "D", "N", "O", "O", "U", "U", "U", "U", "u", "Y", "B", "S", "a", "a", "a", "e", "i", "i", "i", "n", "o", "o", "u", "u", "u", "y", "y", "b", "y");
        return str_replace($search, $remover, $string);
    }

    // ********************************************************************
    // REMOVE TODOS ACENTOS DA STRING
    public function removeAllAccents($string)
    {
        $search = array("À", "Á", "Â", "Ã", "Ä", "Å", "Æ", "Ç", "È", "É", "Ê", "Ë", "Ì", "Í", "Î", "Ï", "Ð", "Ñ", "Ò", "Ó", "Ô", "Õ", "Ö", "Ø", "Ù", "Ú", "Û", "Ü", "Ý", "Þ", "ß", "à", "á", "â", "ã", "ä", "å", "æ", "ç", "è", "é", "ê", "ë", "ì", "í", "î", "ï", "ð", "ñ", "ò", "ó", "ô", "õ", "ö", "ø", "ù", "ú", "û", "ü", "ý", "þ", "ÿ");

        $replace = array("A", "A", "A", "A", "A", "A", "A", "C", "C", "E", "E", "E", "I", "I", "I", "I", "D", "N", "O", "O", "O", "O", "O", "O", "U", "U", "U", "U", "Y", "B", "S", "a", "a", "a", "a", "a", "a", "a", "c", "e", "e", "e", "e", "i", "i", "i", "i", "o", "n", "o", "o", "o", "o", "o", "o", "u", "u", "u", "u", "y", "b", "y");
        return str_replace($search, $replace, $string);
    }

    // ********************************************************************
    // REMOVE CARACTERES ESPECIAIS DA STRING
    public function removeSpecialChar($string)
    {
        $search = array("!", "@", "#", "$", "%", "&", "*", "(", ")", "_", "+", "=", "{", "[", "}", "]", "?", ";", ":", ".", ",", "'.\.'", "'", "<", ">", "°", "º", "ª", '"', "/");
        $replace = array("", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "",  "", "", "", "", "", "", "", "", "", "", "", "", "");
        return str_replace($search, $replace, $string);
    }

    // ********************************************************************
    // FUNÇÃO PARA FORMATAR COORDENADAS 
    public function formatCoords($string)
    {                                                      // (-23.647848381080646, -46.45407951552733)
        $search = array("(", ")", " ");
        $replace = array("");
        $string = str_replace($search, $replace, $string); // -23.647848381080646,-46.45407951552733

        return explode(",", $string);                       // [0] => -23.647848381080646 [1] => -46.45407951552733
    }

    // ********************************************************************
    // FORMATA A DATA PARA O PADRÃO BR
    function formatDateBr($date)
    {
        return date('d/m/Y', strtotime($date));
    }

    // ********************************************************************
    // FORMATA DATA PARA O PADRÃO US
    function formatDateUs($date)
    {
        return implode('-', array_reverse(explode('/', $date)));

        // return date('Y-m-d', strtotime($date));
    }

    // ********************************************************************
    // MÁSCARA DE DADOS

    // $cnpj = '11222333000199';
    // echo mask($cnpj, '##.###.###/####-##').'<br>';

    // $cpf = '00100200300';
    // echo mask($cpf, '###.###.###-##').'<br>';

    // $cep = '08665110';
    // echo mask($cep, '#####-###').'<br>';

    // $data = '10102010';
    // echo mask($data, '##/##/####').'<br>';

    // $hora = '021050';
    // echo mask($hora, 'Agora são ## horas ## minutos e ## segundos').'<br>';
    // echo mask($hora, '##:##:##');

    public function maskAllData($string, $mask)
    {
        $string =  strval($string);
        $maskared = '';

        $k = 0;
        for ($i = 0; $i <= strlen($mask) - 1; ++$i) {
            if ($mask[$i] == '#') {
                if (isset($string[$k])) {
                    $maskared .= $string[$k++];
                }
            } else {
                if (isset($mask[$i])) {
                    $maskared .= $mask[$i];
                }
            }
        }

        return $maskared;
    }

    // ********************************************************************
    // MÁSCARA PARA OCULTAR DOCUMENTOS RG E CPF
    public function docMask($string, $type = 'cpf')
    {
        $string = $this->onlyNumbers($string);

        if (strtolower($type) == 'cnpj') {
            $string = $this->maskAllData($string, '##.###.###/####-##');
            return substr_replace($string, '***.***/****', 3, -3);
        } else {
            $string = $this->maskAllData($string, '###.###.###-##');
            return substr_replace($string, '.***.***-', 3, -2);
        }
    }

    // ********************************************************************
    // PERMITE SOMENTE NÚMEROS NA STRING
    public function onlyNumbers($string)
    {
        return preg_replace("/\D+/", "", $string);
    }

    // ********************************************************************
    // FORMATA O NÚMERO PARA DÓLAR OU REAL
    public function formatCoin($string, $type = "real", $symbol = false)
    {
        $string = $this->onlyNumbers($string);

        if ($type == "real" || $type == "REAL") {
            return $string = ($symbol == TRUE ? 'R$ ' : '') . number_format($string, 2, ",", ".");
        } else {
            return $string = ($symbol == TRUE ? '$ ' : '') . number_format($string, 2, ".", ",");
        }
    }
}
