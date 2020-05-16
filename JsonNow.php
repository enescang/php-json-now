<?php

interface JsonNowInterface
{
    public static function size(int $size);
    public function config(array $arr);
    public function addProp(...$str);
    public function push(string $prop);
    public function json();
}

class JSONX implements JsonNowInterface
{
    public static $size;
    public $JS;
    public $prop = [];
    public $settings = [
        'minAge' => 3,
        'maxAge' => 5
    ];
    const NAMES = ['jhon', 'jack', 'can'];

    public static function size(int $size)
    {
        if ($size < 1) {
            throw new Exception("Size must at least 1.");
        }
        self::$size = $size;
        return new self;
    }

    public function addProp(...$prop)
    {
        foreach ((array) $prop as $key => $value) {
            array_push($this->prop, $value);
        }
        return $this;
    }

    public function config(array $conf)
    {
        $this->prop = $conf['prop'];
        $this->settings = $conf['settings'];
        return $this;
    }



    public function json()
    {
        $arr = $this->prop;
        for ($i = 0; $i < count($arr); $i++) {
            $propName = $arr[$i];
            if ($propName == 'name' || $propName == 'id' || $propName == 'age') {
                self::push($propName);
            }
        }

        return json_encode($this->JS, JSON_UNESCAPED_UNICODE);
    }

    //ADDING ARRAY
    public function push(string $prop)
    {
        for ($t = 0; $t <= self::$size; $t++) {
            switch ($prop) {
                case 'id':
                    $this->JS[$t][$prop] = $t;
                    break;

                case 'name':
                    if (in_array("name", (array) $this->settings['upper'])) {
                        $this->JS[$t][$prop] = strtoupper(JSONX::NAMES[array_rand(JSONX::NAMES)]);
                    } else if (in_array("name", (array) $this->settings['lower'])) {
                        $this->JS[$t][$prop] = strtolower(JSONX::NAMES[array_rand(JSONX::NAMES)]);
                    } else {
                        $this->JS[$t][$prop] = JSONX::NAMES[array_rand(JSONX::NAMES)];
                    }
                    break;

                case 'age':
                    $this->JS[$t][$prop] = rand($this->settings['minAge'], $this->settings['maxAge']);
                    break;

                default:
                    break;
            }
        }
    }
    //ADDING ARRAY

}
