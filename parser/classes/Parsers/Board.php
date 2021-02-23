<?php

namespace Parsers;

// use Orm\Mappers\AccountMapper;
// use Orm\Models\AccountModel;


class Board extends Parser
{ 

    public function getChunk(&$lineGenerator, $batch = 10000)
     {
         $store  = [];
         $i=0;
        while($lineGenerator->valid()) {
            $key = $lineGenerator->key();
            $line = $lineGenerator->current();  
            $lineGenerator->next();
            
            $line = trim($line)."\x00";

            $line = mb_convert_encoding($line , 'UTF-8' , 'windows-1251');

            $line = str_replace('﻿','', $line);
            if(!$line)
                continue;

            $store[] = $line;
            $i++;
            if($i>10000) return $store;
        }
        // var_dump($store);
        return $store;
     }

     public function parse()
    {
        echo self::class . "\n";

        unlink(__PARSER_DIR.'/sql_account.txt');

        $lineGenerator = $this->createFileLinesGenerator($this->pathToFile);

        // var_dump($lineGenerator);
        
        while($store = $this->getChunk($lineGenerator, $batch = 10000))
        {
            file_put_contents(__PARSER_DIR.'/sql_account.txt', '');

            // echo file_get_contents(__PARSER_DIR.'/sql_account.txt');

            foreach($store as $val)
            {
                $this->parseOneByLine($val);
            }

            $sql_start = "INSERT INTO `flightboard` (`airport_departure`, `airport_arrival`, `period`, `craft`, `flight`, `frequency`, `time_departure`, `time_arrival`, `lineHash`) VALUES ";
            $sql = rtrim(file_get_contents(__PARSER_DIR.'/sql_account.txt'), ",");
            $sql_end =" ON DUPLICATE KEY UPDATE `airport_departure` = VALUES(`airport_departure`), `airport_arrival` = VALUES(`airport_arrival`), `period` = VALUES(`period`), `craft` = VALUES(`craft`), `flight` = VALUES(`flight`), `frequency` = VALUES(`frequency`), `time_departure` = VALUES(`time_departure`), `time_arrival` = VALUES(`time_arrival`), `lineHash` = VALUES(`lineHash`);"; 
            $stm = $this->pdo->prepare($sql_start.$sql.$sql_end);
            //var_dump($stm);
            $result = $stm->execute();
            if(!$result){
                echo $sql_start.$sql.$sql_end;
                die(var_dump($stm->errorInfo()));

            }
            print_r("OK\n");
        } 
    }

    private function quote(string $str)
    {
        return '\''.addslashes($str).'\'';
    }

    private function parseOneByLine(string $line)
    {
        $accountArray = explode(',', $line);

        echo $this->type;

        $param = [];
        if ($this->type == 'departure'){
            $param['airport_departure'] = "'Архангельск'";
            $param['airport_arrival'] = "'".$accountArray[0]."'";

        } else if ($this->type == 'arrival'){
            $param['airport_departure'] = "'".$accountArray[0]."'";
            $param['airport_arrival'] = "'Архангельск'";
        } else {
            echo "Unsupported parse type: ".$this->type;
            die();
        }
        $param['period'] = "'".$accountArray[1]."'";
        $param['craft'] = "'".$accountArray[3]."'";
        $param['flight'] = "'".$accountArray[4]."'";
        $param['frequency'] = "'".$accountArray[5]."'";
        $param['time_departure'] = "'".$accountArray[6]."'";
        $param['time_arrival'] = "'".preg_replace('/[\x00-\x1F\x7F]/u', '',$accountArray[7])."'";
        $param['lineHash'] = "'".md5($line)."'";



        $sql = "(".implode(', ', $param)."),";

        file_put_contents(__PARSER_DIR.'/sql_account.txt', $sql ,FILE_APPEND);
        
    }
}
