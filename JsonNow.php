<?php

interface JsonNowInterface{
    public function config(array $arr);
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
    const DATA = ['jhon', 'jack', 'can'];
    public static function size($size)
    {
        self::$size = $size;
        return new self;
    }

    public function name()
    {
        array_push($this->prop, 'name');
        return $this;
    }

    public function id()
    {
        array_push($this->prop, 'id');
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
            if ($propName == 'name' || $propName == 'id'||$propName=='age') {
                self::push($propName);
            }

        }
        return json_encode($this->JS, JSON_UNESCAPED_UNICODE);
    }

    //ADDING ARRAY
    public function push($prop)
    {
        for ($t = 0; $t <= self::$size; $t++) {
            switch ($prop) {
                case 'id':
                    $this->JS[$t][$prop] = $t;
                    break;

                case 'name':
                    $this->JS[$t][$prop] = JSONX::DATA[array_rand(JSONX::DATA)];
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
