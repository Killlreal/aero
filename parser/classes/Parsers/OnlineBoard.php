<?php

namespace Parsers;

// use Orm\Mappers\AccountMapper;
// use Orm\Models\AccountModel;


class OnlineBoard extends Parser
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

            $sql_start = "INSERT INTO `flightboard_online` (`st1`, `company`, `flight`, `airport_departure`, `airport_arrival`, `at1`, `remark`, `craft`, `sd1`, `ad1`, `st2`, `sd2`, `at2`, `ad2`,`lineHash`) VALUES ";
            $sql = rtrim(file_get_contents(__PARSER_DIR.'/sql_account.txt'), ",");
            $sql_end =" ON DUPLICATE KEY UPDATE `st1` = VALUES(`st1`), `company` = VALUES(`company`), `flight` = VALUES(`flight`), `airport_departure` = VALUES(`airport_departure`), `airport_arrival` = VALUES(`airport_arrival`), `at1` = VALUES(`at1`), `remark` = VALUES(`remark`), `craft` = VALUES(`craft`), `sd1` = VALUES(`sd1`), `ad1` = VALUES(`ad1`), `st2` = VALUES(`st2`), `sd2` = VALUES(`sd2`), `at2` = VALUES(`at2`), `ad2` = VALUES(`ad2`), `linehash` = VALUES(`linehash`);"; 
            $stm = $this->pdo->prepare($sql_start.$sql.$sql_end);
            // var_dump($stm);
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
        $accountArray = explode('|', $line);

        $param = [];
        $param['st1'] = (($accountArray[1] == '') || ($accountArray[1] == ' ')) ? 'NULL' : "'".$accountArray[0]."'";
        $param['company'] = (($accountArray[1] == '') || ($accountArray[1] == ' ')) ? 'NULL' : "'".$accountArray[1]."'";
        $param['flight'] = (($accountArray[2] == '') || ($accountArray[2] == ' ')) ? 'NULL' : "'".$accountArray[2]."'";
        if ($this->type == 'departure'){
            $param['airport_departure'] = "'АРХАНГЕЛЬСК'";
            $param['airport_arrival'] = (($accountArray[3] == '') || ($accountArray[3] == ' ')) ? 'NULL' : "'".$accountArray[3]."'";

        } else if ($this->type == 'arrival'){
            $param['airport_departure'] = (($accountArray[3] == '') || ($accountArray[3] == ' ')) ? 'NULL' : "'".$accountArray[3]."'";
            $param['airport_arrival'] = "'АРХАНГЕЛЬСК'";
        } else {
            echo "Unsupported parse type: ".$this->type;
            die();
        }
        $param['at1'] = (($accountArray[4] == '') || ($accountArray[4] == ' ')) ? 'NULL' : "'".$accountArray[4]."'";
        $param['remark'] = (($accountArray[5] == '') || ($accountArray[5] == ' ')) ? 'NULL' : "'".$accountArray[5]."'";
        $param['craft'] = (($accountArray[6] == '') || ($accountArray[6] == ' ')) ? 'NULL' : "'".$accountArray[6]."'";
        $param['sd1'] = (($accountArray[7] == '') || ($accountArray[7] == ' ')) ? 'NULL' : $this->stringToDate($accountArray[7]);
        $param['ad1'] = (($accountArray[8] == '') || ($accountArray[8] == ' ')) ? 'NULL' : $this->stringToDate($accountArray[8]);
        $param['st2'] = (($accountArray[9] == '') || ($accountArray[9] == ' ')) ? 'NULL' : "'".$accountArray[9]."'";
        $param['sd2'] = (($accountArray[10] == '') || ($accountArray[10] == ' ')) ? 'NULL' : $this->stringToDate($accountArray[10]);
        $param['at2'] = (($accountArray[11] == '') || ($accountArray[11] == ' ')) ? 'NULL' : "'".$accountArray[11]."'";
        $str = preg_replace('/[\x00-\x1F\x7F]/u', '',$accountArray[12]);
        $param['ad2'] =  (($str == '') || ($str == ' ')) ? 'NULL' : $this->stringToDate($str);
        $param['lineHash'] = "'".md5($line)."'";

        $sql = "(".implode(', ', $param)."),";

        file_put_contents(__PARSER_DIR.'/sql_account.txt', $sql ,FILE_APPEND);
        
    }
}
