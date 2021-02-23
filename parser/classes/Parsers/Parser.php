<?php 

namespace Parsers;

use Exceptions\FileNotFoundException;
use Exceptions\InvalidFileException;
use Orm\Connection;

class Parser
{
    private const ALLOWED_MIME_TYPES = [
        'text/plain',
    ];

    private $handle;
    protected $pathToFile;
    protected $errorLines;
    public $connection;
    public $pdo;
    public $type;

    public function __construct(string $pathToFile, $type)
    {
        //$this->checkFile($pathToFile);
        $this->type = $type;
        $this->pathToFile = $pathToFile;
        $this->connection = new Connection();
        $this->pdo = $this->connection->getPdo();
    }

    public function __destruct()
    {   
        if (is_resource($this->handle) === true) {
            fclose($this->handle);
        }
    }

    protected function stringToDate($date){
        [$day, $month, $year] = explode('.', $date);
        return "'{$year}-{$month}-{$day}'";
    }

    private function checkFile(string $pathToFile)
    {
        try {
            $this->checkFileExist($pathToFile);
            $this->checkFileMimeType($pathToFile);
        } catch (FileNotFoundException $error) {
            $error->printError();
        } catch (InvalidFileException $error) {
            $error->printError();
        } catch (\Exception $error) {
            print_r($error->getMessage() . "\n");
            print_r($error->getTraceAsString() . "\n");
        }
    }

    private function checkFileExist(string $pathToFile)
    {
        if (!file_exists($pathToFile)) {
            throw new FileNotFoundException(
                'File on path "'.$pathToFile.'" not found'
            );
        } 
    }

    private function checkFileMimeType(string $pathToFile)
    {
        $fileMimeType = mime_content_type($pathToFile);
        if (!in_array($fileMimeType, self::ALLOWED_MIME_TYPES)) {
            throw new InvalidFileException(
                'Invalid file mime type. Found "'
                .$fileMimeType.'"'
            );
        }
    }

    protected function createFileLinesGenerator(string $pathToFile) : \Generator
   {
	$this->handle = fopen($pathToFile, 'r');
    fgets($this->handle);
	while (!feof($this->handle)){
	    $line = fgets($this->handle);

            if ($line[0] == '#') continue;

            if (!preg_match('/\n/', strval($line)))
                continue;

            if ($line != '') {
                yield $line;
            }
        }
        
        fclose($this->handle);
    }

    protected function isLineValid(string $line, $exp) : bool
    {
        if (!preg_match($exp, $line)) {
            return false;
        }
        return true;
    }
}
