<?php

namespace App;

use App\Http\Requests\Request;
use Illuminate\Database\Eloquent\Model;


class Patient extends Model
{
    protected $defaults = array(
        'balance' => 10000,
    );

    public function __construct(array $attributes = array())
    {
        $this->setRawAttributes($this->defaults, true);
        parent::__construct($attributes);
    }

    protected $table = "patient";
    protected $primaryKey = "patient_id";

    public function minusTime($timeCall){
        $unit           = \App\Config::where('id', 2)->first();
        $unit           = (!empty($unit))? intval($unit->content) : 1000;
        $this->balance  -= CEIL($timeCall*$unit);
    }

    public function minusTimeV2($unit, $timeCall){
        $unit           = (!empty($unit))? intval($unit) : 1000;
        $this->balance  -= CEIL($timeCall*$unit);
    }

    public function minusTimeMessage($timeCall){
        $unit           = \App\Config::where('id', 3)->first();
        $unit           = (!empty($unit))? intval($unit->content) : 1000;
        $this->balance  -= CEIL($timeCall*$unit);
    }

    public function createRecharge($quantity){
        $recharge = new Recharge();
        $recharge->patient_id = $this->patient_id;
        $recharge->quantity = $quantity;
        $recharge->save();
    }

    public function recharges(){
        $items = \App\Recharge::where('patient_id', $this->patient_id)->orderBy('recharge_id', 'desc')->paginate(10);
        return $items;
    }
}
