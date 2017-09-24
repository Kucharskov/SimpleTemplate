<?php
/***************************************************************************
 *
 *	SimpleTemplate v1.0
 *	with love by M. Kucharskov (http://kucharskov.pl)
 *
 *	This is free software and it's distributed under Creative Commons BY-NC-SA License.
 *
 *	SimpleTemplate is written in the hopes that it can be useful to people.
 *	It has NO WARRANTY and when you use it, the author is not responsible
 *	for how it works (or doesn't).
 *
 ***************************************************************************/

class SimpleTemplate
{
    private static $_html;
    private static $_marks;

    /**
     * @param $file
     * @param string $view
     *
     * Funkcja pobiera z pliku HTML zawartość dla widoku
     */
    public static function loadHTML($file, string $view = 'default')
    {
        if(file_exists($file))
            self::$_html[$view] = file_get_contents($file);
    }

    /**
     * @param string $string
     * @param string $view
     *
     * Funkcja ustawia podany string jako kod HTML dla widoku
     */
    public static function loadHTMLstring(string $string, string $view = 'default')
    {
        self::$_html[$view] = $string;
    }

    /**
     * @param string $view
     *
     * Funkcja czyści kod HTML widoku
     */
    public static function clearHTML(string $view = 'default')
    {
        self::$_html[$view] = '';
    }

    /**
     * @param string $mark
     * @param $value
     * @param string $view
     *
     * Funkcja ustala znacznik i jego wartość dla widoku
     */
    public static function loadMark(string $mark, string $value, string $view = 'default')
    {
        if(!isset(self::$_marks[$view])) self::$_marks[$view] = [$mark => $value];
        else self::$_marks[$view] = array_merge(self::$_marks[$view], [$mark => $value]);
    }

    /**
     * @param array $marks
     * @param string $view
     *
     * Funkcja ustala znaczniki dla widoku z array'a
     */
    public static function loadMarks(array $marks, string $view = 'default')
    {
        if(!isset(self::$_marks[$view])) self::$_marks[$view] = $marks;
        else self::$_marks[$view] = array_merge(self::$_marks[$view], $marks);
    }

    /*
     * Funkcja czyści znaczniki z wartościami dla widoku
     */
    public static function clearMarks(string $view = 'default')
    {
        self::$_marks[$view] = [];
    }

    /*
     * Funkcja generuje widok podmieniając w kodzie HTML znaczniki na odpowiadające im wartości
     */
    public static function renderView(string $view = 'default', bool $clear = false)
    {
        if(!isset(self::$_html[$view])) throw new Exception("SimpleTemplate error: HTML not loaded for {$view} view!");
        else
        {
            $keys = array_keys(self::$_marks[$view]);
            foreach ($keys as &$key)
                $key = "{{$key}}";
            $html = str_replace($keys, array_values(self::$_marks[$view]), self::$_html[$view]);
            return ($clear) ? preg_replace('/\{+[a-zA-Z0-9]+\}/s', '', $html) : $html;
        }
    }

    /**
     * @param string $view
     * @return array
     *
     * Funkcja zwraca tablicę debugową z informacjami na temat danego widoku:
     *   - loadedHTML - czy załadowano do widoku kod HTML (true/false)
     *   - loadedMarks - czy załadowano do widoku jakiekolwiek znaczniki do podmiany (true/false)
     *   - marksList - lista znaczników do podmiany w widoku (array/null)
     */
    public static function debugView(string $view = 'default')
    {
        return [
            'loadedHTML' => isset(self::$_html[$view]),
            'loadedMarks' => isset(self::$_marks[$view]),
            'marksList' =>  isset(self::$_marks[$view]) ? array_keys(self::$_marks[$view]) : null
        ];
    }
}