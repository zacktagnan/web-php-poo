<?php

namespace Libs;

class Utilities
{
    /**
     * Formatting a string to an array by their \n
     *
     * @param String $data
     * @return array
     */
    public function formatToArray(String $data)
    {
        $patron = "\r\n";
        //$data = preg_split('/\\r\\n/', $data);
        $data   = str_replace($patron, ':|:', $data);

        $patron           = ':|::|:';
        $arrayData_temp   = explode($patron, $data);

        $arrayData   = [];
        $patron      = ':|:';
        foreach ($arrayData_temp as $item) {
            $arrayData[] = str_replace($patron, '<br>', $item);
        }

        return $arrayData;
    }

    /**
     * Formatting a string from a textarea to BD
     * Applying <P> tags and \n
     *
     * @param array $arrayData
     * @return String
     */
    public function formatFromTextAreaToBD(array $arrayData)
    {
        return '<p>' . implode('</p>' . "\n" . '<p>', $arrayData) . '</p>';
    }

    /**
     * Replacing HTML line breaks with \n
     *
     * @param String $data
     * @return String
     */
    public function formatFromBDToTextArea(String $data)
    {
        return implode('', explode("\r\n", str_replace('<br>', "\n", str_replace('</p>', "\r\n\n", str_replace('<p>', '', $data))), -1));
    }

    /**
     * Generating a random string
     *
     * @param integer $length
     * @return String
     */
    public function generateRandomString($length = 10)
    {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
    }

    /**
     * Formating value
     *
     * @param string $data
     * @return String
     */
    public function formatData(string|null $data): string
    {
        $data = trim($data ?? '');
        $data = addslashes($data);
        $data = htmlspecialchars($data);

        return $data;
    }

    /**
     * Formating Array
     *
     * @param array $data
     * @return Array
     */
    public function formatArrayData(array $data): array
    {
        foreach ($data as $k => $v) {
            $data[$k] = $this->formatData($v);
        }

        return $data;
    }

    public function redirectTo(string $path): void
    {
        // $urlRedirect = sprintf(
        //     '%s%s', getBaseURL(), $path);
        // header("Location: {$urlRedirect}");
        // -----------------------------------------
        // $urlRedirect = sprintf(
        //     '%s%s', getBaseURL(), $path);
        header("Location: {$path}");
    }
}
