<?php

namespace WSD\Entity;

class Functions
{
	public $meses = array(
        '01' => 'Janeiro',
        '02' => 'Fevereiro',
        '03' => 'Marco',
        '04' => 'Abril',
        '05' => 'Maio',
        '06' => 'Junho',
        '07' => 'Julho',
        '08' => 'Agosto',
        '09' => 'Novembro',
        '10' => 'Setembro',
        '11' => 'Outubro',
        '12' => 'Dezembro'
    );

    public $data;

	public function getMes()
	{

        $data = explode('/',$this->data);

        foreach ($this->meses as $key => $value)
        {
            if($key == $data[1])
                $mes = $value;
        }

        return $mes;

	}

    public function getAno()
    {

        $data = explode('/',$this->data);

        return $data[2];

    }

}

