<?php
/***************************************************************************
 *
 *	SimpleTemplate v2.0
 *	with love by M. Kucharskov (http://kucharskov.pl)
 *
 *	This is free software and it's distributed under Creative Commons BY-NC-SA License.
 *
 *	SimpleTemplate is written in the hopes that it can be useful to people.
 *	It has NO WARRANTY and when you use it, the author is not responsible
 *	for how it works (or doesn't).
 *
 ***************************************************************************/

class SimpleTemplate {
    private $_html;
    private $_marks;
	
    /**
     * @param $file
     *
     * Funkcja pobiera z pliku HTML zawartość dla widoku
     */
    public function loadHTML($file) {
        if(file_exists($file))
            $this->_html = file_get_contents($file);
    }

    /**
     * @param string $string
     *
     * Funkcja ustawia podany string jako kod HTML dla widoku
     */
    public function loadHTMLstring(string $string) {
        $this->_html = $string;
    }

    /**
     *
     * Funkcja czyści kod HTML widoku
     */
    public function clearHTML() {
        $this->_html = '';
    }

    /**
     * @param string $mark
     * @param $value
     *
     * Funkcja ustala znacznik i jego wartość dla widoku
     */
    public function loadMark(string $mark, string $value) {
        if(!isset($this->_marks))
			$this->_marks = [$mark => $value];
        else
			$this->_marks = array_merge($this->_marks, [$mark => $value]);
    }

    /**
     * @param array $marks
     *
     * Funkcja ustala znaczniki dla widoku z array'a
     */
    public function loadMarks(array $marks) {
        if(!isset($this->_marks))
			$this->_marks = $marks;
        else
			$this->_marks = array_merge($this->_marks, $marks);
    }

    /*
     * Funkcja czyści znaczniki z wartościami dla widoku
     */
    public function clearMarks() {
        $this->_marks = [];
    }

    /*
     * Funkcja generuje widok podmieniając w kodzie HTML znaczniki na odpowiadające im wartości
     * Ustawienie parametru $clear na true powoduje usunięcie niepodmienionych znaczników z kodu HTML
     */
    public function renderView(bool $clear = false) {
        if(!isset($this->_html)) throw new Exception("SimpleTemplate error: HTML not loaded for {$view} view!");
        else {
            $keys = array_keys($this->_marks);
            foreach ($keys as &$key)
                $key = "{{$key}}";
            $html = str_replace($keys, array_values($this->_marks), $this->_html);
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
    public function debugView() {
        return [
            'loadedHTML' => isset($this->_html),
            'loadedMarks' => isset($this->_marks),
            'marksList' => isset($this->_marks) ? array_keys($this->_marks) : null
        ];
    }
}