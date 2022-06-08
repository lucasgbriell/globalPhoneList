<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer';
    protected $fillable = ['name', 'phone'];
    public $timestamps = false;

    const FLAGS = [
        '55'  => '🇧🇷',
        '212' => '🇲🇦',
        '237' => '🇨🇲',
        '251' => '🇪🇹',
        '256' => '🇺🇬',
        '258' => '🇲🇿',
    ];

    public function getDDD(){
        $ddd = explode(' ', trim($this->phone));
        return $this->removeParentheses($ddd[0]);
    }

    public function getFlag() {
        return self::FLAGS[$this->getDDD()] . " + " . $this->getDDD();
    }

    public function getRegex(){
        switch($this->getDDD()){
            case 55:
                return '/(55)\d{2}\d{4}\d{4,5}\b/';
            
            case 212:
                return '/(212)\ ?[5-9]\d{8}\b/';
            
            case 237:
                return '/(237)\ ?[2368]\d{7,8}$\b/';
    
            case 251:
                return '/(251)\ ?[1-59]\d{8}$\b/';
    
            case 256:
                return '/(256)\ ?\d{9}$\b/';
            
            case 258:
                return '/(258)\ ?[28]\d{7,8}$\b/';
    
            default:
                return '/(55) \d{2}\d{4}\d{4}\b/';
        }
    }

    public function isValid() {
        if(preg_match($this->getRegex(), $this->removeParentheses($this->phone))){
            return true;
        }

        return false;
    }

    public function removeParentheses($num){
        return strtr($num, [
            '(' => '',
            ')' => '',
            ' ' => ''
        ]);
    }
    
}
